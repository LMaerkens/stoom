<?php

require __DIR__ . '/_bootstrap.php';

use App\Models\Game;
use App\Models\Library;

require_login();
$user = current_user();

$gameModel = new Game();
$libraryModel = new Library();

$error = null;
$success = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = (string)($_POST['action'] ?? '');
    if ($action === 'add_to_library') {
        $libraryId = (int)($_POST['library_id'] ?? 0);
        $gameId = (int)($_POST['game_id'] ?? 0);

        $owned = $libraryModel->getLibrary((int)$user['id'], $libraryId);
        if (!$owned) {
            $error = 'Geen toegang tot deze library.';
        } else {
            try {
                $libraryModel->addGame($libraryId, $gameId);
                $success = 'Game toegevoegd.';
            } catch (\Throwable $e) {
                $error = 'Toevoegen mislukt. Bestaat de game in de database?';
            }
        }
    }
}

$libraries = $libraryModel->getUserLibraries((int)$user['id']);
$games = $gameModel->all();

?><!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Stoom – Store</title>
  <link rel="stylesheet" href="css/store.css" />
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
        <a href="store.php" class="active">Store</a>
        <a href="library.php">Library</a>
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

<div class="store-layout">
  <aside class="sidebar">
    <div class="filter-group">
      <div class="filter-group-head">
        <span class="filter-group-title">Jouw libraries</span>
      </div>
      <div class="filter-group-body">
        <?php if (count($libraries) === 0): ?>
          <div style="color: var(--muted); font-size: 0.85rem;">
            Je hebt nog geen library. Maak er één aan in <a href="library.php" style="color: var(--gold);">Library</a>.
          </div>
        <?php else: ?>
          <div style="color: var(--muted); font-size: 0.8rem; margin-bottom:0.4rem;">
            Kies een library bij “Add”.
          </div>
        <?php endif; ?>
      </div>
    </div>

    <?php if ($error): ?>
      <div class="filter-group" style="border-color: rgba(255,58,58,0.35);">
        <div class="filter-group-body" style="color: var(--off-white);">
          <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
        </div>
      </div>
    <?php elseif ($success): ?>
      <div class="filter-group" style="border-color: rgba(0,230,118,0.35);">
        <div class="filter-group-body" style="color: var(--off-white);">
          <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?>
        </div>
      </div>
    <?php endif; ?>
  </aside>

  <main class="store-content">
    <div class="sec-head">
      <h2 class="sec-title"><em>Games</em></h2>
      <a href="library.php" class="see-all">Naar Library →</a>
    </div>

    <?php if (count($games) === 0): ?>
      <div style="color: var(--muted);">Geen games gevonden in de database. Vul de `games` tabel.</div>
    <?php else: ?>
      <div class="cards-grid">
        <?php foreach ($games as $g): ?>
          <div class="game-card" style="cursor: default;">
            <div class="card-art ca-1">🎮</div>
            <div class="card-info">
              <div class="card-name"><?= htmlspecialchars($g['title'], ENT_QUOTES, 'UTF-8') ?></div>
              <div class="card-genre">Game #<?= (int)$g['id'] ?></div>
              <div class="card-footer" style="justify-content: flex-end;">
                <?php if (count($libraries) === 0): ?>
                  <a class="see-all" href="library.php">Maak eerst een library</a>
                <?php else: ?>
                  <form method="post" style="margin:0; display:flex; gap:0.5rem; align-items:center;">
                    <input type="hidden" name="action" value="add_to_library" />
                    <input type="hidden" name="game_id" value="<?= (int)$g['id'] ?>" />
                    <select name="library_id" style="background: rgba(6,11,24,0.85); color: var(--off-white); border: 1px solid rgba(255,210,0,0.35); border-radius: 6px; padding: 0.35rem 0.4rem;">
                      <?php foreach ($libraries as $lib): ?>
                        <option value="<?= (int)$lib['id'] ?>"><?= htmlspecialchars($lib['name'], ENT_QUOTES, 'UTF-8') ?></option>
                      <?php endforeach; ?>
                    </select>
                    <button class="btn-filter" type="submit" style="width:auto; padding:0.4rem 0.8rem;">Add</button>
                  </form>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </main>
</div>

</body>
</html>
