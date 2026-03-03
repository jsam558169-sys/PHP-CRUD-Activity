<?php
require 'database.php';
require 'helpers.php';

$id = $_GET['id'];

// ensure id is numeric
if (!is_numeric($id) || $id < 1) {
    die("Invalid request: missing or invalid ID.");
}


$stmt = $pdo->prepare("SELECT * FROM transactions WHERE id = :id");
$stmt->execute([':id' => $id]);
$data = $stmt->fetch();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item = $_POST['item'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];

    // validate numeric inputs
    if (!validateNumber($price) || !validateNumber($qty)) {
        die("Invalid input: price and quantity must be numbers and cannot be negative.");
    }

    $item = trim($item);
    if ($item === '') {
        die("Invalid input: item cannot be empty.");
    }

    $total = totalPrice($price, $qty);


    $sql = "UPDATE transactions 
            SET item=:item, price=:price, qty=:qty, total=:total
            WHERE id=:id";


    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':item' => $item,
        ':price' => $price,
        ':qty' => $qty,
        ':total' => $total,
        ':id' => $id
    ]);


    header("Location: Read.php");
}
?>


<form method="post">
    Item: <input type="text" name="item" value="<?= $data['item'] ?>"><br>
    Price: <input type="number" name="price" value="<?= $data['price'] ?>"><br>
    Qty: <input type="number" name="qty" value="<?= $data['qty'] ?>"><br>
    <button type="submit">Update</button>
</form>