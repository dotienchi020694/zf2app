<?php
namespace Application\Db;
use Application\Db\AbstractTableGateway;
class ScoreTableGateway extends AbstractTableGateway{
	protected $table = 'score';
	protected $entity = 'Application\Entity\Score';
}
