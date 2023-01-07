<?php

$id = $_GET['id'];
$conn = mysqli_connect("localhost", "root", "", "zdg");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// sql to delete a record
$sql = "DELETE FROM pedido_full WHERE pedido_full.id = $id"; 

if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    header('Location: index.php');
    exit;
} else {
    echo "Error deleting record";
}

?>