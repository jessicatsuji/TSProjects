<?php
	require_once( '../app/models/ProjectsModel.php' );
	require_once( '../app/models/UsersModel.php' );
	
	class IndexController extends Zend_Controller_Action
	{
		public function init() {
			$this->session = new Zend_Session_Namespace('session');
				
			$this->view->user_id = isset($this->session->user_id) ? $this->session->user_id : "";
			$this->view->first_name = isset($this->session->first_name) ? $this->session->first_name : "";
			$this->view->last_name = isset($this->session->last_name) ? $this->session->last_name : "";
			//$this->Model = new Model();
			//$this->_helper->layout->setLayout('');
			
			$this->projects_model = new ProjectsModel( );
			$this->users_model = new UsersModel( );
		}
		
		public function indexAction()
		{
			$all_proj = $this->projects_model->getAll( );
			
			foreach( $all_proj as &$proj ) {
				$author = $this->users_model->getOne( array( $proj['author_id'] ) );
				$proj['author'] = $author['first_name'] . " " . $author['last_name'];
			}
			
			$this->view->all_projects = $all_proj;
		}
		
	}
	
?>