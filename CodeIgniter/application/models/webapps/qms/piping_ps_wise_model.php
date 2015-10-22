<?php
    class Piping_Ps_Wise_Model extends CI_Model {
    	private $tblName = "ttExport_whsePSwise";
        public function __construct(){
            parent::__construct();
        	$this->tempdb_sql = $this->load->database('tempdb_sql', true);
        }
		
		public function get_all_export(){
			$sql = "SELECT * FROM {$this->tblName}";
			return $this->tempdb_sql->query($sql)->result_array();
		} 
		public function proc_export_psWise($cArealoc){
			$sql = "declare @result int;";
			$sql .= "exec @result = tempdb_sql.dbo.tt_export_whsePSwise @cArealoc = '{$cArealoc}';";
			$sql .= "select @result as return_value;";
			$query = $this->tempdb_sql->query($sql)->result_array();
			
			return $query;
		}
	} // -- end of class -- //