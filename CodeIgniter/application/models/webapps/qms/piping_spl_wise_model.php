<?php
    class Piping_Spl_Wise_Model extends CI_Model {
    	private $tblName = "tt_export_whseSPLwise";
        public function __construct(){
            parent::__construct();
        	$this->tempdb_sql = $this->load->database('tempdb_sql', true);
        }
		
		public function get_all_export(){
			$sql = "SELECT TOP 100 * FROM {$this->tblName}";
			return $this->tempdb_sql->query($sql)->result_array();
		} 
		public function proc_export($cArealoc){
			$sql = "declare @result int;";
			$sql .= "exec @result = tempdb_sql.dbo.proc_export_whseSPLwise @cArealoc = '{$cArealoc}';";
			$sql .= "select @result as return_value;";
			$query = $this->tempdb_sql->query($sql)->result_array();
			
			return $query;
		}
	} // -- end of class -- //