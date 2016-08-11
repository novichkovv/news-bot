<?php
/**
 * Created by PhpStorm.
 * User: asus1
 * Date: 22.05.2016
 * Time: 22:20
 */
class feed_class extends base
{
    public function getArticles($article_ids)
    {
        $res = [];
        $articles = [];
        $tmp = $this->model('articles')->getByFieldIn('entry_id', $article_ids, true);
        foreach ($tmp as $article) {
            $articles[$article['entry_id']] = $article;
        }
        $new_articles = [];
        foreach ($article_ids as $id) {
            if(!$articles[trim($id)]) {
                $new_articles[] = $id;
            } else {
                $res[$id] = $articles[$id];
            }
        }
        if($new_articles) {
            require_once(ROOT_DIR . 'classes' . DS . 'simple_html_dom_class.php');
            $tmp = $this->api()->getEntries($new_articles);
            $this->writeLog('test', $tmp);
            foreach ($tmp as $article) {
                if(!$article['id']) {
                    continue;
                }
                $content = $article['content']['content'];
                if(!$article['content']['content']) {
                    $content = $article['summary']['content'];
                } else {
                    $row['summary'] = $article['summary']['content'];
                }
                $html = str_get_html($content);
                $content = $html->root;
                $thumb = $content->find('img')[0]->src;
                $image = '';
//                if($thumb) {
//                    if($size = getimagesize($thumb)) {
//                        if($size[0] > 100 && $size[1] > 100) {
//                            $image = $thumb;
//                            $this->writeLog('test', $image);
//                        }
//                    }
//                }
                @$content->find('img')[0]->outertext = '';
                if(!$feed_id = $this->model('feeds')->getByField('feed_id', $article['origin']['streamId'])['id']) {
                    $res = $this->getFeeds([$article['origin']['streamId']]);
                    $feed_id = $res[array_keys($res)[0]];
                }
                $row = [];
                $row['entry_id'] = $article['id'];
                $row['stream_id'] = $article['origin']['streamId'];
                $row['feed_id'] = $feed_id;
                $row['thumbnail'] = $thumb;
                $row['content'] = $content ? $content : '';
                $row['title'] = $article['title'] ? $article['title'] : '';
                $row['keywords'] = $article['keywords'] ? implode(',', $article['keywords']) : '';
                $row['author'] = $article['author'] ? $article['author'] : '';
                $row['publish_date'] = date('Y-m-d H:i:s', round($article['published']/1000));
                $row['source_url'] = $article['canonicalUrl'] ? $article['canonicalUrl'] : '';
                $row['create_date'] = date('Y-m-d H:i:s');
                $row['id'] = $this->model('articles')->insert($row);
                $res[$row['entry_id']] = $this->model('articles')->getById($row['id']);
            }
        }
        return $res;
    }

    public function getUserMix()
    {

        $mix = $this->model('user_mixes')->getByField('user_id', registry::get('user')['id'], true);
        if(time() - strtotime($mix[0]['create_date']) > MIX_UPDATE) {
            $stream = 'user/' . registry::get('user')['feedly_id'] . '/category/global.all';
            $tmp = $this->api()->getMix($stream);
            $this->model('user_mixes')->delete('user_id', registry::get('user')['id']);
            $ids = [];
            $date = date('Y-m-d H:i:s');
            $user_mix = [];
            foreach ($tmp['items'] as $item) {
                $article = $this->getCheckedArticle($item);
                $user_mix[] = ['user_id' => registry::get('user')['id'], 'article_id' => $article['id'], 'create_date' => $date];
                $ids[] = $article['id'];
            }
            $this->model('user_mixes')->insertRows($user_mix);
        } else {
            $ids = [];
            foreach ($mix as $v) {
                $ids[] = $v['article_id'];
            }
        }
        $articles = $this->model('articles')->getArticles($ids);
        return $articles;
    }

    public function getCheckedMix($stream_id)
    {

        $tmp = $this->api()->getMix($stream_id);
        $res = [];
        foreach ($tmp['items'] as $item) {
            $res[] = $this->getCheckedArticle($item);
        }
        foreach ($res as $v) {

        }

        return $res;

    }

