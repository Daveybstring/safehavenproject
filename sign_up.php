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
        <title>Register</title>
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"><img src="images/safehaven.jpe" alt="Members Area" /></a>
	    </div>
		
		<div id ="header">
<nav class="ui fluid five item red menu">
<a class="item" href="index.php"> <i
					class="home icon"></i> Home
				</a> <a class="active red item" href="sign_up.php"> <i class="book icon"></i>
					Register
				</a> <a class=" item" href="connexion.php"> <i class="play icon"></i>
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





//We check if the form has been sent
if(isset($_POST['username'], $_POST['firstname'], $_POST['password'], $_POST['passverif'], $_POST['email'], $_POST['avatar']) and $_POST['username']!='')
{
	
	//We remove slashes depending on the configuration
	if(get_magic_quotes_gpc())
	{
		$_POST['username'] = stripslashes($_POST['username']);
		$_POST['firstname'] = stripslashes($_POST['firstname']);
		$_POST['password'] = stripslashes($_POST['password']);
		$_POST['passverif'] = stripslashes($_POST['passverif']);
		$_POST['email'] = stripslashes($_POST['email']);
		$_POST['avatar'] = stripslashes($_POST['avatar']);
	}
	//We check if the two passwords are identical
	if($_POST['password']==$_POST['passverif'])
	{
		//We check if the password has 6 or more characters
		if(strlen($_POST['password'])>=6)
		{
			//We check if the email form is valid
			if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$_POST['email']))
			{
				//We protect the variables
				
				$username = mysql_real_escape_string($_POST['username']);
				$firstname = mysql_real_escape_string($_POST['firstname']);
				$password = mysql_real_escape_string($_POST['password']);

				//As you can see, we first hashed the password using double hashing algorithm (md5 and sha1) and created salt value.
				// After that, we combined real password with generated salt value and hashed it again with md5. 
				//The advantage is that this way alt value is random and it changes, making it nearly impossible to break. 
				//I mean, if you can wait for a million years and have a super computer on your hands, try to break it.
				$salt = sha1(md5($password));
				$password = md5($password.$salt);
				$email = mysql_real_escape_string($_POST['email']);
				$avatar = mysql_real_escape_string($_POST['avatar']);
				//We check if there is no other user using the same username
				$dn = mysql_num_rows(mysql_query('select id from users where username="'.$username.'"'));
				if($dn==0)
				{
					$dn1 = mysql_num_rows(mysql_query('select email from users where email ="'.encrypt($email,$key).'"'));
					if($dn1==0)
					{
					//We count the number of users to give an ID to this one
					$dn2 = mysql_num_rows(mysql_query('select id from users'));
					$id = $dn2+1;

					//We save the informations to the databse
					if(mysql_query('insert into users(id, username, firstname, password, email, avatar, signup_date) values 
						('.$id.',"'.$username.'","'.encrypt($firstname,$key).'","'.$password.'", "'.encrypt($email,$key).'", "'.$avatar.'", "'.time().'")'))
					{
						//We dont display the form
						$form = false;
?>
<div class="message">You have successfuly been signed up. You can log in.<br />
<a href="login.php">Log in</a></div>
<?php
					}
					else
					{
						//Otherwise, we say that an error occured
						$form = true;
						$message = 'An error occurred while signing up.';
					}
					}
				else
				{
					//Otherwise, we say the username is not available
					$form = true;
					$message = 'The username or email you want to use is not available, please choose another one.';
				}
				}
				else
				{
					//Otherwise, we say the username is not available
					$form = true;
					$message = 'The username/email you want to use is not available, please choose another one.';
				}
			}
			else
			{
				//Otherwise, we say the email is not valid 
				$form = true;
				$message = 'The email you entered is not valid.';
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
		echo '<div class="message">'.$message.'</div>';
	}
	//We display the form
?>
<div id="Sectionreg">
			<div class="ui stacked black segment">
		<div class="ui black form">
			<form action="sign_up.php" method="post" >
        Please fill in the information below:<br />
  <div class="one field">
  	 <div class="field">
            <input type="text" name="username" placeholder="Username" value="<?php if(isset($_POST['username'])){echo htmlentities($_POST['username'], ENT_QUOTES, 'charset=iso-8859-1');} ?>" /><br />
			  </div>
				 <div class="field">
            <input type="text" name="firstname" placeholder="Firstname" value="<?php if(isset($_POST['firstname'])){echo htmlentities($_POST['firstname'], ENT_QUOTES, 'charset=iso-8859-1');} ?>" /><br />
			</div>
			 <div class="field">
            <input type="password" name="password" placeholder="Password" /><br />
			</div>
				 <div class="field">
            <input type="password" name="passverif" placeholder="Verify Password"/><br />
			</div>
			 <div class="field">
            <input type="text" name="email" placeholder="Email" value="<?php if(isset($_POST['email'])){echo htmlentities($_POST['email'], ENT_QUOTES, 'charset=iso-8859-1');} ?>" /><br />
			</div>
				 <div class="field">
            <input type="text" name="avatar" placeholder="avatar" value="<?php if(isset($_POST['avatar'])){echo htmlentities($_POST['avatar'], ENT_QUOTES, 'UTF-8');} ?>" /><br />
			</div>
				 <div class="field">
          <div ><input type="submit" value="Sign up" class="ui submit button" /></div>
   
			</div>
			 </form>
  
</div>
</div>



<?php
}
?>
		
	</body>
</html>