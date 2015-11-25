<?php
namespace Application\Model;
use Zend\Db\TableGateway\TableGateway;
use Application\Entity\Score;
use Zend\Db\Sql\Select;


class ScoreTable extends ModelTable
{

    protected $tableGatewayClass = '\Application\Db\ScoreTableGateway';

    public function fetchAll()
    {
    	$resultSet = $this->tableGateway->select();
        return $resultSet;
    }
    
       
}
