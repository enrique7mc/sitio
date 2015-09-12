<html>
    <head>
        <title>My primer sitio PHP</title>
    </head>
   <?php
     session_start(); //starts the session
     if($_SESSION['user']){ // checks if the user is logged in  
     }
     else{
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
      <th>Id</th>
      <th>Details</th>
      <th>Edit</th>
      <th>Delete</th>
    </table>
  </body>
</html>


