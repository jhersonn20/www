<?php
    class Tran_Acvty_Ctr_Model extends CI_Model {
		private $tblName = "tran_acvty_ctr";
		public function __construct(){
            parent::__construct();
        	$this->qms_atrail = $this->load->database('qms_atrail', true);
        }
		
		public function get_all($where = ""){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			
					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->qms_atrail->query($sql)->result_array();	
					
			return $rowArr;
        }
		
	} //--end line