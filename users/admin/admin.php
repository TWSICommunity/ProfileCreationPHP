<?php
 function removedir($dirname)
    {
        if (is_dir($dirname))
        $dir_handle = opendir($dirname);
        if (!$dir_handle)
        return false;
        while($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($dirname."/".$file))
                unlink($dirname."/".$file);
                else
                {
                    $a=$dirname.'/'.$file;
                    removedir($a);
                }
            }
        }
        closedir($dir_handle);
        rmdir($dirname);
        return true;
    }
	if(isset($_POST['submit']))
	{
		$username_set = 'admin';
		$password_set = 'password';
		$username_post = $_POST['username'];
		$password_post = $_POST['password'];
		$userpage = $_POST['user'];
		$action = $_POST['command'];
		if ($username_post == $username_set) {
			if ($password_post == $password_set) {
				if ($action == 'suspend page') {
					mkdir('../../account_suspend/' . $userpage);
                                        mkdir('../../account_suspend/' . $userpage . '/edit');
					copy('../' . $userpage . '/index.php', '../../account_suspend/' . $userpage . '/index.php');
                                        copy('../' . $userpage . '/edit/login.html', '../../account_suspend/' . $userpage . '/edit/login.html');
                                        copy('../' . $userpage . '/edit/writepage.php', '../../account_suspend/' . $userpage . '/edit/writepage.php');
                                        copy('../' . $userpage . '/edit/editpage.php', '../../account_suspend/' . $userpage . '/edit/editpage.php');
					$suspend = fopen('../' . $userpage . '/index.php', 'w');
					fwrite($suspend, '<?php die("This page has been suspended by admin [Editing page and uploading is impossible!]. Click the back button..."); ?>');
					fclose($suspend);
                                        removedir('../' . $userpage . '/edit');
				}elseif($action == 'delete page') {
					removedir('../' . $userpage);
				}elseif($action == 'backup page') {
					mkdir('../../backup/' . $userpage);
					mkdir('../../backup/' . $userpage . '/edit');
					copy('../' . $userpage . '/index.php', '../../backup/' . $userpage . '/index.php');
					copy('../' . $userpage . '/edit/login.html', '../../backup/' . $userpage . '/edit/login.html');
					copy('../' . $userpage . '/edit/writepage.php', '../../backup/' . $userpage . '/edit/writepage.php');
					copy('../' . $userpage . '/edit/editpage.php', '../../backup/' . $userpage . '/edit/editpage.php');
				}elseif($action == 'clear uploads') {
					//Working on this command...
				}elseif($action == 'unsuspend page') {
					copy('../../account_suspend/' . $userpage . '/index.php', '../' . $userpage . '/index.php');
					copy('../../account_suspend/' . $userpage . '/edit/login.html', '../' . $userpage . '/edit/login.html');
					copy('../../account_suspend/' . $userpage . '/edit/writepage.php', '../' . $userpage . '/edit/writepage.php');
					copy('../../account_suspend/' . $userpage . '/edit/editpage.php', '../' . $userpage . '/edit/editpage.php');
				}elseif($action == 'clear pages') {
					//Working on this command...
				}elseif($action == 'create profile page') {
					//TODO: Put the same function as the createprofile.php to create a page by an admin.
				}elseif($action == 'edit page') {
					//TODO: Any admins can edit the page without a password!
				}elseif($action == 'restore page') {
					$make_profile = fopen('../' . $userpage . '/index.php', 'w');
					fwrite($make_profile, "<?php echo 'Welcome " . $userpage . ", to your page :)'; ?> <html><head><title>RESTORED BY ADMIN</title></head><body><p>Send An EMAIL To Me: Edit line with your email page.</p><br></br><img src='http://img00.deviantart.net/d755/i/2014/304/b/4/we_ve_waited_far_too_long_for_this__by_blixemi-d84r692.png'/><br></br><a href='edit/login.html'><input type'submit' value='Login to control panel'/></a></body></html>");
					fclose($make_profile);
				}
			}
			else
			{
				die("You do not have access to this site INVALID PASSWORD! <a href='../index.php'><input type='submit' value='Login and take action!'/></a>");
				exit;
			}
		}
		else
		{
			die("You do not have access to this site INVALID USERNAME! <a href='../index.php'><input type='submit' value='Login and take action!'/></a>");
			exit;
		}
	}
?>
<html>
 <head>
  <title>Admin Panel</title>
 </head>
 <body>
  <form method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
   Admin Username: <input type='text' name='username'/>
   <br></br>
   Admin Password: <input type='password' name='password'/>
   <br></br>
   User Target: <input type='text' name='user'/>
   <br></br>
   Command: <input type='text' name='command'/>
   <br></br>
   <input type='submit' name='submit' value='Login And Take Action!'/>
  </form>	
