<?php
	require_once '/../../../../../../../grid/config/db-config.php';
	// include the jqGrid Class
	require_once "/../../../../../../../grid/helpers/jqGrid.php";
	// include the PDO driver class
	require_once "/../../../../../../../grid/helpers/jqGridSqlsrv.php";
	// Connection to the server
	$connectionInfo = array("UID" => DB_USER, "PWD" => DB_PASSWORD,"Database"=> DB, "ReturnDatesAsStrings" => true);
	$conn = sqlsrv_connect(DB_DSN, $connectionInfo);
	
	// Create the jqGrid instance
	$grid = new jqGrid($conn);
	// Write the SQL Query
	var_dump($_COOKIE);
	$dbTbl = "utilities";
	$ciSess = explode("{", $_COOKIE['ci_session']);
	$ciSess2 = explode(";", $ciSess[1]);
	$ciSess3 = explode(":", $ciSess2[11]);
	$ciSess3a = explode(":", $ciSess2[13]);
	$ciSess4 = str_replace('"',"",$ciSess3[2]);
	$ciSess4a = str_replace('"',"",$ciSess3a[2]);
	echo $ciSess4 . "<br />". $ciSess4a;
	$grid->SelectCommand = "SELECT * FROM " . $dbTbl . " WHERE system_code = '{$ciSess4}' AND project_code = '{$ciSess4a}'";
	$grid->dataType = "json";
	$grid->queryGrid();
?>