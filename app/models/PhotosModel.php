<?php
	Class PhotosModel extends Zend_Db_Table_Abstract
	{
		private $table = "photos";
		
		function getOne($arguments)
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
			
			//Set arguments to select statement
			$select = "SELECT * FROM $this->table WHERE id = '{$arguments[0]}'";
		
			//Select from table
			return $db->fetchRow($select);
		}

		function getAll( $arguments )
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
			
			//Set arguments to select statement
			$select = "SELECT * FROM $this->table WHERE project_id = '{$arguments[0]}'";
		
			//Select from table
			$images_array = $db->fetchAssoc($select);
			
			//Build array
			$return_array = array();
			foreach ($images_array as $images) {
				$return_array[$images['type']] = array('file_name' => $images['file_name'], 'id' => $images['id']);
			}

			return $return_array;
		}
		
		function addOne($arguments)
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
		
			//Set arguments to Zend insert associative array
			$insertArgs = array(
				'file_name'        	=> $arguments[0],
				'type'         		=> $arguments[1],
				'project_id'        => $arguments[2],
				);
		
			//Insert into table
			$db->insert($this->table, $insertArgs);

			//return Id of last inserted row
			return $db->lastInsertId();
		}
		
		function updateOne($arguments)
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
		
		function deleteOne($arguments)
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
		
			//Set arguments to select statement
			$delete = "id = '{$arguments[0]}' AND project_id = '{$arguments[1]}'";
		
			//Delete from table
			return $db->delete($this->table, $delete);
		}
		
		function deleteAll($arguments)
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
		
			//Set arguments to select statement
			$delete = "project_id = '{$arguments[0]}'";
		
			//Delete from table
			return $db->delete($this->table, $delete);
		}
	}
?>