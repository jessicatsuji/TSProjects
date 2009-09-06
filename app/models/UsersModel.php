<?php
	Class UsersModel extends Zend_Db_Table_Abstract
	{
		private $table = "users";
		
		function getOne( $arguments )
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
			
			//Set arguments to select statement
			$select = "SELECT * FROM $this->table WHERE id = '{$arguments[0]}'";
		
			//Select from table
			return $db->fetchRow($select);
		}

		function getAll( )
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
			
			//Set arguments to select statement
			$select = "SELECT * FROM $this->table";
		
			//Select from table
			return $db->fetchAssoc($select);
		}
		
		function createOne( $arguments )
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
		
			//Set arguments to Zend insert associative array
			$insertArgs = array(
				'first_name'        => $arguments[0],
				'last_name'         => $arguments[1],
				'email'         	=> $arguments[2],
				'pass'         		=> $arguments[3],
				'security_question' => $arguments[4],
				'security_answer'   => $arguments[5]
				);
		
			//Insert into table
			$db->insert($this->table, $insertArgs);

			//return Id of last inserted row
			return $db->lastInsertId();
		}
		
		function updateOne( $arguments )
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
		
			//Set arguments to Zend insert associative array
			$insertArgs = array(
				'first_name'        => $arguments[1],
				'last_name'         => $arguments[2],
				);
				
			$where[] = "id = '{$arguments[0]}'";
			
			//Update
			return $db->update($this->table, $insertArgs, $where);
		}
		
		function deleteOne( $arguments )
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
		
			//Set arguments to select statement
			$delete = "id = '{$arguments[0]}'";
		
			//Delete from table
			return $db->delete($this->table, $delete);
		}
		
		function login($arguments)
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
			
			//Set arguments to select statement
			$select = "SELECT * FROM $this->table WHERE email = '{$arguments[0]}' AND pass = '{$arguments[1]}'";
		
			//Select from table
			return $db->fetchAssoc($select);
		}
		
		/*
		 **	encryptLogin method
		 */
		function encryptLogin( $arguments ) {
			return crypt($arguments[0], md5($arguments[1]));
			//return true;
		}
	}
?>