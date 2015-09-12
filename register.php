<html>
    <head>
        <title>My primer sitio PHP</title>
    </head>
    <body>
        <h2>Registration Page</h2>
        <a href="index.php">Click here to go back</a><br/><br/>
        <form action="register.php" method="POST">
           Enter Username: <input type="text" name="username" required="required" /> <br/>
           Enter password: <input type="password" name="password" required="required" /> <br/>
           <input type="submit" value="Register"/>
        </form>
    </body>
</html>

<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $con=mysqli_connect("localhost","root","","first_db");

    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $username = mysqli_real_escape_string($con, $_POST["username"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);
    $bool = true;

    $query = "SELECT * FROM users";
    $result = mysqli_query($con, $query);
    if (!$result) {
      die('Ocurrió un error en la consulta');
    }

    while($row = mysqli_fetch_assoc($result)) {
      $table_users = $row['username'];
      if ($username == $table_users) {
        $bool = false;
        print '<script>alert("El nombre de usuario ya existe");</script>';
        print '<script>window.location.assign("register.php");</script>';
      }
    }

    if ($bool) {
      $query = "INSERT INTO users(username, password) VALUES ('$username','$password')";
      $result = mysqli_query($con, $query);
      if ($result) {
        print '<script>alert("Registro exitoso");</script>';
      } else {
        print '<script>alert("Error: ' . mysqli_connect_error() . '");</script>';
      }

      print '<script>window.location.assign("register.php");</script>';
    }
    
  }
?>