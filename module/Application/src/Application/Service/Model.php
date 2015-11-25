<?php
namespace Application\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;

class Model implements ServiceManagerAwareInterface
{
    protected $serviceManager;
    protected $container    = array();
    
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }
    
    public function get($modelClass, $tableGateway=null)
    {
        if (!isset($this->container[$modelClass]))
        {
            $this->container[$modelClass]    = new $modelClass($tableGateway);
        }
        return $this->container[$modelClass];
    }
    
    public function set($key, $model)
    {
        $this->container[$key]    = $model;
    }
}
