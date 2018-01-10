<?php

namespace Tutorial;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface {

    public function getConfig() {
        return include __DIR__ . '/../config/module.config.php'; //edicion
    }

}
