<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="profil.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    .center-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    }
    .header {
        display: flex;
        justify-content: space-between;
    }
    .header .navbar li a{
        font-size: 19px;
    }
</style>
</head>
<body>
<div class="header">
    
    <div  >
       <a href="index.html"><img src="pictures/logo.png" class="logo"></a>
       
         </div>
    <div class="top-nav">
        <nav class="navbar">
        <ul>
          <li><a href="dachbord.php" >dacshbord</a></li>
          <li><a href="products.php">Products</a></li>
           <li><a href="orders.php">orders</a></li>
           <li><a href="custemors.php" class="active1">Customers</a></li>
        </ul>
        </nav>  
       </div> 
       <form class="formm" action="logout.php" method="post">
    <button class="button-64" role="button"><span class="text">logout</span></button>
    </form> 
 </div>
<div class="user-management">
    <h2>Clients :</h2>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
        <?php
           include("rtz.php");
              $result = mysqli_query($con, "SELECT flname, email FROM form WHERE type != 'admin'");
            while ($row = mysqli_fetch_assoc($result)) {
           echo "<tr>";
      echo "<td>" . $row['flname'] . "</td>";
          echo "<td class='center-content'>" . $row['email'] . "<form id='suppr' action='delete_user.php' method='post'><input type='hidden' name='email' value='" . $row['email'] . "'><div><button type='submit'>Supprimer</button></div></form></td>";
        echo "</tr>";
          }
          ?>
        </tbody>
    </table>
</div>
</body>
</html>
