<?php
session_start();
require_once __DIR__ . '/db.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim((string) ($_POST['name'] ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');

    if ($name === '' || $email === '' || $password === '') {
        $errors[] = 'Name, email, and password are required.';
    } else {
        try {
            $pdo = get_db();
            $stmt = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':password' => password_hash($password, PASSWORD_DEFAULT),
            ]);

            $_SESSION['flash'] = 'Account created successfully. Please log in.';
            header('Location: /login.php');
            exit;
        } catch (PDOException $e) {
            $errors[] = 'That email is already registered.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register | EatSongBrew</title>
  <link rel="stylesheet" href="/css/style.css" />
</head>
<body>
  <header class="topbar">
    <div class="container nav">
      <div class="brand">EatSongBrew</div>
      <nav>
        <a href="/index.php">Home</a>
        <a href="/login.php">Login</a>
      </nav>
    </div>
  </header>

  <main class="container auth-shell">
    <section class="card form-card">
      <h2>Create an account</h2>
      <?php foreach ($errors as $error): ?>
        <div class="alert error"><?= htmlspecialchars($error) ?></div>
      <?php endforeach; ?>
      <form method="post" action="/register.php">
        <label>
          Full name
          <input type="text" name="name" required>
        </label>
        <label>
          Email
          <input type="email" name="email" required>
        </label>
        <label>
          Password
          <input type="password" name="password" required>
        </label>
        <button class="button primary" type="submit">Register</button>
      </form>
    </section>
  </main>
</body>
</html>
