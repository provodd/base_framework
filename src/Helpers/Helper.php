<?php

namespace provodd\base_framework\Helpers;

class Helper
{
    private static $instance;

    public static function instance(): Helper
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function checkEnvironmentVariables($variable){
        $content = file($_SERVER['DOCUMENT_ROOT'].'/.env');
        $environment = array();
        foreach ($content as $item){
            $explode = explode("=", $item);
            $environment[trim($explode[0])] = trim($explode[1]);
        }
        return array_key_exists($variable, $environment) ? $environment[$variable] : false;
    }
}
