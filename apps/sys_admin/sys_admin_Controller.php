<?php

class sys_admin_Controller {

    public function __construct() {
	    $model = new sys_admin_Model;
      $objcolection = new objectcollection;
      $usermenu =  $objcolection->render_user_menu($_SESSION["user-id"]);

      $shield = new Security();
	    $modify_status = "INS";
      $readonlymode = "";

  		if (!isset($_SESSION["session_id"]) && empty($_SESSION["session_id"])){

  			$_SESSION["session_id"] = md5(microtime().$_SERVER['REMOTE_ADDR']);
  		}

      $activeuser = $model->get_activeusers();

  		require_once $_GET['app'].'_View.php';
    }

}
