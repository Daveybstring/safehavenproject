<?php
include('config.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" href="Semantic-UI-master/dist/semantic.css" media="screen" />
        <link href="style.css" rel="stylesheet" title="Style" />
		<link rel="icon" type="default/images/png" href="images/cloudicon.jpe">
        <title>Home</title>
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"><img src="images/safehaven.jpe" alt="Members Area" /></a>
	    
      
<?php
//We display a welcome message, if the user is logged, we display it username
?>
<?php if(isset($_SESSION['username'])) ?><br />

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
<nav class="ui fluid six item red menu">
				<a class=" item" href="index.php"> <i
					class="home icon"></i> Home
				</a> <a class=" item" href="edit_infos.php"> <i class="book icon"></i>
					Edit personal info
				</a> <a class=" item" href="createprofile.php"> <i class="add user icon"></i>
					Create Profiles
				</a><a class=" item" href="reports.php"> <i class="book icon"></i>
					Reports
				</a>
				<a class="active red item" href="download.php"> <i class="lock icon"></i>
					Download safehaven
				</a>
				<a class=" item" href="login.php"> <i class="bookmark icon"></i>
					Logout
				</a>
			</nav>
			</div>
				
<?php
//We get the IDs, usernames and emails of users display user profile
$req = mysql_query('select id, username, firstname,email,avatar from users where username ="'.$_SESSION['username'].'"');
while($dnn = mysql_fetch_array($req))
{
?>
					<div id="Section1">
			<div class="ui stacked inverted segment">

	<h1><b>Click to Download</b></h1>
	<a href="http://mcs1-f328.broker.sophos.com/agent/?id=4278fca6-f328-3292-a9cc-5e3e4911138b-F6MH5RH3DUBZ7&edx=slim">
  <img src="images/user.png">
</a>

</div>
		</div>
<?php
}
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