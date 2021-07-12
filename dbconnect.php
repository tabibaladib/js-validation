<?php

    function connect()
    {



       $conn = new mysqli("localhost","tabib", "1234", "wtk" );

       //var_dump($conn);

       if($conn->connect_errno)
        {
            die("Database connection failed...".$conn->connect_err);
        }
            return $conn;
    }   

?>