<?php
namespace Application\Db;
use Application\Db\AbstractTableGateway;
class ProfileTableGateway extends AbstractTableGateway
{
    protected $table    = 'profiles';
    protected $entity = 'Application\Entity\Profile';
}
