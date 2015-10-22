<?php
    class Mat_excess_Model extends CI_Model {
    	private $tblName = "mat_excess";
        public function __construct(){
            parent::__construct();
        	$this->piping = $this->load->database('piping', true);
        }
        
        public function get_all($where){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			if ($_GET['value'] == ""){
				$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
				$rowArr = $this->piping->query($sql)->result_array();
			}else {
				if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){					
					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->piping->query($sql)->result_array();							
				}else{
					$sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,* FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					$rowArr = $this->piping->query($sql)->result_array();
				}
			}
			return $rowArr;
        }
        
        public function getAll($criteria){
        	if (isset($criteria)){
	        	if (is_array($criteria))
	        		return $this->piping->get_where($this->tblName, $criteria)->result_array();
	        	else {
	        		if ($criteria == "")
		        		$sql = "select * from {$this->tblName}";
					else
			        	$sql = "select * from {$this->tblName} where {$criteria}";
		        	return $this->piping->query($sql)->result_array();
		        }
		    }
        }
        
         public function get_all_export($where = ""){
			if ($where != "")
				$where = ("WHERE " . $where);
			
			$sql = "select stock_no,item_code,commodity_code,tot_qty,onhand_qty,iss_qty FROM {$this->tblName} {$where} order by {$_GET['fieldS']} {$_GET['dir']}";
			$rowArr = $this->piping->query($sql)->result_array();
				
			return $rowArr;
        }
        
        public function gen_work($where){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;

			$sql = "with thisResult as (
						select t.commodity_code, t.item_code, t.qty_allocated as alloc_qty, t.qty_onhand as qty, t.size, (t.qty_onhand - t.qty_allocated) as balance, t.description as itemdesc from {$this->tblName} t where qty_onhand > 0 and stock_no in (select stock_no from material_file_dtl where disc_code = 'PIP')  
					)
					SELECT top {$_GET['pageSize']} * 
						FROM (
							select (select count(*) FROM thisResult" . (($where != "") ? " where {$where}" : "") . ") as total,
								   *,
								   row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum 
							FROM thisResult" . (($where != "") ? " where {$where}" : "") . "
						) t						
						where" . (($where != "") ? " {$where} AND " : "") . " rownum > {$start} 
						order by {$_GET['fieldS']} {$_GET['dir']}";
			$rowArr = $this->piping->query($sql)->result_array();
			return $rowArr;
        }
		
		public function get_all_dd(){
			//$sql = "select t1.item_code,t1.description,t1.stock_no,(t1.description + ',' + t1.size + ',' + t1.uom + ',' + t1.item_code + ',' + t1.commodity_code + ',' + t1.stock_no) as stock_desc from {$this->tblName} t1 with(index(IDX_NC_Material_file_Item_code)) join (SELECT RTRIM(LTRIM(item_code)) as item_code from {$this->tblName} with(index(IDX_NC_Material_file_Item_code)) where RTRIM(LTRIM(item_code)) <> '' group by RTRIM(LTRIM(item_code))) t2 on t1.item_code = t2.item_code";
			$sql = "select RTRIM(LTRIM(item_code)) as item_code,max(description) as description,max(stock_no) as stock_no,(max(description) + ',' + max(size) + ',' + max(uom) + ',' + RTRIM(LTRIM(item_code)) + ',' + max(commodity_code) + ',' + max(stock_no)) as stock_desc from {$this->tblName} with(index(IDX_NC_Material_file_Item_code)) where RTRIM(LTRIM(item_code)) <> '' group by RTRIM(LTRIM(item_code))";
			return $this->piping->query($sql)->result_array(); //get($this->tblName)->result_array();
		}
        
        public function set($postInfo = array()){
        	$PROGRESS_RECID = 0;
			if (sizeof($postInfo) > 0){
				$PROGRESS_RECID = $postInfo['PROGRESS_RECID'];
				unset($postInfo['PROGRESS_RECID']);
			}else {
				foreach ($_POST as $key => $value) {
					if ($key == "PROGRESS_RECID")
						continue;
					$postInfo[$key] = mysql_real_escape_string($value);
				}
				$postInfo['spool_id'] = mysql_real_escape_string($postInfo['drawing_no'] . "-" . $postInfo['sheet_no'] . "-" . $postInfo['spool_no']);
				$postInfo['log_update'] = $postInfo['log_user'] . " " . mdate("%Y-%m-%d %H:%i:%s");
				$postInfo['log_date'] = mdate("%Y-%m-%d %H:%i:%s");
				$postInfo['log_time'] = mdate("%H:%i:%s");
				$PROGRESS_RECID = $_POST['PROGRESS_RECID'];
			}

            if ($PROGRESS_RECID == 0){
				$this->piping->set($postInfo);
				$query = $this->piping->insert($this->tblName);
			}else{
            	$this->piping->where('PROGRESS_RECID', $PROGRESS_RECID);
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