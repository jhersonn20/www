<?php
	// class Email extends CI_Controller {
	    // public function __construct(){
	        // parent::__construct();
	    // }
// 
		// public function index(){
			// $this->send();
	 		// // $this->load->view('webapps/email/index', '', false);
		// }
// 	    
	    // public function send(){
	 		// $msg = $this->load->view('webapps/email/index', '', true);
			// $config = array(
	            // "protocol" => "smtp",
				// "smtp_host" => "mail.arcc-eei.com",
				// "smtp_port" => 25,
				// "smtp_user" => "system@arcc-eei.com",
	    		// "mailtype" => "html",
				// "newline" => "\r\n"
			// );
// 	
	        // $this->load->library('email',$config);
// 
	        // $this->email->set_newline('\r\n');
	        // $this->email->from('system@arcc-eei.com','Billing and Collection System');
	        // $this->email->to('rcgomez@arcc-eei.com');
	        // $this->email->subject('Reminder');
	        // $this->email->message($msg);
// 
	        // if ($this->email->send())
	            // echo "Sent Successful.";
	        // else
	            // $this->email->print_debugger();
	    // }
	// }
	
	// require_once "Mail.php";
// 	 
	// $from = "System <system@arcc-eei.com>";
	// $to = "Romel C. Gomez <rcgomez@arcc-eei.com>";
	// $subject = "Hi!";
	// $body = "Hi,\n\nHow are you?";
// 	 
	// $host = "mail.arcc-eei.com";
 	// $port = "25";
	// $username = "system@arcc-eei.com";
	// $password = "";
// 	 
	// $headers = array ('From' => $from,
					  // 'To' => $to,
					  // 'Subject' => $subject);
	// $smtp = Mail::factory('smtp',
		// array ('host' => $host,
     		   // 'port' => $port,
			   // 'auth' => false,
			   // 'username' => $username,
			   // 'password' => $password));
// 	 
	// $mail = $smtp->send($to, $headers, $body);
// 	 
	// if (PEAR::isError($mail))
		// echo("<p>" . $mail->getMessage() . "</p>");
	// else
		// echo("<p>Message successfully sent!</p>");
	// Set up parameters
	$uid = strtoupper(md5(uniqid(time())));
	$from = "system@arcc-eei.com";
	$subject = "Your password";
	// $message = "<p>Hello Homer,</p>
	// <p>Thanks for registering.</p>
	// <p>Your password is: <b>springfield</b></p>
	// ";
	$conn = mysql_connect("localhost", "root", "mysql") or
		die("Error: " . mysql_error());
		
	mysql_select_db("projdb") or 
		die("Failed to select database. " . mysql_error());
		
	$result = mysql_query("call projdb.create_email_item()") or
		die("Failed in querying mysql. " . mysql_error());
		
	$jobArr = mysql_fetch_array($result,MYSQL_ASSOC);
		
	// $result2 = mysql_query("select * from billing_item") or
		// die("Failed in querying mysql. " . mysql_error());
	// var_dump($result);
	// return true;	
	mysql_close($conn);
	$conn = mysql_connect("localhost", "root", "mysql") or
		die("Error: " . mysql_error());
		
	mysql_select_db("projdb") or 
		die("Failed to select database. " . mysql_error());
		
	foreach ($jobArr as $key => $value) {
		$email = array();
		$status = array();
		$message = "";
		$to = "";
		$result2 = mysql_query("select * from billing_item t inner join sys_prog t2 on t2.job_no where job_no = '{$value}' order by billing_status") or
			die("Failed in querying mysql. " . mysql_error());
			
		while($row2 = mysql_fetch_array($result2,MYSQL_ASSOC)){
			if (!in_array($row2['billing_status'], $status)){
				array_push($status, $row2['billing_status']);
				$message = $row2['billing_status_desc'];
				// $to .= 
			}
		}	
	}
	// $total = $row['total'];
	// echo $total;
	return true;
	// if( $total >0 )	// $message = file_get_contents('http://localhost/email.php');
	// $to = "rcgomez@arcc-eei.com";
	$headers = "MIME-Version: 1.0" . "\n";
	// $headers .= "Content-Type: multipart/alternative; boundary=$uid\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\n";
	$headers .= "Content-Transfer-Encoding: 8bit;\n";
	$headers .= "From: $from" . "\n";
	// $headers .= "$uid\n";
		
	// Send email
	mail($to,$subject,$message,$headers);
	
	// Inform the user
	echo "Thanks for registering! We have just sent you an email with your password.";
?>