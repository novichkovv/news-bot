<?php
/**
 * Created by PhpStorm.
 * User: enovichkov
 * Date: 28.08.2015
 * Time: 17:20
 */
class index_controller extends controller
{
    public function index()
    {
        $this->user = $this->model('users')->getById(1);
        if(!$this->user['refresh_token']) {
            $api = new feedly_api_class(1);
            header('Location: ' . $api->createAuthUrl(1));
        } else {
//            echo urldecode('user%2F19c7c186-e129-423e-8fdb-f9e1156d4cf4%2Fcategory%2Fglobal.all');exit;
//            print_r(registry::get('user'));
//            $articles = $this->getFeeds();
            $articles = $this->feed()->getUserMix();
//            print_r($articles); exit;
            $this->render('first_article', array_shift($articles));
            $this->render('next', array_keys($articles)[0]);
            $this->render('articles', $articles);
        }
        $this->view('index' . DS . 'index');
    }

    public function index_na()
    {
        $this->index();
    }

    private function getFeeds()
    {
        if(!$_SESSION['entries']) {
            $entry_ids = [];
            $article_entry_ids = [];
            foreach ($this->api()->getSubscriptions() as $feed) {
                foreach ($this->api()->getStream($feed['id'])['ids'] as $entry) {
                    if(!$this->model('articles')->getByField('entry_id', $entry)) {
                        $entry_ids[] = $entry;
                    } else {
                        $article_entry_ids[] = $entry;
                    }
                }
            }
            if($entry_ids) {
                require_once(ROOT_DIR . 'classes' . DS . 'simple_html_dom_class.php');
                foreach ($this->api()->getEntries($entry_ids) as $article) {
                    $content = $article['content']['content'];
                    $html = str_get_html($content);
                    $content = $html->root;
                    $thumb = $content->find('img')[0]->src;
                    $content->find('img')[0]->outertext = '';
                    $row = [];
                    $row['entry_id'] = $article['id'];
                    $row['stream_id'] = $article['origin']['streamId'];
                    $row['thumbnail'] = $thumb;
                    $row['content'] = $content->innertext;
                    $row['title'] = $article['title'];
                    $row['summary'] = $article['summary']['content'];
                    $row['keywords'] = implode(',', $article['keywords']);
                    $row['author'] = $article['author'];
                    $row['publish_date'] = date('Y-m-d H:i:s', round($article['published']/1000));
                    $row['source_url'] = $article['canonicalUrl'];
                    $row['create_date'] = date('Y-m-d H:i:s');
                    $this->model('articles')->insert($row);
                }
            }
            $ids = array_merge($entry_ids, $article_entry_ids);
            $_SESSION['entries'] = $ids;
            $_SESSION['timestamp'] = time();
        } else {
            $ids = $_SESSION['entries'];
        }
        $articles = [];
        $tmp = $this->model('articles')->getByFieldIn('entry_id', $ids, true);
        foreach ($tmp as $article) {
            $articles[$article['entry_id']] = $article;
        }
        if($_GET['article']) {
            $article = $articles[$_GET['article']];
            if($article) {
                unset($articles[$_GET['article']]);
                array_unshift($articles, $article);
            }
        }
        return $articles;
    }

    public function index_ajax()
    {
        switch ($_REQUEST['action']) {
            case "get_article":
                $this->render('first_article', $this->model('articles')->getByField('entry_id', $_POST['id']));
                $template = $this->fetch('index' . DS . 'ajax' . DS . 'article');
                $next = $_SESSION['entries'][array_search($_POST['id'], $_SESSION['entries']) + 1];
                echo json_encode(array('status' => 1, 'template' => $template, 'next' => $next));
                exit;
                break;
        }
    }

    public function index_na_ajax()
    {
        $this->index_ajax();
    }

    public function test_na()
    {
        require_once(ROOT_DIR . 'classes' . DS . 'simple_html_dom_class.php');
        $text = '<p><a href="http://design-milk.com/sophisticated-floor-lamp-named-aerial/aerial01/"><img alt="A Sophisticated Floor Lamp Named Aerial" src="http://0.design-milk.com/images/2016/05/Aerial01-600x899.jpg"></a></p>
 <p>Tall, slim, and with a heavy foundation, the <a target="_blank" href="http://bjornvandenberg.no/aerial">Aerial</a> floor lamp is a study in minimalism. With a strong, curvy neck made of powder coated steel, an LED light at the top, and a neutral granite bottom, Aerial fits many different settings. Its height and curvature can be adjusted, thereby making it adaptable to a variety of different situations and vignettes. It was designed as a partnership between <a target="_blank" href="http://www.falkesvatun.com/">Falke Svatun</a> and <a target="_blank" href="http://www.bjornvandenberg.no/">Bjørn van den Berg</a>.</p>
 <p><a rel="attachment wp-att-263475" href="http://design-milk.com/?attachment_id=263475"><img height="839" alt="Aerial05" width="600" class="wp-image-263475" src="http://0.design-milk.com/images/2016/05/Aerial05-600x839.jpg"></a></p>
 <p><a rel="attachment wp-att-263473" href="http://design-milk.com/?attachment_id=263473"><img height="828" alt="Aerial02" width="600" class="wp-image-263473" src="http://1.design-milk.com/images/2016/05/Aerial02-600x828.jpg"></a></p>
 <p><a rel="attachment wp-att-263474" href="http://design-milk.com/?attachment_id=263474"><img height="906" alt="Aerial03" width="600" class="wp-image-263474" src="http://2.design-milk.com/images/2016/05/Aerial03-600x906.jpg"></a></p>
 <p><a rel="attachment wp-att-263476" href="http://design-milk.com/?attachment_id=263476"><img height="401" alt="Aerial06" width="600" class="wp-image-263476" src="http://1.design-milk.com/images/2016/05/Aerial06-600x401.jpg"></a></p>
 <p>Photos by Lasse Fløde.</p>
 <img height="1" alt="" width="1" src="http://feeds.feedburner.com/~r/design-milk/~4/HwyDM9crhyY">';
        echo $text;
        $html = str_get_html($text);
        $content = $html->root;
        $thumb = $content->find('img')[0]->src;
        echo $thumb;
    }
}