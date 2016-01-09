<?php
	$template = file_get_contents(LOCAL_DIR."/template/starter.html");
	$template = str_replace("{@menu-title@}","Dashboard",$template);
	$template = str_replace("{@menu-description@}",$_SESSION["ws-name"],$template);
	$template = str_replace("{@module@}","Home",$template);
	$template = str_replace("{@sub-module@}","Dashboard",$template);

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

	$additionalcss = "<link href=\"assets/css/core.css\" rel=\"stylesheet\">";
  	$template = str_replace("{@additional-css@}",$additionalcss,$template);

	$corejavascript .= "<script src=\"assets/js/global-function.js\"></script>\n";
	$template = str_replace("{@core-javascript@}",$corejavascript,$template);

	$additionaljavascript = "<script src=\"plugins/chartjs/Chart.min.js\"></script>\n";
	$additionaljavascript .= "<script src=\"assets/js/function-chart.js\"></script>\n";

	$template = str_replace("{@additional-javascript@}",$additionaljavascript,$template);

	$maincontent = file_get_contents(LOCAL_DIR."/template/dashboard/mainlayout.beb");
	$template = str_replace("{@main-content@}",$maincontent,$template);

	$template = str_replace("{@count-of-spk@}",$spk,$template);
	$template = str_replace("{@count-of-sales@}",$sales,$template);
	$template = str_replace("{@count-of-faktur@}",$faktur,$template);
	$template = str_replace("{@count-of-tagihan@}",$tagihan,$template);
	$template = str_replace("{@salesbyfincoy_summary@}",$json_salesbyfincoy_summary,$template);
	$template = str_replace("{@salesstatistik_0_summary@}",	$array_salesstatistik_0_summary,$template);
	$template = str_replace("{@salesstatistik_1_summary@}",	$array_salesstatistik_1_summary,$template);


	echo $template;

?>
