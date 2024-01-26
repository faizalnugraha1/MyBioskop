<?php

namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\sql\sql;
use Zend\Db\sql\Select;
use Zend\Db\Adapter\AdapterInterface;

class Film{
	private $adapter;
    
    public function __construct($config){
        $this->adapter = new Adapter($config);
    }

    // public function __construct(AdapterInterface $adapter)
    // {
    //     $this->adapter = $adapter;
    // }

    public function read(){
        $select = new Sql($this->adapter);
		
		$rowset = new Select();
		$rowset = $select->SELECT()
			->FROM('film')
			->WHERE('id_film = 1');
				
		$statement = $select->prepareStatementForSqlObject($rowset);
		$result = $statement->execute();
		
		if ($result instanceof ResultInterface && $result->isQueryResult()) {
			$resultSet = new ResultSet;
			$resultSet->initialize($result);

			$data = $resultSet->toArray();
			return $data;
		}
	}
	
	public function read2(){
		$stmt = $this->adapter->createStatement
		('SELECT id_pembayaran, COUNT()
			FROM Film 
		');

		$result = $stmt->execute();

		if ($result instanceof ResultInterface && $result->isQueryResult()) {
			$resultSet = new ResultSet;
			$resultSet->initialize($result);

			$data = $resultSet->toArray();
			return $data;
		}		
	}
}

?>
