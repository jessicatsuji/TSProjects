<?php
	class Helper_Projects extends Zend_Controller_Action_Helper_Abstract
	{
		function exists( $project_id, $project_model )
		{
			return $project_model->getOne( array( $project_id ) );
		}
		
		function isOwner($user_id, $project_id, $project_model)
		{
			return $project_model->isOwner($user_id, $project_id);
		}
	}
?>