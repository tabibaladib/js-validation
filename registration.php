
<?php 
   include "config.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<?php include 'title.php'; ?>
</head>
<body>
	<h1><?php include 'header.php'; ?></h1>

	<?php
	
   require 'db-insert.php';

   $fname = $lname = $gender = $dob = $religion = $email = $username = $password = $phone = $pra = $pa = $pw = "";


	$fnameErr = $lnameErr = $genderErr = $dobErr = $religionErr = $emailErr = $usernameErr = $passwordErr = "";

	$successMessage = $errMessage ="";
	$flag = false;
	
	   if($_SERVER['REQUEST_METHOD'] === "POST") 
	   	{ 
	   	  if(empty($_POST['fname']))
	       {
            $fnameErr = "First Name can not be empty!";
            $flag = true;
	       }

	       if(empty($_POST['lname']))
	       {
            $lnameErr = "Last Name can not be empty!";
            $flag = true;
	       }

	       if(empty($_POST['gender']))
	       {
            $genderErr = "Gender can not be empty!";
            $flag = true;
	       }

          if(empty($_POST['dob']))
	       {
            $dobErr = "Date of Birth can not be empty!";
            $flag = true;
	       }

	       if(empty($_POST['religion']))
	       {
            $religionErr = "Religion can not be empty!";
            $flag = true;
	       }

	       if(empty($_POST['email']))
	       {
            $emailErr = "Email can not be empty!";
            $flag = true;
	       }

	       if(empty($_POST['username']))
	       {
            $usernameErr = "Username can not be empty!";
            $flag = true;
	       }

	       if(empty($_POST['password']))
	       {
            $passwordErr = "Password can not be empty!";
            $flag = true;
	       }

	       if(!$flag)
	       {
	      	$fname = $_POST['fname'];
            $lname = $_POST['lname'];
          	$gender = $_POST['gender'];
            $dob = $_POST['dob'];
            $religion = $_POST['religion'];
            $pra = $_POST['pra'];
            $pa = $_POST['pa'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $pw = $_POST['pw'];
            $username = $_POST['username'];
            $password = $_POST['password'];
	      	
	      	$fname = test_input($fname);
	      	$lname = test_input($lname);
	      	$gender = test_input($gender);
	      	$dob = test_input($dob);
	      	$religion = test_input($religion);
	      	$pra = test_input($pra);
	      	$pa = test_input($pa);
	      	$phone = test_input($phone);
	      	$email = test_input($email);
	      	$pw = test_input($pw);
	      	$username = test_input($username);
	      	$password = test_input($password);


            $response = register($fname, $lname, $gender, $dob, $religion, $pra, $pa, $phone, $email, $pw, $username, $password);
            if($response)
            {
               $successMessage = "User Registered Successfully!";
            }


            
	       }

	      else
	      {
	      	$errMessage = "Error while saving!";
	      }

	    }
 
     function test_input($data)
     {
     	$data = trim($data);
     	$data = stripslashes($data);
     	$data = htmlspecialchars($data);
     		return $data;
     }

 
	?>

	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" name="regform" onsubmit="return isValid()">
	   <fieldset>	
	   <legend>Basic Information:</legend>
	   <label for="fname">First name: </label> 
	   <input type="text" id="fname" name="fname" value="<?php //echo $fname;?>">
	   <span style="color: red;"><?php echo $fnameErr; ?></span>
	   <br><br>

	   <label for="lname">Last name: </label> 
	   <input type="text" id="lname" name="lname" value="<?php //echo $lname;?>">
	   <span style="color: red;"><?php echo $lnameErr; ?></span>
	   <br> <br>

	   <label for="gender">Gender: </label>
	   <input type="radio" id="male" name="gender" value="male">
	   <label for="male">Male</label>
	   <input type="radio" id="female" name="gender" value="female">
	   <label for="female">Female</label>
	   <span style="color: red;"><?php echo $genderErr; ?></span>
	   <br><br>

	   <label for="dob">DOB:</label>
       <input type="date" id="dob" name="dob">
       <span style="color: red;"><?php echo $dobErr; ?></span>
	   <br><br>

	   <label for="religion">Religion: </label>
	   <select name = "religion" id="religion">
	   	<option value="none" selected disabled hidden>Select an option
      </option>
	  	<option value = "islam">Islam</option>
	  	<option value = "hindu">Hindu</option>
	  	<option value = "buddhism">Buddhism</option>
	  	<option value = "christianity">Christianity</option>
	  	<option value = "other">Other</option>
	   </select>
	   <span style="color: red;"><?php echo $religionErr; ?></span>

	   </fieldset>

       <br>
       <fieldset>
	   <legend> Contact Information:</legend>
	   <label for="pra">Present Address: </label> 
	   <input type="textarea" id="pra" name="pra">
	   <br> <br>

	   <label for="pa">Permanent Address: </label> 
	   <input type="textarea" id="pa" name="pa">
	   <br> <br>

	   <label for="phone">Phone: </label>
	   <input type="tel" id="phone" name="phone">
	   <br> <br>

	   <label for="email">Email: </label>
	   <input type="email" id="email" name="email">
	   <span style="color: red;"><?php echo $emailErr; ?></span>
	   <br> <br>

	   <label for="pw">Personal Website: </label> 
	   <input type="url" id="pw" name="pw">
	   <br>

	   </fieldset>
	   <br>
       <fieldset>
	   <legend> Account Information:</legend>
	   <label for="username">Username: </label> 
	   <input type="text" id="username" name="username">
	   <span style="color: red;"><?php echo $usernameErr; ?></span>
	   <br> <br>

	   <label for="password">Password: </label> 
	   <input type="password" id="password" name="password">
	   <span style="color: red;"><?php echo $passwordErr; ?></span>
	   <br>

	   </fieldset>
	   <br> 
	   <input class="submit" type="submit" value="Register">
	   <span style="color: green;"><?php echo $successMessage; ?></span>
       <span style="color: red;"><?php echo $errMessage; ?></span>
	     
</form>

<script>
	function isvalid() 
	{
		var fname = document.forms["regform"]["fname"].value;
		var lname = document.forms["regform"]["lname"].value;
		var gender = document.forms["regform"]["gender"].value;
		var dob = document.forms["regform"]["dob"].value;
		var religion = document.forms["regform"]["religion"].value;
		var email = document.forms["regform"]["email"].value;
		var username = document.forms["regform"]["username"].value;
		var password = document.forms["regform"]["password"].value;
		return false;
	}
</script>

<p>Already an user? <a href="login-form.php">Click Here</a> to log in.</p>

  <?php include 'footer.php'; ?>

</body>	
</html>