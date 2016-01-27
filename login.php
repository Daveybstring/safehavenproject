<?php
include('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="Semantic/Semantic/dist/semantic.css" media="screen" />
        <link href="style.css" rel="stylesheet" title="Style" />
		<link rel="icon" type="default/images/png" href="images/cloudicon.jpe">
        <title>Login</title>
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"><img src="images/safehaven.jpe" alt="Members Area" /></a>
	    </div>
		<div id ="header">
<nav class="ui fluid five item red menu">
<a class="item" href="index.php"> <i
					class="home icon"></i> Home
				</a> <a class=" item" href="sign_up.php"> <i class="book icon"></i>
					Register
				</a> <a class="active red item" href="login.php"> <i class="play icon"></i>
					Log in
				</a>
				</nav>
				</div>
<?php





$key=sha1('Australia');
//encrypt
function encrypt($string, $key){
	$string =rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256,$key,$string,MCRYPT_MODE_ECB)));
	return $string;
}


//decrypt
function decrypt($string, $key){
	$string =rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256,$key,base64_decode($string),MCRYPT_MODE_ECB));
	return $string;
}









//If the user is logged, we log him out
if(isset($_SESSION['username']))
{
	//We log him out by deleting the username and userid sessions
	unset($_SESSION['username'], $_SESSION['userid']);
?>
<div class="message">You have successfuly been logged out.<br />

<?php
}
else
{
	$ousername = '';
	//We check if the form has been sent
	if(isset($_POST['username'], $_POST['password']))
	{
		//We remove slashes depending on the configuration
		if(get_magic_quotes_gpc())
		{
			$ousername = stripslashes($_POST['username']);
			$username = mysql_real_escape_string(stripslashes($_POST['username']));
			$password = stripslashes($_POST['password']);
		}
		else
		{

			$username = mysql_real_escape_string($_POST['username']);
			$password = $_POST['password'];
				//As you can see, we first hashed the password using double hashing algorithm (md5 and sha1) and created salt value.
				// After that, we combined real password with generated salt value and hashed it again with md5. 
				//The advantage is that this way alt value is random and it changes, making it nearly impossible to break. 
			
			$salt = sha1(md5($password));
			$password = md5($password.$salt);
			
		}
		//We get the password of the user
		$req = mysql_query('select password,id from users where username="'.$username.'"');
		$dn = mysql_fetch_array($req);
		//We compare the submited password and the real one, and we check if the user exists
		if($dn['password']==$password and mysql_num_rows($req)>0) 
		{
			//If the password is good, we dont show the form
			$form = false;
			//We save the user name in the session username and the user Id in the session userid
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['userid'] = $dn['id'];
?>
<div class="message">You have successfuly logged in. Click Enter to access your profile page<br />
</div>
<div id="footer">
			<div class="ui center aligned red segment">
				<a class="ui red button" href="index.php">Enter</a>
				</div>
	</div>
<?php
		}
		else
		{
			//Otherwise, we say the password is incorrect.
			$form = true;
			$message = 'The username or password is incorrect.';
		}
	}
	else
	{
		$form = true;
	}
	if($form)
	{
		//We display a message if necessary
	if(isset($message))
	{
		echo '<div class="message">'.$message.'</div>';
	}
	//We display the form
?>
<div id="Sectionreg">
			<div class="ui stacked black segment">
		<div class="ui black form">

    <form action="connexion.php" method="post">
        Enter your login info below<br />
      <div class="one field">
  	 <div class="field">
            <input type="text" autocomplete="off" name="username" placeholder="Username" value="<?php if(isset($_POST['username'])){echo htmlentities($_POST['username'], ENT_QUOTES, 'charset=iso-8859-1');} ?>" /><br />
	</div>
				 <div class="field">
					<input type="password" autocomplete="off" name="password" placeholder="Password" /><br />
				</div>
				 <div class="field">
            <div ><input type="submit" value="Log in"  class="ui submit button" /></div>
				</div>
    </form>
</div>
</div>
<?php
	}
}
?>
	
			
	</body>
</html>