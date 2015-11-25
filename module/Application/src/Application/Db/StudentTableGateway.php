<?php
namespace Application\Db;
use Application\Db\AbstractTableGateway;
class StudentTableGateway extends AbstractTableGateway
{
    protected $table    = 'students';
    protected $entity = 'Application\Entity\Student';
}
