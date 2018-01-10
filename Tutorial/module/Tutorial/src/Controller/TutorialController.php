<?php
namespace Tutorial\TutoriallController;
use Zend\Mvc\Controller\AbstractActionController; 
use Zend\View\Model\ViewModel; 
class TutorialController extends AbstractActionController{
    public function indexAction(){
        return ViewModel();
    }
}
