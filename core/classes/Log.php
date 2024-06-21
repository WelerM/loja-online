<?php

namespace core\classes;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class Log
{

    public function logger($message, $mode = 'info')
    {
        $logger = new Logger('logs');
        $logger->pushHandler(new StreamHandler(APP_DOCUMENT_ROOT . '/logs/log.log'));

        switch ($mode) {
            case 'info':
                $logger->info($message);
                break;
            case 'warning':
                $logger->warning($message);
                break;
            case 'error':
                $logger->error($message);
                break;
            case 'debug':
                $logger->debug($message);
                break;
            case 'notice':
                $logger->notice($message);
                break;
            case 'critical':
                $logger->critical($message);
                break;
            case 'alert':
                $logger->alert($message);
                break;
            case 'emergency':
                $logger->emergency($message);
                break;
            default:
                $logger->info($message);
                break;
        }
    }
}
