<html>
    <head>
        <title>My primer sitio PHP</title>
    </head>
    <?php
      session_start(); //starts the session
      if(!$_SESSION['user']){ // checks if the user is logged in  
        header("location: index.php"); // redirects if user is not logged in
      }     
      $user = $_SESSION['user']; //assigns user value
      ?>
    <body>
        <h2>Home Page</h2>
        <!--Display's user name-->
        <a href="logout.php">Logout</a><br/><br/>
        <form action="add.php" method="POST">
           Añadir a la lista: <input type="text" name="details" /> <br/>
           Post publico? <input type="checkbox" name="public[]" value="yes" /> <br/>
           <input type="submit" value="Añadir"/>
        </form>
    <h2 align="center">Mi lista</h2>
    <table border="1px" width="100%">
      <tr>
        <th>Id</th>
        <th>Details</th>
        <th>Post Time</th>
        <th>Edit Time</th>
        <th>Edit</th>
        <th>Delete</th>
        <th>Public Post</th>
      </tr>
      <?php
        $con = mysqli_connect("localhost","root","","first_db");

        if (mysqli_connect_errno()) {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $query = "SELECT * FROM list";
        $result = mysqli_query($con, $query);
        if (!$result) {
          die('Ocurrió un error en la consulta');
        }

        while($row = mysqli_fetch_assoc($result)) {
          Print '<tr>';
            Print '<td align="center">' . $row['id'] . '</td>';
            Print '<td align="center">' . $row['details'] . '</td>';
            Print '<td align="center">' . $row['date_posted'] . '</td>';
            Print '<td align="center">' . $row['date_edited'] . '</td>';
            Print '<td align="center"><a href="edit.php">Edit</a></td>';
            Print '<td align="center"><a href="delete.php">Delete</a></td>';
            Print '<td align="center">' . $row['public'] . '</td>';
          Print '</tr>';  
        }

      ?>
    </table>
  </body>
</html>


