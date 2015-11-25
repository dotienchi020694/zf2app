<?php
namespace Application\Form;
use Zend\Form\Form;
use Zend\Form\Fieldset;

class StudentForm extends Form{
	public function __construct($name = null){
		parent::__construct('student-add-form');
		$this->add(array(
				'name' => 'id',
				'type' => 'Hidden'
		));
		$this->add(array(
				'name'=>'fullName',
				'type' => 'Text',
				'options'=>array(
						'label' => 'FullName:'
				),
				'attributes'=>array(
						'placeholder'=>'Please enter your name',
				)
		));
		$this->add(array(
				'name'=>'address',
				'type'=>'Text',
				'options'=>array(
						'label'=>'Address:'
				),
				'attributes'=>array(
						'placeholder'=>'Please enter your address',
						
				)
		));
		$this->add(array(
				'name'=>'phoneNumber',
				'type'=>'Text',
				'options'=>array(
						'label'=>'PhoneNumber'
				),
				'attributes'=>array(
						'placeholder'=>'Please enter your phone number',
				)
		));
		$this->add(array(
				'name'=>'send',
				'type'=>'Submit',
				'attributes'=>array(
						'value'=>'Send',
						'class'=>'btn btn-success'
				)
		));
	}
}