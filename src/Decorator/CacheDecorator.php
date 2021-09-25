<?php

namespace src\Decorator;

use \MemCache;

class CacheDecorator
{
    // private static array $list = [];
    // private array $registry;
    private static MemCache $mc;

    // public static function getInstance(string $instance = 'default')
    public static function getInstance()
    {
        // if (!isset(self::$list[$instance])) self::$list[$instance] = new self;

        // return self::$list[$instance];

        if (!isset(self::$mc)) {
            self::$mc = new MemCache;
            self::$mc->addServer('localhost', 11211);
        }
        return self::$mc;
    }

    private function __construct()
    {
        #
    }
    private function __clone()
    {
        #
    }
    private function __wakeup()
    {
        #
    }
    public function set($key, $val): void
    {
        $key = md5($key);
        // $this->registry[$key] = $val;
        self::$mc->set($key, $val);
    }
    public function get($key): array
    {
        $key = md5($key);
        // if (isset($this->registry[$key])) {
        //     return $this->registry[$key];
        // } else {
        //     return [];
        // }
        $cache = self::$mc->get($key);
        if ($cache !== null) {
            return $cache;
        }
        return [];
    }
}
