<?php

namespace Application\Form;

use Zend\Form\Form;

class User extends Form {
	public function __construct($name = null) {
		parent::__construct ( 'user-form' );
		$this->add ( array (
				'name' => 'id',
				'type' => 'Hidden' 
		) );
		$this->add ( array (
				'name' => 'name',
				'type' => 'Text',
				'options' => array (
						'label' => 'Name' 
				) 
		) );
		$this->add ( array (
				'name' => 'address',
				'type' => 'Text',
				'options' => array (
						'label' => 'Address' 
				) 
		) );
		$this->add ( array (
				'name' => 'send',
				'type' => 'Submit',
				'attributes' => array (
						'value' => 'Send',
						'class' => 'btn btn-success' 
				) 
		) );
	}
}
        