<?php
	class CI_Email  {
		private $from = "system@arcc-eei.com";
		protected $to = "";
		protected $cc = "";
		protected $subject = "";
		protected $message = "";
		protected $host = "localhost";
		protected $user = "root";
		protected $pass = "mysql";
		protected $db = "portal";
		protected $headers = "";
		protected $msgHeader = "You may now log-in to the ARCC Portal using the information below:";
		protected $msgFooter = "Please do not reply to this mail as it is automated and cannot be responded to. This email was sent by the Management Group of Al Rushaid Construction Company, Limited. <br /> If you're not expecting any files from ARCC, kindly ignore this email.";
		protected $msgFooter2 = "Please do not reply to this mail as it is automated and cannot be responded to. This email was sent by the Management Group of Al Rushaid Construction Company, Limited.";
		protected $conn = "";
		protected $td_style = "";
		protected $th_style = "";
		protected $group_style = "";
		protected $col_title = array('Job #', 'Type of Notice');
		protected $body = "";
		
		public function index($fn = "", $param1 = ""){
			echo $fn . " " . $param1;
			// $this->$fn($param1);
		}
		
		protected function open_conn(){
			$this->conn = mysql_connect($this->host, $this->user, $this->pass) or
				die("Could not connect to mysql. " . mysql_error());
								
			mysql_select_db($this->db) or
				die("Could not select the database. " . mysql_error());
		}
		
		private function process(){
			$this->open_conn();				
			$result = mysql_query("call projdb.create_email_item();") or
				die("Could not query mysql. " . mysql_error());				
			$this->close_conn();			
			$this->open_conn();				
			$result = mysql_query("SELECT * FROM projdb.email_item;") or
				die("Could not query mysql. " . mysql_error());
				
			$email_item = array();
			while($rows = mysql_fetch_array($result,MYSQL_ASSOC)){
				array_push($email_item, $rows);
			}
			$this->close_conn();
			$this->set_style();
			$titleAll = array();
			$detailAll = array();
			$counter = 0;
			$rand = 0;
			while ($counter < sizeof($email_item)) { //record of email_item table
				$row = $email_item[$counter];
				$title = array();
				$invoice = array();
				$detail2 = array();
				$item = explode(";", $row['message']);
				foreach($item as $key => $value){ 														//first division of a record from email_item table using semi-colon as delimiter 
					$detail = explode("***",$value);

					foreach($detail as $key2 => $value2){ 												//second division of a record from the first division of email_item table now using 3 asterisk 
						if ($key2 == 0){ 																//left part of the second division rendering the type of notice being show
							if (!in_array(($row['u_type'] . " - " . $value2), $title))  				//filtering possible redundancy in external variable 'title' array for grid generation
								array_push($title, ($row['u_type'] . " - " . $value2));
						}else { 																		//right part of the second division which is the details of the notice
							$detail2 = explode(", ", $value2); 											//turning string to array for easy access when showing on grid
							array_push($detail2,(sizeof($title) - 1)); 									//additional item on detail2 array that will be equal to the index of an item in title array
							$invoice[$rand] = $detail2; 												//placed to an external variable 'invoice' array for grid generation
							$rand++; 																	//incremental variable use as the index of the invoice array
						}
					}
				}				if (!$this->to($row['u_type'])){ 														//verify if u_type = job_no is now available on "programmer's code" for email forwarding
					$counter++;
					continue; 																			//skip or read next record if nothing found
				}
				$job_td = "";
				$type_td = "";
				$body = "";
				$this->subject("Reminder"); 															//sets the subject of the email
				$i = 0;
				foreach ($title as $key => $value) {
					$firstTwo = explode(" - ", $value);													//depicts the first two(2) column of the grid

					if (strpos($value, "5 Days and below before cut-off") === false)					//exclusion of "5 Days and below before cut-off" notice in the email for management group
						$titleAll[$row['u_type'] . $key] = $value;										//title array for management group
					foreach ($invoice as $key2 => $value2) {											//generation of the succeeding columns on the grid after the firstTwo variable 
						if ($value2[sizeof($value2) - 1] == $key){										//verify if the index key of 'title' array is equal to the last item on 'invoice' array
							$this->build_row($body, $i, $firstTwo, $key2, $value2, $job_td, $type_td);  //dynamic creation of the row on the grid
							$invoice[$key2][sizeof($value2) - 1] = $row['u_type'] . $key;			    //modified unique key that will be use to connect to title array
						}
					}
				}
				$detailAll = array_merge($detailAll, $invoice); 										//summary of all details being sent on every project for management group
				// $this->message($body);																	//sets the body of the email
				$this->send();																			//send the email				$counter++;
			}
			/**********Management Email**********/
			$this->to("all");
			$job_td = "";
			$type_td = "";
			$body = "";
			$this->subject("Notice");
			$i = 0;
			foreach ($titleAll as $key => $value) {
				$firstTwo = explode(" - ", $value);
				foreach ($detailAll as $key2 => $value2) {
					if ($value2[sizeof($value2) - 1] == $key)
						$this->build_row($body, $i, $firstTwo, $key2, $value2, $job_td, $type_td);
				}
			}
			// $this->message($body);
			$this->send();
		}

		protected function login_credential($user_id = ''){
			$this->to($user_id);
			$this->subject("ARCC Portal: Login Credential");
			$this->message('lc');
			$this->send();
		}

		protected function upload($user_ids = ''){
			$this->msgHeader = "File has been uploaded in ARCC Portal dedicated exclusively for your good company. Here is the <a href='http://localhost/codeIgniter/index.php/portal/' style='text-decoration: none;color: #0f73a9;'> link </a> that will directed you to the login page of the portal.";
			$this->to($user_ids);
			$this->subject("ARCC Portal: File Uploaded");
			$this->message('upload');
			$this->send();
		}

		protected function upload_by_client($client = ''){
			$this->msgHeader = "File has been uploaded by {$client}. Below is the details of the said file upload:";
			$this->msgFooter = $this->msgFooter2;
			$this->to('arcc');
			$this->subject("ARCC Portal: File Uploaded");
			$this->message('upload_by_client');
			$this->send();
		}

		protected function download($user_ids = ''){
			$this->msgHeader = "Your file has been downloaded for its specific transaction. Thank you for cooperating with us!";
			$this->to($user_ids);
			$this->subject("ARCC Portal: File Review");
			$this->message('download');
			$this->send();
		}

		protected function download_by_client($client = ''){
			$this->msgHeader = "File has been downloaded by {$client}. Below is the details of the said file:";
			$this->msgFooter = $this->msgFooter2;
			$this->to('arcc');
			$this->subject("ARCC Portal: File Review");
			$this->message('download_by_client');
			$this->send();
		}
		
		protected function close_conn(){
			mysql_close($this->conn);
		}
		
		protected function to($ids = ''){
			$this->open_conn();
			$result = mysql_query("select email_add from portal.ruser where find_in_set(id,'{$ids}') > 0") or
				die("Could not query mysql. " . mysql_error());
			$row = mysql_fetch_array($result,MYSQL_NUM);
			$row = !is_array($row) ? array() : $row;
			$this->close_conn();			
			if (empty($row))
				return false;
				
			$row = array_filter($row);
			$this->to = $row[0];
			// array_shift($row);
			// $this->cc = implode(", ", $row);
			return true;		}
		
		protected function subject($subject){
			$this->subject = $subject;
		}
		
		protected function message($type = ''){
			$this->body = "<font style='font-family: Lucida Sans Unicode,Lucida Grande,Sans-Serif;font-size: 12px;'>Dear Sir,<p style='text-indent: 30pt;'>As-Salaamu 'Alaykum!</p><p style='text-indent: 30pt;'>\n{$this->msgHeader}</p></font>";
			switch ($type) {
				case 'lc':
					$this->body .= "<ul style='list-style-type: none;font-family: Lucida Sans Unicode,Lucida Grande,Sans-Serif;font-size: 12px;font-weight: bold;'>";
					$this->body .= "<li style='display: list-item;text-align: -webkit-match-parent;'> <label style='width: 10%;text-align: right;margin-right: 5px;line-height: 2.2;display: inline-block;'>User ID:</label> RCGomez </li>";
					$this->body .= "<li style='display: list-item;text-align: -webkit-match-parent;'> <label style='width: 10%;text-align: right;margin-right: 5px;line-height: 2.2;display: inline-block;'>Password:</label> RCG1234 </li>";
					$this->body .= "</ul>";
					break;
				case 'upload_by_client':
					$this->body .= "<ul style='list-style-type: none;font-family: Lucida Sans Unicode,Lucida Grande,Sans-Serif;font-size: 12px;font-weight: bold;'>";
					$this->body .= "<li style='display: list-item;text-align: -webkit-match-parent;'> <label style='width: 10%;text-align: right;margin-right: 5px;line-height: 2.2;display: inline-block;'>Uploader:</label> RCGomez </li>";
					$this->body .= "<li style='display: list-item;text-align: -webkit-match-parent;'> <label style='width: 10%;text-align: right;margin-right: 5px;line-height: 2.2;display: inline-block;'>Filename:</label> Invitation for Bidding </li>";
					$this->body .= "<li style='display: list-item;text-align: -webkit-match-parent;'> <label style='width: 10%;text-align: right;margin-right: 5px;line-height: 2.2;display: inline-block;'>Remarks:</label> This is an invitation for a possible project. </li>";
					$this->body .= "</ul>";
					break;
				case 'download_by_client':
					$this->body .= "<ul style='list-style-type: none;font-family: Lucida Sans Unicode,Lucida Grande,Sans-Serif;font-size: 12px;font-weight: bold;'>";
					$this->body .= "<li style='display: list-item;text-align: -webkit-match-parent;'> <label style='width: 10%;text-align: right;margin-right: 5px;line-height: 2.2;display: inline-block;'>Uploader:</label> RCGomez </li>";
					$this->body .= "<li style='display: list-item;text-align: -webkit-match-parent;'> <label style='width: 10%;text-align: right;margin-right: 5px;line-height: 2.2;display: inline-block;'>Filename:</label> Invitation for Bidding </li>";
					$this->body .= "<li style='display: list-item;text-align: -webkit-match-parent;'> <label style='width: 10%;text-align: right;margin-right: 5px;line-height: 2.2;display: inline-block;'>Remarks:</label> This is an invitation for a possible project. </li>";
					$this->body .= "</ul>";
					break;
				default:					
					break;
			}
			$this->body .= "<font style='font-family: Lucida Sans Unicode,Lucida Grande,Sans-Serif;font-size: 10px;font-style: italic;'><p style='text-align: center;'>{$this->msgFooter}</p></font>";			
			$this->message = $this->body;
		}
		
		protected function set_style(){
			$this->td_style = "border-bottom: 1px solid rgb(255, 255, 255); color: rgb(102, 102, 153); border-top: 1px solid transparent; padding: 8px;";
			$this->th_style = "font-weight: normal; font-size: 14px; border-bottom: 2px solid rgb(102, 120, 177); border-right: 10px solid rgb(255, 255, 255); border-left: 10px solid rgb(255, 255, 255); color: rgb(0, 51, 153); padding: 8px 2px;";
			$this->group_style = "font-size: 100%;margin: 0pt; padding: 0pt; outline: 0pt none; border: 0pt none; background: none repeat scroll 0% 0% transparent; vertical-align: baseline;";
		}
		
		protected function send(){
			$this->headers = "MIME-Version: 1.0\n";
			$this->headers .= "Content-type:text/html;charset=iso-8859-1\n";
			$this->headers .= "Content-Transfer-Encoding: 8bit;\n";
			$this->headers .= "To: {$this->to}\n";
			$this->headers .= "From: {$this->from}\n";
			if ($this->cc != "")
				$this->headers .= "CC: {$this->cc}\n";
							
			// mail($this->to, $this->subject, $this->message, $this->headers);
			echo $this->message;
		}
	}

	// $email = new Email('login_credential');
?>