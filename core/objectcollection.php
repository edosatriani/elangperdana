<?php

/* author   : edo satriani

 */
class objectcollection extends configSettings {
	public $dbcon;

	public $dbhost;
	public $dbuser;
	public $dbpass;
	public $dbname;

	public function __construct() {

		$this->LoadSettings();

		$username = $this->dbuser;
		$password = $this->dbpass;
		$hostname = $this->dbhost;

		try {
			//connection to the database
			$this->dbcon = mssql_connect($hostname, $username, $password)or die("Unable to connect to MSSQL");
		} catch(Exception $e) {
			throw new Exception($e->getMessage());
		}
	}

	public function render_user_menu($userid){
		try
		{
			//select the database
			mssql_select_db($this->dbname, $this->dbcon);

			//SQL Select statement
			$xml = new XMLHandler(XML_DIR . "web_request_global.xml");
			$sql_from_xml = $xml->getNode("selectedmenu");

			$sqlselect = str_replace("FILTER_BY_PROGRAM"," WHERE USERID='$userid' ",$sql_from_xml);

			//Run the SQL query
			$sqlquery = mssql_query($sqlselect);
			$string_result= "";
			$createChild = false;
			while ($result = mssql_fetch_array($sqlquery))	{
				if($result["HAS_CHILD"] == "1"){
					if($createChild){
							$string_result .= '</ul>';
							$string_result .= '</li>';
					}
					$string_result .= '<li class="treeview{activeclass}">';
					$string_result .= '	<a href="#"><i class="'.$result["MENU_CLASS"].'"></i> <span>'.$result["MENU_DESCRIPTION"].'</span> <i class="fa fa-angle-left pull-right"></i></a>';
					$string_result .= '	<ul class="treeview-menu">';
					$createChild = true;
				}else{
					$aciveclass="";
					$aciveclassforparent="";
					if($result["URL_TARGET"]==$_GET['app']){
						$aciveclass=' class="active"';
						$aciveclassforparent=" active";
					}
					$string_result = str_replace("{activeclass}",$aciveclassforparent,$string_result);
					$string_result .= '<li'.$aciveclass.'><a href="'.$result["URL_TARGET"].'"><i class="'.$result["MENU_CLASS"].'"></i>'.$result["MENU_DESCRIPTION"].'</a></li>';
				}
			}
			if($createChild){
					$string_result .= '</ul>';
					$string_result .= '</li>';
			}
			return $string_result;

		} catch(Exception $e) {

			throw new Exception($e->getMessage());

		}
	}

	// Function to get the client IP address
	public function get_client_ip() {
		$ipaddress = '';
		/*if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		*/
		$cookie_name="greensysclientinfo";

		if(isset($_COOKIE[$cookie_name])) {
			 $ipaddress=$_COOKIE[$cookie_name];
		}
		return $ipaddress;
	}


	public function executeQuery($strSQL){

		try {

			//select the database
			mssql_select_db($this->dbname, $this->dbcon);

			//Run the SQL query
			$this->result = mssql_query($strSQL);

			if(!$this->result) {
				throw new Exception($this->dbcon->error);
			}else{
				return true;
			}

		} catch(Exception $e) {

			throw new Exception($e->getMessage());

		}
	}

	public function __destruct() {
 		unset($this);
 	}

}
