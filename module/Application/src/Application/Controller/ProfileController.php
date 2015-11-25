<?php

namespace Application\Controller;

use Zend\Form\Form;
use Zend\Form\Element;
use Application\Entity\Profile;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\User;

class ProfileController extends AbstractActionController {
	
	protected function getProfileTable() {
		return $this->getServiceLocator ()->get ( 'Application\Service\Model' )->get ( 'Application\Model\ProfileTable' );
	}
	public function scoreAction()
	{
		
	}
	public function indexAction() {
		echo "profile::index()";
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
		$profiles = $this->getProfileTable ()->fetchAll ();
		return new ViewModel ( array (
				'profiles' => $profiles 
		) );
	}
	public function addAction() {
		$form = new User ();
		// $form->add ( $id )->add ( $name )->add ( $address )->add ( $send );
		// Khong can phai add vao form
		$request = $this->getRequest ();
		if ($request->isPost ()) {
			$entity = new Profile ();
			$form->setInputFilter ( $entity->getInputFilter () );
			
			$form->setData ( $request->getPost () );
			if ($form->isValid ()) {
				$entity->exchangeArray ( $form->getData () );
				$table = $this->getProfileTable ()->save ( $entity );
				return $this->redirect ()->toRoute ( 'profile' );
			}
		}
		
		return new ViewModel ( array (
				'form' => $form 
		) );
	}
	public function editAction() {
		$id = ( int ) $this->params ( 'id', 0 );
		if (! $id) {
			return $this->redirect ()->toRoute ( 'profile', array (
					'action' => 'add' 
			) );
		}
		
		$table = $this->getProfileTable ();
		try {
			$profile = $table->get ( $id );
		} catch ( \Exception $ex ) {
			return $this->redirect ()->toRoute ( 'profile' );
		}
		
		$form = new \Application\Form\User ();
		$form->bind ( $profile );
		
		$request = $this->getRequest ();
		if ($request->isPost ()) {
			$form->setInputFilter ( $profile->getInputFilter () );
			$form->setData ( $request->getPost () );
			
			if ($form->isValid ()) {
				$table->save ( $profile );
				return $this->redirect ()->toRoute ( 'profile' );
			}
		}
		
		return new ViewModel ( array (
				'id' => $id,
				'form' => $form 
		) );
	}
	public function deleteAction() {
		$id = ( int ) $this->params ( 'id', 0 );
		if (! $id) {
			return $this->redirect ()->toRoute ( 'profile' );
		}
		
		$table = $this->getProfileTable ();
		$profile = $table->get ( $id );
		
		$request = $this->getRequest ();
		if ($request->isPost ()) {
			if ('Yes' == $request->getPost ( 'confirm', 'No' )) {
				$id = ( int ) $request->getPost ( 'id' );
				$table->delete ( $id );
			}
			return $this->redirect ()->toRoute ( 'profile' );
		}
		
		return new ViewModel ( array (
				'profile' => $profile 
		) );
	}
}
