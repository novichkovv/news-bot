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
                $row['summary'] = $article['summary']['content'];
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
        if(!$tag || time() - $tag['last_update'] >= TAG_UPDATE) {
            $tag['tag_name'] = $tag_name;
            $tag['last_update'] = date('Y-m-d H:i:s');

        }
    }
}