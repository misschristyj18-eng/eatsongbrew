<?php
session_start();
require_once __DIR__ . '/db.php';

if (!isset($_SESSION['user'])) {
    header('Location: /login.php');
    exit;
}

$user = $_SESSION['user'];
$pdo = get_db();
$orders = $pdo->query('SELECT * FROM orders ORDER BY created_at DESC')->fetchAll();
$customers = $pdo->query('SELECT * FROM users ORDER BY created_at DESC')->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin | EatSongBrew</title>
  <link rel="stylesheet" href="/css/style.css" />
</head>
<body>
  <header class="topbar">
    <div class="container nav">
      <div class="brand">EatSongBrew</div>
      <nav>
        <a href="/index.php">Home</a>
        <a href="/my_account.php">My Account</a>
        <a href="/logout.php">Logout</a>
      </nav>
    </div>
  </header>

  <main class="container">
    <section class="card">
      <h2>Admin dashboard</h2>
      <p>Logged in as <?= htmlspecialchars($user['name']) ?>.</p>
    </section>

    <section class="card">
      <h3>Recent orders</h3>
      <ul class="order-list">
        <?php foreach ($orders as $order): ?>
          <li>
            <strong><?= htmlspecialchars($order['item_name']) ?></strong>
            <span>Qty: <?= (int) $order['quantity'] ?></span>
            <span>Customer: <?= htmlspecialchars($order['user_id'] ?? 'Guest') ?></span>
          </li>
        <?php endforeach; ?>
      </ul>
    </section>

    <section class="card">
      <h3>Users</h3>
      <ul class="order-list">
        <?php foreach ($customers as $customer): ?>
          <li>
            <strong><?= htmlspecialchars($customer['name']) ?></strong>
            <span><?= htmlspecialchars($customer['email']) ?></span>
          </li>
        <?php endforeach; ?>
      </ul>
    </section>
  </main>
</body>
</html>
