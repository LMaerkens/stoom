<?php

require __DIR__ . '/_bootstrap.php';

use App\Models\Game;
use App\Models\Library;

require_login();
$user = current_user();

$libraryModel = new Library();
$gameModel = new Game();

$error = null;

// Handle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = (string)($_POST['action'] ?? '');

    try {
        if ($action === 'create_library') {
            $name = trim((string)($_POST['name'] ?? ''));
            $description = trim((string)($_POST['description'] ?? ''));
            if ($name === '') {
                $error = 'Library naam is verplicht.';
            } else {
                $libraryModel->createLibrary((int)$user['id'], $name, $description !== '' ? $description : null, false);
                redirect('/library.php');
            }
        }

        if ($action === 'delete_library') {
            $libraryId = (int)($_POST['library_id'] ?? 0);
            $libraryModel->deleteLibrary((int)$user['id'], $libraryId);
            redirect('/library.php');
        }

        if ($action === 'remove_game') {
            $libraryId = (int)($_POST['library_id'] ?? 0);
            $gameId = (int)($_POST['game_id'] ?? 0);
            $owned = $libraryModel->getLibrary((int)$user['id'], $libraryId);
            if (!$owned) {
                $error = 'Geen toegang tot deze library.';
            } else {
                $libraryModel->removeGame($libraryId, $gameId);
                redirect('/library.php?library_id=' . $libraryId);
            }
        }
    } catch (\Throwable $e) {
        $error = 'Actie mislukt. Check je database connectie en probeer opnieuw.';
    }
}

$libraries = $libraryModel->getUserLibraries((int)$user['id']);
$selectedLibraryId = (int)($_GET['library_id'] ?? ($libraries[0]['id'] ?? 0));
$selectedLibrary = $selectedLibraryId ? $libraryModel->getLibrary((int)$user['id'], $selectedLibraryId) : null;
$selectedGames = $selectedLibrary ? $libraryModel->getGames($selectedLibraryId) : [];

?><!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Stoom – Library</title>
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
        <a href="library.php" class="active">Library</a>
        <a href="contact.php">Contact</a>
      </div>
    </div>
    <div class="nav-right">
      <span style="color: var(--off-white); font-family: 'Share Tech Mono', monospace; font-size: 0.78rem;">
        <?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?>
      </span>
      <a href="logout.php" class="nav-login">Logout</a>
    </div>
  </div>
</nav>

<main class="section">
  <div class="sec-head">
    <h1 class="sec-title"><em>Jouw libraries</em></h1>
    <a href="store.php" class="btn-cta">+ Game toevoegen</a>
  </div>

  <?php if ($error): ?>
    <div style="background: rgba(255,58,58,0.12); border: 1px solid rgba(255,58,58,0.35); padding: 0.75rem; border-radius: 8px; margin-bottom: 1rem;">
      <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
    </div>
  <?php endif; ?>

  <div style="display:grid; grid-template-columns: 320px 1fr; gap: 1.25rem;">
    <div class="panel" style="padding: 1rem;">
      <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom: 0.75rem;">
        <div class="panel-title">Libraries</div>
      </div>

      <?php if (count($libraries) === 0): ?>
        <div style="color: var(--muted); font-size: 0.9rem;">Je hebt nog geen library. Maak er één aan.</div>
      <?php else: ?>
        <div style="display:flex; flex-direction:column; gap:0.5rem;">
          <?php foreach ($libraries as $lib): ?>
            <?php $active = ((int)$lib['id'] === (int)$selectedLibraryId); ?>
            <div style="display:flex; gap:0.5rem; align-items:center; justify-content:space-between; padding:0.6rem; border-radius:8px; border:1px solid rgba(255,255,255,0.08); background: <?= $active ? 'rgba(255,210,0,0.08)' : 'rgba(13,20,40,0.65)' ?>;">
              <a href="library.php?library_id=<?= (int)$lib['id'] ?>" style="text-decoration:none; color: var(--off-white); font-weight:700;">
                <?= htmlspecialchars($lib['name'], ENT_QUOTES, 'UTF-8') ?>
              </a>
              <form method="post" style="margin:0;">
                <input type="hidden" name="action" value="delete_library" />
                <input type="hidden" name="library_id" value="<?= (int)$lib['id'] ?>" />
                <button type="submit" class="nav-icon-btn" title="Verwijderen" style="border-color: rgba(255,58,58,0.35);">
                  ✕
                </button>
              </form>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <div style="height:1px; background: rgba(255,210,0,0.18); margin: 1rem 0;"></div>

      <div class="panel-title" style="margin-bottom:0.5rem;">Nieuwe library</div>
      <form method="post">
        <input type="hidden" name="action" value="create_library" />
        <label for="name">Naam</label>
        <input id="name" name="name" type="text" class="auth-input" required />
        <label for="description">Beschrijving</label>
        <input id="description" name="description" type="text" class="auth-input" />
        <button type="submit" class="auth-btn">Aanmaken</button>
      </form>
    </div>

    <div class="panel" style="padding: 1rem;">
      <div class="panel-title" style="margin-bottom: 0.75rem;">
        <?= $selectedLibrary ? htmlspecialchars($selectedLibrary['name'], ENT_QUOTES, 'UTF-8') : 'Selecteer een library' ?>
      </div>

      <?php if (!$selectedLibrary): ?>
        <div style="color: var(--muted);">Maak of selecteer een library.</div>
      <?php else: ?>
        <?php if (count($selectedGames) === 0): ?>
          <div style="color: var(--muted);">Nog geen games in deze library. Ga naar de Store om toe te voegen.</div>
        <?php else: ?>
          <div class="game-grid">
            <?php foreach ($selectedGames as $g): ?>
              <div class="game-card" style="cursor:default;">
                <div class="card-art ca-1">🎮</div>
                <div class="card-info">
                  <div class="card-name"><?= htmlspecialchars($g['title'], ENT_QUOTES, 'UTF-8') ?></div>
                  <div class="card-genre">Game #<?= (int)$g['id'] ?></div>
                  <div class="card-footer" style="justify-content:flex-end;">
                    <form method="post" style="margin:0;">
                      <input type="hidden" name="action" value="remove_game" />
                      <input type="hidden" name="library_id" value="<?= (int)$selectedLibraryId ?>" />
                      <input type="hidden" name="game_id" value="<?= (int)$g['id'] ?>" />
                      <button type="submit" class="btn-cta" style="padding:0.35rem 0.8rem;">Remove</button>
                    </form>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>
</main>

</body>
</html>
