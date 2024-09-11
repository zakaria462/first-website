<?php

include("rtz.php");


if (isset($_GET['table'])) {
    $table = $_GET['table'];
 
    $sql = "SELECT * FROM $table";
    $result = mysqli_query($con, $sql);

   
    if (mysqli_num_rows($result) > 0) {
       
        $products = array();       
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }     
        $json_response = json_encode($products);

        
        echo $json_response;
    } else {
        
        echo json_encode(array('message' => 'Aucun produit trouvé.'));
    }
} else {
    echo json_encode(array('message' => 'Paramètre "table" manquant.'));
}

mysqli_close($con);
?>
