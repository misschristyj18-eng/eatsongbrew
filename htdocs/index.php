<?php
session_start();
require_once __DIR__ . '/db.php';

$pdo = get_db();
$user = $_SESSION['user'] ?? null;

function pageHeader(string $title, $user = null): string {
    $accountLink = $user ? '<a href="/my_account.php">My Account</a>' : '<a href="/login.php">Login</a>';
    $authLink = $user ? '<a href="/logout.php">Logout</a>' : '<a href="/register.php">Register</a>';

    return "<!DOCTYPE html>
<html lang=\"en\">
<head>
  <meta charset=\"UTF-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
  <title>{$title}</title>
  <link rel=\"stylesheet\" href=\"/css/style.css\">
</head>
<body>
  <header class=\"topbar\">
    <div class=\"container nav\">
      <div class=\"brand\">EatSongBrew</div>
      <nav>
        <a href=\"/index.php\">Home</a>
        <a href=\"/admin.php\">Admin</a>
        {$accountLink}
        {$authLink}
      </nav>
    </div>
  </header>
  <main class=\"container\">";
}

function pageFooter(): string {
    return "</main>
  <footer class=\"footer\">© 2026 EatSongBrew</footer>
</body>
</html>";
}
?>
<?php echo pageHeader('EatSongBrew', $user); ?>
<section class="hero">
  <div>
    <p class="eyebrow">Freshly brewed daily</p>
    <h1>Order your favorite drinks and bites.</h1>
    <p>Simple ordering, secure login, and a clean checkout flow for your café.</p>
    <?php if ($user): ?>
      <a class="button primary" href="/my_account.php">Go to your account</a>
    <?php else: ?>
      <a class="button primary" href="/register.php">Create an account</a>
    <?php endif; ?>
  </div>
</section>

<section class="grid three">
  <article class="card">
    <h3>Signature Brew</h3>
    <p>Rich espresso, slow roasted beans, and a smooth finish.</p>
    <strong>$5.50</strong>
  </article>
  <article class="card">
    <h3>Garden Matcha</h3>
    <p>Bright, earthy matcha blended with silky oat milk.</p>
    <strong>$6.00</strong>
  </article>
  <article class="card">
    <h3>Breakfast Toast</h3>
    <p>Avocado, chili flakes, lemon, and a side of roasted tomatoes.</p>
    <strong>$8.00</strong>
  </article>
</section>

<section class="card order-box">
  <h2>Place an order</h2>
  <form action="/save_order.php" method="post">
    <div class="form-grid">
      <label>
        Item
        <select name="item_name">
          <option>Signature Brew</option>
          <option>Garden Matcha</option>
          <option>Breakfast Toast</option>
          <option>Cold Brew</option>
        </select>
      </label>
      <label>
        Quantity
        <input type="number" name="quantity" min="1" value="1" required>
      </label>
    </div>
    <label>
      Notes
      <textarea name="notes" rows="3" placeholder="Add extra notes for your order..."></textarea>
    </label>
    <button class="button primary" type="submit">Save order</button>
  </form>
</section>
<?php echo pageFooter(); ?>
