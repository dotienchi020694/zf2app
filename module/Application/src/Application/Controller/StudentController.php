<?php
namespace Application\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Application\Entity\Student;
use Zend\View\Model\ViewModel;
use Application\Form\StudentForm;

class StudentController extends AbstractActionController{
	protected function getStudentTable() {
		return $this->getServiceLocator ()->get ( 'Application\Service\Model' )->get ( 'Application\Model\StudentTable' );
	}
	public function indexAction(){
		$students = $this->getStudentTable()->fetchAll ();
		return new ViewModel ( array (
				'students' => $students 
		) );
	}
	public function addAction(){
		$form = new StudentForm();
		$request = $this->getRequest();
		if($request->isPost()){
			$entity = new Student();
			$form->setInputFilter($entity->getInputFilter());
			$form->setData($request->getPost());
			if($form->isValid()){
					$entity->exchangeArray($form->getData());
					$table = $this->getStudentTable()->save($entity);
					return $this->redirect()->toRoute('student');
			}
		}
		return new ViewModel(array(
			'form'=>$form		
		));
	}
	public function editAction(){
		$id = (int)$this->params('id',0);
		if(!$id){
			return $this->redirect()->toRoute('student',array(
					'action'=>'add'
			));
		}
		$table = $this->getStudentTable();
		try {
			$profile = $table->get ( $id );
		} catch ( \Exception $ex ) {
			return $this->redirect ()->toRoute ( 'student' );
		}
		
		$form = new StudentForm();
		$form->bind ( $profile );
		
		$request = $this->getRequest ();
		if ($request->isPost ()) {
			$form->setInputFilter ( $profile->getInputFilter () );
			$form->setData ( $request->getPost () );
				
			if ($form->isValid ()) {
				$table->save ( $profile );
				return $this->redirect ()->toRoute ( 'student' );
			}
		}
		
		return new ViewModel ( array (
				'id' => $id,
				'form' => $form
		) );
	}
	public function getAction(){
		$id = (int) $this->params('id',0);
		if(!$id){
			return $this->request() ->toRoute('student');
		}
		$table =$this->getStudentTable();
		$student = $table->get($id);
		return new ViewModel ( array (
				'student' => $student
		) );
	}
	public function searchAction(){
		//$key = 
	}
	public function deleteAction(){
		$id = ( int ) $this->params ( 'id', 0 );
		if (! $id) {
			return $this->redirect ()->toRoute ( 'student' );
		}
		
		$table = $this->getStudentTable();
		$student = $table->get ( $id );
		
		$request = $this->getRequest ();
		if ($request->isPost ()) {
			if ('Yes' == $request->getPost ( 'confirm', 'No' )) {
				$id = ( int ) $request->getPost ( 'id' );
				$table->delete ( $id );
			}
			return $this->redirect ()->toRoute ( 'student' );
		}
		
		return new ViewModel ( array (
				'student' => $student
		) );
	}
}