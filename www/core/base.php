<?php
/**
 * Created by PhpStorm.
 * User: asus1
 * Date: 13.07.2015
 * Time: 1:31
 */
class base
{
    private $api_instance;

    /**
     * @param $model
     * @param string $table
     * @param string $db
     * @param string $user
     * @param string $password
     * @return model
     */

    protected function model($model, $table = null, $db = null, $user = null, $password = null)
    {
        $models = registry::get('models');
        if(!$m = $models[$model][$table]) {
            $model_file = ROOT_DIR . 'models' . DS . $model . '_model.php';
            if(file_exists($model_file)) {
                $model_class = $model . '_model';
                $m = new $model_class($table ? $table : $model, $db, $user, $password);
            } else {
                $m = new default_model($model);
            }
            $models[$model][$table] = $m;
            registry::remove('models');
            registry::set('models', $models);
        }
        return $m;
    }

    /**
     * @param string $file
     * @param mixed $value
     * @param string $mode
     */

    protected function writeLog($file, $value, $mode = 'a+') {
        $f = fopen(ROOT_DIR . 'tmp' . DS . 'logs' . DS . $file . '.log', $mode);
        fwrite($f, date('Y-m-d H:i:s') . ' - ' .print_r($value, true) . "\n");
        fclose($f);
    }

    /**
     * @param string $key
     * @return string
     */

    protected function getConfig($key)
    {
        if(!$key) {
            return false;
        }
        if(!$value = registry::get('config')[$key]) {
            $config = registry::get('config');
            $config[$key] = $this->model('system_config')->getByField('config_key', $key)['config_value'];
            registry::remove('config');
            registry::set('config', $key);
            return $config[$key];
        } else {
            return $value;
        }
    }

    protected function getLocale($table, $key)
    {
        $row = array(
            'language' => registry::get('language'),
            'locale_key' => $key,
            'locale_table' => $table
        );
        return $this->model('locale')->getByFields($row)['locale_value'];
    }

    protected function getAllLocale($table)
    {

    }

    protected function callEvent($event, array $data)
    {
        $class_name = $event . '_event';
        return new $class_name($data);
    }

    public function api()
    {
        if(!$this->api_instance) {
            $this->api_instance = new feedly_api_class(registry::get('user')['id']);
        }
        return $this->api_instance;
    }
}