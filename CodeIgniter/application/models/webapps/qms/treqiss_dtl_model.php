<?php
    class Treqiss_dtl_model extends CI_Model {
    	private $tblName = "treqiss_dtl";
		private $rows_this_table;
        public function __construct(){
            parent::__construct();
        	$this->piping = $this->load->database('piping', true);
			$this->qms_atrail = $this->load->database('qms_atrail', true);
        }
		
		public function get_all_dd(){
			$this->piping->select()->from($this->tblName);
			return $this->piping->get()->result_array();
		}
		public function get_dd_drawing(){
			$sql = "select drawing_no from {$this->tblName} where disc_code='STRL' group by drawing_no order by drawing_no ";
			return $this->piping->query($sql)->result_array(); //get($this->tblName)->result_array();
		}
        public function get_all($where){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			 if ($_GET['value'] == ""){
				$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} ) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
				$rowArr = $this->piping->query($sql)->result_array();
			}else {
				// if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} WITH(INDEX(IDX_NC_Treqiss_dtl_Jmif_no)) where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName} WITH(INDEX(IDX_NC_Treqiss_dtl_Jmif_no)) where {$where}) t where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->piping->query($sql)->result_array();					
				// }else{
					// $sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,PROGRESS_RECID,area_no,drawing_no,sheet_no,rev_no,stat,line_size,line_no,lineclass,matl,fluid_code,insulation,insulation_thickness,lbsb,painting,pid,transmittal,remarks,document,subarea_no,plant_no FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					// $rowArr = $this->piping->query($sql)->result_array();
				// }
			 }
			return $rowArr;
        }

		public function get_all_mod($where){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			 // if ($_GET['value'] == ""){
				// $sql = "SELECT top {$_GET['pageSize']} t.*,t2.jmif_date FROM (select (select count(*) FROM {$this->tblName} ) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName} WITH(INDEX(IDX_NC_Treqiss_dtl_Jmif_no))) t inner join dbo.treqiss_hdr t2 on t2.jmif_no = t.jmif_no where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
				// $rowArr = $this->piping->query($sql)->result_array();
			// }else {
				// if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} WITH(INDEX(IDX_NC_Treqiss_dtl_Jmif_no)) where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName} WITH(INDEX(IDX_NC_Treqiss_dtl_Jmif_no)) where {$where}) t where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->piping->query($sql)->result_array();					
				// }else{
					// $sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,PROGRESS_RECID,area_no,drawing_no,sheet_no,rev_no,stat,line_size,line_no,lineclass,matl,fluid_code,insulation,insulation_thickness,lbsb,painting,pid,transmittal,remarks,document,subarea_no,plant_no FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					// $rowArr = $this->piping->query($sql)->result_array();
				// }
			 // }
			return $rowArr;
        }
		
        public function get_all_mod2($where){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			 // if ($_GET['value'] == ""){
				// $sql = "SELECT top {$_GET['pageSize']} t.*,t2.jmif_date FROM (select (select count(*) FROM {$this->tblName} ) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName} WITH(INDEX(IDX_NC_Treqiss_dtl_Jmif_no))) t inner join dbo.treqiss_hdr t2 on t2.jmif_no = t.jmif_no where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
				// $rowArr = $this->piping->query($sql)->result_array();
			// }else {
				// if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
					$sql = "SELECT top {$_GET['pageSize']} t.*,t2.jmif_date FROM (select (select count(*) FROM {$this->tblName} WITH(INDEX(IDX_NC_Treqiss_dtl_Jmif_no)) where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName} WITH(INDEX(IDX_NC_Treqiss_dtl_Jmif_no)) where {$where}) t inner join dbo.treqiss_hdr t2 on t2.jmif_no = t.jmif_no where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->piping->query($sql)->result_array();					
				// }else{
					// $sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,PROGRESS_RECID,area_no,drawing_no,sheet_no,rev_no,stat,line_size,line_no,lineclass,matl,fluid_code,insulation,insulation_thickness,lbsb,painting,pid,transmittal,remarks,document,subarea_no,plant_no FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					// $rowArr = $this->piping->query($sql)->result_array();
				// }
			 // }
			return $rowArr;
        }	
         public function get_all_mod3($where){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			 // if ($_GET['value'] == ""){
				// $sql = "SELECT top {$_GET['pageSize']} t.*,t2.jmif_date FROM (select (select count(*) FROM {$this->tblName} ) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName} WITH(INDEX(IDX_NC_Treqiss_dtl_Jmif_no))) t inner join dbo.treqiss_hdr t2 on t2.jmif_no = t.jmif_no where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
				// $rowArr = $this->piping->query($sql)->result_array();
			// }else {
				// if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->piping->query($sql)->result_array();					
				// }else{
					// $sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,PROGRESS_RECID,area_no,drawing_no,sheet_no,rev_no,stat,line_size,line_no,lineclass,matl,fluid_code,insulation,insulation_thickness,lbsb,painting,pid,transmittal,remarks,document,subarea_no,plant_no FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					// $rowArr = $this->piping->query($sql)->result_array();
				// }
			 // }
			return $rowArr;
        }
        public function get_all_with_inner($where){
        	$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			
			$sql = "SELECT t.* from {$this->tblName} t
					inner join dbo.treqiss_hdr t2
					on t.jmif_no = t2.jmif_no
					where {$where}
				   ";
			$rowArr = $this->piping->query($sql)->result_array();
			return $rowArr;
        }
		public function export_with_inner($rsOption,$cbdisc){
        	$sql = "declare @result int;";
			$sql .= "exec @result = piping.dbo.export_jwrr @rsOption = $rsOption,@cbdisc = $cbdisc;";
			$sql .= "select @result as return_value;";
			$query = $this->piping->query($sql)->result_array();
        }
        public function export_procJwrr($where){
			$sql = "SELECT TOP 100 * FROM {$this->tblName}";
			return $this->piping->query($sql)->result_array();
		}
         public function get_all_export($where = ""){
			if ($where != "")
				$where = ("WHERE " . $where);
			
			$sql = "select TOP 10 jmif_no,stock_no,item_code,commodity_code,size,req_qty,iss_qty,area_no FROM {$this->tblName} {$where} order by {$_GET['fieldS']} {$_GET['dir']}";
			$rowArr = $this->piping->query($sql)->result_array();
				
			return $rowArr;
        }
		

        public function get_all_from_tt($where){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			if ($_GET['value'] == ""){
				$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM ttTempS) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM ttTempS) t where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
				$rowArr = $this->piping->query($sql)->result_array();
			}else {
				if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM ttTempS where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM ttTempS) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->piping->query($sql)->result_array();					
				}else{
					$sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,PROGRESS_RECID,area_no,drawing_no,sheet_no,rev_no,stat,line_size,line_no,lineclass,matl,fluid_code,insulation,insulation_thickness,lbsb,painting,pid,transmittal,remarks,document,subarea_no,plant_no FROM ttTempS where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					$rowArr = $this->piping->query($sql)->result_array();
				}
			}
			return $rowArr;
        }

		public function modified_getAll(){
			
			$sql = "SELECT {$_GET['pageSize']} * FROM ";
			$rowArr = $this->piping->query($sql)->result_array();	
		}
        
        public function getAll($criteria){
        	if (isset($criteria)){
	        	if (is_array($criteria))
	        		return $this->piping->get_where($this->tblName, $criteria)->result_array();
	        	else {
		        	$sql = "select * from {$this->tblName} where {$criteria}";
		        	return $this->piping->query($sql)->result_array();
		        }
		    }
        }
        
        public function set($postInfo = array()){
        	$PROGRESS_RECID = 0;
			$unit = "";
        	if (sizeof($postInfo) == 0){
				foreach ($_POST as $key => $value) {
					if ($key == "PROGRESS_RECID" || $key == "index" || $key == "remarks1" || $key == "idField" || $key == "_defaultId" || $key == "hasChange" || 
						$key == "req_qty_old" || $key == "lisoreqd" || $key == "unit" || $key == "total" || $key == "rownum" || $key == "jmif_date" || $key == "remarks" ||
						$key == "stock_no_input")
						continue;
					$postInfo[$key] = mysql_real_escape_string($value);
					if (is_string($value))
						$postInfo[$key] = stripslashes($value);
				}
				$postInfo['log_date'] = mdate("%Y-%m-%d %H:%i:%s");
				$postInfo['log_time'] = mdate("%H:%i:%s");
				$postInfo['log_update'] = $_POST['log_user'] . " " . mdate("%Y-%m-%d %H:%i:%s");
				$PROGRESS_RECID = $_POST['PROGRESS_RECID'];
				$unit = (isset($_POST['unit']) ? $_POST['unit'] : "");
			}else {
				$PROGRESS_RECID = $postInfo['PROGRESS_RECID'];
				if (isset($postInfo['unit'])){
					$unit = $postInfo['unit'];
					unset($postInfo['unit']);
				}
			}
		
			if (strtolower($postInfo['disc_code']) == "pip"){
				if ($postInfo['module'] == "ISS"){									
					// $query = $this->is_entry_unique(array("jmif_no"=>$postInfo['jmif_no'],"disc_code"=>$postInfo['disc_code'],"stock_no"=>$postInfo['stock_no'],"item_code"=>$postInfo['item_code'],"commodity_code"=>$postInfo['commodity_code'],"drawing_no"=>$postInfo['drawing_no'],"spool_no"=>$postInfo['spool_no'],"size"=>$postInfo['size']));
		        	// if (gettype($query) == 'boolean'){
						// if (!$query)
							// return "Record already exist!";
					// }else
						// return $query;
										
					$rows_mat = array();
					$ci =& get_instance();
					$ci->load->model('webapps/qms/material_file_model');
					$query = $ci->material_file_model->is_entry_unique(array("commodity_code"=>$postInfo['commodity_code'],"uom"=>$postInfo['uom'],"size"=>$postInfo['size']));
		        	if (gettype($query) == 'boolean'){
						if ($query)
							return "Material File with\n 
					                Stock No. : {$postInfo['stock_no']}\n
					                Item Code : {$postInfo['item_code']}\n
					                Commodity Code : {$postInfo['commodity_code']} does not exist.";
						else
							$rows_mat = $ci->material_file_model->getAll(array("commodity_code"=>$postInfo['commodity_code'],"uom"=>$postInfo['uom'],"size"=>$postInfo['size']));
					}else
						return $query;
					
					$rows = $this->getAll(array("PROGRESS_RECID"=>$PROGRESS_RECID));
					
					// echo $rows_mat['qty_onhand'] . " " . intval($rows_mat['qty_onhand']);
					if (intval($postInfo['iss_qty']) == 0 && $rows[0]['direct_with'] == 0 && $rows[0]['dlmr_jwrr'] == 0 && ((intval($rows_mat[0]['qty_onhand']) - (intval($postInfo['iss_qty']) - intval($rows[0]['iss_qty']))) < 0))				
						return "Invalid Transaction. Not enough material quantity on-hand.";
					
					if (intval($postInfo['iss_qty']) == 0 && $rows[0]['direct_with'] == 0 && $rows[0]['dlmr_jwrr'] == 0 && (((intval($rows_mat[0]['qty_onhand']) - intval($rows_mat[0]['qty_allocated'])) - (intval($postInfo['iss_qty']) - intval($rows[0]['iss_qty']))) < 0))				
						return "Invalid Transaction. Not enough material quantity on-hand.";
					
					if (intval($postInfo['direct_with']) == 0 && $rows[0]['direct_with'] == 1 && intval($postInfo['dlmr_jwrr']) == 0 && $rows[0]['dlmr_jwrr'] == 0){
						if (((intval($rows_mat[0]['qty_po']) - intval($rows[0]['iss_qty'])) - ((intval($rows[0]['excess']) == 0) ? 0 : intval($postInfo['iss_qty']))) < 0)
							return "Invalid Transaction. Please check issued quantity inputs.";
								
						if ((intval($rows_mat[0]['qty_onhand']) - ((intval($rows[0]['excess']) == 0) ? 0 : intval($postInfo['iss_qty']))) < 0)
							return "Invalid Transaction. Please check issued quantity inputs.";
								
						if (((intval($rows_mat[0]['qty_onhand']) - intval($rows_mat[0]['qty_allocated'])) - ((intval($rows[0]['excess']) == 0) ? 0 : intval($postInfo['iss_qty']))) < 0)
							return "Invalid Transaction. Please check issued quantity inputs.";
					}
					
					if (intval($postInfo['direct_with']) == 0 && $rows[0]['direct_with'] == 0 && intval($postInfo['dlmr_jwrr']) == 0 && $rows[0]['dlmr_jwrr'] == 1){
						if (((intval($rows_mat[0]['qty_po']) - intval($rows[0]['iss_qty'])) - ((intval($rows[0]['excess']) == 0) ? 0 : intval($postInfo['iss_qty']))) < 0)
							return "Invalid Transaction. Please check issued quantity inputs.";
								
						if ((intval($rows_mat[0]['qty_onhand']) - ((intval($rows[0]['excess']) == 0) ? 0 : intval($postInfo['iss_qty']))) < 0)
							return "Invalid Transaction. Please check issued quantity inputs.";
								
						if (((intval($rows_mat[0]['qty_onhand']) - intval($rows_mat[0]['qty_allocated'])) - ((intval($rows[0]['excess']) == 0) ? 0 : intval($postInfo['iss_qty']))) < 0)
							return "Invalid Transaction. Please check issued quantity inputs.";
					}
					
					$ci =& get_instance();
					$ci->load->model('webapps/qms/mat_excess_model');
					$query = $ci->mat_excess_model->is_entry_unique(array("stock_no"=>$postInfo['stock_no'],"item_code"=>$postInfo['item_code'],"commodity_code"=>$postInfo['commodity_code'],"size"=>$postInfo['size']));
		        	if (gettype($query) == 'boolean'){
						if ($query) {
							$query = $ci->mat_excess_model->set(array("PROGRESS_RECID"=>0,"stock_no"=>$postInfo['stock_no'],"item_code"=>$postInfo['item_code'],"commodity_code"=>$postInfo['commodity_code'],"log_user"=>$postInfo['log_user'],"log_date"=>mdate("%Y-%m-%d %H:%i:%s"),"log_time"=>mdate("%H:%i:%s")));
							if (!$query)
								return "Insert failed! Material Excess table.";
						}
						$rows_material_excess = $ci->mat_excess_model->getAll(array("stock_no"=>$postInfo['stock_no'],"item_code"=>$postInfo['item_code'],"commodity_code"=>$postInfo['commodity_code'],"size"=>$postInfo['size']));					
						$this->rows_this_table = $this->getAll(array("plant_no"=>$postInfo['plant_no'],"area_no"=>$postInfo['area_no'],"drawing_no"=>$postInfo['drawing_no'],"sheet_no"=>$postInfo['sheet_no'],"rev_no"=>$postInfo['rev_no'],"spool_no"=>$postInfo['spool_no'],"commodity_code"=>$postInfo['commodity_code'],"size"=>$postInfo['size'],"jmif_no"=>$postInfo['jmif_no']));
	
						if ($postInfo['iss_qty'] > $postInfo['req_qty']){
							$dcExcess = ($this->rows_this_table[0]['iss_qty'] == 0 ? ($postInfo['iss_qty'] - $postInfo['req_qty']) : (($postInfo['iss_qty'] - $this->rows_this_table[0]['iss_qty']) - ($postInfo['req_qty'] - $this->rows_this_table[0]['req_qty'])));
							
							if (($rows_material_excess[0]['onhand_qty'] + $dcExcess) < 0)
								return 'Insufficient Qty.<br />Kindly see your Excess Material Inventory.';
							
							// proc_excess
							if (!$postInfo['excess']){
								$ci =& get_instance();
								$ci->load->model('webapps/qms/mat_excess_model');
								$query = $query = $ci->mat_excess_model->set(array("PROGRESS_RECID"=>$rows_material_excess[0]['PROGRESS_RECID'],"stock_no"=>$postInfo['stock_no'],"item_code"=>$postInfo['item_code'],
																				   "commodity_code"=>$postInfo['commodity_code'],"size"=>$postInfo['size'],"log_user"=>$postInfo['log_user'],
																				   "tot_qty"=>($rows_material_excess[0]['tot_qty'] + $dcExcess),"onhand_qty"=>($rows_material_excess[0]['onhand_qty'] + $dcExcess),"log_date"=>$postInfo['log_date'],
																				   "log_time"=>$postInfo['log_time'],"log_update"=>$postInfo['log_update']));
								if (!$query)
									return 'Failed. Update failed for table mat_excess.';
							}							
						}
						
						if (($postInfo['iss_qty'] <= $postInfo['req_qty']) && ($this->rows_this_table[0]['iss_qty'] > $this->rows_this_table[0]['req_qty'])){
							$dcExcess = $this->rows_this_table[0]['iss_qty'] - $this->rows_this_table[0]['req_qty'];
														
							if (($rows_material_excess[0]['onhand_qty'] - $dcExcess) < 0)
								return 'Insufficient Qty.<br />Kindly see your Excess Material Inventory.';
							
							// proc_excess
							if (!$postInfo['excess']){
								$ci =& get_instance();
								$ci->load->model('webapps/qms/mat_excess_model');
								$query = $query = $ci->mat_excess_model->set(array("PROGRESS_RECID"=>$rows_material_excess[0]['PROGRESS_RECID'],"stock_no"=>$postInfo['stock_no'],"item_code"=>$postInfo['item_code'],
																				   "commodity_code"=>$postInfo['commodity_code'],"size"=>$postInfo['size'],"log_user"=>$postInfo['log_user'],
																				   "tot_qty"=>($rows_material_excess[0]['tot_qty'] - $dcExcess),"onhand_qty"=>($rows_material_excess[0]['onhand_qty'] - $dcExcess),"log_date"=>$postInfo['log_date'],
																				   "log_time"=>$postInfo['log_time'],"log_update"=>$postInfo['log_update']));
								if (!$query)
									return 'Failed. Update failed for table mat_excess.';
							}		 
						}
						
						if ($postInfo['excess'] && $this->rows_this_table[0]['excess']){
							if ($postInfo['excess'] && $this->rows_this_table[0]['excess'])
								$dcExcess = $postInfo['iss_qty'] - $this->rows_this_table[0]['iss_qty'];
							else if ($postInfo['excess'] && !$this->rows_this_table[0]['excess'])
								$dcExcess = $postInfo['iss_qty'];
							else if (!$postInfo['excess'] && $this->rows_this_table[0]['excess'])
								$dcExcess = $this->rows_this_table[0]['iss_qty'];
							else
								$dcExcess = 0;
														
							if (($rows_material_excess[0]['onhand_qty'] - $dcExcess) < 0 && $postInfo['excess'])
								return 'Insufficient Qty.<br />Kindly see your Excess Material Inventory.';
						}
					}else
						return $query;
				}else {									
					$ci =& get_instance();
					$ci->load->model('webapps/qms/iso_model');
					$query = $ci->iso_model->is_entry_unique(array("plant_no"=>$postInfo['plant_no'],"area_no"=>$postInfo['area_no'],"drawing_no"=>$postInfo['drawing_no'],"sheet_no"=>$postInfo['sheet_no'],"rev_no"=>$postInfo['rev_no']));
		        	if (gettype($query) == 'boolean'){
						if ($query)
							return "Isometric Drawing Not Found!";
					}else
						return $query;
				}
			}else if (strtolower($postInfo['disc_code']) == "ps")
				unset($postInfo['isc_no']);
			unset($postInfo['module']);
			
            if ($PROGRESS_RECID > 0){
            	$this->piping->where('PROGRESS_RECID', $PROGRESS_RECID);
            	$query = $this->piping->update($this->tblName, $postInfo);
				if (!$query)
					return 'Update failed!';
				
				$query = $this->auditTrail("MATERIAL REQUEST-PIPING (DTL)","EDIT");
			}else{
				if (strtolower($postInfo['disc_code']) == "pip"){					
					$ci =& get_instance();
					$ci->load->model('webapps/qms/mat_takeoff_perspool_model');				
					$query = $ci->mat_takeoff_perspool_model->getAll(array("plant_no"=>$postInfo['plant_no'],"area_no"=>$postInfo['area_no'],"drawing_no"=>$postInfo['drawing_no'],"sheet_no"=>$postInfo['sheet_no'],"rev_no"=>$postInfo['rev_no'],"spool_no"=>$postInfo['spool_no'],"commodity_code"=>$postInfo['commodity_code'],"size"=>$postInfo['size']));
		        	if ($query[0]['qty'] == $query[0]['reqd_qty'])
						return "Request Piping Material was already completed base from Engg MTO.";
				}
				
            	$query = $this->is_entry_unique(array("plant_no"=>$postInfo['plant_no'],"area_no"=>$postInfo['area_no'],"drawing_no"=>$postInfo['drawing_no'],"sheet_no"=>$postInfo['sheet_no'],"rev_no"=>$postInfo['rev_no'],"spool_no"=>$postInfo['spool_no'],"commodity_code"=>$postInfo['commodity_code'],"size"=>$postInfo['size'],"jmif_no"=>$postInfo['jmif_no']));
            	if (gettype($query) == 'boolean'){
					if (!$query)
						return "Record already exist!";
				}else
					return $query;
 				
				unset($postInfo['PROGRESS_RECID']);
				$query = $this->piping->set($postInfo);
				$query = $this->piping->insert($this->tblName);
				if (!$query)
					return 'Insert failed!';
						
				if (strtolower($postInfo['disc_code']) == "pip"){
					$ci =& get_instance();
					$ci->load->model('webapps/qms/spool_model');
	            	$query = $this->spool_model->is_entry_unique(array("plant_no"=>$postInfo['plant_no'],"area_no"=>$postInfo['area_no'],"drawing_no"=>$postInfo['drawing_no'],"sheet_no"=>$postInfo['sheet_no'],"rev_no"=>$postInfo['rev_no'],"spool_no"=>$postInfo['spool_no']));
	            	if (gettype($query) == 'boolean'){
						if ($query)
							$query = $this->spool_model->set_spool(array("PROGRESS_RECID"=>0,"plant_no"=>$postInfo['plant_no'],"area_no"=>$postInfo['area_no'],"drawing_no"=>$postInfo['drawing_no'],"sheet_no"=>$postInfo['sheet_no'],"rev_no"=>$postInfo['rev_no'],"spool_no"=>$postInfo['spool_no'],"iso_stat"=>'Active',"lwhse"=>1));
					}else
						return $query;
				}
				
				$query = $this->auditTrail("MATERIAL REQUEST-PIPING (DTL)","ADD");
			}

			switch(strtolower($postInfo['disc_code'])){
				case "pip":
					// if (strtolower($postInfo['disc_code']) == "pip"){
					if ($_POST['module'] == 'ISS'){			
						//proc_whse_update
						$ci =& get_instance();
						$ci->load->model('webapps/qms/treqiss_hdr_model');
						$rows_treqiss_hdr = $ci->treqiss_hdr_model->getAll(array("jmif_no"=>$postInfo['jmif_no']));
						
						if ($rows_treqiss_hdr[0]['finalized']){
							$ci =& get_instance();
							$ci->load->model('webapps/qms/twhse_pip_mat_model');
							$rows_twhse_pip_mat = $ci->twhse_pip_mat_model->getFirst(array("item_code"=>$postInfo['item_code'],"size"=>$postInfo['size'],"drawing_no"=>$postInfo['drawing_no'],"sheet_no"=>$postInfo['sheet_no'],"spool_no"=>$postInfo['spool_no']));
							$query = $ci->twhse_pip_mat_model->set(array("PROGRESS_RECID"=>$rows_twhse_pip_mat[0]['PROGRESS_RECID'],"jmif_no"=>$postInfo['jmif_no'],"req_qty"=>$postInfo['req_qty'],"stock_no"=>$postInfo['stock_no'],
																		 "commodity_code"=>$postInfo['commodity_code'],"iss_qty"=>$postInfo['iss_qty'],"issued_date"=>mdate("%H:%i:%s"),"log_user"=>($rows_treqiss_hdr[0]['whse_prep'] ? $postInfo['log_user'] : $rows_twhse_pip_mat[0]['log_user']),
																		 "log_today"=>($rows_treqiss_hdr[0]['whse_prep'] ? mdate("%H:%i:%s") : $rows_twhse_pip_mat[0]['log_today'])));
							if (!$query)
								return 'Failed. Update failed for table twhse_pip_mat.';
						}
			
						//proc_ex_compute
						if ($postInfo['excess'] && $this->rows_this_table[0]['excess'])
							$dcExcess = $postInfo['iss_qty'] - $this->rows_this_table[0]['iss_qty'];
						else if ($postInfo['excess'] && !$this->rows_this_table[0]['excess'])
							$dcExcess = $postInfo['iss_qty'];
						else if (!$postInfo['excess'] && $this->rows_this_table[0]['excess'])
							$dcExcess = $this->rows_this_table[0]['iss_qty'];
						else
							$dcExcess = 0;
																							
						$ci =& get_instance();
						$ci->load->model('webapps/qms/mat_excess_model');
						$rows_mat_excess = $ci->mat_excess_model->getAll(array("commodity_code"=>$postInfo['commodity_code'],"size"=>$postInfo['size']));
						$query = $ci->mat_excess_model->set(array("PROGRESS_RECID"=>$rows_mat_excess[0]['PROGRESS_RECID'],"onhand_qty"=>($postInfo['excess'] ? ($rows_mat_excess[0]['onhand_qty'] - $dcExcess) : ($rows_mat_excess[0]['onhand_qty'] + $dcExcess)),"iss_qty"=>(!$postInfo['excess'] && $this->rows_this_table[0]['excess'] ? ($rows_mat_excess[0]['onhand_qty'] + $dcExcess) : ($rows_mat_excess[0]['onhand_qty'] - $dcExcess))));
						if (!$query)
							return 'Failed. Update failed for table mat_excess';
						
						//proc_compute
						$query = $this->call_sp();
						if (!$query)
							return 'Failed. Something wrong with the process.';				
					}
		
					$ci =& get_instance();
					$ci->load->model('webapps/qms/material_file_model');
		        	$query = $this->material_file_model->is_entry_unique(array("stock_no"=>$postInfo['stock_no'],"item_code"=>$postInfo['item_code'],"commodity_code"=>$postInfo['commodity_code'],"size"=>$postInfo['size']));
		        	if (gettype($query) == 'boolean'){
						if ($query){
							$query = $this->material_file_model->set(array("PROGRESS_RECID"=>0,"stock_no"=>$postInfo['stock_no'],"item_code"=>$postInfo['item_code'],"commodity_code"=>$postInfo['commodity_code'],"description"=>$postInfo['mat_desc'],"size"=>$postInfo['size'],"uom"=>$postInfo['uom'],"flg_status"=>1,"qty_allocated"=>$postInfo['req_qty'])); //,"unit"=>$postInfo['unit']
							if (!$query)
								return 'Insert failed! Material table.';
													
							$ci =& get_instance();
							$ci->load->model('webapps/qms/material_file_dtl_model');
			            	$query = $this->material_file_dtl_model->is_entry_unique(array("stock_no"=>$postInfo['stock_no'],"disc_code"=>$_POST['disc_code']));
			            	if (gettype($query) == 'boolean'){
								if ($query)
									$query = $this->material_file_dtl_model->set(array("PROGRESS_RECID"=>0,"stock_no"=>$postInfo['stock_no'],"disc_code"=>$_POST['disc_code'],"item_code"=>$postInfo['item_code'],"commodity_code"=>$postInfo['commodity_code'],"size"=>$postInfo['size'],"flg_status"=>1,"log_date"=>mdate("%Y-%m-%d %H:%i:%s"),"lisoreqd"=>$postInfo['direct_with'],"log_user"=>$_POST['log_user']));
									if (!$query)
										return 'Insert failed! Material Detail table.';
							}else
								return $query;
						}else {
							$query = $this->material_file_model->getAll(array("stock_no"=>$postInfo['stock_no'],"item_code"=>$postInfo['item_code'],"commodity_code"=>$postInfo['commodity_code'],"size"=>$postInfo['size']));
							if (!$query)
								return 'Select failed! Material table';
		 
							$query = $this->material_file_model->set(array("PROGRESS_RECID"=>$query[0]['PROGRESS_RECID'],"qty_allocated"=>($query[0]['qty_allocated'] - $_POST['req_qty_old']) + $postInfo['req_qty']));
							if (!$query)
								return 'Update failed! Material table.';
						}
					}else
						return $query;
					// }
					break;
				case "strl":
					if ($_POST['module'] == 'ISS'){
						//proc_compute
						$query = $this->call_sp();
						if (!$query)
							return 'Failed. Something wrong with the process.';
					}
					break;				
			}
			
			return $query;
        }

		public function call_sp(){
			$local_iss_qty = (intval($this->rows_this_table[0]['iss_qty']) == 0 ? 0 : $this->rows_this_table[0]['iss_qty']);
			$local_direct_with = (intval($this->rows_this_table[0]['direct_with']) == 0 ? 0 : $this->rows_this_table[0]['direct_with']);
			$local_dlmr_jwrr = (intval($this->rows_this_table[0]['dlmr_jwrr']) == 0 ? 0 : $this->rows_this_table[0]['dlmr_jwrr']);
			$PROGRESS_RECID = ((isset($_POST['PROGRESS_RECID']) && intval($_POST['PROGRESS_RECID']) > 0) ? $_POST['PROGRESS_RECID'] : $this->piping->insert_id());
			
			$sql = "declare @result int = 0, @warning varchar(max);";			
			$sql .= "exec @result = piping.dbo.proc_compute_iss @ip_PROGRESS_RECID = {$PROGRESS_RECID}, @ip_iss_qty_old = {$local_iss_qty}, @ip_direct_with_old = {$local_direct_with}, 
																@ip_dlmr_jwrr_old = {$local_dlmr_jwrr}, @ip_jmif_date = '{$_POST['jmif_date']}', @ip_remarks = '{$_POST['remarks']}', @warning = @warning output;";
			$sql .= "select @result as return_value;";
			$query = $this->piping->query($sql)->result_array();
			
			return $query[0]['return_value'];
		}

		public function set_from_upl($postInfo = array()){
        	if (sizeof($postInfo) == 0){
				foreach ($_POST as $key => $value) {
					if ($key == "index" || $key == "remarks1" || $key == "idField" || $key == "_defaultId" || $key == "deleteHdr" || $key == "isLast" || $key == "req_qty_old")
						continue;
					$postInfo[$key] = mysql_real_escape_string($value);
				}			
				$postInfo['log_date'] = mdate("%Y-%m-%d %H:%i:%s");
				$postInfo['log_time'] = mdate("%H:%i:%s");
				$postInfo['log_update'] = $_POST['log_user'] . " " . mdate("%Y-%m-%d %H:%i:%s");
			}
						
	        $ci =& get_instance();
            $ci->load->model('webapps/qms/treqiss_hdr_model');
            			
			$query = $ci->treqiss_hdr_model->is_entry_unique(array("jmif_no"=>$postInfo['jmif_no'], "disc_code"=>$postInfo['disc_code']));
        	if (gettype($query) == 'boolean'){
				if ($query)
					return $postInfo['jmif_no'] . " is not found in header transaction.<br /> Please create first the header before proceeding to uploading of details.";
				else {
					if ($_POST['deleteHdr'] == 1){
		        		$query = $this->remove(array("jmif_no"=>$postInfo['jmif_no']));
		        		if (!$query)
		        			return "Failed. Deleting of existing records failed!";
						else {
			            	$query = $this->is_entry_unique(array("plant_no"=>$postInfo['plant_no'],"area_no"=>$postInfo['area_no'],"drawing_no"=>$postInfo['drawing_no'],"sheet_no"=>$postInfo['sheet_no'],"rev_no"=>$postInfo['rev_no'],"spool_no"=>$postInfo['spool_no'],"commodity_code"=>$postInfo['commodity_code'],"size"=>$postInfo['size'],"jmif_no"=>$postInfo['jmif_no']));
			            	if (gettype($query) == 'boolean'){
								if (!$query)
									return "Record already exist! JMIF Upload: " . $postInfo['jmif_no'];
							}else
								return $query;
							
							$query = $this->set($postInfo);
							if (!$query)
								return "Failed. Creating new record failed!";
						}
					// } else{
						// $query = $this->set($postInfo);
						// if (!$query)
							// return "Failed. Creating new record failed!";
					}					
							
					// $ci =& get_instance();
		            // $ci->load->model('webapps/qms/material_file_model');
// 		            			
					// $query = $ci->material_file_model->is_entry_unique(array("stock_no"=>$postInfo['stock_no'], "item_code"=>$postInfo['item_code'], "commodity_code"=>$postInfo['commodity_code'], "size"=>$postInfo['size']));
		        	// if (gettype($query) == 'boolean'){
						// if ($query){
							// $query = $ci->material_file_model->set(array("PROGRESS_RECID"=>$postInfo['PROGRESS_RECID'], "stock_no"=>$postInfo['stock_no'],"item_code"=>$postInfo['item_code'],"commodity_code"=>$postInfo['commodity_code'],"size"=>$postInfo['size'],"uom"=>$postInfo['uom'],"sched"=>$postInfo['sched'],"matl_type"=>$postInfo['matl_type'],"flg_status"=>1));
							// if (!$query)
								// return "Failed. Creating new record for Material File failed!";								
// 							
							// $ci =& get_instance();
				            // $ci->load->model('webapps/qms/material_file_dtl_model');
				            // $query = $ci->material_file_dtl_model->set(array("PROGRESS_RECID"=>$postInfo['PROGRESS_RECID'], "stock_no"=>$postInfo['stock_no'],"item_code"=>$postInfo['item_code'],"commodity_code"=>$postInfo['commodity_code'],"disc_code"=>$postInfo['disc_code'],"flg_status"=>1));
							// if (!$query)
								// return "Failed. Creating new record for Material detail failed!";
						// }
					// }else
						// return $query;
					
					if ($_POST['isLast'] == 1){
						$sql = "update t
								set t.iss_by = @nsuserid,
									t.jmif_status = (case when (t2.icnt_req != 0) then (case when (t2.icnt_req = t2.icnt_iss) then 'CLOSED' else (case when (icnt_iss != 0) then 'PARTIAL' when (t2.icnt_iss = 0) then (case when (t2.deqty_iss != 0) then 'PARTIAL' else 'OPEN' end) end) end) else t.jmif_status end)
								from piping.dbo.treqiss_hdr t
								inner join (
									select COUNT(jmif_no) as icnt_req, sum(req_qty) as deqty_req,
										   sum(case when (iss_qty != 0 and iss_qty = req_qty) then 1 else 0 end) as icnt_iss, SUM(iss_qty) as deqty_iss,
										   MAX(jmif_no) as jmif_no
										from piping.dbo.treqiss_dtl where jmif_no = '{$postInfo['jmif_no']}'
								) t2
								on t.jmif_no = t2.jmif_no
								where t.jmif_no = '{$postInfo['jmif_no']}' and
									  t.disc_code = '{$postInfo['disc_code']}'";
						$query = $this->piping->query($sql);
						if (!$query)
							return "Failed. Update failed for Issuance Hdr table!";
					}
				}
			}else
				return $query;
				
			if (!isset($query) || trim($query) == "")
				//var_dump($_POST);
				// $query = $postInfo['jmif_no'] . " " . $_POST['deleteHdr'] . " " . (($_POST['deleteHdr'] == 1) ? "true" : "false");
			return $query;
		}
        
        public function update($postInfo = array(), $criteria = array()){
        	if (sizeof($postInfo) == 0){
				foreach ($_POST as $key => $value) {
					if ($key == "PROGRESS_RECID" || $key == "index" || $key == "remarks1" || $key == "idField" || $key == "_defaultId")
						continue;
					$postInfo[$key] = mysql_real_escape_string($value);
				}
				$postInfo['log_date'] = mdate("%Y-%m-%d %H:%i:%s");
				$postInfo['log_time'] = mdate("%H:%i:%s");
				$postInfo['log_update'] = $_POST['log_user'] . " " . mdate("%Y-%m-%d %H:%i:%s");
			}

        	$query = $this->piping->where($criteria);
        	$query = $this->piping->update($this->tblName, $postInfo);
			
			return $query;        	
        }
        
        public function showJSon(){ 
	        $ci =& get_instance();
            $ci->load->model('webapps/qms/treqiss_hdr_model');
            			
			$query = $ci->treqiss_hdr_model->is_entry_unique(array("jmif_no"=>$_POST['jmif_no'], "disc_code"=>$_POST['disc_code']));
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
				$query = $this->is_entry_unique(array("plant_no"=>$newDtls->plant_no, "area_no"=>$newDtls->area_no, "drawing_no"=>$newDtls->drawing_no, "sheet_no"=>$newDtls->sheet_no, "spool_no"=>$newDtls->spool_no, "commodity_code"=>$newDtls->commodity_code, "size"=>$newDtls->size, "jmif_no"=>$_POST['jmif_no'], "isc_no"=>$newDtls->isc_no));
	        	if (gettype($query) == 'boolean'){
					if (!$query)
						continue;
				}else
					continue;
				
				// if (strpos($_POST['jmif_no'], $newDtls->jmif_no) < 0)
					// if (!$ci->tjwrr_hdr_model->set(array("PROGRESS_RECID"=>$_POST['PROGRESS_RECID'], "log_user"=>$_POST['log_user'], "jmif_no"=>$_POST['jmif_no'] .= ($_POST['jmif_no'] == "" ? "" : ", ") . $newDtls->jmif_no)))
						// return "Update failed. JMIF No.";
		
				foreach($newDtls as $index2 => $value2):
					if (!in_array($index2, array("stock_no","item_code","commodity_code","direct_with","mat_desc","uom","size","activity_code","mat_util","measurement","req_qty","plant_no","area_no","drawing_no","sheet_no","rev_no","system_no","sub_system","testpack_no","spl_type","spool_no","disc_code","disc_desc","frecid","isc_no")))
						continue;
					$postInfo[$index2] = mysql_real_escape_string($value2);
				endforeach;
				$postInfo["isc_no"] = $newDtls->itemno;
				$postInfo["module"] = $_POST['module'];
				$postInfo["jmif_no"] = $_POST['jmif_no'];
				$postInfo["log_user"] = $_POST['log_user'];
				$postInfo['log_date'] = mdate("%Y-%m-%d %H:%i:%s");
				$postInfo['log_time'] = mdate("%H:%i:%s");
				$postInfo['log_update'] = $_POST['log_user'] . " " . mdate("%Y-%m-%d %H:%i:%s");
				$postInfo["PROGRESS_RECID"] = 0;
				if (!isset($postInfo['stock_no']) || $postInfo['stock_no'] == NULL){
					$postInfo['stock_no'] = $postInfo['commodity_code'];
					$postInfo['item_code'] = $postInfo['commodity_code'];
				}

				if (!$this->set($postInfo))
					return "Insert failed!";

				switch ($postInfo['disc_code']) {
					case 'strl':
				        $ci =& get_instance();
			            $ci->load->model('webapps/qms/piece_struc_model');
			            $query = $ci->piece_struc_model->getAll(array("piece_no"=>$newDtls->commodity_code, "drawing_no"=>$newDtls->drawing_no, "reqd_qty"=>0));
			            if (sizeof($query) > 0){
							while ($a <= $postInfo['req_qty']) {
				            	$query = $ci->piece_struc_model->update(array("reqd_qty"=>1),array("piece_no"=>$newDtls->commodity_code, "drawing_no"=>$newDtls->drawing_no, "reqd_qty"=>0));
								if (!$query)
									return "Update failed. Required Qty.";
							}													
						}
						break;					
					case "pip":
				        $ci =& get_instance();
			            $ci->load->model('webapps/qms/mat_takeoff_perspool_model');
			            $query = $ci->mat_takeoff_perspool_model->getAll(array("plant_no"=>$newDtls->plant_no, "area_no"=>$newDtls->area_no, "drawing_no"=>$newDtls->drawing_no, "sheet_no"=>$newDtls->sheet_no, "rev_no"=>$newDtls->rev_no, "spool_no"=>$newDtls->spool_no, "commodity_code"=>$newDtls->commodity_code, "size"=>$newDtls->size, "qty >"=>$newDtls->req_qty - $newDtls->qty)); //, "isc_no"=>$newDtls->itemno
			            if (sizeof($query) > 0){
			            	$query = $ci->mat_takeoff_perspool_model->update(array("reqd_qty"=>($query[0]['reqd_qty'] + $newDtls->req_qty)),array("plant_no"=>$newDtls->plant_no, "area_no"=>$newDtls->area_no, "drawing_no"=>$newDtls->drawing_no, "sheet_no"=>$newDtls->sheet_no, "rev_no"=>$newDtls->rev_no, "spool_no"=>$newDtls->spool_no, "commodity_code"=>$newDtls->commodity_code, "size"=>$newDtls->size, "qty >"=>($newDtls->req_qty - $newDtls->qty))); //, "isc_no"=>$newDtls->itemno
							if (!$query)
								return "Update failed. Required Qty.";
						}						
						break;
					case "ps":
				        $ci =& get_instance();
			            $ci->load->model('webapps/qms/ps_mto_model');
			            $query = $ci->ps_mto_model->getAll(array("plant_no"=>$newDtls->plant_no, "area_no"=>$newDtls->area_no, "drawing_no"=>$newDtls->drawing_no, "sheet_no"=>$newDtls->sheet_no, "rev_no"=>$newDtls->rev_no, "spool_no"=>$newDtls->spool_no, "ps_code"=>$newDtls->ps_code, "mat_tag"=>$newDtls->mat_tag, "com_code"=>$newDtls->com_code, "ps_type"=>$newDtls->ps_type, "uqty >"=>$newDtls->req_qty));
			            if (sizeof($query) > 0){
			            	$query = $ci->ps_mto_model->update(array("reqd_qty"=>($query[0]['reqd_qty'] + $newDtls->req_qty)),array("plant_no"=>$newDtls->plant_no, "area_no"=>$newDtls->area_no, "drawing_no"=>$newDtls->drawing_no, "sheet_no"=>$newDtls->sheet_no, "rev_no"=>$newDtls->rev_no, "spool_no"=>$newDtls->spool_no, "ps_code"=>$newDtls->item_code, "mat_tag"=>$newDtls->isc_no, "com_code"=>$newDtls->support_no, "ps_type"=>$newDtls->system_no, "uqty >"=>$newDtls->reqd_qty));
							if (!$query)
								return "Update failed. Required Qty.";
						}
						break;
					case 'spl':
				        $ci =& get_instance();
			            $ci->load->model('webapps/qms/spool_model');
			            $query = $ci->spool_model->getAll(array("plant_no"=>$newDtls->plant_no, "area_no"=>$newDtls->area_no, "drawing_no"=>$newDtls->drawing_no, "sheet_no"=>$newDtls->sheet_no, "rev_no"=>$newDtls->rev_no, "spool_no"=>$newDtls->spool_no));
			            if (sizeof($query) > 0){
			            	$query = $ci->spool_model->update(array("spool_qty"=>$newDtls->req_qty),array("plant_no"=>$newDtls->plant_no, "area_no"=>$newDtls->area_no, "drawing_no"=>$newDtls->drawing_no, "sheet_no"=>$newDtls->sheet_no, "rev_no"=>$newDtls->rev_no, "spool_no"=>$newDtls->spool_no));
							if (!$query)
								return "Update failed. Required Qty.";													
						}
						break;
					case 'psf':
				        $ci =& get_instance();
			            $ci->load->model('webapps/qms/ps_mto_hdr_model');
			            $query = $ci->ps_mto_hdr_model->getAll(array("stock_no"=>$newDtls->stock_no, "ps_code"=>$newDtls->commodity_code));
			            if (sizeof($query) > 0){
			            	$query = $ci->ps_mto_hdr_model->update(array("spool_qty"=>($query[0]['reqd_qty'] + $newDtls->req_qty)),array("stock_no"=>$newDtls->stock_no, "ps_code"=>$newDtls->commodity_code, "iso_qty >"=>$query[0]['reqd_qty']));
							if (!$query)
								return "Update failed. Required Qty.";													
						}
						break;
				}
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
	            } else{
	                return TRUE;
	            }
	        } else {
	            return 'Error in retrieving criteria.';
	        }
	    }

		public function auditTrail($tranDesc = "", $type = ""){        	
			$sql = "declare @result int = 0;";
			$sql .= "exec @result = qms_atrail.dbo.auditTrail_sp @syscode = 'QMS', @userid = '{$_POST['log_user']}', @trandesc = '{$tranDesc}', @type = '{$type}';";			
			$sql .= "select @result as return_value;";
			$query = $this->qms_atrail->query($sql)->result_array();
			
			return $query[0]['return_value'];			
		}
		
		public function remove($postInfo = array()){
			if (sizeof($postInfo) == 0){
				foreach ($_POST as $key => $value) {
					if ($key == "index" || $key == "remarks1" || $key == "idField" || $key == "_defaultId" || $key == "total" || $key == "rownum" || $key == "module")
						continue;
					$postInfo[$key] = mysql_real_escape_string($value);
				}
				$postInfo['log_date'] = mdate("%Y-%m-%d %H:%i:%s");
				$postInfo['log_time'] = mdate("%H:%i:%s");
				$postInfo['log_update'] = $_POST['log_user'] . " " . mdate("%Y-%m-%d %H:%i:%s");
				// $postInfo['PROGRESS_RECID'] = $_POST['PROGRESS_RECID'];
			}
			switch (strtolower($postInfo['disc_code'])) {
				case 'ps':
					unset($postInfo['req_qty_old']);
					unset($postInfo['isc_no']);
					unset($postInfo['excess']);
					unset($postInfo['iss_qty']);
					break;
				case 'strl':
					unset($postInfo['req_qty_old']);
					unset($postInfo['isc_no']);
					unset($postInfo['excess']);
					unset($postInfo['iss_qty']);
			        $ci =& get_instance();
		            $ci->load->model('webapps/qms/piece_struc_model');
		            $query = $ci->piece_struc_model->getAll(array("piece_no"=>$postInfo['commodity_code'], "drawing_no"=>$postInfo['drawing_no'], "reqd_qty"=>1));
		            if (sizeof($query) > 0){
		            	$b = 1;
						while ($b <= $postInfo['req_qty']) {
			            	$query = $ci->piece_struc_model->update(array("reqd_qty"=>0),array("piece_no"=>$postInfo['commodity_code'], "drawing_no"=>$postInfo['drawing_no'], "reqd_qty"=>1));
							if (!$query)
								return "Update failed. Required Qty.";
						}													
					}							
					foreach ($postInfo as $key => $value) {
						if ($key != 'PROGRESS_RECID')
							unset($postInfo[$key]);						
					}			
					break;
				case 'pip':
					if (isset($postInfo['plant_no'])){
				        $ci =& get_instance();
			            $ci->load->model('webapps/qms/mat_takeoff_perspool_model');
			            $query = $ci->mat_takeoff_perspool_model->getAll(array("plant_no"=>$postInfo['plant_no'], "area_no"=>$postInfo['area_no'], "drawing_no"=>$postInfo['drawing_no'], 
			            														   						"sheet_no"=>$postInfo['sheet_no'], "rev_no"=>$postInfo['rev_no'], "spool_no"=>$postInfo['spool_no'], "commodity_code"=>$postInfo['commodity_code'], 
			            														   						"size"=>$postInfo['size'])); //, "isc_no"=>$postInfo['isc_no']
			            if (sizeof($query) > 0){
			            	$query = $ci->mat_takeoff_perspool_model->update(array("reqd_qty"=>($query[0]['reqd_qty'] == 0 ? $query[0]['reqd_qty'] : ($query[0]['reqd_qty'] - $postInfo['req_qty']))),array("plant_no"=>$postInfo['plant_no'], "area_no"=>$postInfo['area_no'], "drawing_no"=>$postInfo['drawing_no'], 
			            														   						"sheet_no"=>$postInfo['sheet_no'], "rev_no"=>$postInfo['rev_no'], "spool_no"=>$postInfo['spool_no'], "commodity_code"=>$postInfo['commodity_code'], 
			            														   						"size"=>$postInfo['size'])); //, "isc_no"=>$postInfo['isc_no']
							if (!$query)
								return "Update failed. System failed to update the Material Take-Off table for its 'Required Qty.' field.";
						}else
							return "Update failed. No records found for Material Take-Off table.";
					}
					break;
				case "spl":
				        $ci =& get_instance();
			            $ci->load->model('webapps/qms/spool_model');
			            $query = $ci->spool_model->getAll(array("plant_no"=>$postInfo['plant_no'], "area_no"=>$postInfo['area_no'], "drawing_no"=>$postInfo['drawing_no'], "sheet_no"=>$postInfo['sheet_no'], "rev_no"=>$postInfo['rev_no'], "spool_no"=>$postInfo['spool_no']));
			            if (sizeof($query) > 0){
			            	$query = $ci->spool_model->update(array("spool_qty"=>0),array("plant_no"=>$postInfo['plant_no'], "area_no"=>$postInfo['area_no'], "drawing_no"=>$postInfo['drawing_no'], "sheet_no"=>$postInfo['sheet_no'], "rev_no"=>$postInfo['rev_no'], "spool_no"=>$postInfo['spool_no']));
							if (!$query)
								return "Update failed. Required Qty.";													
						}				
						foreach ($postInfo as $key => $value) {
							if ($key != 'PROGRESS_RECID')
								unset($postInfo[$key]);						
						}
					break;
					case "psf":
				        $ci =& get_instance();
			            $ci->load->model('webapps/qms/ps_mto_hdr_model');
			            $query = $ci->ps_mto_hdr_model->getAll(array("stock_no"=>$postInfo['stock_no'], "ps_code"=>$postInfo['commodity_code']));
			            if (sizeof($query) > 0){
			            	$query = $ci->ps_mto_hdr_model->update(array("spool_qty"=>($query[0]['reqd_qty'] + $postInfo['req_qty'])),array("stock_no"=>$postInfo['stock_no'], "ps_code"=>$postInfo['commodity_code'], "iso_qty >"=>$query[0]['reqd_qty']));
							if (!$query)
								return "Update failed. Required Qty.";													
						}
						break;
			}

			if (isset($postInfo['PROGRESS_RECID']))
        		$query = $this->piping->where("PROGRESS_RECID", $postInfo['PROGRESS_RECID']);
			else
        		$query = $this->piping->where($postInfo);
        	$query = $this->piping->delete($this->tblName);
			return $query;
		}
		
		public function remove_tt(){
        	$query = $this->piping->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->piping->delete("ttTempS");
			return $query;
		}
		
		public function qc_inspec($jmif_no = ""){
			$sql = "select count(t.jwrr_no) as return_value
					from tjwrr_hdr t
					inner join tjwrr_dtl t2
					on t.jwrr_no = t2.jwrr_no
					inner join treqiss_hdr t3
					on t2.jmif_no = t3.jmif_no
					inner join treqiss_dtl t4
					on t3.jmif_no = t4.jmif_no and
					   t3.disc_code = t4.disc_code
					where t4.jmif_no = '{$jmif_no}' and
						  t.qcmrir_no is null and
						  t.qcmrir_date is null;";
			$query = $this->piping->query($sql)->result_array();
			
			return $query[0]['return_value'];
		}
    }
?>