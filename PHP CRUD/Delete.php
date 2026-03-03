<?php
require 'database.php';


$id = $_GET['id'];

// validate id before deletion
if (!is_numeric($id) || $id < 1) {
    die("Invalid request: missing or invalid ID.");
}


$stmt = $pdo->prepare("DELETE FROM transactions WHERE id = :id");
$stmt->execute([':id' => $id]);


header("Location: Read.php");
