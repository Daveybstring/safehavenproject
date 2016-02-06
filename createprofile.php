<?php
include('config.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" href="Semantic-UI-master/dist/semantic.css" media="screen" />
        <link href="style.css" rel="stylesheet" title="Style" />
		<link rel="icon" type="default/images/png" href="images/cloudicon.jpe">
		<script type="text/javascript" src="Semantic-UI-master/dist/semantic.min.js"></script>
		<script type="text/javascript" src="main.js"></script>
		
		
        <title>profile</title>
		
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"><img src="images/safehaven.jpe" alt="Members Area" /></a>
	    
     
<?php
$key=sha1('Australia');

//decrypt
function decrypt($string, $key){
	$string =rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256,$key,base64_decode($string),MCRYPT_MODE_ECB));
	return $string;
}




//If the user is logged, we display links to edit his infos, to see his pms and to log out
if(isset($_SESSION['username']))
{
//We count the number of new messages the user has

?>
</div>

<div id="header">
<nav class="ui fluid five item red menu">
				<a class=" item" href="index.php"> <i
					class="home icon"></i> Home
				</a> <a class=" item" href="edit_infos.php"> <i class="book icon"></i>
					Edit personal info
				</a> <a class="active red item" href="createprofile.php"> <i class="add user icon"></i>
					Create Profiles
				</a><a class=" item" href="reports.php"> <i class="book icon"></i>
					Reports
				</a>
				<a class=" item" href="login.php"> <i class="bookmark icon"></i>
					Logout
				</a>
			</nav>
			</div>
				
<?php

	
?>

<?php
}
else
{
//Otherwise, we display a link to log in and to Sign up
?>
<div id ="header">
<nav class="ui fluid five item red menu">
<a class="item" href="index.php"> <i
					class="home icon"></i> Home
				</a> <a class=" active red item" href="sign_up.php"> <i class="book icon"></i>
					Register
				</a> <a class=" active red item" href="connexion.php"> <i class="play icon"></i>
					Log in
				</a>
				</nav>
				</div>
				
<?php
}
?>


	</body>
</html>