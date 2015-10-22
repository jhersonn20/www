<?php
    class Ttemp_conf_model extends CI_Model {
    	private $tblName = "ttemp_conf";
        public function __construct(){
            parent::__construct();
        	$this->tempdb_sql = $this->load->database('tempdb_sql', true);
        	$this->piping = $this->load->database('piping', true);
        }

        public function get_all($where){
			if ($_GET['processThis']) {			
				$sql = "SET IDENTITY_INSERT {$this->tblName} ON;
						delete from {$this->tblName};
						insert into {$this->tblName}(jmif_no, stock_no, item_code, commodity_code, mat_desc, uom, measurement, size, activity_code, req_qty, iss_qty, drawing_no, direct_with, testpack_no, system_no, sub_system, mat_util, mat_status, log_user, log_date, log_time, log_update, spl_type, disc_code, disc_desc, support_no, dlmr_jwrr, sheet_no, rev_no, area_no, rfi_no, qcmrir_no, spool_no, excess, issue_date, issued_by, recvd_by, supp_code, pl_dn_inv, pr_po_no, frecid, jwrr_no, plant_no, isc_no, PROGRESS_RECID, PROGRESS_RECID_IDENT_, old_draw, old_dw, old_dj, old_iss, old_ex, old_req, valid, liss)
						select *, t3.drawing_no as old_draw, t3.direct_with as old_dw,
								  t3.dlmr_jwrr as old_dj, t3.iss_qty as old_iss,
								  t3.excess as old_ex, t3.req_qty as old_req, 0,
								  (case when t3.iss_qty = 0 then 1
										when t3.iss_qty < t3.req_qty then 1
										else 0 end) as liss from piping.dbo.treqiss_dtl t3
						where t3.PROGRESS_RECID = (
							select top (1) MAX(t2.progress_recid) from piping.dbo.material_file t
								inner join piping.dbo.treqiss_dtl t2
								on (t.commodity_code = t2.commodity_code or
								    t.stock_no = t2.stock_no) and
								   isnull(t.size,'') = isnull(t2.size,'')
								where t2.jmif_no = '{$_GET['jmif_no']}' and
									  t2.disc_code = '{$_GET['disc_code']}'
								group by t.commodity_code, t.size
						);";
						
				if (!$this->tempdb_sql->query($sql))
					return array();
			}
			
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			if ($_GET['value'] == ""){
				$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
				$rowArr = $this->tempdb_sql->query($sql)->result_array();
			}else {
				if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName} where {$where}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->tempdb_sql->query($sql)->result_array();				
				}else{
					$sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,PROGRESS_RECID,area_no,drawing_no,sheet_no,rev_no,stat,line_size,line_no,lineclass,matl,fluid_code,insulation,insulation_thickness,lbsb,painting,pid,transmittal,remarks,document,subarea_no,plant_no FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					$rowArr = $this->tempdb_sql->query($sql)->result_array();
				}
			}
			return $rowArr;
        }
        
        public function getAll($criteria){
        	if (isset($criteria)){
	        	if (is_array($criteria))
	        		return $this->tempdb_sql->get_where($this->tblName, $criteria)->result_array();
	        	else {
	        		if ($criteria != ""){
			        	$sql = "select * from {$this->tblName} where {$criteria}";
			        	return $this->tempdb_sql->query($sql)->result_array();
					}else {		    	
			        	$sql = "select * from {$this->tblName}";
			        	return $this->tempdb_sql->query($sql)->result_array();
				    }
		        }
		    }
        }

		public function call_sp($item = ""){
			$sql = "declare @result int = 0, @warning varchar(max);";
			switch(strtolower($_POST['disc_code'])){
				case 'ps':				
					$sql .= "exec @result = tempdb_sql.dbo.issconf_ps_sp @ip_jmif_no = '{$_POST['jmif_no']}', @disc_code = '{$_POST['disc_code']}', @nsuserid = '{$_POST['nsuserid']}', @ip_issue_date = '{$_POST['issue_date']}', @ip_issued_by = '{$_POST['issued_by']}', @ip_recvd_by = '{$_POST['recvd_by']}', @ip_supp_code = '{$_POST['supp_code']}', @ip_pr_po_no = '{$_POST['pr_po_no']}', @ip_pl_dn_inv = '{$_POST['pl_dn_inv']}', @warning = @warning output;";
					break;
				case "cvl":
				case "strl":
				case "mech":
				case "inst":
				case "ele":
				case "psf":
					$sql .= "exec @result = tempdb_sql.dbo.issconf_cvl_sp @ip_jmif_no = '{$_POST['jmif_no']}', @disc_code = '{$_POST['disc_code']}', @nsuserid = '{$_POST['nsuserid']}', @ip_issue_date = '{$_POST['issue_date']}', @ip_issued_by = '{$_POST['issued_by']}', @ip_recvd_by = '{$_POST['recvd_by']}', @ip_supp_code = '{$_POST['supp_code']}', @ip_pr_po_no = '{$_POST['pr_po_no']}', @ip_pl_dn_inv = '{$_POST['pl_dn_inv']}', @warning = @warning output;";
					break;
				// case "strl":
					// $sql .= "exec @result = tempdb_sql.dbo.issconf_cvl_sp @ip_jmif_no = '{$_POST['jmif_no']}', @disc_code = '{$_POST['disc_code']}', @nsuserid = '{$_POST['nsuserid']}', @ip_issue_date = '{$_POST['issue_date']}', @ip_issued_by = '{$_POST['issued_by']}', @ip_recvd_by = '{$_POST['recvd_by']}', @ip_supp_code = '{$_POST['supp_code']}', @ip_pr_po_no = '{$_POST['pr_po_no']}', @ip_pl_dn_inv = '{$_POST['pl_dn_inv']}';";
					// break;
				case 'pip':				
					$sql .= "exec @result = tempdb_sql.dbo.issconf_sp @ip_jmif_no = '{$_POST['jmif_no']}', @disc_code = '{$_POST['disc_code']}', @nsuserid = '{$_POST['nsuserid']}', @ip_issue_date = '{$_POST['issue_date']}', @ip_issued_by = '{$_POST['issued_by']}', @ip_recvd_by = '{$_POST['recvd_by']}', @ip_supp_code = '{$_POST['supp_code']}', @ip_pr_po_no = '{$_POST['pr_po_no']}', @ip_pl_dn_inv = '{$_POST['pl_dn_inv']}', @warning = @warning output;";
					break;
				case 'spl':				
					$sql .= "exec @result = tempdb_sql.dbo.issconf_spl_sp @ip_jmif_no = '{$_POST['jmif_no']}', @disc_code = '{$_POST['disc_code']}', @nsuserid = '{$_POST['nsuserid']}', @ip_issue_date = '{$_POST['issue_date']}', @ip_issued_by = '{$_POST['issued_by']}', @ip_recvd_by = '{$_POST['recvd_by']}', @ip_supp_code = '{$_POST['supp_code']}', @ip_pr_po_no = '{$_POST['pr_po_no']}', @ip_pl_dn_inv = '{$_POST['pl_dn_inv']}', @warning = @warning output;";
					break;
				// case 'mech':			
					// $sql .= "exec @result = tempdb_sql.dbo.issconf_sp @ip_jmif_no = '{$_POST['jmif_no']}', @disc_code = '{$_POST['disc_code']}', @nsuserid = '{$_POST['nsuserid']}', @ip_issue_date = '{$_POST['issue_date']}', @ip_issued_by = '{$_POST['issued_by']}', @ip_recvd_by = '{$_POST['recvd_by']}', @ip_supp_code = '{$_POST['supp_code']}', @ip_pr_po_no = '{$_POST['pr_po_no']}', @ip_pl_dn_inv = '{$_POST['pl_dn_inv']}', @warning = @warning output;";
					// break;
			}
			$sql .= "select @result as return_value, @warning as warning;";
			// if (!write_file('e:\sql.txt', $sql))
			     // echo 'Unable to write the file';
			// else
			     // echo 'File written!';
			$query = $this->tempdb_sql->query($sql)->result_array();
			
			return ($query[0]['return_value'] == 0 ? $query[0]['warning'] : $query[0]['return_value']);
		}
        
        public function set(){
			foreach ($_POST as $key => $value) {
				if ($key == "PROGRESS_RECID" || $key == "index" || $key == "remarks1" || $key == "idField" || $key == "_defaultId" || $key == "total" || $key == "rownum" || $key == "processThis")
					continue;
				$postInfo[$key] = mysql_real_escape_string($value);
			}
			$postInfo['log_date'] = mdate("%Y-%m-%d %H:%i:%s");
			$postInfo['log_time'] = mdate("%H:%i:%s");
			$postInfo['log_update'] = $_POST['log_user'] . " " . mdate("%Y-%m-%d %H:%i:%s");
			
            // if ($_POST['PROGRESS_RECID'] > 0){
            	// foreach ($postInfo as $key => $value){
            		// // if (!in_array($key, array("iss_qty")))
            		// if (!in_array($key, array("req_qty","iss_qty","liss","drawing_no","dlmr_jwrr","direct_with","issue_date","issued_by","recvd_by","supp_code","pr_po_no","pl_dn_inv")))
            			// unset($postInfo[$key]);
            	// }
				// var_dump($postInfo);
				// // return true;
			// }
			 			 
            if ($_POST['PROGRESS_RECID'] > 0){
            	$query = $this->tempdb_sql->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
            	$query = $this->tempdb_sql->update($this->tblName, $postInfo);
				// var_dump($query . " " . $_POST['PROGRESS_RECID']);
			}else{
            	$query = $this->is_entry_unique(array("PROGRESS_RECID" => $_POST['PROGRESS_RECID']));
            	if (gettype($query) == 'boolean'){
					if (!$query)
						return "Record already exist!";
				}else
					return $query;
					
				$query = $this->tempdb_sql->set($postInfo);
				$query = $this->tempdb_sql->insert($this->tblName);
			}
						
			return $query;
        }
		
	    public function is_entry_unique($criteria = '') {
            $this->tempdb_sql->select('count(*) as counter')->from($this->tblName)->where($criteria);
			$query = $this->tempdb_sql->get();
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
		
		public function remove(){
        	$query = $this->tempdb_sql->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->tempdb_sql->delete($this->tblName);
			
			return $query;
		}
    }
?>