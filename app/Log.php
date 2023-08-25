<?php

namespace App;

use Monolog\Formatter\SyslogFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Log extends Logger
{
    public function __construct()
    {
        parent::__construct('main');

        $this->pushHandler((new StreamHandler('../storage/logs/' . date('y-m-d') . '.log'))->setFormatter(new SyslogFormatter()));
    }
}