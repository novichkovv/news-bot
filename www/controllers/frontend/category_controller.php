<?php
/**
 * Created by PhpStorm.
 * User: asus1
 * Date: 24.05.2016
 * Time: 17:16
 */
class category_controller extends controller
{
    private $locale = 'EN_en';
    protected function init()
    {
        $locales = array(
            'EN_en',
            'RU_ru'
        );
        if(in_array($this->user['locale'], $locales)) {
            $this->locale = $this->user['locale'];
        }
    }

    public function index()
    {
///        $feed = new feed_class();
//         echo $feed->subscribeToTag('tech');
        if($_GET['unsub']) {
            foreach ($this->api()->getSubscriptions() as $feed) {
                $feeds[] = $feed['id'];
            }
            $this->api()->unsubscribe($feeds);
        }
//        print_r($this->api()->getSubscriptions());
//        exit;
//        print_r($this->api()->getMix('topic/food', 30, 1, 24,'RU_ru'));exit;
        $this->addStyle(SITE_DIR . 'css/libs/bootstrap.min.css');
        $list = array(
            'tech' => array(
                'bg' => '#ffffff',
                'EN_en' => 'Tech',
                'RU_ru' => 'Техника',
                'color' => '#000'
            ),
            'food' => array(
                'bg' => '#392a31',
                'EN_en' => 'Food',
                'RU_ru' => 'Еда',
                'color' => '#fff'
            ),
            'news' => array(
                'bg' => '#000000',
                'EN_en' => 'News',
                'RU_ru' => 'Новости',
                'color' => '#fff'
            ),
            'design' => array(
                'bg' => '#170e0a',
                'EN_en' => 'Design',
                'RU_ru' => 'Дизайн',
                'color' => '#fff'
            ),
            'fashion' => array(
                'bg' => '#d4d1d5',
                'EN_en' => 'Fashion',
                'RU_ru' => 'Мода',
                'color' => '#000'
            ),
            'business' => array(
                'bg' => '#7c89a5',
                'EN_en' => 'Business',
                'RU_ru' => 'Бизнес',
                'color' => '#fff'
            ),
            'gaming' => array(
                'bg' => '#383b31',
                'EN_en' => 'Gaming',
                'RU_ru' => 'Игры',
                'color' => '#fff'
            ),
            'marketing' => array(
                'bg' => '#3a0202',
                'EN_en' => 'Marketing',
                'RU_ru' => 'Маркетинг',
                'color' => '#fff'
            ),
            'photography' => array(
                'bg' => '#686976',
                'EN_en' => 'Photography',
                'RU_ru' => 'Фотография',
                'color' => '#fff'
            ),
            'entrepreneurship' => array(
                'bg' => '#1f323f',
                'EN_en' => 'Startups',
                'RU_ru' => 'Стартап',
                'color' => '#fff'
            ),
            'baking' => array(
                'bg' => '#f4f1e9',
                'EN_en' => 'Baking',
                'RU_ru' => 'Готовка',
                'color' => '#000'
            ),
            'DIY' => array(
                'bg' => '#f1b86c',
                'EN_en' => 'DIY',
                'RU_ru' => 'Хэнд Мэйд',
                'color' => '#000'
            )

        );
        $tags = [];
        foreach ($this->model('tags')->getUserTags(registry::get('user')['id']) as $tag) {
            $tags[$tag['tag_name']] = $tag;
        }
        $this->render('tags', $tags);
        $this->render('locale', $this->locale);
        $this->render('list', $list);
        $this->view('category' . DS . $this->locale);
    }

    public function index_na()
    {
        $this->index();
    }

    public function index_ajax()
    {
        switch ($_REQUEST['action']) {
            case "subscribe":
                $this->feed()->subscribeToTag($_POST['category']);
                /*
                if(!$tag = $this->model('tags')->getByField('tag_name', $_POST['category'])) {
                    $tag = array('tag_name' => $_POST['category']);
                    $tag['id'] = $this->model('tags')->insert($tag);
                }
                $this->model('user_tags')->insert(array(
                    'user_id' => $this->user['id'],
                    'tag_id' => $tag['id']
                ));
                $query = $this->model('tag_queries')->getByField('tag_id', $tag['id']);
                if(time() - strtotime($query['last_update']) > 3600) {
                    require_once(ROOT_DIR . 'classes' . DS . 'simple_html_dom_class.php');
                    $query['last_update'] = date('Y-m-d H:i:s');
//                    $this->model('tag_queries')->insert($query);
                    $feeds = $this->getTagFeeds($tag['tag_name']);
                    print_r($feeds);
                    foreach ($feeds as $feed) {
                        if(time() - $feed['last_update'] >= 3600) {
                            $this->model('feed_queries')->delete('feed_id', $feed['id']);
                            $feed['last_update'] = date('Y-m-d H:i:s');
                            $this->model('feeds')->insert($feed);
                            $entries = $this->api()->getStream($feed['feed_id'])['items'];
                            print_r($entries);
                            foreach ($entries as $article) {
                                print_r($article);
                                if(!$row = $this->model('articles')->getByField('entry_id', $article['id'])) {
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
                                    $row['id'] = $this->model('articles')->insert($row);
                                }
                                $this->model('feed_queries')->insert(array('feed_id' => $feed['id'], 'article_id' => $row['id']));
                            }
                        }
                    }
                }
                */
                exit;
                break;

            case "unsubscribe":
                exit;
                break;
        }


    }

    public function index_na_ajax()
    {
        $this->index_ajax();
        exit;
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

    private function getTagFeeds($key, $count = 3)
    {
        $feeds = [];
        foreach ($this->api()->search($key, $count, $this->locale)['results'] as $feed) {
            if($row = $this->model('feeds')->getByField('feed_id', $feed['feedId'])) {
                if(strtotime(time() - $row['last_update']) > 24*360) {
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
                    foreach ($feed['tag'] as $tag) {
                        $this->model('feed_tags')->insert(array(
                            'feed_id' => $row['id'],
                            'tag_name' => $tag
                        ));
                    }
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
                $this->model('feed_tags')->delete('feed_id', $feed['id']);
                foreach ($feed['tag'] as $tag) {
                    $this->model('feed_tags')->insert(array(
                        'feed_id' => $row['id'],
                        'tag_name' => $tag
                    ));
                }
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