<?php 

    require 'dbconnect.php';

    function register($fname, $lname, $gender, $dob, $religion, $pra, $pa, $phone, $email, $pw, $username, $password)
    {
      $conn = connect();
      $sql = $conn->prepare("INSERT INTO USERS (fname, lname, gender, dob, religion, pra, pa, phone, email, pw, username, password) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
      $sql->bind_param("ssssssssssss", $fname, $lname, $gender, $dob, $religion, $pra, $pa, $phone, $email, $pw, $username, $password);
      return $sql->execute();
    }



?>