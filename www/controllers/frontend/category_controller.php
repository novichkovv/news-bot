<?php
/**
 * Created by PhpStorm.
 * User: asus1
 * Date: 24.05.2016
 * Time: 17:16
 */
class category_controller extends controller
{
    public function index()
    {
//        var_dump(tools_class::checkImgUrl('http://storage.googleapis.com/site-assets/PSNTZO8gXFUe-cpCZyApw0vEKWPT4b14D6teBEocIAE_visual'));exit;
        $list = array(
            'tech' => array(
                'bg' => '#ffffff',
                'title' => 'Tech',
                'color' => '#000'
            ),
            'food' => array(
                'bg' => '#392a31',
                'title' => 'Food',
                'color' => '#fff'
            ),
            'news' => array(
                'bg' => '#000000',
                'title' => 'News',
                'color' => '#fff'
            ),
            'design' => array(
                'bg' => '#170e0a',
                'title' => 'Design',
                'color' => '#fff'
            ),
            'fashion' => array(
                'bg' => '#d4d1d5',
                'title' => 'Fashion',
                'color' => '#000'
            ),
            'business' => array(
                'bg' => '#7c89a5',
                'title' => 'Business',
                'color' => '#fff'
            ),
            'gaming' => array(
                'bg' => '#383b31',
                'title' => 'Gaming',
                'color' => '#fff'
            ),
            'marketing' => array(
                'bg' => '#3a0202',
                'title' => 'Marketing',
                'color' => '#fff'
            ),
            'photography' => array(
                'bg' => '#686976',
                'title' => 'Photography',
                'color' => '#fff'
            ),
            'entrepreneurship' => array(
                'bg' => '#1f323f',
                'title' => 'Startups',
                'color' => '#fff'
            ),
            'baking' => array(
                'bg' => '#f4f1e9',
                'title' => 'Baking',
                'color' => '#000'
            ),
            'DIY' => array(
                'bg' => '#f1b86c',
                'title' => 'DIY',
                'color' => '#000'
            )

        );
        $this->render('list', $list);
        $this->view('category' . DS . 'index');
    }

    public function index_na()
    {
        $this->index();
    }

    public function search()
    {
        if($tag_id = $this->model('tags')->getByField('tag_name', $_GET['q'])['id']) {
            $query = $this->model('tag_queries')->getByField('tag_id', $tag_id);
            if(time() - strtotime($query['last_update']) > 3600) {
                $query['last_update'] = date('Y-m-d H:i:s');
                $this->model('tag_queries')->insert($query);
                $feeds = $this->getTagFeeds();
                $this->model('tag_query_results')->delete('tag_id', $tag_id);
                foreach ($feeds as $feed) {
                    $this->model('tag_query_results')->insert(array('tag_id' => $tag_id, 'feed_id' => $feed['id']));
                }
            } else {
                $ids = [];
                foreach ($this->model('tag_query_results')->getByField('tag_id', $tag_id, true) as $res) {
                    $ids[] = $res['feed_id'];
                }
                $feeds = $this->model('feeds')->getByFieldIn('id', $ids, true);
            }
        } else {
            $tag_id = $this->model('tags')->insert(array('tag_name' => $_GET['q']));
            $this->model('tag_queries')->insert(array('tag_id' => $tag_id, 'last_update' => date('Y-m-d H:i:s')));
            $feeds = $this->getTagFeeds();
            $this->model('tag_query_results')->delete('tag_id', $tag_id);
            foreach ($feeds as $feed) {
                $this->model('tag_query_results')->insert(array('tag_id' => $tag_id, 'feed_id' => $feed['id']));
            }
        }
        $this->render('feeds', $feeds);
        $this->view('category' . DS . 'search');
    }

    private function getTagFeeds()
    {
        $feeds = [];
        foreach ($this->api()->search($_GET['q'], 12, 'RU_ru')['results'] as $feed) {
            if($row = $this->model('feeds')->getByField('feed_id', $feed['feedId'])) {
                if(strtotime(time() - $row['last_update']) > 48*360) {
                    $row['title'] = $feed['title'];
                    $row['description'] = $feed['description'];
                    $row['velocity'] = $feed['velocity'];
                    $row['subscribers'] = $feed['subscribers'];
                    $row['icon_url'] = $feed['iconUrl'];
                    $row['cover_url'] = $feed['coverUrl'];
                    $row['visual_url'] = $feed['visualUrl'];
                    $row['last_update'] = date('Y-m-d H:i:s');
                    $this->model('feeds')->insert($row);
                }
                $feeds[] = $row;
            } else {
                $row = [];
                $row['feed_id'] = $feed['feedId'];
                $row['title'] = $feed['title'];
                $row['description'] = $feed['description'];
                $row['velocity'] = $feed['velocity'];
                $row['subscribers'] = $feed['subscribers'];
                $row['icon_url'] = tools_class::checkImgUrl($feed['iconUrl']) ? $feed['iconUrl'] : '';
                $row['cover_url'] = tools_class::checkImgUrl($feed['coverUrl']) ? $feed['coverUrl'] : '';
                $row['visual_url'] = tools_class::checkImgUrl($feed['visualUrl']) ? $feed['visualUrl'] : '';
                $row['last_update'] = date('Y-m-d H:i:s');
                $row['id'] = $this->model('feeds')->insert($row);
                $feeds[] = $row;
            }
        }
        return $feeds;
    }

    public function search_na()
    {
        $this->search();
    }
}