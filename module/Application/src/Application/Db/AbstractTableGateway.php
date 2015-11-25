<?php

namespace Application\Db;

use Zend\Db\TableGateway\AbstractTableGateway as ZendAbstractTableGateway;
use Zend\Db\TableGateway\Feature;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\ResultSet\ResultSetInterface;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\TableIdentifier;

/**
 * *
 * TableGatewayInterface
 * TableGatewayInterface object is intended to provide an object that represents a table in a database
 * It include function:
 * + getTable()
 * + select($where = null)
 * + insert($set)
 * + update($set, $where=null)
 * + delete();
 * -There are two primary implementations of the TableGatewayInterface: AbstractTableGateway and TableGateway
 * - AbstractTableGateway is an abstract basic implemeantation that provile function for:
 * + select()
 * + insert()
 * + update()
 * + delete()
 * - AbstractTableGateway also implementation a "Feature" API, that alows for expalnding the behaviors of the base TableGateway
 * More infomation: http://framework.zend.com/manual/current/en/modules/zend.db.table-gateway.html
 */
abstract class AbstractTableGateway extends ZendAbstractTableGateway {
	
	/***
	 * Adapter
	 * - It's responsible for adapting any code writen in or for Zend\Db to targeted php extensions and vendor databased.
	 * - In doing this, it creates an abstraction layer for the PHP extensions, which is called the "Driver" portion of the Zend\Db adapter
	 * ??? Where is GlobalAdapterFeature ???? may be in global.php????
	 * More infomation: http://framework.zend.com/manual/current/en/modules/zend.db.adapter.html
	 */
	
	/***
	 * Driver
	 * Driver array is an abstraction for the extension level required paramaters something like
	 * - driver: required - value: Mysqli, Sqlsrv, Pdo_Sqlite, Pdo_Mysql, Pdo = OtherPdoDriver
	 * - database: generally required - value: the name of the database (schema)
	 * - username: generally required - ....
	 * - password: generally required - ....
	 * - hostname: not generally required - ....
	 * - port	 : not generally required - 
	 * - charset : not generally required - the character set to use
	 * Example: $adapter = new Zend\Db\Adapter\Adaprer(
	 * array(
	 * 	'driver'=> 'Mysqli',
	 * 	'database' => 'zend_db_example'
	 *  'username' => 'developer',
	 *  'password' => 'developer-password'
	 * ));
	 * 
	 */
	
	/***
	 * ResultSet
	 * That will expose each row as either an ArrayObject-like object or an array of row data
	 * By default Zend\Db\Adapter\Adapter will use a prototypical Zend\Db\ResultSet\ResultSet
	 * object for iterating when using the Zend\Db\Adapter\Adapter::query() method.
	 */
	public function __construct(AdapterInterface $adapter = null, Sql $sql = null) {
		if (! isset ( $this->table )) {
			throw new \Exception ( 'Table name must be set as a property $table' );
		}
		
		if (null === $adapter) {
			$this->featureSet = new Feature\FeatureSet ();
			$this->featureSet->addFeature ( new Feature\GlobalAdapterFeature () );
			$this->initialize ();
		} else {
			$this->adapter = $adapter;
		}
		
		$resultSetPrototype = new ResultSet ();
		if (isset ( $this->entity )) {
			$resultClass = $this->entity;
			$resultSetPrototype->setArrayObjectPrototype ( new $resultClass () );
		}
		$this->resultSetPrototype = $resultSetPrototype;
		$this->sql = ($sql) ?  : new Sql ( $this->getAdapter (), $this->table );
		
		// check sql object bound to same table
		if ($this->sql->getTable () != $this->table) {
			throw new \Exception ( 'The table inside the provided Sql object must match the table of this TableGateway' );
		}
	}
}
