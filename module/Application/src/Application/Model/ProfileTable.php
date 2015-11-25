<?php
namespace Application\Model;
use Zend\Db\TableGateway\TableGateway;
use Application\Entity\Profile;


class ProfileTable extends ModelTable
{

    protected $tableGatewayClass = '\Application\Db\ProfileTableGateway';

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
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
    
    public function save(Profile $profile)
    {
    	$data = array(
    			'name' => $profile->name,
    			'address'  => $profile->address,
    	);
    
    	$id = (int) $profile->id;
    	if ($id == 0) {
    		$this->tableGateway->insert($data);
    	} else {
    		if ($this->get($id)) {
    			$this->tableGateway->update($data, array('id' => $id));
    		} else {
    			throw new \Exception('Profile id does not exist');
    		}
    	}
    }
    
    public function delete($id)
    {
    	$this->tableGateway->delete(array('id' => (int) $id));
    }
    
}
