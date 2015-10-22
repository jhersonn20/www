<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'default';
$active_record = TRUE;

/*$db['projdb']['hostname'] = "RCGOMEZ-PC\SQLEXPRESS";
$db['projdb']['username'] = "rcgomez";
$db['projdb']['password'] = "";
$db['projdb']['database'] = "projdb";
$db['projdb']['dbdriver'] = "sqlsrv";
$db['projdb']['dbprefix'] = "";
$db['projdb']['pconnect'] = TRUE;
$db['projdb']['db_debug'] = TRUE;
$db['projdb']['cache_on'] = FALSE;
$db['projdb']['cachedir'] = "";
$db['projdb']['char_set'] = "utf8";
$db['projdb']['dbcollat'] = "utf8_general_ci";
$db['projdb']['swap_pre'] = '';
$db['projdb']['autoinit'] = TRUE;
$db['projdb']['stricton'] = FALSE;

$db['default']['hostname'] = 'RCGOMEZ-PC\SQLEXPRESS';
$db['default']['username'] = 'rcgomez';
$db['default']['password'] = '';
$db['default']['database'] = 'global';
$db['default']['dbdriver'] = 'sqlsrv';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;*/

// $db['usccb']['hostname'] = 'localhost';
// $db['usccb']['username'] = 'root';
// $db['usccb']['password'] = 'mysql';
// $db['usccb']['database'] = 'usccb';
// $db['usccb']['dbdriver'] = 'mysql';
// $db['usccb']['dbprefix'] = '';
// $db['usccb']['pconnect'] = TRUE;
// $db['usccb']['db_debug'] = TRUE;
// $db['usccb']['cache_on'] = FALSE;
// $db['usccb']['cachedir'] = '';
// $db['usccb']['char_set'] = 'utf8';
// $db['usccb']['dbcollat'] = 'utf8_general_ci';
// $db['usccb']['swap_pre'] = '';
// $db['usccb']['autoinit'] = TRUE;
// $db['usccb']['stricton'] = FALSE;

//$db['DB2']['port']  = 1433;  //—> config using DB port, must Use DB PORT

// $db['PMDB']['hostname'] = 'RCTUAZON-PC';
// $db['PMDB']['username'] = 'sa';
// $db['PMDB']['password'] = 'admin';
// $db['PMDB']['database'] = 'PMDB';
// $db['PMDB']['dbdriver'] = 'sqlsrv';
// $db['PMDB']['dbprefix'] = '';
// $db['PMDB']['pconnect'] = FALSE;
// $db['PMDB']['db_debug'] = TRUE;
// $db['PMDB']['cache_on'] = FALSE;
// $db['PMDB']['cachedir'] = '';
// $db['PMDB']['char_set'] = 'utf8';
// $db['PMDB']['dbcollat'] = 'utf8_general_ci';
// $db['PMDB']['swap_pre'] = '';
// $db['PMDB']['autoinit'] = TRUE;
// $db['PMDB']['stricton'] = FALSE;

$db['dms']['hostname'] = 'JVCAYAO-PC';
$db['dms']['username'] = '';
$db['dms']['password'] = '';
$db['dms']['database'] = 'dms';
$db['dms']['dbdriver'] = 'sqlsrv';
$db['dms']['dbprefix'] = '';
$db['dms']['pconnect'] = FALSE;
$db['dms']['db_debug'] = TRUE;
$db['dms']['cache_on'] = FALSE;
$db['dms']['cachedir'] = '';
$db['dms']['char_set'] = 'utf8';
$db['dms']['dbcollat'] = 'utf8_general_ci';
$db['dms']['swap_pre'] = '';
$db['dms']['autoinit'] = TRUE;
$db['dms']['stricton'] = FALSE;

$db['piping']['hostname'] = 'JVCAYAO-PC';
$db['piping']['username'] = '';
$db['piping']['password'] = '';
$db['piping']['database'] = 'piping';
$db['piping']['dbdriver'] = 'sqlsrv';
$db['piping']['dbprefix'] = '';
$db['piping']['pconnect'] = FALSE;
$db['piping']['db_debug'] = TRUE;
$db['piping']['cache_on'] = FALSE;
$db['piping']['cachedir'] = '';
$db['piping']['char_set'] = 'utf8';
$db['piping']['dbcollat'] = 'utf8_general_ci';
$db['piping']['swap_pre'] = '';
$db['piping']['autoinit'] = TRUE;
$db['piping']['stricton'] = FALSE;

$db['qms_pip']['hostname'] = 'JVCAYAO-PC';
$db['qms_pip']['username'] = '';
$db['qms_pip']['password'] = '';
$db['qms_pip']['database'] = 'qms_pip';
$db['qms_pip']['dbdriver'] = 'sqlsrv';
$db['qms_pip']['dbprefix'] = '';
$db['qms_pip']['pconnect'] = FALSE;
$db['qms_pip']['db_debug'] = TRUE;
$db['qms_pip']['cache_on'] = FALSE;
$db['qms_pip']['cachedir'] = '';
$db['qms_pip']['char_set'] = 'utf8';
$db['qms_pip']['dbcollat'] = 'utf8_general_ci';
$db['qms_pip']['swap_pre'] = '';
$db['qms_pip']['autoinit'] = TRUE;
$db['qms_pip']['stricton'] = FALSE;

