<?php
namespace Application\Model;

class ModelTable
{
    protected $tableGateway;
    protected $tableGatewayClass     = null;
    
    public function __construct($tableGateway=null)
    {
        if (null===$tableGateway)
        {
            if (!isset($this->tableGatewayClass) || null === $this->tableGatewayClass)
            {
                throw new \Exception(
                        'You have to set $tableGatewayClass property in your ModelTable');
            }
            $tableGatewayClass    = $this->tableGatewayClass;
            $tableGateway    = new $tableGatewayClass();
        }
        $this->tableGateway = $tableGateway;
    }
}
