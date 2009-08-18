<?php
	Class ProjectsModel extends Zend_Db_Table_Abstract
	{
		private $table = "projects";
		
		function getOne($arguments)
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
			
			//Set arguments to select statement
			$select = "SELECT * FROM $this->table WHERE id = '{$arguments[0]}'";
		
			//Select from table
			return $db->fetchAssoc($select);
		}

		function getAll()
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
			
			//Set arguments to select statement
			$select = "SELECT * FROM $this->table";
		
			//Select from table
			return $db->fetchAssoc($select);
		}
		
		function validate( $txtInput )
		{
			$return_array = array( );
					
			$validator = new Zend_Validate_StringLength(3, 250);
			
			//Validator messages
			$validator->setMessages( array(
				Zend_Validate_StringLength::TOO_SHORT =>
					'The string value, \' %value% \' is too short',
				Zend_Validate_StringLength::TOO_LONG =>
					'You entered \' %max% \' characters, which is over 250.'
			));
			
			// Looping through the text inputs
			foreach($txtInput as $key => $txtIn){
				if(!$validator->isValid($txtIn)) {
					$error = $validator->getMessages();
					foreach ($error as $e) {
						$errorMessage =  $key . ': '. $e;
					}
					array_push($return_array,  $errorMessage);
				}
			}
			
			return $return_array;
		}
		
		function handleCBs( $cbValues ) {
			$return_string;
			
			foreach ($cbVAlues as $key => $cb) {
				$return_string .= isset($cb) ? $key . ", " : NULL;
			}
			
			return $return_string;
		}
		
		function create()
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
			
			//Test insert
			$arguments = array(
							'myURL.com',
							'author1',
							'title is awesome',
							'tools',
							'courses',
							'languages',
							'May 2, 2009',
							'assignment specification',
							'project approach'
						);
		
			//Set arguments to Zend insert associative array
			$insertArgs = array(
				'url'        		=> $arguments[0],
				'authors'         	=> $arguments[1],
				'title'        		=> $arguments[2],
				'tools'         	=> $arguments[3],
				'courses'         	=> $arguments[4],
				'languages'         => $arguments[5],
				'date_complete'     => $arguments[6],
				'assign_spec'       => $arguments[7],
				'project_approach'  => $arguments[8],
				);
		
			//Insert into table
			return $db->insert($this->table, $insertArgs);
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
			$delete = "id = '{$arguments[0]}'";
		
			//Delete from table
			return $db->delete($this->table, $delete);
		}
	}
?>