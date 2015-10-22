<?php
    class Iso_struc_Model extends CI_Model {
    	private $tblName = "iso_struc";
        public function __construct(){
            parent::__construct();
        	$this->piping = $this->load->database('piping', true);
        }
		
		public function get_all_dd2(){
			//$sql = "select t1.area_no from {$this->tblName} t1 join (SELECT RTRIM(LTRIM(area_no)) as area_no from {$this->tblName} where RTRIM(LTRIM(area_no)) <> '' group by RTRIM(LTRIM(area_no))) t2 on t1.area_no = t2.area_no";
			$sql = "select area_no from {$this->tblName} group by area_no order by area_no";
			return $this->piping->query($sql)->result_array(); //get($this->tblName)->result_array();
		}
        
        public function get_all($where){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			if ($_GET['value'] == ""){
				$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
				$rowArr = $this->piping->query($sql)->result_array();
			}else {
				if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->piping->query($sql)->result_array();					
				}else{
					$sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,PROGRESS_RECID,area_no,drawing_no,sheet_no,rev_no,stat,line_size,line_no,lineclass,matl,fluid_code,insulation,insulation_thickness,lbsb,painting,pid,transmittal,remarks,document,subarea_no,plant_no FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					$rowArr = $this->piping->query($sql)->result_array();
				}
			}
			return $rowArr;
        }
		public function get_all_iso_struc($p_isoWhere = ''){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			
			$sql = "select top 100 t2.workable_pct, t.supp_code,t.area_no,t.area_loc,t.drawing_no,t.rev_no,t.sheet_no,t.workable_pct,weight,t.plant_no,t.drawing_no,t.sheet_no,(select SUM(length) from piping.dbo.piece_struc 
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
				
		return $this->piping->query($sql)->result_array();
		}
        public function get_all_export($where){
			$sql = "select (select count(*) FROM {$this->tblName} where {$where}) as total,* FROM {$this->tblName} where {$where} order by {$_GET['fieldS']} {$_GET['dir']}";
			$rowArr = $this->piping->query($sql)->result_array();
			return $rowArr;
        }
    	public function get_all_export2($where = ""){
			if ($where != "")
				$where = ("WHERE " . $where);
			
			$sql = "select TOP 100 t.supp_code,t.plant_no,t.area_no,t.area_sub,t.area_loc,t2.prior_no,t.drawing_no,t.sheet_no,t.rev_no,t.workable_pct,t2.piece_no,t2.piece_desc,t2.location,t2.elevation,t2.qty,t2.length,    
                    	   t2.weight,t2.um,t2.workable_pct,t2.received_dt,t2.issued_dt,t2.plan_delv_dt,t2.chip_fdn_dt,t2.packer_plate_dt,t2.assembly_dt,t2.erection_dt,t2.alignment_dt,t2.bolt_avail_dt	 
					FROM {$this->tblName} t
					inner join dbo.piece_struc t2
					on  t2.plant_no = t.plant_no
   					    AND t2.area_no = t.area_no
					    AND t2.area_loc = t.area_loc
					    AND t2.drawing_no = t.drawing_no
					    AND t2.sheet_no  = t.sheet_no
					    AND t2.rev_no = t.rev_no	
			 		";
			
			$rowArr = $this->piping->query($sql)->result_array();
				
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
		
		
		$rowArr = $this->piping->query($sql)->result_array();
		return $rowArr;
    }
        
        
        public function set_isoStruc(){			$postInfo = array();
			foreach ($_POST as $key => $value) {
				if ($key == "PROGRESS_RECID")
					continue;
				$postInfo[$key] = mysql_real_escape_string($value);
			}
			$postInfo['log_update'] = $_POST['log_user'] . " " . mdate("%Y-%m-%d");
			$postInfo['log_date'] = mdate("%Y-%m-%d %H:%i:%s");
            if ($_POST['PROGRESS_RECID'] == "0"){
				$query = $this->piping->set($postInfo);
				$query = $this->piping->insert($this->tblName);
			}else{
            	$query = $this->piping->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
            	$query = $this->piping->update($this->tblName, $postInfo);
			}
			
			return $query;
        }
		public function call_sp_isoPiece($file){
			$sql = "declare @result int = 0;";			
			$sql .= "exec @result = piping.dbo.uplisoPiece_struc @ip_filename =" ."'" .str_replace(".csv", "", $file). "'". ";";
			$sql .= "select @result as return_value;";
			return $this->piping->query($sql)->result_array();
		}
		public function remove_isoStruc(){
        	$query = $this->piping->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->piping->delete($this->tblName);
			return $query;
		}
    }
?>