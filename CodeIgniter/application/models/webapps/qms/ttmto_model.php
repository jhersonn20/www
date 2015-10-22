<?php
    class Ttmto_model extends CI_Model {
    	private $tblName = "ttmto";
        public function __construct(){
            parent::__construct();
        	$this->tempdb_sql = $this->load->database('tempdb_sql', true);
        }

        public function get_all($where){			
			// $start = ($_GET['page'] - 1) * $_GET['pageSize'];
			// $end = ($start + $_GET['pageSize']) - 1;
			// if ($_GET['value'] == ""){
				// $sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
				// $rowArr = $this->tempdb_sql->query($sql)->result_array();
			// }else {
				// if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
					$sql = "SELECT * FROM {$this->tblName} t where {$where} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->tempdb_sql->query($sql)->result_array();					
				// }else{
					// $sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,PROGRESS_RECID,area_no,drawing_no,sheet_no,rev_no,stat,line_size,line_no,lineclass,matl,fluid_code,insulation,insulation_thickness,lbsb,painting,pid,transmittal,remarks,document,subarea_no,plant_no FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					// $rowArr = $this->tempdb_sql->query($sql)->result_array();
				// }
			// }
			return $rowArr;
        }

		public function call_sp($item = ""){
			$sql = "declare @result int = 0;";			
			$sql .= "exec @result = tempdb_sql.dbo.{$item}_sp @ip_refrecno = '{$_POST['ip_refrecno']}', @ip_refrecdate = '{$_POST['ip_refrecdate']}', @ip_suppcode = '{$_POST['ip_suppcode']}', @ip_suppdesc = '{$_POST['ip_suppdesc']}', @ip_prpono = '{$_POST['ip_prpono']}', @ip_pldninv = '{$_POST['ip_pldninv']}', @ip_recby = '{$_POST['ip_recby']}', @ip_recdate = '{$_POST['ip_recdate']}', @ip_qcmrirno = '{$_POST['ip_qcmrirno']}', @ip_qcmrirdate = '{$_POST['ip_qcmrirdate']}', @ip_rfino = '{$_POST['ip_rfino']}', @ip_rfidate = '{$_POST['ip_rfidate']}', @ip_refissno = '{$_POST['ip_refissno']}', @ip_refrem = '{$_POST['ip_refrem']}', @ip_loguser = '{$_POST['ip_loguser']}', @ip_precid = '{$_POST['pRecid']}';";
			$sql .= "select @result as return_value;";
			$query = $this->tempdb_sql->query($sql)->result_array();
			
			return $query[0]['return_value'];
		}
        
        public function set($item = ""){
        	if ($item == "add"){
        		if ($_POST['drawing_no'] == "<ALL>"){
			        $ci =& get_instance();
			        $ci->load->model('webapps/qms/iso_model');
					$query = $ci->iso_model->is_entry_unique(array("drawing_no" => $_POST['drawing_no'], "sheet_no" => $_POST['sheet_no']));
	            	if (gettype($query) == 'boolean'){
						if ($query)
							return ($_POST['disc_code'] == "PIP") ? "Drawing No./Sheet No. not found in ENGG PIPING MTO" : "PS Code/PS Type not found in ENGG PIPE SUPPORT MTO";
					}else
						return $query;
				}
					
				if ($_POST['disc_code'] == "PIP"){
					if ($_POST['drawing_no'] != "<ALL>")
						$filter = "drawing_no = '{$_POST['drawing_no']}' AND ";
					if ($_POST['sheet_no'] != "<ALL>")
						$filter = (isset($filter) ? $filter : "") . "sheet_no = '{$_POST['sheet_no']}' AND ";
						
					$sql = "insert into {$this->tblName}(disc_code, item_code, mat_desc, commodity_code, uom, size, area_no, drawing_no, sheet_no, rev_no, loguser, PROGRESS_RECID, lcm, sys_man, logdate, logupdate) 
								select '{$_POST['disc_code']}', item_code, mat_desc, commodity_code, uom, size, area_no, drawing_no, sheet_no, rev_no, '{$_POST['loguser']}', PROGRESS_RECID, 0, 'SYS', '" . mdate('%Y-%m-%d %H:%i:%s') . "', '" . ($_POST['loguser'] . ' ' . mdate("%Y-%m-%d %H:%i:%s")) . "' from piping.dbo.mat_takeoff_perspool where {$filter} qty != 0 AND ref_rec_qty < qty AND PROGRESS_RECID NOT IN (SELECT PROGRESS_RECID from dbo.ttMTO where {$filter} PROGRESS_RECID > 0);
							insert into ttMTO1(disc_code, item_code, mat_desc, commodity_code, uom, size, area_no, drawing_no, sheet_no, rev_no, loguser, PROGRESS_RECID, lcm, sys_man, logdate, logupdate) 
								select '{$_POST['disc_code']}', item_code, mat_desc, commodity_code, uom, size, area_no, drawing_no, sheet_no, rev_no, '{$_POST['loguser']}', PROGRESS_RECID, 1, 'SYS', '" . mdate('%Y-%m-%d %H:%i:%s') . "', '" . ($_POST['loguser'] . ' ' . mdate("%Y-%m-%d %H:%i:%s")) . "' from piping.dbo.mat_takeoff_perspool where {$filter} qty != 0 AND ref_rec_qty >= qty AND PROGRESS_RECID NOT IN (SELECT PROGRESS_RECID from dbo.ttMTO1 where {$filter} PROGRESS_RECID > 0)";
				}
				if ($_POST['disc_code'] == "PS"){
					if ($_POST['drawing_no'] != "<ALL>")
						$filter = "ps_code = '{$_POST['drawing_no']}' AND ";
					if ($_POST['sheet_no'] != "<ALL>")
						$filter = (isset($filter) ? $filter : "") . "ps_type = '{$_POST['sheet_no']}' AND ";
						
					$sql = "insert into {$this->tblName}(disc_code, area_no, drawing_no, sheet_no, rev_no, mat_tag, ps_code, ps_type, wt_fab, ref_rec_qty, loguser, PROGRESS_RECID, lcm, sys_man, logdate, logupdate), ps_matl, ps_specs, ps_class, um, line_size 
								select '{$_POST['disc_code']}', area_no, drawing_no, sheet_no, rev_no, mat_tag, ps_code, ps_type, wt_fab, ref_rec_qty, '{$_POST['loguser']}', PROGRESS_RECID, 0, 'SYS', '" . mdate('%Y-%m-%d %H:%i:%s') . "', '" . ($_POST['loguser'] . ' ' . mdate("%Y-%m-%d %H:%i:%s")) . "', ps_matl, ps_specs, ps_class, um, line_size from piping.dbo.ps_mto where {$filter} wt_fab != 0 AND ref_rec_qty < wt_fab AND PROGRESS_RECID NOT IN (SELECT PROGRESS_RECID from dbo.ttMTO where {$filter} PROGRESS_RECID > 0);
							insert into ttMTO1(disc_code, area_no, drawing_no, sheet_no, rev_no, mat_tag, ps_code, ps_type, wt_fab, ref_rec_qty, loguser, PROGRESS_RECID, lcm, sys_man, logdate, logupdate, ps_matl, ps_specs, ps_class, um, line_size) 
								select '{$_POST['disc_code']}', area_no, drawing_no, sheet_no, rev_no, mat_tag, ps_code, ps_type, wt_fab, ref_rec_qty, '{$_POST['loguser']}', PROGRESS_RECID, 1, 'SYS', '" . mdate('%Y-%m-%d %H:%i:%s') . "', '" . ($_POST['loguser'] . ' ' . mdate("%Y-%m-%d %H:%i:%s")) . "', ps_matl, ps_specs, ps_class, um, line_size from piping.dbo.ps_mto where {$filter} wt_fab != 0 AND ref_rec_qty >= wt_fab AND PROGRESS_RECID NOT IN (SELECT PROGRESS_RECID from dbo.ttMTO1 where {$filter} PROGRESS_RECID > 0)";
				}
				$query = $this->tempdb_sql->query($sql);
				if (!$query)
					return "Insert failed!";
					
				$query = $this->tempdb_sql->query("select count(*) as counter from ttMTO1")->result_array();
				if (!$query)
					return "Find failed!";
				if ($query[0]['counter'] > 0)
					return "Completed Materials found under this ISO/DWG.";
        	}else if ($item == "manual"){
        		foreach ($_POST as $key => $value) {
					if ($key == "setType")
						continue;
					$postInfo[$key] = mysql_real_escape_string($value);
				}
				$postInfo['logdate'] = mdate("%Y-%m-%d %H:%i:%s");
				$postInfo['logupdate'] = $_POST['loguser'] . " " . mdate("%Y-%m-%d %H:%i:%s");
				$this->tempdb_sql->select_max('PROGRESS_RECID');
				$PROGRESS_RECID = $this->tempdb_sql->get($this->tblName)->result_array();
				$postInfo['PROGRESS_RECID'] = (int)$PROGRESS_RECID[0]['PROGRESS_RECID'] + 1;
									
				$query = $this->tempdb_sql->set($postInfo);
				$query = $this->tempdb_sql->insert($this->tblName);
        	}else if ($item == "temp"){
        		$sql = "INSERT INTO {$this->tblName}
        					select * from ttMTO1 where PROGRESS_RECID IN ({$_POST['pRecid']}) and
        											   PROGRESS_RECID NOT IN (select PROGRESS_RECID FROM {$this->tblName})";
        		$query = $this->tempdb_sql->query($sql);
        	}else if ($item == "update"){
        		foreach ($_POST as $key => $value) {
					if ($key == "rec_qty" || $key == "dtl_rem")
						$postInfo[$key] = mysql_real_escape_string($value);
				}
				$postInfo['logdate'] = mdate("%Y-%m-%d %H:%i:%s");
				$postInfo['logupdate'] = $_POST['loguser'] . " " . mdate("%Y-%m-%d %H:%i:%s");
				    
            	$query = $this->tempdb_sql->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
            	$query = $this->tempdb_sql->update($this->tblName, $postInfo);
        	}else if ($item == "ps")
        		$query = $this->call_sp("ttMTO");
						
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
	        }else {
	            return 'Error in retrieving criteria.';
	        }
	    }
		
		public function remove(){
			$postInfo = array("loguser" => $_POST['loguser']);
			if ($_POST['PROGRESS_RECID'] > 0)
				$postInfo['PROGRESS_RECID'] = $_POST['PROGRESS_RECID'];
			
    		$query = $this->tempdb_sql->where($postInfo);        		
    		$query = $this->tempdb_sql->delete($this->tblName);
			if (!$query)
				return "Delete failed!";
						
	        $ci =& get_instance();
	        $ci->load->model('webapps/qms/ttmto1_model');
    		$query = $ci->ttmto1_model->remove();
			
			return $query;
		}
    }
?>