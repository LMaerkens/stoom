<?php
// Frontend homepage (PHP). API is verplaatst naar api.php.
require __DIR__ . '/_bootstrap.php';

use App\Models\Game;

// Fetch games from DB
$gameModel = new Game();
$games = $gameModel->all();
$featured = array_slice($games, 0, 3); // Top 3 for hero
$popular = array_slice($games, 3, 6); // Next 6 for grid

?><!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Stoom – Game Marketplace</title>
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
        <a href="index.php" class="active">Home</a>
        <a href="store.php">Store</a>
        <a href="library.php">Library</a>
        <a href="contact.php">Contact</a>
      </div>
    </div>

    <div class="nav-search">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#ffd200" stroke-width="2.2">
        <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
      </svg>
      <input type="text" placeholder="Zoek een game…" />
    </div>

    <div class="nav-right">
      <div class="nav-icons">
        <button class="nav-icon-btn" title="Berichten">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
            <polyline points="22,6 12,13 2,6"/>
          </svg>
        </button>
        <button class="nav-icon-btn" title="Winkelwagen">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
          </svg>
          <span class="cart-badge">3</span>
        </button>
      </div>
      <?php if (function_exists('is_logged_in') && is_logged_in()): ?>
        <a href="library.php" class="nav-login">Library</a>
        <a href="logout.php" class="nav-login">Logout</a>
      <?php else: ?>
        <a href="login.php" class="nav-login">Login</a>
      <?php endif; ?>
    </div>
  </div>
</nav>

<!-- HERO -->
<section class="hero">
  <div class="section-eyebrow">
    <span class="eyebrow-text">— Featured games</span>
    <span class="eyebrow-line"></span>
  </div>

  <div class="carousel-wrap">
    <button class="carousel-arrow left" id="prevBtn">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
    </button>

    <div class="carousel-track">
<?php $i = 0; foreach ($featured as $game): ?>
      <!-- Slide <?= $i+1 ?> -->
      <div class="slide<?= $i === 0 ? ' active' : '' ?>">
        <div class="slide-bg s<?= ($i % 3) +1 ?>">
          <svg class="slide-deco" width="400" height="400" viewBox="0 0 400 400">
            <circle cx="200" cy="200" r="180" stroke="#1e90ff" stroke-width="1.5" fill="none"/>
            <circle cx="200" cy="200" r="120" stroke="#ffd200" stroke-width="1" fill="none" opacity="0.5"/>
            <circle cx="200" cy="200" r="55" fill="#0d2060" stroke="#32b4ff" stroke-width="1.5"/>
            <circle cx="200" cy="200" r="28" fill="#1e90ff" opacity="0.45"/>
            <line x1="200" y1="20" x2="200" y2="380" stroke="#1e90ff" stroke-width="0.5" opacity="0.4"/>
            <line x1="20"  y1="200" x2="380" y2="200" stroke="#1e90ff" stroke-width="0.5" opacity="0.4"/>
            <line x1="73"  y1="73"  x2="327" y2="327" stroke="#ffd200" stroke-width="0.5" opacity="0.25"/>
            <line x1="327" y1="73"  x2="73"  y2="327" stroke="#ffd200" stroke-width="0.5" opacity="0.25"/>
          </svg>
        </div>
        <div class="slide-overlay"></div>
        <div class="slide-content">
          <div class="slide-badge">🔥 <?= htmlspecialchars($game['title']) ?></div>
          <div class="slide-title"><?= htmlspecialchars($game['title']) ?><br>Uitgelicht</div>
          <div class="slide-sub">PC &nbsp;·&nbsp; <?= date('Y', strtotime($game['release_date'] ?? 'now')) ?></div>
          <div class="slide-price-row">
            <span class="price-new">€<?= number_format(rand(20,60)/10 * 10, 0, ',', '.') ?></span>
          </div>
          <a href="store.php" class="btn-buy">🛒 Nu Kopen</a>
          <a href="store.php" class="btn-secondary">Meer info</a>
        </div>
      </div>
<?php $i++; endforeach; ?>

    </div>

    <button class="carousel-arrow right" id="nextBtn">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
    </button>
  </div>

  <div class="carousel-dots">
    <button class="dot active" data-i="0"></button>
    <button class="dot" data-i="1"></button>
    <button class="dot" data-i="2"></button>
  </div>
</section>

<!-- GAME GRID -->
<section class="section">
  <div class="sec-head">
    <h2 class="sec-title">Populaire <em>Games</em></h2>
    <a href="#" class="see-all">Alle games →</a>
  </div>
  <div class="filters">
    <span class="filter-label">Filter:</span>
    <button class="chip active">Alle</button>
    <button class="chip">Actie</button>
    <button class="chip">RPG</button>
    <button class="chip">Sport</button>
    <button class="chip">Strategie</button>
    <button class="chip">Indie</button>
  </div>
<?php if (empty($popular)): ?>
      <div style="grid-column: 1/-1; text-align: center; padding: 2rem; color: var(--muted);">
        <h3>Geen games in database</h3>
        <p>Voeg games toe via store.php of database.</p>
      </div>
    <?php else: foreach ($popular as $game): ?>
      <a href="store.php?id=<?= $game['id'] ?>" class="game-card">
        <div class="card-art ca-<?= array_rand([1,2,3,4,5,6]) ?>">🎮</div>
        <div class="card-info">
          <div class="card-name"><?= htmlspecialchars($game['title']) ?></div>
          <div class="card-genre"><?= htmlspecialchars($game['description'] ?? 'Game') ?></div>
          <div class="card-footer">
            <span class="card-price">€<?= number_format(rand(10,50), 2, ',', '.') ?></span>
            <span class="card-disc"><?= rand(0,50) > 30 ? '-' . rand(10,60) . '%' : '' ?></span>
          </div>
        </div>
      </a>
    <?php endforeach; endif; ?>
    </div>

</section>

<div class="divider"><hr/></div>

<footer>
  <div class="foot-logo">⚙ Stoom</div>
  <div class="foot-links">
    <a href="#">Privacy</a>
    <a href="#">Voorwaarden</a>
    <a href="contact.php">Contact</a>
    <a href="#">Support</a>
  </div>
  <div class="foot-copy">© 2026 Stoom — Alle rechten voorbehouden</div>
</footer>

<script src="js/app.js"></script>
</body>
</html>
