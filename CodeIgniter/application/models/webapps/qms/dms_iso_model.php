<?php
    class Dms_Iso_Model extends CI_Model {
    	private $tblName = "iso";
        public function __construct(){
            parent::__construct();
        	$this->dms= $this->load->database('dms', true);
			
			// $db['piping']['hostname'] = 'RCGOMEZ-PC\SQLEXPRESS';
			// $db['piping']['username'] = '';
			// $db['piping']['password'] = '';
			// $db['piping']['database'] = 'piping';
			// $db['piping']['dbdriver'] = 'sqlsrv';
			// $db['piping']['dbprefix'] = '';
			// $db['piping']['pconnect'] = FALSE;
			// $db['piping']['db_debug'] = TRUE;
			// $db['piping']['cache_on'] = FALSE;
			// $db['piping']['cachedir'] = '';
			// $db['piping']['char_set'] = 'utf8';
			// $db['piping']['dbcollat'] = 'utf8_general_ci';
			// $db['piping']['swap_pre'] = '';
			// $db['piping']['autoinit'] = TRUE;
			// $db['piping']['stricton'] = FALSE;
// 			
			// $this->dms = $this->load->database($db, TRUE);
        }
        
      public function getall_mod($where){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			 // if ($_GET['value'] == ""){
				// $sql = "SELECT top {$_GET['pageSize']} t.*,t2.jmif_date FROM (select (select count(*) FROM {$this->tblName} ) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName} WITH(INDEX(IDX_NC_Treqiss_dtl_Jmif_no))) t inner join dbo.treqiss_hdr t2 on t2.jmif_no = t.jmif_no where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
				// $rowArr = $this->piping->query($sql)->result_array();
			// }else {
				// if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName}  where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}  where {$where}) t where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->dms->query($sql)->result_array();					
				// }else{
					// $sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,PROGRESS_RECID,area_no,drawing_no,sheet_no,rev_no,stat,line_size,line_no,lineclass,matl,fluid_code,insulation,insulation_thickness,lbsb,painting,pid,transmittal,remarks,document,subarea_no,plant_no FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					// $rowArr = $this->piping->query($sql)->result_array();
				// }
			 // }
			return $rowArr;
        }
	    public function is_entry_unique($criteria = array()) {
            $this->dms->select('count(*) as counter')->from($this->tblName)->where($criteria);
			$query = $this->dms->get();
			$result = $query->result();

	        if ($result !== FALSE) {
	            if ($result[0]->counter > 0) {
	                return FALSE;
	            } else {
	                return TRUE;
	            }
	        } else {
	            return 'Error in retrieving criteria.';
	        }
	    }
		
		public function remove_iso(){
        	$query = $this->dms->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->dms->delete($this->tblName);
			return $query;
		}
    }
?>