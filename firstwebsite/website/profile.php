<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="profil.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="header">
    <div class="stiky">
        <div>
            <a href="index.html"><img src="pictures/logo.png" class="logo"></a>
        </div>
        <div class="top-nav">
            <nav class="navbar">
                <ul>
                    <li><a href="index.html" class="active1">Home</a></li>
                    <li><a href="#product">Products</a></li>
                    <li><a href="#About">About</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="login.php">Account</a></li>
                </ul>
            </nav>  
            <form class="formm" action="logout.php" method="post">
                <button class="button-64" role="button"><span class="text">logout</span></button>
            </form>
        </div>
    </div>
</div>

<p>Here you can manage your account settings.</p>
<div class="prof">
    <section class="user-info">
        <h2>your informations</h2>
        <div style="display: flex; justify-content: center; align-items: center; margin-top : 0 ; margin-buttom : 30px;">
            <img style="width: 39px; height: 39px;margin-bottom: 25px;" src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="">
        </div>
        <form id="infoForm" class="form" action="" method="post">
            <table>
                <?php
                include("rtz.php");
                session_start();
                if (isset($_SESSION['user_id'])) {
                    $user_id = $_SESSION['user_id'];
                    $query = "SELECT * FROM form WHERE id = '$user_id'";
                    $result = mysqli_query($con, $query);
                    if ($result && mysqli_num_rows($result) > 0) {
                        $user_data = mysqli_fetch_assoc($result);
                        foreach ($user_data as $key => $value) {
                            if ($key !== 'id' && $key !== 'type') {
                                echo "<tr>";
                                echo "<th><label for='$key'>$key:</label></th>";
                                echo "<td><input type='text' id='$key' name='$key' value='" . htmlspecialchars($value) . "' required></td>";
                                echo "</tr>";
                            }
                        }
                    } else {
                        echo "<tr><td colspan='2'>No user data found.</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>User not logged in.</td></tr>";
                }
                ?>
            </table>
            <button id="miseajour" type="submit" name="update_profile" role="button"><span class="text">Update</span></button>
        </form>
    </section>
</div>

<?php
if (isset($_POST['update_profile'])) {
    $updated_values = [];
    foreach ($_POST as $key => $value) {
        if ($key !== 'id' && $key !== 'type' && !empty($value)) {
            $updated_values[$key] = htmlspecialchars($value);
        }
    }
    include('rtz.php');
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $update_query = "UPDATE form SET ";
    foreach ($updated_values as $key => $value) {
        $update_query .= "$key = '$value', ";
    }
    $update_query = rtrim($update_query, ", ");
    $update_query .= " WHERE id = '" . $_SESSION['user_id'] . "'";
    if (mysqli_query($con, $update_query)) {
        echo "<script>alert('Profile updated successfully!');
        </script>
        <script>window.location.replace(window.location.href);</script>";
    } else {
        echo "<p>Error updating profile: " . mysqli_error($con) . "</p>";
    }
    mysqli_close($con);
}
?>


</body>
</html>
