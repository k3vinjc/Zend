<?php  
require __DIR__ . '/vendor/autoload.php';  

use Zend\EventManager\EventManagerInterface; 
use Zend\EventManager\EventManager; 
use Zend\EventManager\EventManagerAwareInterface; 

class Greeter implements EventManagerAwareInterface { 
   protected $events;
   public function setEventManager(EventManagerInterface $events) { 
      $events->setIdentifiers([__CLASS__, get_called_class(), ]); 
      $this->events = $events; 
      return $this; 
   }  
   public function getEventManager() { 
      if (null === $this->events) { 
         $this->setEventManager(new EventManager()); 
      } 
      return $this->events; 
   } 

   public function asdf($message){
      printf("\"%s\" from class\n", $message); 
      $this->getEventManager()->trigger(__FUNCTION__, $this, [$message ]); 
   }

   public function greet($message) { 
      printf("\"%s\" from class\n", $message); 
      $this->getEventManager()->trigger(__FUNCTION__, $this, [$message ]); 
   } 
} 

$greeter = new Greeter(); 
$greeter->asdf("Hello");  
$greeter->getEventManager()->attach('asdf', function($e) { 
	var_dump($e);
   $event_name = $e->getName(); 
   $target_name = get_class($e->getTarget()); 
   $params_json = json_encode($e->getParams()); 
   printf("\"%s\" event of class \"%s\" is called." . " The parameter supplied is %s\n",
      $event_name,
      $target_name,  
      $params_json); 
});  
$greeter->asdf("Hello"); 
