<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $order_sum = mysqli_real_escape_string($db_handle->connectDB(), number_format(($_POST['sum'] + $_POST['delivery']), 2));
    $user_account = $_SESSION['user_account'] - $order_sum;
    $db_handle->runQuery("UPDATE users SET money ='$user_account' WHERE id = '" . $_SESSION['user_id'] . "'");
    $sql = $db_handle->runQuery("SELECT money FROM users WHERE id = '" . $_SESSION['user_id'] . "'");
    $_SESSION['user_account'] = $sql[0]['money'];
    unset($_SESSION["cart_item"]);

    header("location: index.php");

}