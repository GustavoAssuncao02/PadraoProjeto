<?php

class LogSingleton {
    private static $instance = null;
    private $logFile;

    private function __construct() {
        $this->logFile = fopen("log.txt", "a");
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new LogSingleton();
        }
        return self::$instance;
    }

    public function logEvent($message) {
        $timestamp = date("Y-m-d H:i:s");
        $logMessage = "[$timestamp] $message\n";
        fwrite($this->logFile, $logMessage);
    }

    public function close() {
        fclose($this->logFile);
    }
}

?>
