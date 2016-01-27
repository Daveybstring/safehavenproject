<?php
include('config.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" href="Semantic/Semantic/dist/semantic.css" media="screen" />
        <link href="style.css" rel="stylesheet" title="Style" />
		<link rel="icon" type="default/images/png" href="images/cloudicon.jpe">
        <title>profile</title>
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"><img src="images/safehaven.jpe" alt="Members Area" /></a>
	    
      
<?php
//We display a welcome message, if the user is logged, we display it username
?>
<?php if(isset($_SESSION['username'])){echo ' '.htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8');} ?>,<br />

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
//We get the IDs, usernames and emails of users display user profile
$req = mysql_query('select id, username, firstname,email,avatar,quote,about from users where username ="'.$_SESSION['username'].'"');
while($dnn = mysql_fetch_array($req))
{
?>
					<div id="Section1">
			<div class="ui stacked inverted segment">

	<h1><b><?php echo htmlentities($dnn['username']); ?></b></h1>

<table style="width:500px;">
	<tr>
    	<td><?php
if($dnn['avatar']!='')
{
	echo '<img src="'.htmlentities($dnn['avatar']).'" alt="Avatar" style="max-width:100px;max-height:100px;" />';
}
else
{
	echo '<img src="images/user.png" alt="Avatar" style="max-width:100px;max-height:100px;" />';
}
?></td>


    	<td class="left"><h1><?php echo htmlentities($dnn['username'], ENT_quoteS, 'UTF-8')?></h1>
    		<h2>FirstName:</h2><?php echo '<h1>' .decrypt($dnn['firstname'],$key).'</h1>';?>
    	<h2>Email:</h2><?php echo '</h1>' .decrypt($dnn['email'],$key). '</h1>'; ?><br />
		  <h2>Quote:</h2><?php echo '</h1>' .decrypt($dnn['quote'],$key). '</h1>'; ?>
	<br/>
    <h2>About:</h2> <?php echo '</h1>' .decrypt($dnn['about'],$key). '</h1>'; ?><br/>
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
				
				<div id="Section1">
			
		</div>			
<?php
}
?>

	</body>
</html>