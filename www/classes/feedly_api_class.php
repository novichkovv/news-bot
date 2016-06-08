<?php
/**
 * Created by PhpStorm.
 * User: asus1
 * Date: 18.05.2016
 * Time: 0:38
 */
class feedly_api_class extends base
{
    public $user = [];
    public $access_token;
    public $rand;

    public function search($query, $count = null, $locale = null)
    {
        if(!$query) {
            return false;
        }
        $url = API_URL . '/v3/search/feeds?query=' . $query . ($count ? '&count=' . $count : '') . ($locale ? '&locale=' . $locale : '');
        return $this->makeApiCall($url, 'GET');
    }

    public function getCategories()
    {
        $url = API_URL . '/v3/categories/global.all';
        return $this->makeApiCall($url, 'GET');
    }

    public function getSubscriptions()
    {
        $url = API_URL . '/v3/subscriptions';
        return $this->makeApiCall($url, 'GET');
    }

    public function getProfile()
    {
        $url = API_URL . '/v3/profile';
        return $this->makeApiCall($url, 'GET');
    }

    public function getFeed($feed_id)
    {
        $url = API_URL . '/v3/feeds/' . urlencode($feed_id);
        return $this->makeApiCall($url, 'GET');
    }

    public function getFeeds()
    {
        $url = API_URL . '/v3/feeds/.mget';
        return $this->makeApiCall($url, 'GET');
    }

    public function getPreferences()
    {
        $url = API_URL . '/v3/preferences';
        return $this->makeApiCall($url, 'GET');
    }

    public function subscribe($params)
    {
        $url = API_URL . '/v3/subscriptions';
        return $this->makeApiCall($url, 'POST', $params);
    }

    public function getTags()
    {
        $url = API_URL . '/v3/tags';
        return $this->makeApiCall($url, 'GET');
    }

    public function getStream($stream_id, $newer_than = 0, $unread_only = true)
    {
        if(!$newer_than) {
            $params['newerThan'] = time() - 24*3600;
        } else {
            $params['newerThan'] = $newer_than;
        }
        $params['unreadOnly'] = $unread_only;
        $url = API_URL . '/v3/streams/' . urlencode($stream_id) . '/ids';
        return $this->makeApiCall($url, 'GET');
    }

    public function getMix($stream_id, $count = 10, $unread_only = true, $hours = 24, $locale = 'EN_en')
    {
        $params = [];
        $params['count'] = $count;
        $params['unread_only'] = $unread_only;
        $params['hours'] = $hours;
        $params['locale'] = $locale;
        $url = API_URL . '/v3/mixes/' . urlencode($stream_id) . '/contents' . ($params ? '?' . http_build_query($params) : '');
        return $this->makeApiCall($url, 'GET');
    }

    public function getEntry($entry_id)
    {
        $url = API_URL . '/v3/entries/' . urlencode($entry_id);
        return $this->makeApiCall($url, 'GET');
    }

    public function getEntries(array $entry_ids)
    {
        $url = API_URL . '/v3/entries/.mget';
        return $this->makeApiCall($url, 'POST', $entry_ids);
    }

    public function __construct($id)
    {
        $this->rand = rand();
        $this->user['id'] = $id;
        $this->getAccessToken();
    }

    public function createAuthUrl($id)
    {
        $params = array(
            'response_type' => 'code',
            'client_id' => API_APP_ID,
            'scope' => 'https://cloud.feedly.com/subscriptions',
            'redirect_uri' => API_REDIRECT_URL,
            'state' => $id
        );
        $url = API_URL . '/v3/auth/auth?' . http_build_query($params);
        return $url;
    }


    public function getAccessToken()
    {
        $refresh_token = $this->getRefreshToken($this->user['id']);
        if($_GET['code'] && !$refresh_token) {
            $params = array(
                "grant_type" => "authorization_code",
                "code" => $_GET['code'],
                "redirect_uri" => API_REDIRECT_URL,
                "state" => $this->user['id'],
                "client_id" => API_APP_ID,
                "client_secret" => API_APP_SECRET,
            );
            $curl = curl_init(API_URL . '/v3/auth/token');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
            $response = curl_exec($curl);
            $res = json_decode($response, true);
            $this->setRefreshToken($res['refresh_token']);
            $this->access_token = $res['access_token'];
        } elseif(!$_GET['code']) {
            if($refresh_token) {
                $this->refreshToken($refresh_token);
            }
        }
    }

    private function refreshToken($refresh_token)
    {
        $params = array(
            "grant_type" => "refresh_token",
            "client_id" => API_APP_ID,
            "client_secret" => API_APP_SECRET,
            "refresh_token" => $refresh_token
        );
        $curl = curl_init(API_URL . '/v3/auth/token');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
        $response = curl_exec($curl);
        $res = json_decode($response, true);
        $this->access_token = $res['access_token'];
        if(!empty($res['refresh_token'])) {
            $this->setRefreshToken($res['refresh_token']);
        }
    }

    private function makeApiCall($url, $method, array $params = array()) {
        $headers = array(
            "User-Agent: php-tutorial/1.0",
            "Authorization: Bearer " . $this->access_token,
            "Accept: application/json",
        );
        $curl = curl_init($url);
        switch($method) {
            case "GET":
                break;
            case "POST":
                $headers[] = "Content-Type: application/json";
                curl_setopt($curl, CURLOPT_POST, true);
                $params = $params ? json_encode($params) : json_encode($params, JSON_FORCE_OBJECT);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
                break;
            case "PATCH":
                $headers[] = "Content-Type: application/json";
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PATCH");
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
                break;
            case "DELETE":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                break;
            default:
                self::writeLog('EXCHANGE', 'INVALID METHOD ' . $method);
                exit;
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($curl);
        return json_decode($response, true);
    }

    private function getRefreshToken($id)
    {
        return $this->model('users')->getById($id)['refresh_token'];
    }

    private function setRefreshToken($token)
    {
        $this->user['refresh_token'] = $token;
        $this->model('users')->insert($this->user);
    }

}