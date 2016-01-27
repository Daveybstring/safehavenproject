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
        <title>List of users</title>
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"><img src="images/safehaven.jpe" alt="Members Area" /></a>
		<?php
if(isset($_SESSION['username'])){echo ''.htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8');
//We display the links



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






?>
<div id="header">
<nav class="ui fluid five item red menu">
				<a class="item" href="index.php"> <i
					class="home icon"></i> Home
				</a> <a class=" item" href="edit_infos.php"> <i class="book icon"></i>
					Edit personal info
				</a>
				</a> <a class=" active red item" href="users.php"> <i class="bookmark icon"></i>
					Users
				</a>
				<a class=" item" href="connexion.php"> <i class="bookmark icon"></i>
					Logout
				</a>
			</nav>
			</div>
			
			<div id="Section1">
			<div class="ui stacked inverted segment">
				<p>
		
This page shows the users within our database and what a hacker can actually see.
<table>
<?php
//We get the IDs, usernames and emails of users
$req = mysql_query('select id,username,firstname from users');
while($dnn = mysql_fetch_array($req))
{
?>
<div class="ui inverted segment">
  <div class="ui inverted black basic button">
	<?php echo $dnn['id']; ?> 
	<?php echo $dnn['username']; ?>    
    <a href="profile.php?id=<?php echo $dnn['id']; ?>"><?php  echo '</h1>' .decrypt($dnn['firstname'],$key). '</h1>'; ?></a>
   </div>
   </div>
<?php
}
?>
</table>
</p>
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
<a class="active red item" href="index.php"> <i
					class="home icon"></i> Home
				</a> <a class=" active red item" href="sign_up.php"> <i class="book icon"></i>
					Sign up
				</a> <a class=" active red item" href="login.php"> <i class="play icon"></i>
					Log in
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
			</div>
	</body>
</html>