    public function getFeeds($feeds_ids)
    {
        $res = [];
        $feeds = [];
        $tmp = $this->model('feeds')->getByFieldIn('feed_id', $feeds_ids, true);
        foreach ($tmp as $v) {
            $feeds[$v['feed_id']] = $v;
        }
        $new_feeds = [];
        $feeds_to_update = [];
        foreach ($feeds_ids as $id) {
            if(!$feeds[$id]) {
                $new_feeds[] = $id;
            } else {
                if(time() - $feeds[$id]['last_update'] >= FEED_UPDATE) {
                    $feeds_to_update[] = $id;
                } else {
                    $res[$id] = $feeds[$id];
                }
            }
        }

        foreach ($this->api()->getFeeds(array_merge($new_feeds, $feeds_to_update)) as $feed) {
            if($feeds_to_update[$feed['id']]) {
                $row['id'] = $feeds[$feed['id']]['id'];
            }
            $row['feed_id'] = $feed['id'];
            $row['title'] = $feed['title'];
            $row['description'] = $feed['description'];
            $row['velocity'] = $feed['velocity'];
            $row['subscribers'] = $feed['subscribers'];
            $row['icon_url'] = $feed['iconUrl'];
            $row['cover_url'] = $feed['coverUrl'];
            $row['visual_url'] = $feed['visualUrl'];
            $row['last_update'] = date('Y-m-d H:i:s');
            if(!$row['feed_id']) {
                return false;
            }
            $row['id'] = $this->model('feeds')->insert($row);
            if(!$feeds_to_update[$feed['id']]) {
                $this->model('user_feeds')->insert([
                    'user_id' => registry::get('user')['id'],
                    'feed_id' => $row['id']
                ]);
            }
            $this->model('feed_tags')->delete('feed_id', $feed['id']);
            foreach ($feed['topics'] as $tag) {
                $this->model('feed_tags')->insert(array(
                    'feed_id' => $row['id'],
                    'tag_name' => $tag
                ));
            }
            $res[$row['feed_id']] = $feed['id'];
        }
        return $res;
    }

    public function subscribeToTag($tag_name)
    {
        $tag = $this->model('tags')->getByField('tag_name', $tag_name);
        if($tag && $user_tag = $this->model('user_tags')->getByFields(array('user_id' => registry::get('user')['id'], 'tag_id' => $tag['id']))) {
            return true;
        }
        if(!$tag || time() - $tag['last_update'] >= TAG_UPDATE) {
            $tag['tag_name'] = $tag_name;
            $tag['last_update'] = date('Y-m-d H:i:s');
            $tag['id'] = $this->model('tags')->insert($tag);
            $mix = $this->api()->getMix('topic/' . $tag_name, 20, true, 24, registry::get('user')['locale'])['items'];
            $feeds_to_subscribe = [];
            if($mix) {
                require_once(ROOT_DIR . 'classes' . DS . 'simple_html_dom_class.php');
                $this->model('tag_query_results')->delete('tag_id', $tag['id']);
                foreach ($mix as $article) {
                    $article = $this->getCheckedArticle($article);
                    $feeds_to_subscribe[$article['stream_id']] = $article['stream_id'];
                    $row = [];
                    $row['tag_id'] = $tag['id'];
                    $row['article_id'] = $article['id'];
                    $this->model('tag_query_results')->insert($row);
                }
                $params = [];
                $count = 0;
                foreach ($feeds_to_subscribe as $feed_id) {
                    $params[$count]['categories'][0] = array(
                        'id' => "user/" . registry::get('user')['feedly_id'] . "/category/$tag_name",
                        'label' => $tag_name
                    );
                    $params[$count]['id'] = $feed_id;
                    $params[$count]['title'] = $tag_name;
                }
                if($params) {
                    print_r($params);
                    $this->api()->subscribe($params);
                }
            }
            $this->model('user_tags')->insert(array('user_id' => registry::get('user')['id'], 'tag_id' => $tag['id']));
            return true;
        }
        return false;
    }

