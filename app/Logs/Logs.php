<?php

declare (strict_types = 1);

namespace AppUtbf\Logs;

/**
* Logs
*
* @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
*/
class Logs
{

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Write
     *
     * @param  $error  log Message
     *
     * @return void
     */
    public function write($error):void
    {

        $message            = '['.date("Y-m-j g:i:s").'] '.$error.PHP_EOL;
        $logFile            = untrailingslashit(UTBF_APP_PATH).'\Logs\logs.log';
        error_log($message, 3, $logFile);

    }

}