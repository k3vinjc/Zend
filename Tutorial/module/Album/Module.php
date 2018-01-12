<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Album;

 use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
 use Zend\ModuleManager\Feature\ConfigProviderInterface;
 use Album\Model\Album;
 use Album\Model\AlbumTable;
 use Zend\Db\ResultSet\ResultSet;
 use Zend\Db\TableGateway\TableGateway;

 class Module implements AutoloaderProviderInterface, ConfigProviderInterface
 {
//     public function getAutoloaderConfig()
//     {
//         return array(
//             'Zend\Loader\ClassMapAutoloader' => array(
//                 __DIR__ . '/autoload_classmap.php',
//             ),
//             'Zend\Loader\StandardAutoloader' => array(
//                 'namespaces' => array(
//                     __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
//                 ),
//             ),
//         );
//     }

     public function getConfig()
     {
         return include __DIR__ . '/config/module.config.php';
     }
     
      // Add this method:
public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\AlbumTable::class => function($container) {
                    $tableGateway = $container->get(Model\AlbumTableGateway::class);
                    return new Model\AlbumTable($tableGateway);
                },
                Model\AlbumTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Album());
                    return new TableGateway('album', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }
 }