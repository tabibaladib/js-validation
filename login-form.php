
<?php
    include "config.php";

    require 'db-read.php';

    $username = $password = "";
    $isValid = true;
    $usernameErr = $passwordErr = "";
    $uid = "";
     

    if(isset($_COOKIE['uid']))
    {
          $uid = $_COOKIE['uid'];
           
    }
	
	   if($_SERVER['REQUEST_METHOD'] === "POST") 
	   	{ 
          $username = $_POST['username'];
          $password = $_POST['password'];
          $isValid = true;
          

	      if(empty($username))
	      {
            $usernameErr = "Username can not be empty!";
            $isValid = false;
	      }

	      if(empty($password))
	      {
            $passwordErr = "Password can not be empty!";
            $isValid = false;
	      }

	      if($isValid)
	      {


	      	 $response = login($username, $password);

           if($response)
           {
           	echo '<span style="color:green;">Log In Successfull!</span>';
           	
           	if(isset($_POST['rememberme']))
           	{

           		setcookie("uid",$username, time() + 60*60*24*30);
            }

           	session_start();
           	$_SESSION['uid'] = $username;

           	header("Location: welcomepage.php");
           }

           else
           {
           	echo '<span style="color:red;">Log In failed! Invalid username or password!</span>';
           }

            
	      }

	    }
	    
 
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<?php include 'title.php'; ?> 
</head>
<body>
	<h1><?php include 'header.php'; ?></h1>

	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" name="regform" onsubmit="return isValid()">
	   

	   </fieldset>
	   <br>
       <fieldset>
	   <legend>Log In form:</legend>
	   <label for="username">Username: </label> 
	   <input type="text" id="username" name="username" value="<?php echo $uid;?>">
	   <span style="color: red; " id = "usernameErr"><?php echo $usernameErr; ?></span>
	   <br> <br>

	   <label for="password">Password: </label> 
	   <input type="password" id="password" name="password">
	   <span style="color: red;" id = "passwordErr"><?php echo $passwordErr; ?></span>
	   <br>
       <br>
      
      <input type="checkbox" name="rememberme" id="rememberme">
      <label for="rememberme">Remember Me</label>
      <br><br>


	   <input class="submit" type="submit" value="Log In">


	  

	     
</form>

<script>
	function isValid() 
	{
		var flag = true;

		var usernameErr = document.getElementById("usernameErr");
		var passwordErr = document.getElementById("passwordErr");

		var username = document.forms["regform"]["username"].value;
		var password = document.forms["regform"]["password"].value;

		usernameErr.innerHTML = "";
		passwordErr.innerHTML = "";

		if(username === "")
		{
			flag = false;
			document.getElementById("usernameErr").innerHTML = "Username can't be empty!";
		}

		if(password === "")
		{
			flag = false;
			document.getElementById("passwordErr").innerHTML = "Password can't be empty!";
		}

	
		return flag;

	}
</script>
<br><br>
<p>New user? <a href="registration.php">Click Here</a> for registration.</p>
</fieldset>
  <?php include 'footer.php'; ?>

</body>
</html>
