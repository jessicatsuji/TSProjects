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
			return $db->fetchRow($select);
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

		function getUserProj($arguments)
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
			
			//Set arguments to select statement
			$select = "SELECT * FROM $this->table WHERE author_id = '{$arguments[0]}'";
		
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
			$return_array = array();
			
			foreach ($cbValues as $cb) {
				$type = strtolower($cb['type']);
				if(isset($_POST[$type])) {
					array_push($return_array,  $_POST[$type]);
				}
			}
			
			return $return_array;
		}
		
		function create($arguments)
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
			
		
			//Set arguments to Zend insert associative array
			$insertArgs = array(
				'title'        		=> $_POST[ $arguments[0] ],
				'url'        		=> $_POST[ $arguments[1] ],
				'author_id'         => $arguments[2] 		  ,
				'courses'         	=> $_POST[ $arguments[3] ],
				'date_month'        => $_POST[ $arguments[4] ],
				'date_day'         	=> $_POST[ $arguments[5] ],
				'date_year'     	=> $_POST[ $arguments[6] ],
				'assign_spec'       => $_POST[ $arguments[7] ],
				'project_approach'  => $_POST[ $arguments[8] ],
				'other_tools'  		=> $_POST[ $arguments[9] ],
				'other_languages'  	=> $_POST[ $arguments[10] ],
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
				'title'        		=> $_POST[ $arguments[0] ],
				'url'        		=> $_POST[ $arguments[1] ],
				'author_id'         => $arguments[2] 		  ,
				'courses'         	=> $_POST[ $arguments[3] ],
				'date_month'        => $_POST[ $arguments[4] ],
				'date_day'         	=> $_POST[ $arguments[5] ],
				'date_year'     	=> $_POST[ $arguments[6] ],
				'assign_spec'       => $_POST[ $arguments[7] ],
				'project_approach'  => $_POST[ $arguments[8] ],
				'other_tools'  		=> $_POST[ $arguments[9] ],
				'other_languages'  	=> $_POST[ $arguments[10] ],
				);
				
			$where[] = "id = '{$arguments[11]}'";
			
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
		
		function isOwner( $arguments )
		{
			//Connect to database
			$db = $this->getDefaultAdapter();
			
			//Set arguments to select statement
			$select = "SELECT * FROM $this->table WHERE id = '{$arguments[1]}' AND author_id = '{$arguments[0]}'";
		
			//Select from table
			return $db->fetchRow($select);
		}
	}
?>