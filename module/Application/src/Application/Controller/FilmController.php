<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class FilmController extends AbstractActionController{
    private $config;
    private $db;
  
    public function filmAction(){
        $this->config = $this->getServiceLocator()->get('Config'); //mengambil basis data autoconfig
        $this->db = $this->config['db'];
    
        $film = new \Application\Model\Film($this->db);
        $data = $film->read();
        
        $response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent(json_encode($data));
        return $response;
    }
    
    public function showFilmAction(){ //Ini memunculkan Film melalui view
        return new ViewModel();
    
    }
    
}

?>