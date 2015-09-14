<?php
    session_start();
    if(!$_SESSION['user']){
        header("location: index.php");
    }   

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $details = mysql_real_escape_string($_POST['details']);
        $time = strftime("%X"); //time
        $date = strftime("%B %d, %Y"); //date
        $decision = 'no';

        $con = mysqli_connect("localhost","root","","first_db");

        if (mysqli_connect_errno()) {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        foreach ($_POST['public'] as $each_check) {
            if ($each_check != null) {
                $decision = 'yes';
            }            
        }

        $query = "INSERT INTO list(details, date_posted, time_posted, public) VALUES ('$details', '$date', '$time', '$decision')"; 
        $result = mysqli_query($con, $query);
        header('location: home.php');
    } else {
        header("location: home.php");
    }
?>