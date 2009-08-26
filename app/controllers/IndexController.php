<?php
	class IndexController extends Zend_Controller_Action
	{
		public function init() {
			$this->session = new Zend_Session_Namespace('session');
				
			$this->view->user_id = isset($this->session->user_id) ? $this->session->user_id : "";
			$this->view->first_name = isset($this->session->first_name) ? $this->session->first_name : "";
			$this->view->last_name = isset($this->session->last_name) ? $this->session->last_name : "";
			//$this->Model = new Model();
			//$this->_helper->layout->setLayout('');
		}
		
		public function indexAction()
		{
		
		}
		
	}
	
?>