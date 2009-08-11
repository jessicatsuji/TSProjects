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
			$this->projects_model = new ProjectsModel( );
			$valid = $this->projects_model->validate( );

			//Set View username_error if not valid inputs
			if ( !$valid ) {
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
			}
		}
		
	}
	
?>