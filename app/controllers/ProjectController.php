<?php
	require_once( '../app/models/ToolsModel.php' );
	require_once( '../app/models/LanguagesModel.php' );
	require_once( '../app/models/ProjectsModel.php' );
	
	class ProjectController extends Zend_Controller_Action
	{
		public $inputs = array();
		public $tools = array();
		public $languages = array();
	
		public function init() {
			$this->session = new Zend_Session_Namespace('session');
				
			$this->view->user_id = isset($this->session->user_id) ? $this->session->user_id : "";
			$this->view->first_name = isset($this->session->first_name) ? $this->session->first_name : "";
			$this->view->last_name = isset($this->session->last_name) ? $this->session->last_name : "";
			
			//$this->session_alert = new Zend_Session_Namespace('');
			//$this->Model = new Model();
			//$this->_helper->layout->setLayout('');
			
			$this->tools_model = new ToolsModel( );
			$this->languages_model = new LanguagesModel( );
			$this->projects_model = new ProjectsModel( );
			
			$this->tools = $this->tools_model->getAll( );
			$this->languages = $this->languages_model->getAll( );
		}
		
		public function indexAction()
		{
		
		}
		
		public function newAction()
		{
			$this->view->tools = $this->tools;
			$this->view->languages = $this->languages;
		}
		
		public function createAction()
		{
			$this->inputs = array(
									'title'        			,
									'url'        			,
									$this->session->user_id	,
									'courses'         		,
									'date_month'        	,
									'date_day'         		,
									'date_year'     		,
									'assign_spec'       	,
									'project_approach'  	,
									'otherTools'  			,
									'otherLanguages'  		,
								);
			
			//validate
			/* if (valid) {
				$this->projects_model->create($arguments);
				$toolChecked = $this->projects_model->handleCBs( $this->tools );
				$this->project_tools_model->insert(foreach $toolChecked as $tool);
				$toolChecked = $this->projects_model->handleCBs( $this->languages );
				$this->project_tools_model->insert(foreach $toolChecked as $language);
			} else {
				redirect to /project/new
			}*/
			
			$proj = $this->projects_model->create( $this->inputs );
			
			//need to add into linking project_tools & project_languages tables now
			
			$this->view->toolsChecked = $this->projects_model->handleCBs( $this->tools );
			$this->view->languagesChecked = $this->projects_model->handleCBs( $this->languages );
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