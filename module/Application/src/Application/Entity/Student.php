<?php
namespace Application\Entity;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilter;

class Student implements InputFilterAwareInterface{
	public $id;
	public $fullName;
	public $address;
	public $phoneNumber;
	protected $inputFilter;
	public function exchangeArray($data){
		$this->id = (!empty($data['id']))?$data['id']:null;
		$this->fullName = (!empty($data['fullName']))?$data['fullName']:null;
		$this->address = (!empty($data['address']))?$data['address']:null;
		$this->phoneNumber = (!empty($data['phoneNumber']))?$data['phoneNumber']:null;
	}
	
	public function setInputFilter(InputFilterInterface $inputFilter){
		throw new \Exception('Not used');
	}
	
public function getInputFilter() {
		if (! $this->inputFilter) {
			$inputFilter = new InputFilter ();
			
			$inputFilter->add ( array (
					'name' => 'id',
					'required' => true,
					'filters' => array (
							array (
									'name' => 'Int' 
							) 
					) 
			) );
			$inputFilter->add ( array (
					'name' => 'fullName',
					'required' => true,
					'filters' => array (
							array (
									'name' => 'StripTags' 
							),
							array (
									'name' => 'StringTrim' 
							) 
					),
					'validators' => array (
							array (
									'name' => 'StringLength',
									'options' => array (
											'encoding' => 'UTF-8',
											'min' => 1,
											'max' => 100 
									) 
							) 
					) 
			) );
			
			$inputFilter->add ( array (
					'name' => 'address',
					'required' => true,
					'filters' => array (
							array (
									'name' => 'StripTags' 
							),
							array (
									'name' => 'StringTrim' 
							) 
					),
					'validators' => array (
							array (
									'name' => 'StringLength',
									'options' => array (
											'encoding' => 'UTF-8',
											'min' => 1,
											'max' => 100 
									) 
							) 
					) 
			) );
			$inputFilter->add ( array (
					'name' => 'phoneNumber',
					'required' => true,
					'filters' => array (
							array (
									'name' => 'StripTags'
							),
							array (
									'name' => 'StringTrim'
							)
					),
					'validators' => array (
							array (
									'name' => 'StringLength',
									'options' => array (
											'encoding' => 'UTF-8',
											'min' => 1,
											'max' => 100
									)
							)
					)
			) );
			$this->inputFilter = $inputFilter;
		}
		return $this->inputFilter;
	}
	
	public function getArrayCopy(){
		//function to return properties of the given object
		//gets the accessible non-static properties of the given object according to scope
		//http://www.php.net/manual/en/function.get-object-vars.php  
		return get_object_vars($this);
	}
}