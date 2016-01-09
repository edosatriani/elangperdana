<?php
	$template = file_get_contents(LOCAL_DIR."/template/starter.html");
	$template = str_replace("{@menu-title@}","System Administrators",$template);
	$template = str_replace("{@menu-description@}","...",$template);
	$template = str_replace("{@module@}","apps",$template);
	$template = str_replace("{@sub-module@}","sys-admin",$template);

	/*Default-content, must be exist in all View Object */
	$template = str_replace("{@user-menu@}",$usermenu,$template);
	$template = str_replace("{@username@}",$_SESSION["user-fullname"],$template);
	$template = str_replace("{@user-member-since@}",$_SESSION["user-member-since"],$template);
	$template = str_replace("{@user-default-machine@}",$_SESSION["user-default-machine"],$template);
	$template = str_replace("{@user-position@}",$_SESSION["user-position"],$template);
	$template = str_replace("{@active-data@}",str_replace("dbH1_","",$_SESSION["activedb"]),$template);
	if($_SESSION["user-avatar"]!=""){
		$user_avatar = $_SESSION["user-avatar"];
	}else{
		if($_SESSION["user-gender"]=="female"){
				$user_avatar = "avatar3.png";
		}else{
				$user_avatar = "avatar5.png";
		}
	}
	$template = str_replace("{@user-avatar@}",$user_avatar,$template);
  /*end of default content*/

	$templateentry = file_get_contents(LOCAL_DIR."/template/".$_GET['app']."/entry.beb");

	$additionalcss = "<link href=\"assets/css/test.css\" rel=\"stylesheet\">";
  	$template = str_replace("{@additional-css@}",$additionalcss,$template);

	$additionaljavascript = "<script src=\"assets/js/app_greenSys_dataaccess.js\"></script>\n";
	$additionaljavascript .= "<script src=\"assets/js/function-test.js\"></script>\n";
	$template = str_replace("{@additional-javascript@}",$additionaljavascript,$template);

	$template = str_replace("{@main-content@}",$templateentry,$template);
	$template = str_replace("{@mode@}",$modify_status,$template);
	$template = str_replace("{@readonlymode@}",$readonlymode,$template);
	$template = str_replace("{@themes@}","default",$template);
	$template = str_replace("{@session-id@}",$_SESSION["session_id"],$template);
	$template = str_replace("{@autonumber@}",$autonumber,$template);
	$template = str_replace("{@today@}",date("m/d/Y"),$template);
	$template = str_replace("{@time@}",date("h:m:s"),$template);
	$template = str_replace("{@direct-active-size-0@}",$active_size,$template);
	$template = str_replace("{@current-active-size@}",$currentactivesize,$template);
	$template = str_replace("{@active-session-count@}",$countactivetrans,$template);
	$template = str_replace("{@active-users@}",$activeuser,$template);


	echo $template;

?>
