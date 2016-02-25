<?php
include('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="Semantic-UI-master/dist/semantic.css" media="screen" />
        <link href="style.css" rel="stylesheet" title="Style" />
		<link rel="icon" type="default/images/png" href="images/cloudicon.jpe">
        <title>Edit my personnal informations</title>
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"><img src="images/safehaven.jpe" alt="Members Area" /></a>
			<?php
if(isset($_SESSION['username'])){;
//We display the links
?>
<nav class="ui fluid five item red menu">
				<a class=" item" href="index.php"> <i
					class="home icon"></i> Home
				</a> <a class="active red item" href="edit_infos.php"> <i class="book icon"></i>
					Edit personal info
				</a> <a class=" item" href="createprofile.php"> <i class="add user icon"></i>
					Create Profiles
				</a><a class=" item" href="reports.php"> <i class="book icon"></i>
					Reports
				</a>
				<a class=" item" href="login.php"> <i class="bookmark icon"></i>
					Logout
				</a>
			</nav>
		<?php
}
?>
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





//We check if the user is logged
if(isset($_SESSION['username']))
	

{
	//We check if the form has been sent
	if(isset($_POST['username'], $_POST['password'], $_POST['passverif']))
	{
		//We remove slashes depending on the configuration
		if(get_magic_quotes_gpc())
		{
			$_POST['username'] = stripslashes($_POST['username']);
			$_POST['password'] = stripslashes($_POST['password']);
			$_POST['passverif'] = stripslashes($_POST['passverif']);
			
		}
		//We check if the two passwords are identical
		if($_POST['password']==$_POST['passverif'])
		{
			//We check if the password has 6 or more characters
			if(strlen($_POST['password'])>=6)
			{
					//We protect the variables
					
					
									

					
					
					$username = mysql_real_escape_string($_POST['username']);
					$password = mysql_real_escape_string($_POST['password']);

				//As you can see, we first hashed the password using double hashing algorithm (md5 and sha1) and created salt value.
				// After that, we combined real password with generated salt value and hashed it again with md5. 
				//The advantage is that this way alt value is random and it changes, making it nearly impossible to break. 
				
				$salt = sha1(md5($password));
				$password = md5($password.$salt);
					//We check if there is no other user using the same username
					$dn = mysql_fetch_array(mysql_query('select count(*) as nb from users where username="'.$username.'"'));
					//We check if the username changed and if it is available
					if($dn['nb']==0 or $_POST['username']==$_SESSION['username'])
					{
						//We edit the user informations
						if(mysql_query('update users set username="'.$username.'", password="'.$password.'", 
							quote="'.encrypt($quote,$key).'", about="'.encrypt($about,$key).'" where id="'.mysql_real_escape_string($_SESSION['userid']).'"'))
						{
							//We dont display the form
							$form = false;
							//We delete the old sessions so the user need to log again
							unset($_SESSION['username'], $_SESSION['userid']);
?>
<div class="message">Your informations have successfuly been updated. You need to log again.<br />
<a href="connexion.php">Log in</a></div>
<?php
						}
						else
						{
							//Otherwise, we say that an error occured
							$form = true;
							$message = 'An error occurred while updating your informations.';
						}
					}
					else
					{
						//Otherwise, we say the username is not available
						$form = true;
						$message = 'The username you want to use is not available, please choose another one.';
					}
				}
			else
			{
				//Otherwise, we say the password is too short
				$form = true;
				$message = 'Your password must contain at least 6 characters.';
			}
		}
		else
		{
			//Otherwise, we say the passwords are not identical
			$form = true;
			$message = 'The passwords you entered are not identical.';
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
			echo '<strong>'.$message.'</strong>';
		}
		//If the form has already been sent, we display the same values
		if(isset($_POST['username'],$_POST['password']))
		{
			$pseudo = htmlentities($_POST['username'], ENT_quoteS, 'UTF-8');
			if($_POST['password']==$_POST['passverif'])
			{
				$password = htmlentities($_POST['password'], ENT_quoteS, 'UTF-8');
			}
			else
			{
				$password = '';
			}
			
		}
		else
		{
			//otherwise, we display the values of the database
			$dnn = mysql_fetch_array(mysql_query('select username,password, from users where username="'.$_SESSION['username'].'"'));
			$username = htmlentities($dnn['username'], ENT_quoteS, 'UTF-8');
			$password = htmlentities($dnn['password'], ENT_quoteS, 'UTF-8');
			
		}
		//We display the form
?>

<div id="Sectionreg">
			<div class="ui stacked black segment">
		<div class="ui black form">
  <div class="one field">
  	 <div class="field">
    <form action="edit_infos.php" method="post">
        You can edit your user details:<br />
        <div class="center">
            <input type="text" placeholder="Username" name="username" id="username" value="<?php echo $username; ?>" /><br />
            <br /><input type="password" placeholder="Password" name="password" id="password" value="<?php echo $password; ?>" /><br />
            <br /><input type="password" placeholder="Verify Password" name="passverif" id="passverif" value="<?php echo $password; ?>" /><br />
            <br /><input type="submit" value="Send" class="ui submit button" />
        </div>
    </form>
</div>
</div>
</div>
<?php
	}
}
else
{
?>
<div id ="header">
<nav class="ui fluid five item red menu">
<a class="item" href="index.php"> <i
					class="home icon"></i> Home
				</a> <a class=" active red item" href="sign_up.php"> <i class="book icon"></i>
					Sign up
				</a> <a class="active red item" href="login.php"> <i class="play icon"></i>
					Log out
				</a>
				</nav>
				</div>
				
<?php
}
?>
		<div id="footer">
			<div class="ui center aligned red segment">
				<a class="ui red button" href="https://www.sup.tf/index.php">Home</a>
			</div>
		</div>
	</body>
</html>