<?php
	require_once( '../app/models/ProjectsModel.php' );
	require_once( '../app/models/UsersModel.php' );
	require_once( '../app/models/PhotosModel.php' );
	
	class AccountController extends Zend_Controller_Action
	{
		public function init() {
			$this->session = new Zend_Session_Namespace('session');
			$this->view->alert = isset($this->session->alert) ? $this->session->alert : "";
				
			$this->view->user_id = isset($this->session->user_id) ? $this->session->user_id : "";
			$this->view->first_name = isset($this->session->first_name) ? $this->session->first_name : "";
			$this->view->last_name = isset($this->session->last_name) ? $this->session->last_name : "";
			
			$this->projects_model = new ProjectsModel( );
			$this->users_model = new UsersModel( );
			$this->photos_model = new PhotosModel( );
			//$this->_helper->layout->setLayout('');
		}
		
		public function indexAction()
		{
		
		}
		
		public function loginAction()
		{
			//validate and confirm pass here
			$encry = array($_POST['pass'], $_POST['email']);
			$pass = $this->users_model->encryptLogin( $encry );
			
			$arguments = array($_POST['email'], $pass);
			$logged_in = $this->users_model->login($arguments);
			if ($logged_in) {
				foreach ($logged_in as $user) {
					$this->session->user_id = $user['id'];
					$this->session->first_name = $user['first_name'];
					$this->session->last_name = $user['last_name'];
				}
				
				header("Location: /");
			} else {
				//Destroy Session
				header("Location: /account/logout");
			}
			
		}
		
		public function logoutAction()
		{
			//Destroy Session
			Zend_Session::destroy($remove_cookie = true, $readonly = true);
			header("Location: /");
		}
		
		public function newAction()
		{
			$this->view->cssLink = "/css/isaiah.css";
		}
		
		public function createAction()
		{
			// !!!!!!!!!!!!! Do Validation first !!!!!!!!!!!!!!!
			
			
			$encry = array($_POST['pass'], $_POST['email']);
			$pass = $this->users_model->encryptLogin( $encry );
			
			//validate and confirm pass here
			$arguments = array(
								$_POST['first_name'], 
								$_POST['last_name'], 
								$_POST['email'], 
								$pass, 
								$_POST['security_question'], 
								$_POST['security_answer']
							);
			$success = $this->users_model->createOne( $arguments );
			
			if ($success) {
				$this->session->user_id = $success;
				
				header("Location: /");
			} else {
				$this->session->alert = 'Could not add you.';
				header("Location: /account/new");
			}
		
		}
		
		public function forgotAction()
		{
		
		}
		
		public function resetAction()
		{
		
		}
		
		public function viewAction()
		{
			$this->view->cssLink = "/css/isaiah.css";
			
			if( $this->session->user_id == "" ) {
				header( "Location: /" );
			}
			
			$all_proj = $this->projects_model->getUserProj( array( $this->session->user_id ) );
			
			foreach( $all_proj as &$proj ) {
				$author = $this->users_model->getOne( array( $proj['author_id'] ) );
				$proj['author'] = $author['first_name'] . " " . $author['last_name'];
				
				
				$photos = $this->photos_model->getAll( array ( $proj['id'] ) );
				
				if( isset($photos['portrait']))
					$proj['photo'] = $photos['portrait'];
			}
			
			$this->view->all_projects = $all_proj;
		}
		
	}
	
?>