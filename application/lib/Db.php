<?php

namespace application\lib;
use PDO;

class Db
{
	protected $db;
	
	function __construct()//+
	{
		$config = require 'application/config/db.php';
		$this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['db'].'',$config['username'],$config['password'],$config['options']);
		$this->db -> exec("set names utf8");
	}

	public function dbCheckError($query)
	{
		$errInfo = $query->errorInfo();
		if ($errInfo[0] !== PDO::ERR_NONE)
		{
			echo $errInfo[2];
			exit();
		}
		return true;
	}

	//getting all rows with a conditions
	public function selectAll($table, $params = [])
	{
		$sql = "SELECT * FROM $table";
		
		if (!empty($params))
		{
			$i=0;
			foreach($params as $key => $value)
			{
				if(!is_numeric($value))
				{
					$value = "'".$value."'";
				}
				if ($i===0)
				{
					$sql = $sql . " WHERE $key = $value";
				}
				else
				{
					$sql = $sql . " AND $key = $value";
				}
				$i++;
			}
		}
	
		$query = $this -> db -> prepare($sql);
		$query->execute();
		
		$this -> dbCheckError($query);
		return $query -> fetchAll();
	}

	public function selectСolumn($table, $column, $params = [])//+
	{
		if (isset($this -> selectAll($table, $params)[0][$column]))
		{
			return $this -> selectAll($table, $params)[0][$column];
		}
		else
		{
			return false;
		}
	}

	public function selectAllonPage($table, $limit, $offset, $parameter, $type)//+++
	{
		$sql = "SELECT * FROM $table ORDER BY $parameter $type LIMIT $limit OFFSET $offset";
		$query = $this -> db -> prepare($sql);
		$query->execute();
		$this -> dbCheckError($query);
		return $query -> fetchAll();
	}

	//Writing data to the database
	public function insert($table,$params)//+
	{
		$i=0;
		$coll = '';
		$mask = '';
		foreach($params as $key => $value){
			if ($i===0)
			{
				$coll = $coll."$key";
				$mask = $mask."'"."$value"."'";
			}
			else
			{
				$coll = $coll.", $key";
				$mask = $mask.", '"."$value"."'";
			}	
			$i++;
		}

		$sql = "INSERT INTO $table ($coll) VALUES ($mask)";
		$query = $this -> db -> prepare($sql);
		$query->execute($params);
		$this -> dbCheckError($query);
		return $this -> db -> lastInsertId();
	}

	//updating a record in the database
	public function update($table, $id, $params)
	{
		global $BD;
		$i=0;
		$str = '';
		
		foreach($params as $key => $value)
		{
			if ($i===0)
			{
				$str = $str.$key." = '".$value."'";
			}
			else
			{
				$str = $str.", ".$key." = '".$value."'";
			}	
			$i++;
		}

		$sql = "UPDATE $table SET $str where id = $id";
		$query = $this -> db -> prepare($sql);
		$query->execute($params);
		$this -> dbCheckError($query);
	}

	//line deletion
	public function delete($table, $id)
	{
		$sql = "DELETE FROM $table where id =". $id;
		$query = $this -> db -> prepare($sql);
		$query->execute();
		$this -> dbCheckError($query);
	}

	//counts the number of lines
	public function numPosts($table,$column)//+++
	{
		$sql = "SELECT COUNT($column) FROM $table";
		$query = $this -> db -> prepare($sql);
		$query->execute();
		$this -> dbCheckError($query);
		return $query -> fetchColumn();
	}
} 