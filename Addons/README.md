How to install the addons?

1. Visit http://localhost/users/yourusernamehere
2. Login to your page panel located below your page where a button is located.
3. Once logged in. Copy the code and paste it below echo.
4. If install is required, make a form like this in your HTML code. If not then ignore this step.
<form method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>
 <input type='submit' name='install_softwarename' value='Install'/>
</form>
5. Done! Now go on and install software available from users that host scripts or use my scripts that are made here.