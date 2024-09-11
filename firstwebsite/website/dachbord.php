<?php
session_start();


$total_earnings = isset($_SESSION['total_earnings']) ? $_SESSION['total_earnings'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    
    <link rel="stylesheet" href="profil.css">
    <link rel="stylesheet" href="dachbord.css">
    <style>
        .header {
            display: flex;
            justify-content: space-between;
        }
        .header .navbar li a {
            font-size: 19px;
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
                    <li><a href="index.html" class="active1">Dashboard</a></li>
                    <li><a href="products.php">Products</a></li>
                    <li><a href="orders.php">Orders</a></li>
                    <li><a href="custemors.php">Customers</a></li>
                </ul>
            </nav>  
        </div> 
        <form class="formm" action="logout.php" method="post">
            <button class="button-64" role="button"><span class="text">Logout</span></button>
        </form> 
    </div>

    <div class="cardBox">
        <div class="card">
            <div>
                <div class="numbers">2</div>
                <div class="cardName">Daily Views</div>
            </div>
            <div class="iconBx">
                <ion-icon name="eye-outline"></ion-icon>
            </div>
        </div>
        <div class="card">
            <div>
                <div class="numbers">12</div>
                <div class="cardName">Sales</div>
            </div>
            <div class="iconBx">
                <ion-icon name="cart-outline"></ion-icon>
            </div>
        </div>
        <div class="card">
            <div>
                <div class="numbers">15</div>
                <div class="cardName">Comments</div>
            </div>
            <div class="iconBx">
                <ion-icon name="chatbubbles-outline"></ion-icon>
            </div>
        </div>
        <div class="card">
            <div>
                <div class="numbers"><?php echo $total_earnings; ?> Dh</div>
                <div class="cardName">Earnings</div>
            </div>
            <div class="iconBx">
                <ion-icon name="cash-outline"></ion-icon>
            </div>
        </div>
    </div>

    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>Recent Orders</h2>
                <a href="#" class="btn">View All</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <td>Name</td>
                        <td>Price</td>
                        <td>Payment</td>
                        <td>Status</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Logitech G213 Prodigy</td>
                        <td>549 Dh</td>
                        <td>Paid</td>
                        <td><span class="status delivered">Delivered</span></td>
                    </tr>
                    <tr>
                        <td>IPHONE 15 128GB</td>
                        <td>13790 Dh</td>
                        <td>Due</td>
                        <td><span class="status pending">Pending</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        
        <div class="recentCustomers">
            <div class="cardHeader">
                <h2>Recent Customers</h2>
            </div>
            <table>
                <tr>
                    <td width="60px">
                        <div class="imgBx"><img src="assets/imgs/customer02.jpg" alt=""></div>
                    </td>
                    <td>
                        <h4>Ayoub <br> <span>Rabat</span></h4>
                    </td>
                </tr>
                <tr>
                    <td width="60px">
                        <div class="imgBx"><img src="assets/imgs/customer02.jpg" alt=""></div>
                    </td>
                    <td>
                        <h4>Zakaria <br> <span>Casablanca</span></h4>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <script src="assets/js/main.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
