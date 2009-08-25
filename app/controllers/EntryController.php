<?php
	require_once( '../app/models/ProjectsModel.php' );
	
	class EntryController extends Zend_Controller_Action
	{
		public function init( ) {
			$this->session = new Zend_Session_Namespace('session');
			//$this->_helper->layout->setLayout('');
		}
		
		public function indexAction( )
		{
			$this->view->alert = $this->session->alert;
			$this->view->success = $this->session->success;
		}
		
		public function createAction( )
		{

			//these are all checkboxes (except the last text input) that needs to be converted to a string before we can insert them into the database field
			$toolsCB = array(
							'photoshop',	
							'flash',	
							'illustrator',	
							'dreamweaver',	
							'fireworks',	
							'coda',	
							'textmate',		
							'jquery',	
							'otherTools'
							);	
			
			
			//these are all checkboxes (except the last text input) that needs to be converted to a string before we can insert them into the database field
			$languagesCB = array(
							'html'			,
							'css'			,
							'xml'			,
							'javascript'	,
							'php'			,
							'actionscript'	,
							'otherLanguages',
							);	
							
			 
			$this->projects_model = new ProjectsModel( );
			//$valid = $this->projects_model->validate( $txtInput );
			$toolString = $this->projects_model->handleCBs( $toolsCB );
			$languageString = $this->projects_model->handleCBs( $languagesCB );
			
			
			//Test insert
			$arguments = array(
							$_POST['url'],
							$_POST['authors'],
							$_POST['title'],
							$toolString,
							$_POST['courses'],
							$languageString,
							$_POST['date_complete'],
							$_POST['assign_spec'],
							$_POST['project_approach']
						);
			
			$this->projects_model->create( $arguments );

			//Set View username_error if not valid inputs
			/*if ( !$valid ) {
				$this->session->username_error = $valid;
				
				//Redirect Entry
				header( 'Location: /entry' );
				
			} else {
				//Create the new user
				$this->projects_model->create( );
				
				//Set Success message
				$this->session->success = "{$_POST['title']} is added";
				
				//Clear username error
				unset( $this->session->alert );
				
				//Redirect Upload
				header( 'Location: /upload' );
			}*/
		}
		
	}
	
?>