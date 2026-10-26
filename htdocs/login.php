<?php
session_start();
require_once __DIR__ . '/db.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim((string) ($_POST['email'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');

    if ($email === '' || $password === '') {
        $errors[] = 'Email and password are required.';
    } else {
        $pdo = get_db();
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => (int) $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role'],
            ];
            header('Location: /my_account.php');
            exit;
        }

        $errors[] = 'Invalid login. Please check your email and password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | EatSongBrew</title>
  <link rel="stylesheet" href="/css/style.css" />
</head>
<body>
  <header class="topbar">
    <div class="container nav">
      <div class="brand">EatSongBrew</div>
      <nav>
        <a href="/index.php">Home</a>
        <a href="/register.php">Register</a>
      </nav>
    </div>
  </header>

  <main class="container auth-shell">
    <section class="card form-card">
      <h2>Login</h2>
      <?php foreach ($errors as $error): ?>
        <div class="alert error"><?= htmlspecialchars($error) ?></div>
      <?php endforeach; ?>
      <form method="post" action="/login.php">
        <label>
          Email
          <input type="email" name="email" required>
        </label>
        <label>
          Password
          <input type="password" name="password" required>
        </label>
        <button class="button primary" type="submit">Sign in</button>
      </form>
    </section>
  </main>
</body>
</html>
