<?php
/**
 * Created by PhpStorm.
 * User: enovichkov
 * Date: 23.07.2015
 * Time: 13:16
 */
class settings_model extends model
{
    public function updateSettings($row)
    {
        $stm = $this->pdo->prepare('
        UPDATE system_config SET config_value = :value WHERE config_key = :key
        ');
        foreach ($row as $key => $value) {
            $stm->execute(array('key' => $key, 'value' => $value));
        }
        return true;
    }
}