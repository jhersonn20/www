<?php
class OGMR_Model extends CI_Model {
	private $tblName = "ogmr";
	//private $GLOBAL;
	public function __construct(){
		parent::__construct();
		//$this->load->database();
		//$this->GLOBAL = $this->load->database("default", TRUE);
		//$DB1 = $this->load->database('group_one', TRUE);
        $this->gendb = $this->load->database('gendb', true);
        $this->projdb = $this->load->database('projdb', true);
        $this->tempdb = $this->load->database('tempdb', true);
	}
	
	public function getAll($where = "" /*array()*/){
		$start = ($_GET['page'] - 1) * $_GET['pageSize'];
		if ($_GET['value'] == ""){
			//$sql = "SELECT (select count(*) FROM ogmr) as total,PROGRESS_RECID,job_no,booklet_no,ogmr_no,requisitioner,trans_date,addressee,description,dept,remarks,file_attach,upload_no,loguser,logdate,logupdate FROM {$this->tblName} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
			$query = $this->projdb->select("(select count(*) FROM {$this->tblName}) as total,PROGRESS_RECID,job_no,booklet_no,ogmr_no,requisitioner,trans_date,addressee,description,dept,remarks,file_attach,upload_no,loguser,logdate,logupdate")->from($this->tblName)->order_by($_GET['fieldS'],$_GET['dir'])->limit($_GET['pageSize'],$start);
			$query = $this->projdb->get();
			$rowArr = $query->result_array();
		}else {
			if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
				/*$sql = "SELECT (select count(*) FROM ogmr where {$_GET['fieldF']} like '%{$_GET['value']}%') as total,PROGRESS_RECID,job_no,booklet_no,ogmr_no,requisitioner,trans_date,addressee,description,dept,remarks,file_attach,upload_no,loguser,logdate,logupdate FROM {$this->tblName} where {$_GET['fieldF']} like '%{$_GET['value']}%' order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$_GET['pageSize']},{$start}";*/
				/*$query = $this->projdb->select('count(*)','total')->from($this->tblName)->where($_GET['fieldF'], $_GET['value'])->order_by($_GET['dir'])->limit($_GET['pageSize'],$start);
				$query = $this->projdb->get();*/
				$query = $this->projdb->select('count(*) as total')->from($this->tblName)->where($where); //->order_by($_GET['fieldS'],$_GET['dir'])->limit($_GET['pageSize'],$start);
				$query = $this->projdb->get();
				$total = $query->result();
				$total = $total[0]->total;
				
				$query = $this->projdb->select('PROGRESS_RECID,job_no,booklet_no,ogmr_no,requisitioner,trans_date,addressee,description,dept,remarks,file_attach,upload_no,loguser,logdate,logupdate')->from($this->tblName)->where($where)->order_by($_GET['fieldS'],$_GET['dir'])->limit($_GET['pageSize'],$start);
				$query = $this->projdb->get();
				$rowArr = $query->result_array();
				$rowArr[0]['total'] = $total;
			}else{
				$sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,PROGRESS_RECID,job_no,booklet_no,ogmr_no,requisitioner,trans_date,addressee,description,dept,remarks,file_attach,upload_no,loguser,logdate,logupdate FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
				$rowArr = $this->projdb->query($sql)->result_array();
			}
		}
		return $rowArr;
	}
	
	public function getAll_export(){
		if ($_GET['value'] == "")
			$sql = "SELECT PROGRESS_RECID,job_no,booklet_no,ogmr_no,requisitioner,trans_date,addressee,description,dept,remarks,file_attach,upload_no,loguser,logdate,logupdate FROM {$this->tblName} order by {$_GET['fieldS']} {$_GET['dir']}";
		else
			$sql = "SELECT PROGRESS_RECID,job_no,booklet_no,ogmr_no,requisitioner,trans_date,addressee,description,dept,remarks,file_attach,upload_no,loguser,logdate,logupdate FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']}";
		return $this->projdb->query($sql); //->result_array();
	}
	
	public function getAllPlus(){
        $query = $this->projdb->query("select @y:=max(convert(ogmr_no,unsigned)) from (select * from projdb.ogmr order by convert(ogmr_no,unsigned) limit 0, 1000) as max");
        $query = $this->projdb->query("CALL projdb.query_ogmr()")->result_array();

		return $query;
	}
	
	public function getAllBooklet(){
		$sql = "SELECT booklet_no FROM " . $this->tblName . " GROUP BY booklet_no";
		return $this->projdb->query($sql)->result_array();
	}
	
	public function get_all_filtered_booklet(){
		if ($_GET['value'] == "")
			$sql = "SELECT booklet_no FROM " . $this->tblName . " GROUP BY booklet_no";
		else
			$sql = "SELECT booklet_no FROM " . $this->tblName . " where {$_GET['value']} GROUP BY booklet_no order by {$_GET['fieldS']} {$_GET['dir']}";
		return $this->projdb->query($sql)->result_array();
	}
        
    public function getUser($filters){
    	$sql = "SELECT * FROM " . $this->tblName . " WHERE user_id = ?";
		$query = $this->projdb->query($sql, $filters[0]);
		if ($query->num_rows() > 0){
			$row = $query->row();
			//echo "Orig: " . $row->password . " Substr: " . substr($row->password, 0, 64) . " Keyed: " . $filters[1] . "<br />";
			$salt = substr($row->password, 0, 64);
			$hash = $this->makeHash($salt, $filters[1]);
	
			//echo "Orig: " . $row->password . " Keyed: " . $hash;
        	$sql = "SELECT * FROM " . $this->tblName . " WHERE user_id = ? AND password = ?";
            $query = $this->projdb->query($sql, array($row->user_id,$hash)); //$row->password
			if ($query->num_rows() > 0)
				return array("user_id"=>$query->row()->user_id,"user_name"=>$query->row()->user_name,"PROGRESS_RECID"=>$query->row()->PROGRESS_RECID);
			else
				return false;
		}else
			return false;            
    }
	
	public function set_ogmr(){
		if ($_POST['PROGRESS_RECID'] > 0){
	        $postInfo = array("job_no"=>$_POST['job_no'],
	        				  "loguser"=>$_POST['loguser'],
	        				  "logdate"=>mdate("%Y-%m-%d"),
	        				  "logupdate"=>$_POST['loguser'] . " " . mdate("%Y-%m-%d"),
	        				  "booklet_no"=>$_POST['booklet_no'],
	        				  "requisitioner"=>mysql_real_escape_string($_POST['requisitioner']),
	        				  "trans_date"=>$_POST['trans_date'],
	        				  "addressee"=>mysql_real_escape_string($_POST['addressee']),
	        				  "dept"=>$_POST['dept'],
	        				  "file_attach"=>mysql_real_escape_string($_POST['file_attach']),
	        				  "description"=>mysql_real_escape_string($_POST['description']),
	        				  "remarks"=>mysql_real_escape_string($_POST['remarks']));
							  
	    	$sql = "SELECT ogmr_no FROM {$this->tblName} WHERE PROGRESS_RECID = ?";
			$query = $this->projdb->query($sql, $_POST['PROGRESS_RECID']);
			if ($query->num_rows() > 0){
				$row = $query->row();
							  
	        	$query = $this->projdb->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
	        	$query = $this->projdb->update($this->tblName, $postInfo);
				
	        	$query = $this->tempdb->where('ogmr_no', intval($row->ogmr_no));
	        	$query = $this->tempdb->update($this->tblName, $postInfo);
			}
		}else {
	        $postInfo = array("ogmr_no"=>$_POST['ogmr_no'],
	        				  "loguser"=>$_POST['loguser'],
	        				  "logupdate"=>$_POST['loguser'] . " " . mdate("%Y-%m-%d"),
	        				  "logdate"=>mdate("%Y-%m-%d"),
	        				  "job_no"=>$_POST['job_no'],
	        				  "booklet_no"=>$_POST['booklet_no'],
	        				  "requisitioner"=>mysql_real_escape_string($_POST['requisitioner']),
	        				  "trans_date"=>$_POST['trans_date'],
	        				  "addressee"=>mysql_real_escape_string($_POST['addressee']),
	        				  "dept"=>$_POST['dept'],
	        				  "upload_no"=>$_POST['upload_no'],
	        				  "file_attach"=>mysql_real_escape_string($_POST['file_attach']),
	        				  "description"=>mysql_real_escape_string($_POST['description']),
	        				  "remarks"=>mysql_real_escape_string($_POST['remarks']));
			
			$this->projdb->set($postInfo);
			$query = $this->projdb->insert($this->tblName);
			
			$postInfo['iUse'] = 2;
			$this->tempdb->select_max('ogmr_no');
			$maxOgmr = intval($this->tempdb->get($this->tblName)->row()->ogmr_no);
			//var_dump($this->tempdb->get($this->tblName)->row()->ogmr_no); //$this->tempdb->select('MAX(ogmr_no) AS ogmr_no',false)
			if (intval($_POST['ogmr_no']) < $maxOgmr){
				$this->tempdb->where('ogmr_no',$_POST['ogmr_no']);
				$query = $this->tempdb->update($this->tblName, $postInfo);
			}else {
				$this->tempdb->set($postInfo);
				$query = $this->tempdb->insert($this->tblName);
				
        		$query = $this->tempdb->query("select @x:={$maxOgmr}, (select @y:=max(ogmr_no) from ogmr)");
				$query = $this->tempdb->query("CALL tempdb.create_tempOgmr()");
			}
		}
		return $query;
	}

	public function call_proc(){
		$query = $this->tempdb->query("select @x:=1, (select @y:=max(ogmr_no) from ogmr)");
		$query = $this->tempdb->query("CALL tempdb.create_tempOgmr()");
		
		return $query;
	}
		
	public function remove_ogmr(){
    	$sql = "SELECT ogmr_no FROM " . $this->tblName . " WHERE PROGRESS_RECID = ?";
		$query = $this->projdb->query($sql, $_POST['PROGRESS_RECID']);
		if ($query->num_rows() > 0){
			$row = $query->row();
							  
			$this->projdb->select_max('ogmr_no');
			$maxOgmr = intval($this->projdb->get($this->tblName)->row()->ogmr_no);
	        	
	        $query = $this->projdb->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
	    	$query = $this->projdb->delete($this->tblName);
			
			if (intval($row->ogmr_no) < $maxOgmr){
		        $postInfo = array("job_no"=>"",
		        				  "booklet_no"=>"",
		        				  "requisitioner"=>"",
		        				  "trans_date"=>"",
		        				  "addressee"=>"",
		        				  "dept"=>"",
		        				  "file_attach"=>"",
		        				  "description"=>"",
		        				  "remarks"=>"",
		        				  "iUse"=>3);
				
		        $query = $this->tempdb->where('ogmr_no', $row->ogmr_no);
	        	$query = $this->tempdb->update($this->tblName, $postInfo);
			}else {								  
				// $this->projdb->select_max('ogmr_no');
				// $maxOgmr = intval($this->projdb->get($this->tblName)->row()->ogmr_no);
				$sql = "SELECT max(convert(ogmr_no,unsigned)) as maxOGMR from {$this->tblName}";
				$result = $this->projdb->query($sql)->result_array();
				$maxOgmr = intval($result[0]['maxOGMR']);
				
				$sql = "DELETE FROM {$this->tblName} WHERE ogmr_no > {$maxOgmr}";
				$query = $this->tempdb->query($sql);
			}
			return $query;
		}
		return false;
	}
		
	public function remove_ogmr_br(){
    	$sql = "SELECT ogmr_no FROM {$this->tblName} WHERE PROGRESS_RECID = 95982621";
		$query = $this->projdb->query($sql);
		if ($query->num_rows() > 0){
			$row = $query->row();
							  
			//$this->projdb->select_max("ogmr_no");
			//$maxOgmr = intval($this->projdb->get($this->tblName)->row()->ogmr_no);
			$maxOgmr = intval($row->ogmr_no);
	        	
	        // $query = $this->projdb->where('PROGRESS_RECID', 95982621);
	    	// $query = $this->projdb->delete($this->tblName);			
			if (intval($row->ogmr_no) < $maxOgmr){
		        $postInfo = array("job_no"=>"",
		        				  "booklet_no"=>"",
		        				  "requisitioner"=>"",
		        				  "trans_date"=>"",
		        				  "addressee"=>"",
		        				  "dept"=>"",
		        				  "file_attach"=>"",
		        				  "description"=>"",
		        				  "remarks"=>"",
		        				  "iUse"=>3);
				
		        // $query = $this->tempdb->where('ogmr_no', $row->ogmr_no);
	        	// $query = $this->tempdb->update($this->tblName, $postInfo);
			}else {								  
				//$this->projdb->select_max('ogmr_no');
				$sql = "SELECT max(convert(ogmr_no,unsigned)) as maxOGMR from {$this->tblName}";
				$result = $this->projdb->query($sql)->result_array();
				$maxOgmr = intval($result[0]['maxOGMR']);
				//var_dump($this->projdb->query($sql)->result_array());
				//$maxOgmr = intval($this->projdb->query($sql)->row()->maxOGMR);
				
				// $sql = "DELETE FROM {$this->tblName} WHERE ogmr_no > {$maxOgmr}";
				// $query = $this->tempdb->query($sql);
			}
			return true; //$query;
		}
		return false;
	}
	
	public function rpt_register_csv(){
		$sqlH = "SELECT * FROM {$this->tblName}";
		if (trim($_GET['fijob']) != "<ALL>")
			$sql = " job_no = '{$_GET['fijob']}'";
		if (trim($_GET['fibooklet']) != "<ALL>")
			$sql = (isset($sql) ? $sql . " AND" : "") . " booklet_no = '{$_GET['fibooklet']}'";
		if (trim($_GET['fireq']) != "<ALL>")
			$sql = (isset($sql) ? $sql . " AND" : "") . " requisitioner = '{$_GET['fireq']}'";
		if (trim($_GET['fidesc']) != "<ALL>")
			$sql = (isset($sql) ? $sql . " AND" : "") . " description = '{$_GET['fidesc']}'";
		if (trim($_GET['firem']) != "<ALL>")
			$sql = (isset($sql) ? $sql . " AND" : "") . " remarks = '{$_GET['firem']}'";
		if ($_GET['fidateF'] != "null")
			$sql = (isset($sql) ? $sql . " AND" : "") . " trans_date >= '{$_GET['fidateF']}'";
		if ($_GET['fidateT'] != "null")
			$sql = (isset($sql) ? $sql . " AND" : "") . " trans_date <= '{$_GET['fidateT']}'";
		
		$sqlH .= (isset($sql) ? " WHERE" : "") . $sql;
		
		//return $sql;
		//$this->load->dbutil();
		$query = $this->projdb->query($sqlH); //->result_array();
		return $query;
		//echo $this->dbutil->csv_from_result($query);
	}
	
	public function rpt_register(){
		$sqlH = "SELECT * FROM {$this->tblName}";
		if (trim($_POST['fijob']) != "<ALL>")
			$sql = " {{$this->tblName}.job_no} = '{$_POST['fijob']}'";
		if (trim($_POST['fibooklet']) != "<ALL>")
			$sql = (isset($sql) ? $sql . " AND" : "") . " {{$this->tblName}.booklet_no} = '{$_POST['fibooklet']}'";
		if (trim($_POST['fireq']) != "<ALL>")
			$sql = (isset($sql) ? $sql . " AND" : "") . " {{$this->tblName}.requisitioner} = '{$_POST['fireq']}'";
		if (trim($_POST['fidesc']) != "<ALL>")
			$sql = (isset($sql) ? $sql . " AND" : "") . " {{$this->tblName}.description} = '{$_POST['fidesc']}'";
		if (trim($_POST['firem']) != "<ALL>")
			$sql = (isset($sql) ? $sql . " AND" : "") . " {{$this->tblName}.remarks} = '{$_POST['firem']}'";
		if ($_POST['fidateF'] != "")
			$sql = (isset($sql) ? $sql . " AND" : "") . " {{$this->tblName}.trans_date} >= '{$_POST['fidateF']}'";
		if ($_POST['fidateT'] != "")
			$sql = (isset($sql) ? $sql . " AND" : "") . " {{$this->tblName}.trans_date} <= '{$_POST['fidateT']}'";
		
		$sqlH .= (isset($sql) ? " WHERE" : "") . $sql;
		
		return $sql;
		//$this->load->dbutil();
		//$query = $this->projdb->query($sqlH); //->result_array();
		//return $query;
		//echo $this->dbutil->csv_from_result($query);
	}/**/
	
	public function rpt_register_wa(){
		$sqlH = "SELECT * FROM {$this->tblName}";
		$sql = " {{$this->tblName}.file_attach} = ''";
		if (trim($_POST['fijob']) != "<ALL>")
			$sql .= " AND {{$this->tblName}.job_no} = '{$_POST['fijob']}'";
		if (trim($_POST['fibooklet']) != "<ALL>")
			$sql .= " AND {{$this->tblName}.booklet_no} = '{$_POST['fibooklet']}'";
		
		$sqlH .= (isset($sql) ? " WHERE" : "") . $sql;
		
		return $sql;
		//$this->load->dbutil();
		//$query = $this->projdb->query($sqlH); //->result_array();
		//return $query;
		//echo $this->dbutil->csv_from_result($query);
	}

	public function clear_content(){
        $ci =& get_instance();
        $ci->load->model('webapps/ruser_model');
        
        $sql = "SELECT sa from ruser where ruser.PROGRESS_RECID = {$_POST['user_recid']}";
		$query = $this->gendb->query($sql);
		if ($query->num_rows() > 0){
			$row = $query->row();
			
			if ($row->sa)
				return $this->clear();
			else
				return false;
		}
	}
	
	private function clear(){
		$sql = "DELETE FROM {$this->tblName}";
		$query = $this->projdb->query($sql);
		
		return $query;
	}
}
?>