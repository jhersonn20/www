<?php
    class Tjwrr_dtl_model extends CI_Model {
    	private $tblName = "tjwrr_dtl";
        public function __construct(){
            parent::__construct();
        	$this->piping = $this->load->database('piping', true);
        }

        public function get_all($where){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			// if ($_GET['value'] == ""){
				// $sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
				// $rowArr = $this->piping->query($sql)->result_array();
			// }else {
				// if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} WITH(INDEX(IDX_NC_Tjwrr_dtl_jwrr_no)) where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName} WITH(INDEX(IDX_NC_Tjwrr_dtl_jwrr_no)) where {$where}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->piping->query($sql)->result_array();					
				// }else{
					// $sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,PROGRESS_RECID,area_no,drawing_no,sheet_no,rev_no,stat,line_size,line_no,lineclass,matl,fluid_code,insulation,insulation_thickness,lbsb,painting,pid,transmittal,remarks,document,subarea_no,plant_no FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					// $rowArr = $this->piping->query($sql)->result_array();
				// }
			// }
			return $rowArr;
        }
		public function get_all2($where){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			// if ($_GET['value'] == ""){
				// $sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
				// $rowArr = $this->piping->query($sql)->result_array();
			// }else {
				// if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} WITH(INDEX(IDX_NC_Tjwrr_dtl_jwrr_no)) where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName} WITH(INDEX(IDX_NC_Tjwrr_dtl_jwrr_no)) where {$where}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->piping->query($sql)->result_array();					
				// }else{
					// $sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,PROGRESS_RECID,area_no,drawing_no,sheet_no,rev_no,stat,line_size,line_no,lineclass,matl,fluid_code,insulation,insulation_thickness,lbsb,painting,pid,transmittal,remarks,document,subarea_no,plant_no FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					// $rowArr = $this->piping->query($sql)->result_array();
				// }
			// }
			return $rowArr;
        }
	
		public function getAll_export(){
			$sql = "SELECT t.jwrr_no,t.jwrr_date,t.supp_code,t.supp_desc,t.pr_po_no,t.pl_dn_inv,t.rcvd_by,t.rcvd_date,t.qcmrir_no,t.qcmrir_date,t.rfi_no,t.rfi_date,t.jmif_no,t.remarks,t2.stock_no,t2.stock_desc,t2.item_code,t2.commodity_code,t2.uom,t2.size,t2.jwrr_qty,t2.remarks,t2.drawing_no,t2.sheet_no,t2.rev_no,t2.area_no FROM {$this->tblName} t2 inner join tjwrr_hdr t on t.jwrr_no = t2.jwrr_no and t.disc_code = t2.disc_code where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']}";
			return $this->piping->query($sql)->result_array();
		}
        
        public function set($postInfo = array()){
        	$PROGRESS_RECID = 0;
        	if (sizeof($postInfo) == 0){
				foreach ($_POST as $key => $value) {
					if ($key == "PROGRESS_RECID" || $key == "index" || $key == "remarks1" || $key == "idField" || $key == "_defaultId")
						continue;
					$postInfo[$key] = mysql_real_escape_string($value);
				}
				$postInfo['log_date'] = mdate("%Y-%m-%d %H:%i:%s");
				$postInfo['log_time'] = mdate("%H:%i:%s");
				$postInfo['log_update'] = $_POST['log_user'] . " " . mdate("%Y-%m-%d %H:%i:%s");
				$PROGRESS_RECID = $_POST['PROGRESS_RECID'];
			}else
				$PROGRESS_RECID = $postInfo['PROGRESS_RECID'];
			
            if ($PROGRESS_RECID > 0){
            	$query = $this->piping->where('PROGRESS_RECID', $PROGRESS_RECID);
            	$query = $this->piping->update($this->tblName, $postInfo);
			}else{			            	// $query = $this->is_entry_unique(array("jwrr_no" => $_POST['jwrr_no'], "stock_no" => $_POST['stock_no']));
            	$query = $this->is_entry_unique(array("jwrr_no" => $postInfo['jwrr_no'], "stock_no" => $postInfo['stock_no']));
            	if (gettype($query) == 'boolean'){
					if (!$query)
						return "Record already exist!";
				}else
					return $query;

				unset($postInfo['PROGRESS_RECID']);
				$query = $this->piping->set($postInfo);
				$query = $this->piping->insert($this->tblName);
			}
			
			return $query;
        }
        
        public function showJSon(){
	        $ci =& get_instance();
            $ci->load->model('webapps/tjwrr_hdr_model');
            			
			$query = $ci->tjwrr_hdr_model->is_entry_unique(array("jwrr_no"=>$_POST['jwrr_no'], "disc_code"=>$_POST['disc_code']));
        	if (gettype($query) == 'boolean'){
				if ($query)
					return "Record not yet exist!";
			}else
				return $query;

			$data = mysql_real_escape_string($_POST['jsonData']);
            $json = str_replace('\\','',$data);
            $newdata = json_decode($json);
							
            foreach($newdata->item as $newDtls):
            // foreach($newdata->item as $index => $value):
				$query = $this->is_entry_unique(array("jwrr_no"=>$_POST['jwrr_no'], "commodity_code"=>$newDtls->commodity_code, "size"=>$newDtls->size));
	        	if (gettype($query) == 'boolean'){
					if (!$query)
						continue;
				}else
					continue;
				
				if (strpos($_POST['jmif_no'], $newDtls->jmif_no) < 0)
					if (!$ci->tjwrr_hdr_model->set(array("PROGRESS_RECID"=>$_POST['PROGRESS_RECID'], "log_user"=>$_POST['log_user'], "jmif_no"=>$_POST['jmif_no'] .= ($_POST['jmif_no'] == "" ? "" : ", ") . $newDtls->jmif_no)))
						return "Update failed. JMIF No.";
		
				foreach($newDtls as $index2 => $value2):
					if (!in_array($index2, array("disc_code","disc_desc","stock_no","stock_desc","item_code","commodity_code","uom","size","jwrr_qty","plant_no","area_no","drawing_no","sheet_no","rev_no","spool_no","jmif_no","remarks")))
						continue;
					$postInfo[$index2] = mysql_real_escape_string($value2);
				endforeach;
				$postInfo["jwrr_no"] = $_POST['jwrr_no'];
				$postInfo["PROGRESS_RECID"] = 0;
				if (!$this->set($postInfo))
					return "Insert failed!";

		        $ci =& get_instance();
	            $ci->load->model('webapps/treqiss_dtl_model');
				if (!$ci->treqiss_dtl_model->update(array("jwrr_no"=>$_POST['jwrr_no']),array("jmif_no"=>$newDtls->jmif_no)))
					return "Update failed. JWRR No.";
			endforeach;
			
			return true;
        }
		
	    public function is_entry_unique($criteria = '') {
            $this->piping->select('count(*) as counter')->from($this->tblName)->where($criteria);
			$query = $this->piping->get();
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
		
		public function remove($criteria = array()){
			if (sizeof($criteria) == 0)
				$criteria = array('PROGRESS_RECID' => $_POST['PROGRESS_RECID']);
			
        	$query = $this->piping->where($criteria);
        	$query = $this->piping->delete($this->tblName);
			return $query;
		}
    }
?>