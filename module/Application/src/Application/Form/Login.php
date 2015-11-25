<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;

class Login extends Form implements InputFilterAwareInterface {
	protected $inputFilter;
	public function __construct($name = null) {
		parent::__construct ( 'login-form' );
		$this->add ( array (
				'name' => 'username',
				'type' => 'Text',
				'options' => array (
						'label' => 'Username' 
				) 
		) );
		$this->add ( array (
				'name' => 'password',
				'type' => 'Password',
				'options' => array (
						'label' => 'Password' 
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
	public function setInputFilter(InputFilterInterface $inputFilter) {
		throw new \Exception ( "Not used" );
	}
	public function getInputFilter() {
		if (! $this->inputFilter) {
			$inputFilter = new InputFilter ();
			
			$inputFilter->add ( array (
					'name' => 'username',
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
					'name' => 'password',
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
}
        		