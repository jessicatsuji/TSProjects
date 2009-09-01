<?php
	require_once( '../app/models/ToolsModel.php' );
	require_once( '../app/models/LanguagesModel.php' );
	
	class ProjectController extends Zend_Controller_Action
	{
		public function init() {
			$this->session = new Zend_Session_Namespace('session');
			//$this->session_alert = new Zend_Session_Namespace('');
			//$this->Model = new Model();
			//$this->_helper->layout->setLayout('');
		}
		
		public function indexAction()
		{
		
		}
		
		public function newAction()
		{
			$this->tools_model = new ToolsModel( );
			$this->view->tools = $this->tools_model->getAll( );
			$this->languages_model = new LanguagesModel( );
			$this->view->languages = $this->languages_model->getAll( );
		}
		
		public function createAction()
		{
			
		}
		
		public function uploadAction()
		{
		
		}
		
		public function createdAction()
		{
		
		}
		
		public function viewAction()
		{
		
		}
		
		public function editAction()
		{
		
		}
		
		public function updateAction()
		{
		
		}
		
		public function reuploadAction()
		{
		
		}
		
		public function deleteAction()
		{
		
		}
		
		public function editedAction()
		{
		
		}
		
	}
	
?>