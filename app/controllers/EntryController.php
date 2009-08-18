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
		
			//these are all text inputs
			$txtInput = array(
							'Title Input'				=>	$_POST['title'],
							'Url Input'					=>	$_POST['url'],
							'Authors Input'				=>	$_POST['authors'],
							'Courses Input'				=>	$_POST['courses'],
							'Date Complete Input'		=>	$_POST['date_complete'],
							'Assignemnt Input'			=>	$_POST['assign_spec'],
							'Project Approach Input'	=>	$_POST['project_approach']
							);
			
			//these are all checkboxes (except the last text input) that needs to be converted to a string before we can insert them into the database field
			$toolsCB = array(
							$_POST['photoshop'],
							$_POST['flash'],
							$_POST['illustrator'],
							$_POST['dreamweaver'],
							$_POST['fireworks'],
							$_POST['coda'],
							$_POST['textmate'],
							$_POST['jquery'],
							$_POST['otherTools'] //hey this is an input
							);	
			
			//these are all checkboxes (except the last text input) that needs to be converted to a string before we can insert them into the database field
			$languagesCB = array(
							$_POST['html'],
							$_POST['css'],
							$_POST['xml'],
							$_POST['javascript'],
							$_POST['php'],
							$_POST['actionscript'],
							$_POST['otherLanguages'] //hey this is an input
							);				
			
			$this->projects_model = new ProjectsModel( );
			$valid = $this->projects_model->validate( $txtInput, $toolsCB, $languagesCB );
			
			var_dump($valid);

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