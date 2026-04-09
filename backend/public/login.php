<?php

require __DIR__ . '/_bootstrap.php';

use App\Models\User;

if (is_logged_in()) {
    redirect('/library.php');
}

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usernameOrEmail = trim((string)($_POST['usernameOrEmail'] ?? ''));
    $password = (string)($_POST['password'] ?? '');

    if ($usernameOrEmail === '' || $password === '') {
        $error = 'Vul je gebruikersnaam/email en wachtwoord in.';
    } else {
        $userModel = new User();
        $user = $userModel->verifyLogin($usernameOrEmail, $password);
        if (!$user) {
            $error = 'Inloggen mislukt. Controleer je gegevens.';
        } else {
            // store minimal safe session payload
            $_SESSION['user'] = [
                'id' => (int)$user['id'],
                'username' => (string)$user['username'],
                'email' => (string)$user['email'],
                'role' => (string)($user['role'] ?? 'user'),
            ];
            redirect('/library.php');
        }
    }
}

?><!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Stoom – Inloggen</title>
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
      <a href="signup.php" class="nav-login">Signup</a>
    </div>
  </div>
</nav>

<main class="section">
  <div class="auth-container">
    <div class="auth-card">
      <h1>Inloggen</h1>
      <p>Log in met je gebruikersnaam of e-mailadres.</p>

      <?php if ($error): ?>
        <div style="background: rgba(255,58,58,0.12); border: 1px solid rgba(255,58,58,0.35); padding: 0.75rem; border-radius: 8px; margin-bottom: 1rem;">
          <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
        </div>
      <?php endif; ?>

      <form method="post" autocomplete="on">
        <label for="usernameOrEmail">Gebruikersnaam / Email</label>
        <input id="usernameOrEmail" name="usernameOrEmail" type="text" required class="auth-input" />

        <label for="password">Wachtwoord</label>
        <input id="password" name="password" type="password" required class="auth-input" />

        <button type="submit" class="auth-btn">Inloggen</button>
      </form>

      <div class="auth-extra">
        <a href="signup.php">Maak een account</a>
        <a href="index.php">Terug naar home</a>
      </div>
    </div>
  </div>
</main>

</body>
</html>
