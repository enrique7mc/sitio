<?php
	$con = mysqli_connect("localhost","root","","first_db");

    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    session_start();
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $bool = true;

    $query = "SELECT * FROM users WHERE username='$username'"; // Query the users table
    $result = mysqli_query($con, $query);

    $table_users = "";
    $table_password = "";
    if($result) {//IF there are no returning rows or no existing username
       while($row = mysqli_fetch_assoc($result)) { // display all rows from query
          $table_users = $row['username']; // the first username row is passed on to $table_users, and so on until the query is finished
          $table_password = $row['password']; // the first password row is passed on to $table_password, and so on until the query is finished
       }
       if(($username == $table_users) && ($password == $table_password)) {// checks if there are any matching fields       
          if($password == $table_password) {
             $_SESSION['user'] = $username; //set the username in a session. This serves as a global variable
             header("location: home.php"); // redirects the user to the authenticated home page
          }
       }
       else {
        Print '<script>alert("Incorrect Password!");</script>'; // Prompts the user
        Print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
       }
    }
    else {
        Print '<script>alert("Incorrect username!");</script>'; // Prompts the user
        Print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
    }
?>