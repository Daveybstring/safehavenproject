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
        <title>Profile of a user</title>
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"><img src="images/safehaven.jpe" alt="Members Area" /></a>
	    </div>
        <div class="content">
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










if(isset($_SESSION['username'])){echo ''.htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8');
//We display the links
?>
<div id="header">
<nav class="ui fluid five item red menu">
				<a class="active red item" href="index.php"> <i
					class="home icon"></i> Home
				</a> <a class=" item" href="edit_infos.php"> <i class="book icon"></i>
					Edit personal info
				</a> 
				</a> <a class=" item" href="users.php"> <i class="bookmark icon"></i>
					Users
				</a>
				<a class=" item" href="login.php"> <i class="bookmark icon"></i>
					Logout
				</a>
			</nav>
			</div>
<?php
//We check if the users ID is defined
if(isset($_GET['id']))
{
	$id = intval($_GET['id']);
	//We check if the user exists
	$dn = mysql_query('select username,firstname,password,email, avatar, signup_date from users where id="'.$id.'"');
	if(mysql_num_rows($dn)>0) 
	{
		$dnn = mysql_fetch_array($dn);
		//We display the user datas
?>

<div id="Section1">
			<div class="ui stacked inverted segment">
			
	<?php
//We add a link to send agent to user
if(isset($_SESSION['username']))
{
?>

<?php
}
	}
	else
	{
		echo 'This user dont exists.';
	}
}
else
{
	echo 'The user ID is not defined.';
}
?>
<div id ="leftdiv">
	<?php
if($dnn['avatar']!='')
{
	echo '<img src="'.htmlentities($dnn['avatar']).'" alt="Avatar" style="max-width:100px;max-height:100px;" />';
}
else
{
	echo '<img src="images/user.png" alt="Avatar" style="max-width:100px;max-height:100px;" />';
}
?>
</div>
<table style="width:500px;">
    	<td class="left">
    		<h2>Username:</h2><?php echo $dnn['username']; ?><br />
    		<h2>First Name:</h2><?php echo $dnn['firstname']; ?><br />
    		 <h2>Password:</h2><?php echo $dnn['password']; ?>
    	<h2>Email:</h2><?php echo $dnn['email']; ?><br />
		  <h2>Quote:</h2><?php echo $dnn['quote']; ?><br/>
	<br/>
    <h2>About:</h2> <?php echo $dnn['about']; ?><br/>
	<br/>
       <h2>This user joined the website on </h2><?php echo date('Y/m/d',$dnn['signup_date']); ?>
		<br/>
		</td>
		<tr>
		    </tr>
</table>
</div>
		</div>
		
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
					Sign up
				</a> <a class=" active red item" href="connexion.php"> <i class="play icon"></i>
					Log in
				</a>
				</nav>
				</div>
				
				<?php
}
?>

<div id="footer">
			<div class="ui center aligned red segment">
				<a class="ui red button">Home</a>
			</div>
		</div>
	</body>
</html>