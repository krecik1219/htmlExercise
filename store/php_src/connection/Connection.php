<?php

namespace connection;

require_once ("Config.php");

use Config;
use Exception;
use http\Env\Request;use mysqli;

class Connection
{
    /**
     * @var mysqli
     */
    protected $connection;

    /**
     * UserConnection constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->connection = new mysqli(Config::$host, Config::$db_user, Config::$db_password, Config::$db_name);
        if($this->connection->connect_errno != 0)
            throw new Exception("Couldn't establish");

        $this->connection->set_charset("utf8");
    }

    public function __destruct()
    {
        $this->connection->close();
    }
}