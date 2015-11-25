<?php
namespace Application\Entity;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilter;

class Score {
	public $id;
	public $name;
	public $q1;
	public $q2;
	public $q3;
	public $q4;
	public function exchangeArray($data){
		$this->id = (!empty($data['id']))?$data['id']:null;
		$this->name = (!empty($data['name']))?$data['name']:null;
		$this->q1 = (!empty($data['q1']))?$data['q1']:null;
		$this->q2 = (!empty($data['q2']))?$data['q2']:null;
		$this->q3 = (!empty($data['q3']))?$data['q3']:null;
		$this->q4 = (!empty($data['q4']))?$data['q4']:null;
	}
	
	

}