<?php

namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Sql;
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
            ->WHERE('id_film')          
			;
            date_default_timezone_set('GMT');
				
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
		('SELECT nama_film, harga_tiket, jam_tayang, film_image
			FROM Film 
		');
        date_default_timezone_set('GMT');
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
