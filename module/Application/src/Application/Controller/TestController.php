<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class TestController extends AbstractActionController {
	public function indexAction() {
		echo "test::index()";
		exit ();
	}
	public function testAction() {
		$profile = new \stdClass ();
		$profile->name = "Chidt";
		$profile->org = "Thang Long University";
		return new ViewModel ( array (
				'profile' => $profile 
		) );
	}
	public function listAction() {
		$gateway = $this->getServiceLocator ()->get ( 'Application\Model\ProfileTable' );
		$profiles = $gateway->fetchAll ();
		return new ViewModel ( array (
				'profiles' => $profiles 
		) );
	}
}