$db['tempdb_sql']['hostname'] = 'JVCAYAO-PC';
$db['tempdb_sql']['username'] = '';
$db['tempdb_sql']['password'] = '';
$db['tempdb_sql']['database'] = 'tempdb_sql';
$db['tempdb_sql']['dbdriver'] = 'sqlsrv';
$db['tempdb_sql']['dbprefix'] = '';
$db['tempdb_sql']['pconnect'] = TRUE;
$db['tempdb_sql']['db_debug'] = TRUE;
$db['tempdb_sql']['cache_on'] = FALSE;
$db['tempdb_sql']['cachedir'] = '';
$db['tempdb_sql']['char_set'] = 'utf8';
$db['tempdb_sql']['dbcollat'] = 'utf8_general_ci';
$db['tempdb_sql']['swap_pre'] = '';
$db['tempdb_sql']['autoinit'] = TRUE;
$db['tempdb_sql']['stricton'] = FALSE;

$db['qms_atrail']['hostname'] = 'JVCAYAO-PC';
$db['qms_atrail']['username'] = '';
$db['qms_atrail']['password'] = '';
$db['qms_atrail']['database'] = 'qms_atrail';
$db['qms_atrail']['dbdriver'] = 'sqlsrv';
$db['qms_atrail']['dbprefix'] = '';
$db['qms_atrail']['pconnect'] = FALSE;
$db['qms_atrail']['db_debug'] = TRUE;
$db['qms_atrail']['cache_on'] = FALSE;
$db['qms_atrail']['cachedir'] = '';
$db['qms_atrail']['char_set'] = 'utf8';
$db['qms_atrail']['dbcollat'] = 'utf8_general_ci';
$db['qms_atrail']['swap_pre'] = '';
$db['qms_atrail']['autoinit'] = TRUE;
$db['qms_atrail']['stricton'] = FALSE;

$db['portal']['hostname'] = 'localhost';
$db['portal']['username'] = 'root';
$db['portal']['password'] = '';
$db['portal']['database'] = 'portal';
$db['portal']['dbdriver'] = 'mysql';
$db['portal']['dbprefix'] = '';
$db['portal']['pconnect'] = TRUE;
$db['portal']['db_debug'] = TRUE;
$db['portal']['cache_on'] = FALSE;
$db['portal']['cachedir'] = '';
$db['portal']['char_set'] = 'utf8';
$db['portal']['dbcollat'] = 'utf8_general_ci';
$db['portal']['swap_pre'] = '';
$db['portal']['autoinit'] = TRUE;
$db['portal']['stricton'] = FALSE;

$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'root';
$db['default']['password'] = '';
$db['default']['database'] = 'sysadmin';
$db['default']['dbdriver'] = 'mysql';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;

$db['gendb']['hostname'] = 'localhost';
$db['gendb']['username'] = 'root';
$db['gendb']['password'] = '';
$db['gendb']['database'] = 'gendb';
$db['gendb']['dbdriver'] = 'mysql';
$db['gendb']['dbprefix'] = '';
$db['gendb']['pconnect'] = TRUE;
$db['gendb']['db_debug'] = TRUE;
$db['gendb']['cache_on'] = FALSE;
$db['gendb']['cachedir'] = '';
$db['gendb']['char_set'] = 'utf8';
$db['gendb']['dbcollat'] = 'utf8_general_ci';
$db['gendb']['swap_pre'] = '';
$db['gendb']['autoinit'] = TRUE;
$db['gendb']['stricton'] = FALSE;

$db['projdb']['hostname'] = 'localhost';
$db['projdb']['username'] = 'root';
$db['projdb']['password'] = '';
$db['projdb']['database'] = 'projdb';
$db['projdb']['dbdriver'] = 'mysql';
$db['projdb']['dbprefix'] = '';
$db['projdb']['pconnect'] = TRUE;
$db['projdb']['db_debug'] = TRUE;
$db['projdb']['cache_on'] = TRUE;
$db['projdb']['cachedir'] = '';
$db['projdb']['char_set'] = 'utf8';
$db['projdb']['dbcollat'] = 'utf8_general_ci';
$db['projdb']['swap_pre'] = '';
$db['projdb']['autoinit'] = TRUE;
$db['projdb']['stricton'] = FALSE;

$db['tempdb']['hostname'] = 'localhost';
$db['tempdb']['username'] = 'root';
$db['tempdb']['password'] = '';
$db['tempdb']['database'] = 'tempdb';
$db['tempdb']['dbdriver'] = 'mysql';
$db['tempdb']['dbprefix'] = '';
$db['tempdb']['pconnect'] = TRUE;
$db['tempdb']['db_debug'] = TRUE;
$db['tempdb']['cache_on'] = FALSE;
$db['tempdb']['cachedir'] = '';
$db['tempdb']['char_set'] = 'utf8';
$db['tempdb']['dbcollat'] = 'utf8_general_ci';
$db['tempdb']['swap_pre'] = '';
$db['tempdb']['autoinit'] = TRUE;
$db['tempdb']['stricton'] = FALSE;

// $db['progress_projdb']['hostname'] = 'DSN=progress_projdb;HOST=localhost;PORT=23002;DB=projdb;UID=SYSPROGRESS;PWD=sysprogress';
// $db['progress_projdb']['username'] = 'sysprogress';
// $db['progress_projdb']['password'] = 'sysprogress';
// $db['progress_projdb']['database'] = 'projdb';
// $db['progress_projdb']['dbdriver'] = 'odbc';
// $db['progress_projdb']['dbprefix'] = '';
// $db['progress_projdb']['pconnect'] = TRUE;
// $db['progress_projdb']['db_debug'] = TRUE;
// $db['progress_projdb']['cache_on'] = FALSE;
// $db['progress_projdb']['cachedir'] = '';
// $db['progress_projdb']['char_set'] = 'utf8';
// $db['progress_projdb']['dbcollat'] = 'utf8_general_ci';
// $db['progress_projdb']['swap_pre'] = '';
// $db['progress_projdb']['autoinit'] = TRUE;
// $db['progress_projdb']['stricton'] = FALSE;

/* End of file database.php */
/* Location: ./application/config/database.php */