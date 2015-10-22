<?php
	/**
	 * 
	 */
	class MY_Email extends CI_Email {
		private $msgHeader = "You may now log-in to the <a href='http://www.arcc-eei.com/codeIgniter/index.php/portal/' style='text-decoration: none;color: #0f73a9;'> ARCC Portal </a> using the information below:";
		private $msgFooter = "If you're not expecting any files from ARCC, kindly ignore this email. <br />Please do not reply to this mail as it is automated and cannot be responded to. This email was sent by: Management Group of Al Rushaid Construction Company, Limited.";
		private $msgFooter2 = "Please do not reply to this mail as it is automated and cannot be responded to. This email was sent by: Management Group of Al Rushaid Construction Company, Limited.";
		private $body = "";		
		private $from_locl = "system@arcc-eei.com";
		private $to_locl = "";
		private $cc_locl = "";
		private $bcc_locl = "";

	    public function __construct() {
	        parent::__construct();
	    }
		
		function init($fn = '', $from = '', $to, $cc = "", $bcc = "", $params = array()) {
			if ($from == "")
				$from = $this->from_locl;
			$this->to_locl = $to;			$this->cc_locl = $cc;			$this->bcc_locl = $bcc;
			$pieces = explode("_", $fn);
			if (count($pieces) == 1)
				return $this->$fn();
			else
				return $this->$fn($params);
		}

		private function login_credential($params = array()){
			$this->subject("ARCC Portal: Login Credential");
			$this->message($this->build_message('lc', $params));
			$this->set_mailtype("html");			
			return $this->before_sending('Login Credential');
				
			// echo $this->print_debugger();
		}

		private function upload(){
			$this->msgHeader = "File has been uploaded in ARCC Portal dedicated exclusively for your good company. Here is the <a href='http://www.arcc-eei.com/codeIgniter/index.php/portal/' style='text-decoration: none;color: #0f73a9;'> link </a> that will directed you to the login page of the portal.";
			$this->subject("ARCC Portal: File Uploaded");
			$this->message($this->build_message('upload'));		
			return $this->before_sending('ARCC File Uploaded');
		}

		private function upload_by_client($params = array()){
			$this->msgHeader = "File has been uploaded by {$params['client_name']}. Below is the details of the said file upload:";
			$this->msgFooter = $this->msgFooter2;
			$this->subject("ARCC Portal: File Uploaded");
			$this->message($this->build_message('upload_by_client',$params));
			return $this->before_sending('Client File Uploaded');
		}

		private function download(){
			$this->msgHeader = "Your file has been downloaded for its specific transaction. Thank you for cooperating with us!";
			$this->subject("ARCC Portal: File Review");
			$this->message($this->build_message('download'));
			return $this->before_sending('ARCC File Download');
		}

		private function download_by_client($params = array()){
			$this->msgHeader = "File has been downloaded by {$params['client_name']}. Below is the details of the said file:";
			$this->msgFooter = $this->msgFooter2;
			$this->subject("ARCC Portal: File Review");
			$this->message($this->build_message('download_by_client',$params));
			return $this->before_sending('Client File Download');
		}
		
		private function build_message($type = '', $params = array()){
			$this->body = "<!DOCTYPE html><html>";
			$this->body .= "<head><style>body {font-family: 'Lucida Sans Unicode,Lucida Grande,Sans-Serif';font-size: '12px';} ul{list-style-type: none;font-weight: bold;} li{display: list-item;text-align: -webkit-match-parent;} label{width: 17%;text-align: right;margin-right: 5px;line-height: 2.2;display: inline-block;}</style></head>";
			$this->body .= "<body>Dear Sir,<p style='text-indent: 30pt;'>As-Salaamu 'Alaykum!</p><p style='text-indent: 30pt;'>\n{$this->msgHeader}</p>";
			switch ($type) {
				case 'lc':
					$this->body .= "<ul>";
					$this->body .= "<li> <label>User ID:</label> {$params['user_id']} </li>";
					$this->body .= "<li> <label>Password:</label> {$params['pword']} </li>";
					$this->body .= "<li> <label>Expiration:</label> " . date_format(new DateTime($params['expiry']), 'g:ia \o\n l jS F Y') . " </li>";
					$this->body .= "</ul>";
					break;
				case 'upload_by_client':
					$this->body .= "<ul>";
					$this->body .= "<li> <label>Uploader:</label> {$params['user_name']} </li>";
					foreach ($params['name_array'] as $key => $value) {
						if ($key == 0)
							$this->body .= "<li> <label>Filename/s:</label> {$value} </li>";
						else						
							$this->body .= "<li> <label>:</label> {$value} </li>";						
					}
					foreach ($params['remarks_array'] as $key => $value) {
						if ($key == 0)
							$this->body .= "<li> <label>Remark/s:</label> {$value} </li>";
						else						
							$this->body .= "<li> <label>:</label> {$value} </li>";						
					}
					$this->body .= "</ul>";
					break;
				case 'download_by_client':
					$this->body .= "<ul>";
					$this->body .= "<li> <label>Downloader:</label> {$params['user_name']} </li>";
					foreach ($params['name_array'] as $key => $value) {
						if ($key == 0)
							$this->body .= "<li> <label>Filename/s:</label> {$value} </li>";
						else						
							$this->body .= "<li> <label>:</label> {$value} </li>";						
					}
					foreach ($params['remarks_array'] as $key => $value) {
						if ($key == 0)
							$this->body .= "<li> <label>Remark/s:</label> {$value} </li>";
						else						
							$this->body .= "<li> <label>:</label> {$value} </li>";						
					}
					$this->body .= "</ul>";
					break;
				default:					
					break;
			}
			$this->body .= "<font style='font-size: 10px;font-style: italic;'><p style='text-align: center;'>{$this->msgFooter}</p></font>";
			$this->body .= "</body></html>";
			return $this->body;
		}
		
		private function before_sending($type_of_email){
			$this->from($this->from_locl, 'ARCC Administrator');
			$this->to($this->to_locl); 
			$this->cc($this->cc_locl); 
			$this->bcc($this->bcc_locl);
			if ($this->send()){
				$filepath = 'e:\portal\logs.txt';
				$string = '';
				$log = "Email Type: " . $type_of_email . " Recipients: (To) " . $this->to_locl . " (CC) " . $this->cc_locl . " (BCC) " . $this->bcc_locl . " " . mdate("%Y-%m-%d %H:%i:%s") . PHP_EOL;
				if (file_exists($filepath))
					$string = read_file($filepath);
				$string .= $log;
				
				if (!write_file($filepath, $string))
				     return 'Unable to write the file';		
				return true;		
			}			
		}
	}
?>