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
				<a class="active red item" href="index.php"> <i
					class="home icon"></i> Home
				</a> <a class=" item" href="edit_infos.php"> <i class="book icon"></i>
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
			<div class="ui stacked inverted segment">
				<p>
 <details>
  <summary><h2><span title="Click here for more info"><u>Safe Haven</u></span></h2></summary>
  <p>This project is to develop a safe enviorment for kids to use devices</p>
  <p>This project focuses on making a secure website and safely storing user information.</p>
</details>
	<br>
	 <details>
  <summary><h3><span title="Click here for more info">Create a Secure Login & Registration Page</span></h3></summary>
  <p>I looked to make sure that each username and email is unique and no two members can register with these details.<br>
   I kept the error messages on the form very vague so as not to give people too much info about what the database contains.<br>
For each input parameter on the form I made sure to unclude protection to protect against sql injection which I will explain below.<br>
Both pages require users to enter in all data except for the avatar on the registration page.<br>
Both forms check whether passwords match up so for e.g when you register you have to enter two passwords and they have to be exactly the same within the form to be accepted.<br>
When a user trys to login the form will check the users information against the database and validate whether the users is an actual user else they will be declined and not get past the login page.<br>
</p>
</details>
 
<br>
 <details>
  <summary><h3><span title="Click here for more info">Form validation</span></h3></summary>
  <p>This simply ensures that all the required fields have been filled in within any form.</p>
</details>
<br>
 <details>
  <summary><h3><span title="Click here for more info">User Session validation for every page</span></h3></summary>
  <p>User Session validation is important!<br> I need to have this on every page because I want to limit the access to pages from non members of the website.<br> So to protect pages if a user session hasn't been set the person trying to access a certain page will be declined access.<br></p>
</details>
<br>
 <details>
  <summary><h3><span title="Click here for more info">Prevent sql injection</span></h3></summary>
  <p> All form inputs are protected against sql injection.<br> They use mysql real escape string to escape the single quotations which can be placed around statements which if entered into an input can be made to look like they were part of the original script.<br> The script may by accident execute these and return sensitive information from the database.<br> </p>
</details>
<br>
 <details>
  <summary><h3><span title="Click here for more info">Hash and salt passwords</span></h3></summary>
  <p>When a user registers and enters in what they wish there password to be we hash and salt the password. <br> For every user the salt is unique so the with the salt being unique to every user the salt will never be known.<br> We take the password and use it as a salt, we md5 the password string which is now a salt. <br> We then sha1 this entire string and add it to the original password and sha1 both of them together combining the password and the salt.<br></p>
</details>
<br>
 <details>
  <summary><h3><span title="Click here for more info">Protect index directory</span></h3></summary>
  <p>Originally the index directory wasn't protected so you could easily access the .php files of the website. <br> Dangerous considering if a person downloaded these they would be able to edit them and perhaps find out the key that we are using for encyrption.<br></p>
</details>
<br>
 <details>
  <summary><h3><span title="Click here for more info">Implement SSL encryption</span></h3></summary>
  <p>I made sure to install a TLS connection which ensures that traffic between the browser and server is ecnrypted.<br> This means that anyone using a packet sniffer like wireshark won't be able to spy on the actual info being sent or received. <br>It also doesn't help that I am encrypting the data being sent I'd imagine :) </p>
</details>
<br>
 <details>
  <summary><h3><span title="Click here for more info">Encrypt data within the database</span></h3></summary>
  <p>By using 2 functions which encrypt and decrypt data with the use of special key to encrypt and decrypt.<br> It encrypts all data sent to the database and stores it there encrypted which is really cool. When I want to display a user's profile I simply echo it out using the decrypt function and it decrypts everything. <br>The key is hashed using sha1 so can't be unhashed.<br> If a hacker breaks into my database they will never be able to decrypt the data without the key.<br> </p>
</details>

<br>
    </p>
				</p>
			</div>
		</div>			
<?php
}
?>

	</body>
</html>