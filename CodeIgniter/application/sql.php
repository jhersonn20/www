<?php
require_once "../../sample/jq-config.php";
// include the jqGrid Class
require_once "../../sample/php/jqGrid.php";
// include the PDO driver class
//require_once "php/jqGridPdo.php";
	require_once "../../sample/php/jqGridSqlsrv.php";
// Connection to the server
//$conn = new PDO(DB_DSN,DB_USER,DB_PASSWORD);
	$connectionInfo = array("UID" => DB_USER, "PWD" => DB_PASSWORD,"Database"=> DB, "ReturnDatesAsStrings" => true);
	$conn = sqlsrv_connect(DB_DSN, $connectionInfo);

// Create the jqGrid instance
$grid = new jqGrid($conn);
// Write the SQL Query
//$grid->SelectCommand = 'SELECT OrderID, OrderDate, CustomerID, Freight, ShipName FROM orders';
$grid->SelectCommand = 'SELECT * FROM utilities';
$grid->dataType = "json";
$grid->queryGrid();
?>