<?php
function folder_exist($folder)
{
    // Get canonicalized absolute pathname
    $path = realpath($folder);

    // If it exist, check if it's a directory
    if($path !== false AND is_dir($path))
    {
        // Return canonicalized absolute pathname
        return $path;
    }

    // Path/folder does not exist
    return false;
}
	if(isset($_POST['submit']))
	{
		$user_reg = $_POST['username'];
		$pass_reg = $_POST['password'];
		$dis_reg = $_POST['display_name'];
		$email_reg = $_POST['email'];
if (folder_exist($user_reg)){
 die('User page already exists! <a href="index.html"><input type="submit" value="Return to the main page!"/></a>');
}
else
{
		mkdir($user_reg);
		$make_profile = fopen($user_reg . '/index.php', 'w');
		fwrite($make_profile, "<?php echo 'Welcome " . $user_reg . ", to your page :)'; ?> <html><head><title>" . $dis_reg . "'s profile page</title></head><body><p>Send An EMAIL To Me: " . $email_reg . "</p><br></br><img src='http://img00.deviantart.net/d755/i/2014/304/b/4/we_ve_waited_far_too_long_for_this__by_blixemi-d84r692.png'/><br></br><a href='edit/login.html'><input type='submit' value='Login to control panel'/></a></body></html>");
		fclose($make_profile);
		//TODO: Make edit panel for the user's page.
		mkdir($user_reg . '/edit');
		$make_editpage = fopen($user_reg . '/edit/editpage.php', 'w');
		fwrite($make_editpage, '<?php $username = "' . $user_reg . '"; $password = "' . $pass_reg .'"; $username_posted = $_POST[username]; $password_posted = $_POST[password]; if($username_posted == $username) { if($password_posted == $password) { echo "Welcome, " . $username . " to page panel"; } else { header("Location: ../index.php"); exit(); }}else{ header("Location: ../index.php"); exit();} ?><html><head><title>Page Admin Panel</title></head><body><form action="writepage.php" method="post"><textarea name="change" rows="4" cols="50"><?php $read_page = fopen("../index.php", r); while(!feof($read_page)) { echo fgets($read_page); } fclose($read_page);?></textarea><br></br><input type="submit" value="Change page"/></form></body></html>');
		fclose($make_editpage);
		$make_login = fopen($user_reg . '/edit/login.html', 'w');
		fwrite($make_login, '<!DOCTYPE html><html><head><title>Page Panel Login</title></head><body><form action="editpage.php" method="post"><input type="text" name="username" value="Type the username!"/><br></br><input type="password" name="password" value="Password"/><br></br><input type="submit" value="Login to page panel"/></form></body></html>');
		fclose($make_login);
		$writepage_system = fopen($user_reg . '/edit/writepage.php', 'w');
		fwrite($writepage_system, '<?php $result = $_POST[change]; echo $result; $changepage = fopen("../index.php", w); fwrite($changepage,"$result"); ?><html><head><title>Page changed successfully!</title></head><body><a href="../index.php">Return to the changed page</a></body></html>');
		fclose($writepage_system);
		
        $ip_address = $_SERVER["REMOTE_ADDR"];
        $ip_system = fopen($user_reg . '/ipaddress.txt', 'w'); //Used for tracking people's ip address so incase if they do spam and recreate profile pages then I can be able to deny their ip address through cpanel.
        fwrite($ip_system, 'Created by ' . $ip_address . ' OWNER NOTE: If you see duplicated accounts deleted them or suspend their page.');
        fclose($ip_system);
		
		echo 'Thank you, ' . $user_reg . ' for registering with us. <a href="' . $user_reg . '/index.php">Click</a> to visit your page and edit it by clicking (Login to page panel) button.';
}
	}
?>
<html>
 <head>
  <title>Create the profile!</title>
 </head>
 <body>
  <b>We might need your email incase if your profile page was compromised. We send out a backup to our site every 1 hour or day.</b>
  <form method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
   Username: <input type="text" name="username"/>
   <br></br>
   Password: <input type="password" name="password"/>
   <br></br>
   Display Name: <input type="text" name="display_name"/>
   <br></br>
   E-mail: <input type="text" name="email"/>
   <br></br>
   <input type="submit" name="submit" value="Register Profile Page!"/>
  </form>
 </body>
</html>	
