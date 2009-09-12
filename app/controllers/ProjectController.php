<?php
	require_once( '../app/models/UsersModel.php' );
	require_once( '../app/models/ToolsModel.php' );
	require_once( '../app/models/LanguagesModel.php' );
	require_once( '../app/models/ProjectsModel.php' );
	require_once( '../app/models/ProjectToolsModel.php' );
	require_once( '../app/models/ProjectLanguagesModel.php' );
	require_once( '../app/models/PhotosModel.php' );
	
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
			
			$this->users_model = new UsersModel( );
			
			$this->tools_model = new ToolsModel( );
			$this->languages_model = new LanguagesModel( );
			$this->projects_model = new ProjectsModel( );
			$this->project_tools_model = new ProjectToolsModel( );
			$this->project_languages_model = new ProjectLanguagesModel( );
			$this->photos_model = new PhotosModel( );
			
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
			
			$toolsChecked = $this->projects_model->handleCBs( $this->tools );
			$languagesChecked = $this->projects_model->handleCBs( $this->languages );
			
			foreach( $toolsChecked as $tool ) {
				$this->project_tools_model->addOne( array($tool, $proj));
			}
			
			foreach( $languagesChecked as $language ) {
				$this->project_languages_model->addOne( array($language, $proj));
			}
			
			header('Location: /account/view');
		}
		
		public function addphotosAction()
		{
			$this->view->cssLink = "/css/joe_photos.css";
		
			//Verify Owner
			$project_id = $this->_request->getParam('id');
			$project_helper = $this->_helper->Projects;
			if( !$project_helper->isOwner( $this->session->user_id, $project_id, $this->projects_model ) ) {
				header("Location: /error/error");
			} else {
				$this->view->id = $project_id;
				$this->view->photos = $this->photos_model->getAll( array( $project_id ) );
			}
		}
		
		public function uploadAction()
		{
		
			$project_id = $this->_request->getParam('id');
			//Validate that project belongs to user here.
			$project_helper = $this->_helper->Projects;
			if( $project_helper->isOwner( $this->session->user_id, $project_id, $this->projects_model ) ) {
			    
	            $adapter = new Zend_File_Transfer_Adapter_Http();
	            
	            foreach($adapter->getFileInfo() as $key => $file) {
	            	if($file != NULL) {
		            	//Get extension
			            $path = split("[/\\.]", $file['name']);
						$ext = end($path);
		
						try {
							$adapter->addValidator('Extension', false, array('extension' => 'jpg,gif,png', 'case' => true));
							//Should probably use the array method below to enable overwriting
							$new_name = md5(rand()) .'-' . $project_id . '.' . $ext;
							//Add rename filter
							$adapter->addFilter('Rename', '/Applications/MAMP/htdocs/Repositories/TSProjects/public/uploads/' . $new_name);
						} catch(Zend_File_Transfer_Exception $e) {
							//die($e->getMessage());
							$error = $e->getMessage();
						}
						
			            try {
			            	//Store
			            	if ($adapter->receive($file['name'])) {
					        	$this->photos_model->addOne( array( $new_name, $key, $project_id ) );
					        }
			            } catch (Zend_File_Transfer_Exception $e) {
			            	//die($e->getMessage());
							$error = $e->getMessage();
			            }
			    	}
	            }
	            header("Location: /project/view/id/{$project_id}");
            } else {
            	header("Location: /account/view");
            }
		}
		
		public function createdAction()
		{
		
		}
		
		public function viewAction()
		{
			$this->view->cssLink = "/css/joe_project.css";
			
			//Verify Exists
			$project_id = $this->_request->getParam('id');
			$project_helper = $this->_helper->Projects;
			if( !$project_helper->exists( $project_id, $this->projects_model ) ) {
				header("Location: /error/error");
			} else {
				$this->view->id = $project_id;
				
				$this->project['info'] = $this->projects_model->getOne( array( $project_id ));
				
				$this->project['author'] = $this->users_model->getOne( array( $this->project['info']['author_id'] ) );
				
				$this->project['photos'] = $this->photos_model->getAll( array ( $project_id ) );
				
				$projTools = $this->project_tools_model->getOneByProject( array( $project_id ) );
				$this->project['tools'] = array();
				foreach ( $projTools as $tool ) {
					$toolArray = $this->tools_model->getOne( array( $tool['tools_id'] ) );
					array_push( $this->project['tools'], $toolArray['type'] );
				}
				
				$projLanguages = $this->project_languages_model->getOneByProject( array( $project_id ) );
				$this->project['languages'] = array();
				foreach ( $projLanguages as $language ) {
					$languageArray = $this->languages_model->getOne( array( $language['language_id'] ) );
					array_push( $this->project['languages'], $languageArray['type'] );
				}
	
				$this->view->project = $this->project;
			}
		}
		
		public function editAction()
		{
		
			//Verify Owner
			$project_id = $this->_request->getParam('id');
			$project_helper = $this->_helper->Projects;
			if( !$project_helper->isOwner( $this->session->user_id, $project_id, $this->projects_model ) ) {
				header("Location: /error/error");
			} else {
				$this->view->id = $project_id;
				
				$this->project['info'] = $this->projects_model->getOne( array( $project_id ));
				
				$this->project['author'] = $this->users_model->getOne( array( $this->project['info']['author_id'] ) );
				
				//$this->project['images'] = $this->image_model->getAll($project_id);

				$projTools = $this->project_tools_model->getOneByProject( array( $project_id ) );
				$this->project['tools'] = array();
				foreach ( $projTools as $tool ) {
					$toolArray = $this->tools_model->getOne( array( $tool['tools_id'] ) );
					array_push( $this->project['tools'], $toolArray['type'] );
				}

				
				$projLanguages = $this->project_languages_model->getOneByProject( array( $project_id ) );
				$this->project['languages'] = array();
				foreach ( $projLanguages as $language ) {
					$languageArray = $this->languages_model->getOne( array( $language['language_id'] ) );
					array_push( $this->project['languages'], $languageArray['type'] );
				}
				
				
				$this->view->tools = $this->tools;
				$this->view->languages = $this->languages;
	
				$this->view->project = $this->project;
			}
		}
		
		public function updateAction()
		{
			$project_id = $this->_request->getParam('id');
			
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
									$project_id  		
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
			
			$proj = $this->projects_model->updateOne( $this->inputs );
			
			$toolsChecked = $this->projects_model->handleCBs( $this->tools );
			$languagesChecked = $this->projects_model->handleCBs( $this->languages );
			
			
			$this->project_tools_model->deleteAll( array($project_id));
			$this->project_languages_model->deleteAll( array($project_id));
			
			foreach( $toolsChecked as $tool ) {
				$this->project_tools_model->addOne( array($tool, $project_id));
			}
			
			foreach( $languagesChecked as $language ) {
				$this->project_languages_model->addOne( array($language, $project_id));
			}
			
			header("Location: /project/view/id/$project_id");
		}
		
		public function removeAction()
		{
			$project_id = $this->_request->getParam('id');
				
			$this->view->project = $this->projects_model->getOne( array ( $project_id ) );
		}
		
		public function removephotoAction()
		{
			$photo_id = $this->_request->getParam('id');
			$project_id = $this->_request->getParam('project');
				
			$this->view->photo = $this->photos_model->getOne( array ( $photo_id ) );
			$this->view->id = $project_id;
		}
		
		public function deleteAction()
		{	
			$project_id = $this->_request->getParam('id');
				
			$this->projects_model->deleteOne( array( $project_id ));
			
			$this->photos_model->deleteAll( array ( $project_id ) );
			
			$this->project_tools_model->deleteAll( array( $project_id ) );
			
			$this->project_languages_model->deleteAll( array( $project_id ) );
			
			header("Location: /account/view");
		}
		
		public function deletephotoAction()
		{
			$photo_id = $this->_request->getParam('id');
			$project_id = $this->_request->getParam('project');
			
			//Varify Project Ownership
			$project_helper = $this->_helper->Projects;
			if($project_helper->isOwner($this->session->user_id, $project_id, $this->projects_model)) {
				$this->photos_model->deleteOne( array( $photo_id, $project_id ) );
			}
			
			header("Location: /project/addphotos/id/{$project_id}");
			
		}
		
		public function editedAction()
		{
		
		}
		
	}
	
?>