    public function getCheckedArticle(array $article)
    {
        if(!$res = $this->model('articles')->getByField('entry_id', $article['id'])) {
            require_once(ROOT_DIR . 'classes' . DS . 'simple_html_dom_class.php');
            $content = $article['content']['content'];
            if(!$article['content']['content']) {
                $content = $article['summary']['content'];
            } else {
                $row['summary'] = $article['summary']['content'];
            }
            if(!$feed_id = $this->model('feeds')->getByField('feed_id', $article['origin']['streamId'])) {
                $res = $this->getFeeds([$article['origin']['streamId']]);
                $feed_id = $res[array_keys($res)[0]];
            }
            $html = str_get_html($content);
            $content = $html->root;
            $thumb = $content->find('img')[0]->src;
            $content->find('img')[0]->outertext = '';
            $row = [];
            $row['entry_id'] = $article['id'];
            $row['stream_id'] = $article['origin']['streamId'];
            $row['feed_id'] = $feed_id;
            $row['thumbnail'] = $thumb;
            $row['content'] = $content;
            $row['title'] = $article['title'];
            if ($article['keywords']) {
                $keywords = implode(',', $article['keywords']);
            }
            $row['keywords'] = $keywords ? $keywords : '';
            $row['author'] = $article['author'] ? $article['author'] : '';
            $row['publish_date'] = date('Y-m-d H:i:s', round($article['published']/1000));
            $row['source_url'] = $article['canonicalUrl'] ? $article['canonicalUrl'] : '';
            $row['create_date'] = date('Y-m-d H:i:s');
            $row['id'] = $this->model('articles')->insert($row);

            $res = $row;
        }
        return $res;
    }

    public function getFeedArticles($feed_id)
    {
        $queries = $this->model('feed_queries')->getByField('feed_id', $feed_id, true);
        if(time() - strtotime($queries[0]['last_update']) > FEED_QUERY_UPDATE) {
            $this->model('feed_queries')->delete('feed_id', $feed_id);
            $feed = $this->model('feeds')->getById($feed_id);
            $feed_articles = $this->api()->getStream($feed['feed_id']);
            $articles = $this->getArticles($feed_articles['ids']);
//            print_r($articles);
//            exit;
//            print_r($feed_articles);exit;
//            $articles = [];
            $date = date('Y-m-d H:i:s');
            $rows = [];
            foreach ($articles as $article) {
//                $article = $this->getCheckedArticle($feed_article);
//                $articles[] = $article;
                $rows[] = [
                    'article_id' => $article['id'],
                    'feed_id' => $feed_id,
                    'last_update' => $date,      
                ];
            }
            if($rows) {
                $this->model('feed_queries')->insertRows($rows);
            }
            $articles = $this->model('articles')->getByFieldIn('id', $feed_articles['ids'], true);
        } else {
            $article_ids = [];
            foreach ($queries as $query) {
                $article_ids[] = $query['article_id'];
            }
            $articles = $this->model('articles')->getByFieldIn('id', $article_ids, true);
        }
        return $articles;
    }

    public function getUserPriorMix($page = 0)
    {
        $user_feeds = $this->model('user_feeds')->getByField('user_id', registry::get('user')['id'], true);
        $res = [];
        $feed_articles = [];
        foreach ($user_feeds as $feed) {
            $feed_articles[$feed['feed_id']] = $this->getFeedArticles($feed['feed_id']);
            $feed_ids[] = $feed['feed_id'];
        }
        $feeds = [];
        foreach ($this->model('feeds')->getByFieldIn('id', $feed_ids, true) as $feed) {
            $feeds[$feed['id']] = $feed;
        }

        foreach ($user_feeds as $feed) {
            for($i = $feed['priority']*$page + $page; $i <= $feed['priority'] + $feed['priority']*$page + $page; $i ++) {
                $feed_articles[$feed['feed_id']][$i]['feed_title'] = $feeds[$feed['feed_id']]['title'];
                $feed_articles[$feed['feed_id']][$i]['icon_url'] = $feeds[$feed['feed_id']]['icon_url'];
                $feed_articles[$feed['feed_id']][$i]['feed_id'] = $feeds[$feed['feed_id']]['id'];
                $res[] = $feed_articles[$feed['feed_id']][$i];
            }
        }
        shuffle($res);
        return $res;

    }
}