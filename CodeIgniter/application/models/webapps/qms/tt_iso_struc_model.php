<?php
    class Tt_Iso_Struc_Model extends CI_Model {
    	private $tblName = "TTiso_struc";
        public function __construct(){
            parent::__construct();
        	$this->tempdb = $this->load->database('tempdb_sql', true);
        }
        
        public function get_all($where){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			
					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->tempdb->query($sql)->result_array();					
				
		
			return $rowArr;
        }
		public function get_all_iso_struc($p_isoWhere = ''){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			
			$sql = "select top 17 t2.workable_pct, t.supp_code,t.area_no,t.area_loc,t.drawing_no,t.rev_no,t.sheet_no,t.workable_pct,weight,t.plant_no,t.drawing_no,t.sheet_no,(select SUM(length) from piping.dbo.piece_struc 
					where {$p_isoWhere})as totLength,
					(select SUM(weight) from piping.dbo.piece_struc where {$p_isoWhere})as totWeight,
					(select count(*) from piping.dbo.piece_struc where {$p_isoWhere})as totiso
				    from dbo.iso_struc t
					inner join dbo.piece_struc t2
					on	t2.plant_no = t.plant_no and
						t2.area_no = t.area_no and
						t2.area_loc = t.area_loc and
						t2.drawing_no = t.drawing_no and
						t2.sheet_no = t.sheet_no and
						t2.rev_no = t.rev_no
					where {$p_isoWhere}	";
				
		return $this->tempdb->query($sql)->result_array();
		}
        public function get_all_export($where){
			$sql = "select (select count(*) FROM {$this->tblName} where {$where}) as total,* FROM {$this->tblName} where {$where} order by {$_GET['fieldS']} {$_GET['dir']}";
			$rowArr = $this->tempdb->query($sql)->result_array();
			return $rowArr;
        }
           public function export_iso_piece_struc($where){
			$sql = "select top 17 t.supp_code,t.area_no,t.area_loc,t.drawing_no,t.sheet_no,t.rev_no,t.workable_pct,t2.piece_no,t2.piece_desc,
        			t2.location,t2.qty,t2.length,t2.weight,t2.um,t2.workable_pct,t2.received_dt,t2.issued_dt,t2.assembly_dt,t2.erection_dt
        			from dbo.iso_struc t
					inner join dbo.piece_struc t2
					on	t2.plant_no = t.plant_no and
						t2.area_no = t.area_no and
						t2.area_loc = t.area_loc and
						t2.drawing_no = t.drawing_no and
						t2.sheet_no = t.sheet_no and
						t2.rev_no = t.rev_no
					where {$where}	";
			
			
			$rowArr = $this->tempdb->query($sql)->result_array();
			return $rowArr;
        }
        
        
        public function set_isoStruc(){
			$postInfo = array();
			foreach ($_POST as $key => $value) {
				if ($key == "PROGRESS_RECID")
					continue;
				$postInfo[$key] = mysql_real_escape_string($value);
			}
			$postInfo['log_update'] = $_POST['log_user'] . " " . mdate("%Y-%m-%d");
			$postInfo['log_date'] = mdate("%Y-%m-%d %H:%i:%s");

            if ($_POST['PROGRESS_RECID'] == "0"){
				$query = $this->tempdb->set($postInfo);
				$query = $this->tempdb->insert($this->tblName);
			}else{
            	$query = $this->tempdb->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
            	$query = $this->tempdb->update($this->tblName, $postInfo);
			}
			
			return $query;
        }
	    public function create_ttisoStruc(){
			$postInfo = array();
			foreach ($_POST as $key => $value) {
				if ($key == "PROGRESS_RECID_IDENT")
					continue;
				$postInfo[$key] = mysql_real_escape_string($value);
			}
            if ($_POST['PROGRESS_RECID_IDENT'] == "0"){
				$query = $this->tempdb->set($postInfo);
				$query = $this->tempdb->insert($this->tblName);
			}else{
            	$query = $this->tempdb->where('PROGRESS_RECID_IDENT', $_POST['PROGRESS_RECID_IDENT']);
            	$query = $this->tempdb->update($this->tblName, $postInfo);
			}
			
			return $query;
        }
		public function autoDelete(){
        	$sql = "delete from {$this->tblName}";
			
			$rowArr = $this->tempdb->query($sql)->result_array();
			return $rowArr;
		}
		public function remove_isoStruc(){
        	$query = $this->tempdb->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->tempdb->delete($this->tblName);
			return $query;
		}
    }
?>