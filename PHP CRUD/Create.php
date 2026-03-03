<?php
require 'database.php';
require 'helpers.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item = $_POST['item'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];

    // validate numeric inputs
    if (!validateNumber($price) || !validateNumber($qty)) {
        die("Invalid input: price and quantity must be numbers and cannot be negative.");
    }
    // basic string validation for item
    $item = trim($item);
    if ($item === '') {
        die("Invalid input: item cannot be empty.");
    }

    $total = totalPrice($price, $qty);


    $sql = "INSERT INTO transactions (item, price, qty, total)
            VALUES (:item, :price, :qty, :total)";


    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':item' => $item,
        ':price' => $price,
        ':qty' => $qty,
        ':total' => $total
    ]);


    header("Location: read.php");
}
