<?php
    class Material_file_dtl_Model extends CI_Model {
    	private $tblName = "material_file_dtl";
        public function __construct(){
            parent::__construct();
        	$this->piping = $this->load->database('piping', true);
        }
		
		// public function get_all_dd(){
			// $sql = "select t1.item_code,t1.description,t1.stock_no,(t1.description + ',' + t1.size + ',' + t1.uom) as stock_desc from {$this->tblName} t1 join (SELECT RTRIM(LTRIM(item_code)) as item_code from {$this->tblName} where RTRIM(LTRIM(item_code)) <> '' group by RTRIM(LTRIM(item_code))) t2 on t1.item_code = t2.item_code";
			// return $this->piping->query($sql)->result_array(); //get($this->tblName)->result_array();
		// }
		
		public function get_all_dd(){
			//$sql = "select t1.item_code,t1.description,t1.stock_no,(t1.description + ',' + t1.size + ',' + t1.uom + ',' + t1.item_code + ',' + t1.commodity_code + ',' + t1.stock_no) as stock_desc from {$this->tblName} t1 with(index(IDX_NC_Material_file_Item_code)) join (SELECT RTRIM(LTRIM(item_code)) as item_code from {$this->tblName} with(index(IDX_NC_Material_file_Item_code)) where RTRIM(LTRIM(item_code)) <> '' group by RTRIM(LTRIM(item_code))) t2 on t1.item_code = t2.item_code";
			$sql = "select t2.* from {$this->tblName} t with(index(IDX_NC_Material_file_dtl_DiscStock)) inner join (select (RTRIM(LTRIM(item_code)) + ' (' + isnull(RTRIM(LTRIM(size)),'') + ')') as item_size, RTRIM(LTRIM(item_code)) as item_code,max(description) as description,RTRIM(LTRIM(stock_no)) as stock_no,max(commodity_code) as commodity_code, isnull(RTRIM(LTRIM(size)),'') as size, max(uom) as uom,(max(isnull(description,'')) + ',' + max(isnull(RTRIM(LTRIM(size)),'')) + ',' + max(isnull(uom,'')) + ',' + isnull(RTRIM(LTRIM(item_code)),'') + ',' + max(isnull(commodity_code,'')) + ',' + isnull(RTRIM(LTRIM(stock_no)),'')) as stock_desc from material_file with(index(IDX_NC_Material_file_Item_code)) where RTRIM(LTRIM(item_code)) <> '' group by RTRIM(LTRIM(stock_no)), RTRIM(LTRIM(item_code)), RTRIM(LTRIM(size))) t2 on t.stock_no = t2.stock_no where t.disc_code = '{$_GET['disc_code']}'";
			return $this->piping->query($sql)->result_array(); //get($this->tblName)->result_array();
		}
		public function getAll_dd_mod(){
			//$sql = "select t1.item_code,t1.description,t1.stock_no,(t1.description + ',' + t1.size + ',' + t1.uom + ',' + t1.item_code + ',' + t1.commodity_code + ',' + t1.stock_no) as stock_desc from {$this->tblName} t1 with(index(IDX_NC_Material_file_Item_code)) join (SELECT RTRIM(LTRIM(item_code)) as item_code from {$this->tblName} with(index(IDX_NC_Material_file_Item_code)) where RTRIM(LTRIM(item_code)) <> '' group by RTRIM(LTRIM(item_code))) t2 on t1.item_code = t2.item_code";
			$sql = "select t2.* from {$this->tblName} t with(index(IDX_NC_Material_file_dtl_DiscStock)) inner join (select (RTRIM(LTRIM(item_code)) + ' (' + isnull(RTRIM(LTRIM(size)),'') + ')') as item_size, RTRIM(LTRIM(item_code)) as item_code,max(description) as description,RTRIM(LTRIM(stock_no)) as stock_no,max(commodity_code) as commodity_code, isnull(RTRIM(LTRIM(size)),'') as size, max(uom) as uom,(max(isnull(description,'')) + ',' + max(isnull(RTRIM(LTRIM(size)),'')) + ',' + max(isnull(uom,'')) + ',' + isnull(RTRIM(LTRIM(item_code)),'') + ',' + max(isnull(commodity_code,'')) + ',' + isnull(RTRIM(LTRIM(stock_no)),'')) as stock_desc from material_file with(index(IDX_NC_Material_file_Item_code)) where RTRIM(LTRIM(item_code)) <> '' group by RTRIM(LTRIM(stock_no)), RTRIM(LTRIM(item_code)), RTRIM(LTRIM(size))) t2 on t.stock_no = t2.stock_no";
			return $this->piping->query($sql)->result_array(); //get($this->tblName)->result_array();
		}
        
        public function get_all($where){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			if ($_GET['value'] == ""){
				$sql = "SELECT (select count(*) FROM {$this->tblName} where {$where}) as total,* FROM {$this->tblName} where {$where} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
				$rowArr = $this->piping->query($sql)->result_array();
			}else {
				if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){					
					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->piping->query($sql)->result_array();					
				}else{
					$sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,* FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					$rowArr = $this->piping->query($sql)->result_array();
				}
			}
			return $rowArr;
        }	
        
        public function getAll($criteria = array()){
        	return $this->piping->get_where($this->tblName, $criteria)->result_array();        	
        }
        
        public function set_spool(){
            $postInfo = array("plant_no"=>mysql_real_escape_string($_POST['plant_no']),"area_no"=>mysql_real_escape_string($_POST['area_no']),
            				  "drawing_no"=>mysql_real_escape_string($_POST['drawing_no']),"rev_no"=>mysql_real_escape_string($_POST['rev_no']),
            				  "sheet_no"=>mysql_real_escape_string($_POST['sheet_no']),"spool_id"=>mysql_real_escape_string($_POST['drawing_no'] . "-" . $_POST['sheet_no'] . "-" . $_POST['spool_no']),
            				  "subarea_no"=>mysql_real_escape_string($_POST['subarea_no']),"loguser"=>mysql_real_escape_string($_POST['loguser']),
            				  "logdate"=>mdate("%Y-%m-%d"),"lbsb"=>mysql_real_escape_string($_POST['lbsb']),
            				  "tot_diainch"=>$_POST['tot_diainch'],"tot_lm"=>$_POST['tot_lm'],
            				  "spool_cont"=>($_POST['spool_cont'] == "true" ? 1 : 0),"spl_type"=>mysql_real_escape_string($_POST['spl_type']),
            				  "testpack_no"=>mysql_real_escape_string($_POST['testpack_no']),"lengg"=>1,
            				  "logupdate"=>$_POST['loguser'] . " " . mdate("%Y-%m-%d"),"spool_no"=>mysql_real_escape_string($_POST['spool_no']));

            if ($_POST['PROGRESS_RECID'] == "0"){
				$query = $this->piping->set($postInfo);
				$query = $this->piping->insert($this->tblName);
			}else{
            	$query = $this->piping->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
            	$query = $this->piping->update($this->tblName, $postInfo);
			}
			
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
		
		public function remove_spool(){
        	$query = $this->piping->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->piping->delete($this->tblName);
			return $query;
		}
    }
?>