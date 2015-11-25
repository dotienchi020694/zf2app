<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PublicController extends AbstractActionController {
	/**
	 * Implementing route "login"
	 * If it's GET, render login form
	 * If it's POST, run data validation and authentication
	 * 
	 * @return \Zend\Http\Response|\Zend\View\Model\ViewModel
	 */
	public function loginAction() {
		/* @var $form \Application\Form\Login */
		$form = new \Application\Form\Login ();
		$request = $this->getRequest ();
		if ($request->isPost ()) {
			$form->setData ( $request->getPost () );
			if ($form->isValid ()) {
				$value = $form->getData ();
				/* @var $auth \Zend\Authentication\AuthenticationService */
				$auth = $this->getServiceLocator ()->get ( 'Zend\Authentication\AuthenticationService' );
				$auth->getAdapter ()->setIdentity ( $value ['username'] )->setCredential ( $value ['password'] );
				/* @var $rs \Zend\Authentication\Result */
				$rs = $auth->authenticate ();
				if ($rs->isValid ()) {
					return $this->redirect ()->toRoute ( 'student' );
				} else {
					$this->flashMessenger ()->addMessage ( 'Login Failed' );
					return $this->redirect ()->toRoute ( 'login' );
				}
			}
		}
		
		return new ViewModel ( array (
				'form' => $form 
		) );
	}
	
	/**
	 * Implementing a route "/logout", eliminating session and redirect to login page
	 * 
	 * @return \Zend\Http\Response
	 */
	public function logoutAction() {
		/* @var $auth \Zend\Authentication\AuthenticationService */
		$auth = $this->getServiceLocator ()->get ( 'Zend\Authentication\AuthenticationService' );
		$auth->getStorage ()->clear ();
		return $this->redirect ()->toRoute ( 'login' );
	}
}
                    