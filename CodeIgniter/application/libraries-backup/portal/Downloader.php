<?php
	class Downloader {
	     private $file_path;
	     private $downloadRate;
	     private $file_pointer;
	     private $error_message;
	     private $_tickRate = 4; // Ticks per second.
	     private $_oldMaxExecTime; // saving the old value.
		 private $fileinfo;
	     function __construct() {
	        $this->_tickRate = 4;
	        $this->downloadRate = 1024; // in Kb/s (default: 1Mb/s)
	        $this->file_pointer = 0; // position of current download.
	     }
		 public function index($file_to_download = null){
	        try {
	        	$this->setFile($file_to_download);	        	
	        }
			catch (exception $e){
	           throw new Exception($e->getMessage());
			}
		 }  
	     public function setFile($file) {
	        if (file_exists($file) && is_file($file))
	           $this->file_path = $file;
	        else {
	           $file = explode("/", $file);
	           throw new Exception("Error finding file {$file[4]}.");
			}
	     }
	     public function setRate($kbRate) {
	        $this->downloadRate = $kbRate;
	     }
	     private function sendHeaders() {
	        if (!headers_sent($filename, $linenum)) {
	           // header("Content-Type: application/octet-stream");
	           header("Content-Control: Private");
	           header("Content-Type: " . $this->fileinfo);
	           header("Content-Description: file transfer");
	           header('Content-Disposition: attachment; filename="' . $this->file_path . '"');
	           header('Content-Length: '. filesize($this->file_path));
	        } else {
	           throw new Exception("Headers have already been sent. File: {$filename} Line: {$linenum}");
	        }
	     }
	     public function download() {
	        if (!$this->file_path) {
	           $file = explode("/", $this->file_path);
	           throw new Exception("Error finding file {$file[4]}.");
	        }else {
				$finfo = finfo_open(); 
				$this->fileinfo = finfo_file($finfo, $this->file_path, FILEINFO_MIME);
				finfo_close($finfo);
				try{
	        		$this->sendHeaders();					
				}
				catch(exception $e){
	           		throw new Exception($e->getMessage());
				}
	        }
	        flush();    
	        $this->_oldMaxExecTime = ini_get('max_execution_time');
	        ini_set('max_execution_time', 0);
	        $file = fopen($this->file_path, "r");     
	        while(!feof($file)) {
	           print fread($file, ((($this->downloadRate*1024)*1024)/$this->_tickRate));    
	           flush();
	           usleep((1000/$this->_tickRate)); 
	        }    
	        fclose($file);
	        ini_set('max_execution_time', $this->_oldMaxExecTime);
	        return true; // file downloaded.
	     }
	}
?>