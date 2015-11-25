<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Application\Entity\Score;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class ApiController extends AbstractActionController {
	protected function getScoreTable() {
		return $this->getServiceLocator ()->get ( 'Application\Service\Model' )->get ( 'Application\Model\ScoreTable' );
	}
	public function getScoresAction() {
		$scores = $this->getScoreTable()->fetchAll ();
		$data1 = [];
		$data2 = [];
		$data3 = [];
		$data4 = [];
		foreach ($scores as $score){
			$data1[]= $score->q1;
			$data2[]= $score->q2;
			$data3[]= $score->q3;
			$data4[]= $score->q4;
			$labels[]=$score->name;
		}
		$dataset[0]['fillColor'] = "rgba(255,0,0,0.2)";
		$dataset[0]['data'] = $data1;
		

		$dataset[1]['fillColor'] = "rgba(0,0,0,0.2)";
		$dataset[1]['data'] = $data2;
		
		$dataset[2]['fillColor'] = "rgba(0,255,0,0.2)";
		$dataset[2]['data'] = $data3;
		
		$dataset[3]['fillColor'] = "rgba(0,0,255,0.2)";
		$dataset[3]['data'] = $data4;
		return new JsonModel ( array (
				'labels' => $labels,
				'datasets' => $dataset
		) );
	}
}