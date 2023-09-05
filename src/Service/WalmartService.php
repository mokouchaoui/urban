<?php

namespace App\Service;

use Walmart\Walmart;
use Walmart\Configuration;

class WalmartService {

    private static $instance = null;  // This will store the instance of the class
    private $marketplace;
    private $config;

    private function __construct(Configuration $config) {
        $this->config = $config;
        $this->marketplace = Walmart::marketplace($this->config);
    }

    public static function getInstance(Configuration $config): WalmartService {
        if (self::$instance === null) {
            self::$instance = new WalmartService($config);
        }
        return self::$instance;
    }

    public function getItems() {
        return $this->marketplace->items();
    }

    public function getInventory() {
        return $this->marketplace->inventory();
    }

    public function getOrders() {
        return $this->marketplace->orders();
    }

    private function __clone() {
    }

    public function __wakeup() {
        throw new \Exception("Cannot unserialize a singleton.");
    }
}
