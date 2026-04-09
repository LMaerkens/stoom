<?php

require __DIR__ . '/_bootstrap.php';

use App\Models\User;

if (is_logged_in()) {
    redirect('/library.php');
}

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim((string)($_POST['username'] ?? ''));
    $email = trim((string)($_POST['email'] ?? ''));
    $password = (string)($_POST['password'] ?? '');

    if ($username === '' || $email === '' || $password === '') {
        $error = 'Vul alle velden in.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Ongeldig e-mailadres.';
    } elseif (strlen($password) < 6) {
        $error = 'Wachtwoord moet minimaal 6 tekens zijn.';
    } else {
        $userModel = new User();

        if ($userModel->findByUsername($username)) {
            $error = 'Gebruikersnaam bestaat al.';
        } elseif ($userModel->findByEmail($email)) {
            $error = 'E-mailadres bestaat al.';
        } else {
            try {
                $userModel->create($username, $email, $password);
                $user = $userModel->verifyLogin($username, $password);
                if ($user) {
                    $_SESSION['user'] = [
                        'id' => (int)$user['id'],
                        'username' => (string)$user['username'],
                        'email' => (string)$user['email'],
                        'role' => (string)($user['role'] ?? 'user'),
                    ];
                }
                redirect('/library.php');
            } catch (\Throwable $e) {
                $error = 'Account aanmaken mislukt. Probeer opnieuw.';
            }
        }
    }
}

?><!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Stoom – Signup</title>
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>

<nav>
  <div class="nav-top">
    <div class="nav-left">
      <a href="index.php" class="nav-logo">
        <span class="logo-text">Stoom</span>
      </a>
      <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="store.php">Store</a>
        <a href="library.php">Library</a>
        <a href="contact.php">Contact</a>
      </div>
    </div>
    <div class="nav-right">
      <a href="login.php" class="nav-login">Login</a>
    </div>
  </div>
</nav>

<main class="section">
  <div class="auth-container">
    <div class="auth-card">
      <h1>Signup</h1>
      <p>Maak een account aan om libraries te beheren.</p>

      <?php if ($error): ?>
        <div style="background: rgba(255,58,58,0.12); border: 1px solid rgba(255,58,58,0.35); padding: 0.75rem; border-radius: 8px; margin-bottom: 1rem;">
          <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
        </div>
      <?php endif; ?>

      <form method="post" autocomplete="on">
        <label for="username">Gebruikersnaam</label>
        <input id="username" name="username" type="text" required class="auth-input" />

        <label for="email">E-mailadres</label>
        <input id="email" name="email" type="email" required class="auth-input" />

        <label for="password">Wachtwoord</label>
        <input id="password" name="password" type="password" required class="auth-input" />

        <button type="submit" class="auth-btn">Account maken</button>
      </form>

      <div class="auth-extra">
        <a href="login.php">Ik heb al een account</a>
        <a href="index.php">Terug naar home</a>
      </div>
    </div>
  </div>
</main>

</body>
</html>

