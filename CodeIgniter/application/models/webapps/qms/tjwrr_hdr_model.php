<?php
    class Tjwrr_hdr_model extends CI_Model {
    	private $tblName = "tjwrr_hdr";
        public function __construct(){
            parent::__construct();
        	$this->piping = $this->load->database('piping', true);
        	$this->qms_atrail = $this->load->database('qms_atrail', true);
        }

        public function get_all($where){
        	if (isset($_GET['page'])){
				$start = ($_GET['page'] - 1) * $_GET['pageSize'];
				$end = ($start + $_GET['pageSize']) - 1;
				
				$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} WITH(INDEX(IDX_NC_Tjwrr_hdr_disc_code)) where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName} WITH(INDEX(IDX_NC_Tjwrr_hdr_disc_code)) where {$where}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
				$rowArr = $this->piping->query($sql)->result_array();
			}else {
				$sql = "SELECT (select count(*) FROM {$this->tblName} WITH(INDEX(IDX_NC_Tjwrr_hdr_disc_code)) where {$where}) as total,* FROM {$this->tblName} WITH(INDEX(IDX_NC_Tjwrr_hdr_disc_code)) t where {$where} order by {$_GET['fieldS']} {$_GET['dir']}";
				$rowArr = $this->piping->query($sql)->result_array();				
			}
			// if ($_GET['value'] == ""){
				// $sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
				// $rowArr = $this->piping->query($sql)->result_array();
			// }else {
				// if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
					// $sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName} where {$where}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					// $rowArr = $this->piping->query($sql)->result_array();
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
				
				$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
				$rowArr = $this->piping->query($sql)->result_array();
			
			return $rowArr;
        }

        public function set_from_upl($postInfo = array()){
        	if (sizeof($postInfo) == 0){
				foreach ($_POST as $key => $value) {
					if ($key == "PROGRESS_RECID" || $key == "index" || $key == "remarks1" || $key == "idField" || $key == "_defaultId")
						continue;
					$postInfo[$key] = mysql_real_escape_string($value);
				}
				if (sizeof($_POST) > 3){			
					$postInfo['log_date'] = mdate("%Y-%m-%d %H:%i:%s");
					$postInfo['log_time'] = mdate("%H:%i:%s");
				}
				$postInfo['log_update'] = $_POST['loguser'] . " " . mdate("%Y-%m-%d %H:%i:%s");
			}
			
	        $ci =& get_instance();
	        $ci->load->model('webapps/qms/rdiscipline_model');
	        $returnValue = $ci->rdiscipline_model->get_by_field(array("disc_code"=>$postInfo['disc_code']));
			$postInfo['disc_desc'] = $returnValue[0]['disc_desc'];
			
	        $ci =& get_instance();
	        $ci->load->model('webapps/qms/rcontrol_model');
            $control_no = $ci->rcontrol_model->get_by_field(array("trancode"=>"JWRR", "disc_code"=>$postInfo['disc_code']));
            if (sizeof($control_no) == 0)
            	return "PO does not exists in 'Control #' reference.";
			
        	$query = $this->is_entry_unique(array("jwrr_no" => $postInfo['hdr_jwrr_no']));
        	if (gettype($query) == 'boolean'){
				if ($query){					
					$postInfo_field = array("hdr_jwrr_no"=>"jwrr_no","disc_code"=>"disc_code","disc_desc"=>"disc_desc","log_user"=>"log_user","log_date"=>"log_date","log_time"=>"log_time","hdr_jwrr_date"=>"jwrr_date","hdr_supplier_code"=>"supp_code","hdr_supplier_desc"=>"supp_desc","hdr_pr_po_no"=>"pr_po_no","hdr_pl_dn_inv_no"=>"pl_dn_inv","hdr_recv_by"=>"rcvd_by","hdr_recv_date"=>"rcvd_date","hdr_qcmrir_no"=>"qcmrir_no","hdr_qcmrir_date"=>"qcmrir_date","hdr_rfi_no"=>"rfi_no","hdr_rfi_date"=>"rfi_date","hdr_jmif_no"=>"jmif_no","hdr_remarks"=>"remarks","log_update"=>"log_update");
					$postInfo_jwrrHdr = array();
					foreach($postInfo as $key => $value){
						if (array_key_exists($key, $postInfo_field)){
							$postInfo_jwrrHdr[$postInfo_field[$key]] = $value;					
						}
					}
					
					$query = $this->piping->set($postInfo_jwrrHdr);
					$query = $this->piping->insert($this->tblName);
					if (!$query)
						return "Insert Failed. JWRR Header.";
				}
			}else
				return $query;
			
            // $control_no = $ci->rcontrol_model->update_control("inc", array("trancode"=>"JWRR", "disc_code"=>$postInfo['disc_code']));
        	// if (gettype($control_no) == 'boolean'){
				// if (!$control_no)
					// return "'RControl': Record not exist!";
			// }else
				// return $control_no;
			$postInfo_field = array("hdr_jwrr_no"=>"jwrr_no","dtl_stock_no"=>"stock_no","dtl_stock_desc"=>"stock_desc","dtl_item_code"=>"item_code","dtl_commodity_code"=>"commodity_code","dtl_uom"=>"uom","dtl_size"=>"size","dtl_area_no"=>"area_no","dtl_drawing_no"=>"drawing_no","dtl_sheet_no"=>"sheet_no","dtl_rev_no"=>"rev_no","dtl_remarks"=>"remarks","hdr_jmif_no"=>"jmif_no","disc_code"=>"disc_code","hdr_recv_date"=>"rcvd_date","log_user"=>"log_user","log_date"=>"log_date","dtl_jwrr_qty"=>"jwrr_qty","log_update"=>"log_update");
			$postInfo_jwrrDtl = array();
			foreach($postInfo as $key => $value){
				if (array_key_exists($key, $postInfo_field)){
					$postInfo_jwrrDtl[$postInfo_field[$key]] = $value;
				}
			}
	        $ci =& get_instance();
	        $ci->load->model('webapps/qms/tjwrr_dtl_model');
			$query = $ci->tjwrr_dtl_model->piping->set($postInfo_jwrrDtl);
			$query = $ci->tjwrr_dtl_model->piping->insert("tjwrr_dtl");
			if (!$query)
				return "Insert Failed. JWRR Detail.";
						
	        $ci =& get_instance();
	        $ci->load->model('webapps/qms/material_file_model');
        	$query = $ci->material_file_model->is_entry_unique(array("stock_no" => $postInfo['dtl_stock_no'], "item_code" => $postInfo['dtl_item_code'], "commodity_code" => $postInfo['dtl_commodity_code'], "size" => $postInfo['dtl_size']));
        	if (gettype($query) == 'boolean'){
				if ($query){
					$postInfo_field = array("dtl_stock_no"=>"stock_no","dtl_item_code"=>"item_code","dtl_commodity_code"=>"commodity_code","dtl_uom"=>"uom","dtl_size"=>"size");
					$postInfo_matHdr = array();
					foreach($postInfo as $key => $value){
						if (array_key_exists($key, $postInfo_field)){
							$postInfo_matHdr[$postInfo_field[$key]] = $value;
						}
					}
					$postInfo_matHdr['flg_status'] = 1;
					$query = $ci->material_file_model->piping->set($postInfo_matHdr);
					$query = $ci->material_file_model->piping->insert("material_file");
					if (!$query)
						return "Insert Failed. Material File.";
					
					$postInfo_field = array("dtl_stock_no"=>"stock_no","dtl_item_code"=>"item_code","dtl_commodity_code"=>"commodity_code","disc_code"=>"disc_code");
					$postInfo_matDtl = array();
					foreach($postInfo as $key => $value){
						if (array_key_exists($key, $postInfo_field)){
							$postInfo_matHdr[$postInfo_field[$key]] = $value;
						}
					}
					$postInfo_matDtl['flg_status'] = 1;
			        $ci =& get_instance();
			        $ci->load->model('webapps/qms/material_file_dtl_model');
			        $query = $ci->material_file_dtl_model->is_entry_unique(array("stock_no" => $postInfo['dtl_stock_no'], "item_code" => $postInfo['dtl_item_code'], "commodity_code" => $postInfo['dtl_commodity_code'], "disc_code" => $postInfo['disc_code']));
		        	if (gettype($query) == 'boolean'){
						if ($query){		
							$query = $ci->material_file_dtl_model->piping->set($postInfo_matDtl);
							$query = $ci->material_file_dtl_model->piping->insert("material_file_dtl");
							if (!$query)
								return "Insert Failed. Material File Detail.";					
						}
					}else
						return $query;
				}
			}else
				return $query;
        }

        public function set($postInfo = array()){
        
        	$PROGRESS_RECID = 0;
        	if (sizeof($postInfo) == 0){
				foreach ($_POST as $key => $value) {
					if ($key == "PROGRESS_RECID" || $key == "index" || $key == "remarks1" || $key == "idField" || $key == "_defaultId")
						continue;
					$postInfo[$key] = mysql_real_escape_string($value);
				}
				if (sizeof($_POST) > 3){			
					$postInfo['log_date'] = mdate("%Y-%m-%d %H:%i:%s");
					$postInfo['log_time'] = mdate("%H:%i:%s");
				}
				$postInfo['log_update'] = $_POST['log_user'] . " " . mdate("%Y-%m-%d %H:%i:%s");
				$PROGRESS_RECID = $_POST['PROGRESS_RECID'];
			}else
				$PROGRESS_RECID = $postInfo['PROGRESS_RECID'];
			// var_dump($postInfo);
			// return true;
	        $ci =& get_instance();
	        $ci->load->model('webapps/qms/rdiscipline_model');
	        $returnValue = $ci->rdiscipline_model->get_by_field(array("disc_code"=>$postInfo['disc_code']));
			$postInfo['disc_desc'] = $returnValue[0]['disc_desc'];
            if ($_POST['PROGRESS_RECID'] > 0){
				
            	$query = $this->is_entry_unique(array("PROGRESS_RECID" => $PROGRESS_RECID));
            	if (gettype($query) == 'boolean'){
					if ($query)
						return "Cannot update stock.\nNo record found.";
				}else
					return $query;
				
            	if (sizeof($_POST) == 5){ 
	            	$query = $this->is_finalized(array("PROGRESS_RECID" => $PROGRESS_RECID));
	            	if (gettype($query) == 'boolean'){
						if (!$query){
							// return "Cannot Update.\nPO is already finalized.";
							$ci =& get_instance();
		        			$ci->load->model('webapps/qms/tjwrr_dtl_model');
							$query = $ci->tjwrr_dtl_model->is_entry_unique(array("jwrr_no"=>$postInfo['jwrr_no'],"disc_code"=>$postInfo['disc_code']));
			            	if (gettype($query) == 'boolean'){
								if ($query)
									return "Cannot finalized.\nNo JWRR detail found.";
							}else
								return $query;
						}
					}else
						return $query;
				}
				
		        $ci =& get_instance();
		        $ci->load->model('webapps/qms/rcontrol_model');				
	            $control_no = $ci->rcontrol_model->get_by_field(array("trancode"=>"JWRR", "disc_code"=>$postInfo['disc_code']));
				
				if (strpos($control_no[0]['prefix'], $postInfo['jwrr_no']) !== false)
					return "Cannot finalize/unfinalize.\nMRR is on Direct Withdraw mode.";
					
            	$query = $this->piping->where('PROGRESS_RECID', $PROGRESS_RECID);
            	$query = $this->piping->update($this->tblName, $postInfo);
            					
            	if (sizeof($_POST) == 5){        	
					$sql = "declare @result int = 0;";
					$sql .= "exec @result = piping.dbo.proc_compute_sp @lFinMode = 1, @PROGRESS_RECID = {$PROGRESS_RECID}, @discCode = {$postInfo['disc_code']};";			
					$sql .= "select @result as return_value;";
					$query = $this->piping->query($sql)->result_array();
					// var_dump($query);
					// return $query;
            	}
			}else{
		        $ci =& get_instance();
		        $ci->load->model('webapps/qms/rcontrol_model');
	            $control_no = $ci->rcontrol_model->get_by_field(array("trancode"=>"JWRR", "disc_code"=>$postInfo['disc_code']));
	            if (sizeof($control_no) == 0)
	            	return "PO does not exists in 'Control #' reference.";
				
            	$query = $this->is_entry_unique(array("jwrr_no" => $postInfo['jwrr_no']));
            	if (gettype($query) == 'boolean'){
					if (!$query)
						return "Record already exist!";
				}else
					return $query;
				
	            $control_no = $ci->rcontrol_model->update_control("inc", array("trancode"=>"JWRR", "disc_code"=>$postInfo['disc_code']));
            	if (gettype($control_no) == 'boolean'){
					if (!$control_no)
						return "'RControl': Record not exist!";
				}else
					return $control_no;
				
				$query = $this->piping->set($postInfo);
				$query = $this->piping->insert($this->tblName);
			}
			
			return $query;
        }

		public function call_sp($item = ""){
			$sql = "declare @result int = 0;";			
			$sql .= "exec @result = piping.dbo.{$item}_sp @PROGRESS_RECID = {$_POST['PROGRESS_RECID']}, @user_id = '{$_POST['log_user']}';";			
			$sql .= "select @result as return_value;";
			$query = $this->piping->query($sql)->result_array();

			return $query;
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

	    public function is_finalized($criteria = '') {
            $this->piping->select('finalized')->from($this->tblName)->where($criteria);
			$query = $this->piping->get();
			$result = $query->result();

	        if ($result !== FALSE) {
	            if ($result[0]->finalized == 0 || $result[0]->finalized == null) {
	                return FALSE;
	            } else {
	                return TRUE;
	            }
	        } else {
	            return 'Error in retrieving criteria.';
	        }
	    }
		
		public function remove(){
	        $ci =& get_instance();
	        $ci->load->model('webapps/qms/rcontrol_model');
			if ($ci->rcontrol_model->is_entry_unique(array("trancode"=>"JWRR", "disc_code"=>$_POST['disc_code'])))
				return "Cannot delete.\nJWRR Control No. reference does not exist.";
			
            $control_no = $ci->rcontrol_model->get_by_field(array("trancode"=>"JWRR", "disc_code"=>$_POST['disc_code']));
			
			if (strpos($control_no[0]['prefix'], $_POST['jwrr_no']) !== false)
				return "Cannot Delete.\nMRR is on Direct Withdraw mode.\nKindly go to WHSE Issuance transaction\nand uncheck the Direct Withdraw option.";
			// var_dump($control_no);
        	// $query = $this->piping->select('(control_no - 1) as control_no')->from($this->tblName)->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
			// $query = $this->piping->get();
			// $post_control_no = intval(substr($_POST['jwrr_no'], 3,6));
			$post_control_no = (int)str_replace($control_no[0]['suffix'] . "-", "", str_replace($control_no[0]['prefix'] . "-", "", $_POST['jwrr_no']));
			
			if ($post_control_no != ($control_no[0]['control_no'] - 1))
				return "Cannot Delete.\nA higher PO No. exist. ";			
			
	        $ci =& get_instance();
	        $ci->load->model('webapps/qms/tjwrr_dtl_model');
	        if (!$ci->tjwrr_dtl_model->remove(array("jwrr_no"=>$_POST['jwrr_no'])))
				return "Cannot Delete. Failed on JWRR Detail.";

	        $control_no = $ci->rcontrol_model->update_control("dec", array("trancode"=>"JWRR", "disc_code"=>$_POST['disc_code']));
        	$query = $this->piping->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->piping->delete($this->tblName);
			if (!$query)
				return "Cannot Delete. Failed on JWRR Header.";
			
			$query = $this->auditTrail('WHSE MATERIAL RECEIVING-PIPING (HDR)','DELETE');
			
			return $query;
		}

		public function auditTrail($tranDesc = "", $type = ""){        	
			$sql = "declare @result int = 0;";
			$sql .= "exec @result = qms_atrail.dbo.auditTrail_sp @syscode = 'QMS', @userid = '{$_POST['log_user']}', @trandesc = '{$tranDesc}', @type = '{$type}';";
			$sql .= "select @result as return_value;";
			$query = $this->qms_atrail->query($sql)->result_array();
			
			return $query;			
		}

		public function remove_upl(){
			$sql = "update t2
						set t2.ref_rec_no = replace(STUFF(t2.ref_rec_no,charindex(t.jwrr_no,t2.ref_rec_no,1),len(t.jwrr_no),''),',,',','),
							t2.ref_rec_qty = t2.ref_rec_qty - t.jwrr_qty
						from dbo.tjwrr_dtl t
						inner join dbo.mat_takeoff_perspool t2
						on t2.ref_rec_no like '%' + t.jwrr_no + '%' and
						   t2.drawing_no = t.drawing_no and
						   t2.item_code = t.stock_no and
						   t2.item_code = t.item_code and
						   t2.commodity_code = t.commodity_code and
						   t2.size = t.size
						where t.PROGRESS_RECID = {$_POST['PROGRESS_RECID']};						
					delete t 
						from tjwrr_dtl t 
						inner join tjwrr_hdr t2 
						on t.jwrr_no = t2.jwrr_no
						where t2.PROGRESS_RECID = {$_POST['PROGRESS_RECID']};
					delete from tjwrr_hdr where PROGRESS_RECID = {$_POST['PROGRESS_RECID']};";
			$query = $this->piping->query($sql)->result_array();
			return $query;
		}
    }
?>