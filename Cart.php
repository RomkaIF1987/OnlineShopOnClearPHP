<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            if (!empty($_POST["quantity"])) {
                $productByCode = $db_handle->runQuery("SELECT * FROM product WHERE code='" . $_GET["code"] . "'");
                $itemArray = [$productByCode[0]["code"] => ['name' => $productByCode[0]["name"], 'id' => $productByCode[0]["id"], 'quantity' => $_POST["quantity"], 'price' => $productByCode[0]["price"], 'unit' => $productByCode[0]["unit"], 'image' => $productByCode[0]["image"], 'code' => $productByCode[0]["code"]]];

                if (!empty($_SESSION["cart_item"])) {
                    if (in_array($productByCode[0]["code"], array_keys($_SESSION["cart_item"]))) {
                        foreach ($_SESSION["cart_item"] as $key => $value) {
                            if ($productByCode[0]["code"] == $key) {
                                if (empty($_SESSION["cart_item"][$key]["quantity"])) {
                                    $_SESSION["cart_item"][$key]["quantity"] = 0;
                                }
                                $_SESSION["cart_item"][$key]["quantity"] += $_POST["quantity"];
                            }
                        }
                    } else {
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                    }
                } else {
                    $_SESSION["cart_item"] = $itemArray;
                }
            }
            break;
        case "remove":
            if (!empty($_SESSION["cart_item"])) {
                foreach ($_SESSION["cart_item"] as $key => $value) {
                    if ($_GET["code"] == $key)
                        unset($_SESSION["cart_item"][$key]);
                    if (empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
                }
            }
            break;
        case "empty":
            unset($_SESSION["cart_item"]);
            break;
    }
}


