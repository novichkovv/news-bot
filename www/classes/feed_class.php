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
            if(!in_array($id, $articles)) {
                $new_articles[] = $id;
            } else {
                $res[$id] = $articles[$id];
            }
        }
        if($new_articles) {
            require_once(ROOT_DIR . 'classes' . DS . 'simple_html_dom_class.php');
            $tmp = $this->api()->getEntries($new_articles);
            foreach ($tmp as $article) {
                $content = $article['content']['content'];
                if(!$article['content']['content']) {
                    $content = $article['summary']['content'];
                } else {
                    $row['summary'] = $article['summary']['content'];
                }
                $html = str_get_html($content);
                $content = $html->root;
                $thumb = $content->find('img')[0]->src;
                $content->find('img')[0]->outertext = '';
                if(!$this->model('feeds')->getByField('feed_id', $article['origin']['streamId'])) {
                    $this->getFeeds([$article['origin']['streamId']]);
                }
                $row = [];
                $row['entry_id'] = $article['id'];
                $row['stream_id'] = $article['origin']['streamId'];
                $row['thumbnail'] = $thumb;
                $row['content'] = $content;
                $row['title'] = $article['title'];
                $row['keywords'] = implode(',', $article['keywords']);
                $row['author'] = $article['author'];
                $row['publish_date'] = date('Y-m-d H:i:s', round($article['published']/1000));
                $row['source_url'] = $article['canonicalUrl'];
                $row['create_date'] = date('Y-m-d H:i:s');
                $this->model('articles')->insert($row);
                $res[$row['entry_id']] = $row;
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
        print_r($new_feeds);
        print_r(array_merge($new_feeds, $feeds_to_update));
        foreach ($this->api()->getFeeds(array_merge($new_feeds, $feeds_to_update)) as $feed) {
//            print_r($feed);
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
            $row['id'] = $this->model('feeds')->insert($row);
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
            if(!$this->model('feeds')->getByField('feed_id', $article['origin']['streamId'])) {
                echo 'getFeeds - ' . $article['origin']['streamId'] . "\n";
                $this->getFeeds([$article['origin']['streamId']]);
            }
            $html = str_get_html($content);
            $content = $html->root;
            $thumb = $content->find('img')[0]->src;
            $content->find('img')[0]->outertext = '';
            $row = [];
            $row['entry_id'] = $article['id'];
            $row['stream_id'] = $article['origin']['streamId'];
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
}