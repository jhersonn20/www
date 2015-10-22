<?php
    class tt_JmifInfo_model extends CI_Model {
		private $tblName = "tt_jmifInfo";
        public function __construct(){
            parent::__construct();
            //$this->load->database();
        	$this->piping = $this->load->database('piping', true);
        	$this->tempdb_sql = $this->load->database('tempdb_sql', true);
        }
		public function get_all($where){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			
			if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
				$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
				$rowArr = $this->piping->query($sql)->result_array();	
			}else{
				$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
				$rowArr = $this->tempdb_sql->query($sql)->result_array();
			}
			return $rowArr;
			
		} // -- end of get_all function -- //
		public function remove_all(){
			$sql = "DELETE FROM {$this->tblName}";
		}
		public function remove_insert(){
			// -- detele table first before inserting  -- //
			$this->tempdb_sql->query(remove_all());
			// -- in
			$ci =& get_instance();
		    $ci->load->model('webapps/treqiss_hdr_model');
		}
	}