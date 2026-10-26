<?php
session_start();
require_once __DIR__ . '/db.php';

if (!isset($_SESSION['user'])) {
    header('Location: /login.php');
    exit;
}

$user = $_SESSION['user'];
$pdo = get_db();
$orders = $pdo->query("SELECT * FROM orders WHERE user_id = " . (int) $user['id'] . " ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Account | EatSongBrew</title>
  <link rel="stylesheet" href="/css/style.css" />
</head>
<body>
  <header class="topbar">
    <div class="container nav">
      <div class="brand">EatSongBrew</div>
      <nav>
        <a href="/index.php">Home</a>
        <a href="/logout.php">Logout</a>
      </nav>
    </div>
  </header>

  <main class="container">
    <section class="card">
      <h2>Welcome, <?= htmlspecialchars($user['name']) ?></h2>
      <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
      <p><strong>Role:</strong> <?= htmlspecialchars($user['role']) ?></p>
    </section>

    <section class="card">
      <h3>Your orders</h3>
      <?php if (empty($orders)): ?>
        <p>No orders yet.</p>
      <?php else: ?>
        <ul class="order-list">
          <?php foreach ($orders as $order): ?>
            <li>
              <strong><?= htmlspecialchars($order['item_name']) ?></strong>
              <span>Qty: <?= (int) $order['quantity'] ?></span>
              <span><?= htmlspecialchars($order['notes'] ?: 'No notes') ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </section>
  </main>
</body>
</html>
