<?php
namespace Application\Model;
use Zend\Db\TableGateway\TableGateway;
use Application\Entity\Student;
use Zend\Db\Sql\Select;


class StudentTable extends ModelTable
{

    protected $tableGatewayClass = '\Application\Db\StudentTableGateway';

    public function fetchAll()
    {
    	$resultSet = $this->tableGateway->select();
        /*$resultSet = $this->tableGateway->select(function (Select $select){
        	$select->where->like('address', 'Hà Nội')->AND->between('id', 1, 5);
//         	var_dump($expression);
        });*/
        return $resultSet;
    }
    
    public function get($id)
    {
    	$id  = (int) $id;
    	$rowset = $this->tableGateway->select(array('id' => $id));
    	$row = $rowset->current();
    	if (!$row) {
    		throw new \Exception("Could not find row $id");
    	}
    	return $row;
    }
    
    public function find($keyword)
    {
    	$rowset	= $this->tableGateway->select(function (Select $select){
    		$select->where->like('fullName', $keyword);
    	});
    	return $rowset();
    }
    
    public function save(Student $student)
    {
    	$data = array(
    			'fullname' => $student->fullName,
    			'address'  => $student->address,
    			'phonenumber' =>$student->phoneNumber,
    	);
    
    	$id = (int) $student->id;
    	if ($id == 0) {
    		$this->tableGateway->insert($data);
    	} else {
    		if ($this->get($id)) {
    			$this->tableGateway->update($data, array('id' => $id));
    		} else {
    			throw new \Exception('Student id does not exist');
    		}
    	}
    }
    
    public function delete($id)
    {
    	$this->tableGateway->delete(array('id' => (int) $id));
    }
    
}
