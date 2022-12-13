<?php

namespace provodd\base_framework;
use provodd\base_framework\Helpers\Helper;
/**
 * Подключение к бд с помощью ORM - RedBeanPHP
 */
class Db
{
    protected $db_name;
    protected $db_user;
    protected $db_password;
    private static $instance;

    public static function instance(): Db
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct()
    {
        $this->db_name = Helper::instance()->checkEnvironmentVariables('DB_NAME') ?? false;
        $this->db_user = Helper::instance()->checkEnvironmentVariables('DB_USER') ?? Helper::instance()->checkEnvironmentVariables('DB_NAME') ?? false;
        $this->db_password = Helper::instance()->checkEnvironmentVariables('DB_PASSWORD') ?? false;

        require($_SERVER['DOCUMENT_ROOT'] . '/src/include/RedBeanORM.php');

        \R::setup('mysql:host=127.0.0.1;dbname=' . $this->db_name . '', $this->db_user, $this->db_password);
        \R::ext('xdispense', function ($table_name) {
            return \R::getRedBean()->dispense($table_name);
        });
        session_start();
    }
}
