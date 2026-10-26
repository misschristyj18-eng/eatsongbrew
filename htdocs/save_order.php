<?php
session_start();
require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemName = trim((string) ($_POST['item_name'] ?? ''));
    $quantity = max(1, (int) ($_POST['quantity'] ?? 1));
    $notes = trim((string) ($_POST['notes'] ?? ''));

    if ($itemName === '') {
        $_SESSION['flash'] = 'Please choose an item.';
        header('Location: /index.php');
        exit;
    }

    $pdo = get_db();
    $userId = $_SESSION['user']['id'] ?? null;

    $stmt = $pdo->prepare('INSERT INTO orders (user_id, item_name, quantity, notes) VALUES (:user_id, :item_name, :quantity, :notes)');
    $stmt->execute([
        ':user_id' => $userId,
        ':item_name' => $itemName,
        ':quantity' => $quantity,
        ':notes' => $notes,
    ]);

    $_SESSION['flash'] = 'Order saved successfully.';
    header('Location: /my_account.php');
    exit;
}

header('Location: /index.php');
