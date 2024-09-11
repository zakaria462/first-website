<?php
include 'rtz.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['orderId']) && isset($_POST['status'])) {
    $orderId = $_POST['orderId'];
    $status = $_POST['status'];


    $updateSql = "UPDATE commande SET etat_commande = '$status' WHERE id = '$orderId'";
    if ($con->query($updateSql) === TRUE) {

        echo $status;
        exit;
    } else {
        echo 'Erreur lors de la mise à jour du statut de commande';
        exit;
    }
}

$sql = "SELECT * FROM commande";
$result = $con->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="profil.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <style>
        .header {
            display: flex;
            justify-content: space-between;
        }
        .header .navbar li a{
            font-size: 19px;
        }
        .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 24px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }
        .button.accept {
            background-color: #4CAF50;
            display: block;
            margin-bottom: 10px;
        }
        .button.reject {
            background-color: #f44336;
            display: block;
        }
        tr{
            height : 80px;
        }
    </style>
</head>
<body>

<div class="header">
    
    <div>
       <a href="index.html"><img src="pictures/logo.png" class="logo"></a>
    </div>
    <div class="top-nav">
        <nav class="navbar">
            <ul>
                <li><a href="dachbord.php" >dachbord</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="dachbord.php" class="active1">orders</a></li>
                <li><a href="custemors.php">Customers</a></li>
            </ul>
        </nav>  
    </div> 
    <form class="formm" action="logout.php" method="post">
        <button class="button-64" role="button"><span class="text">logout</span></button>
    </form> 
</div>

<h2>Orders</h2>
<table>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Full Name</th>
            <th>Phone Number</th>
            <th>Delivery Address</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["full_name"] . "</td>";
                echo "<td>" . $row["phone_number"] . "</td>";
                echo "<td>" . $row["delivery_address"] . "</td>";
                echo "<td>" . $row["total_commande"] . "</td>";
                echo "<td id='order-details-" . $row["id"] . "'>"; 
                if ($row["etat_commande"] === 'nouvelle') {
                    echo "<button class='button accept' onclick='acceptOrder(" . $row["id"] . ")'>Accepter</button>";
                    echo "<button class='button reject' onclick='rejectOrder(" . $row["id"] . ")'>Refuser</button>";
                } else {
                    echo $row["etat_commande"];
                }
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No orders found.</td></tr>";
        }
        ?>
    </tbody>
</table>

<script>
    function acceptOrder(orderId) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    document.getElementById('order-details-' + orderId).textContent = 'Accepté';
                } else {
                    console.error('Erreur lors de la mise à jour du statut de commande');
                }
            }
        };
        xhr.open('POST', 'orders.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('orderId=' + encodeURIComponent(orderId) + '&status=accepte');
    }

    function rejectOrder(orderId) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    document.getElementById('order-details-' + orderId).textContent = 'Refusé';
                } else {
                    console.error('Erreur lors de la mise à jour du statut de commande');
                }
            }
        };
        xhr.open('POST', 'orders.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('orderId=' + encodeURIComponent(orderId) + '&status=refuse');
    }
</script>

</body>
</html>

<?php
$con->close();
?>
