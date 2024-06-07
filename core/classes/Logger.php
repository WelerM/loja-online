<?php

namespace core\classes;

use Monolog\Logger as MonologLogger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

class Logger
{
    private $logger;

    public function __construct($channel_name)
    {
        $this->logger = new MonologLogger($channel_name);

        // Add handlers
        $this->logger->pushHandler(new StreamHandler(APP_DOCUMENT_ROOT . '/logs/log.log', MonologLogger::DEBUG));
        $this->logger->pushHandler(new FirePHPHandler());
    }

    public function create_log()
    {
  
        return $this->logger;
    }
}
