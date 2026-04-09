<?php
// Frontend homepage (PHP). API is verplaatst naar api.php.
require __DIR__ . '/_bootstrap.php';
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
      <!-- Slide 1 -->
      <div class="slide active">
        <div class="slide-bg s1">
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
          <div class="slide-badge">🔥 Uitgelicht</div>
          <div class="slide-title">Cyber Horizon<br>Zero Dawn</div>
          <div class="slide-sub">Action RPG &nbsp;·&nbsp; PC &nbsp;·&nbsp; 2024</div>
          <div class="slide-price-row">
            <span class="price-old">€59,99</span>
            <span class="price-new">€39,99</span>
            <span class="price-badge">-33%</span>
          </div>
          <a href="#" class="btn-buy">🛒 Nu Kopen</a>
          <a href="#" class="btn-secondary">Meer info</a>
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="slide">
        <div class="slide-bg s2">
          <svg class="slide-deco" width="400" height="400" viewBox="0 0 400 400">
            <polygon points="200,20 380,200 200,380 20,200" stroke="#ff4444" stroke-width="1.5" fill="none"/>
            <polygon points="200,60 340,200 200,340 60,200" stroke="#ff8888" stroke-width="1" fill="none" opacity="0.5"/>
            <circle cx="200" cy="200" r="40" fill="#3a0a0a" stroke="#ff4444" stroke-width="1.5"/>
            <circle cx="200" cy="200" r="18" fill="#cc0000" opacity="0.6"/>
          </svg>
        </div>
        <div class="slide-overlay"></div>
        <div class="slide-content">
          <div class="slide-badge" style="background:#ff4444;color:#fff">⚔️ Bestseller</div>
          <div class="slide-title">Dark Realm<br>Chronicles</div>
          <div class="slide-sub">Fantasy RPG &nbsp;·&nbsp; PC / Console &nbsp;·&nbsp; 2023</div>
          <div class="slide-price-row"><span class="price-new">€29,99</span></div>
          <a href="#" class="btn-buy" style="background:#ff4444;box-shadow:0 4px 24px rgba(255,68,68,0.45)">🛒 Bekijk Game</a>
          <a href="#" class="btn-secondary">Meer info</a>
        </div>
      </div>

      <!-- Slide 3 -->
      <div class="slide">
        <div class="slide-bg s3">
          <svg class="slide-deco" width="400" height="400" viewBox="0 0 400 400">
            <circle cx="200" cy="200" r="170" stroke="#00e676" stroke-width="1.5" fill="none" opacity="0.5"/>
            <rect x="80" y="80" width="240" height="240" rx="35" stroke="#00e676" stroke-width="1" fill="none"/>
            <circle cx="200" cy="200" r="55" fill="#0a2a0a" stroke="#00e676" stroke-width="1.5"/>
            <circle cx="200" cy="200" r="24" fill="#00c060" opacity="0.5"/>
          </svg>
        </div>
        <div class="slide-overlay"></div>
        <div class="slide-content">
          <div class="slide-badge" style="background:#00c060;color:#fff">🎮 Gratis te Spelen</div>
          <div class="slide-title">Forest<br>Legends Online</div>
          <div class="slide-sub">MMO &nbsp;·&nbsp; PC &nbsp;·&nbsp; Free to Play</div>
          <div class="slide-price-row">
            <span class="price-new" style="color:#00e676;text-shadow:0 0 22px rgba(0,230,118,0.45)">Gratis</span>
          </div>
          <a href="#" class="btn-buy" style="background:#00c060;box-shadow:0 4px 24px rgba(0,192,96,0.45)">▶ Speel Nu</a>
          <a href="#" class="btn-secondary">Meer info</a>
        </div>
      </div>
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
  <div class="game-grid">
    <a href="#" class="game-card" data-genres="Sci-Fi, Actie">
      <div class="card-art ca-1">🚀</div>
      <div class="card-info">
        <div class="card-name">Stellar Drift</div>
        <div class="card-genre">Sci-Fi · Actie</div>
        <div class="card-footer"><span class="card-price">€19,99</span><span class="card-disc">-40%</span></div>
      </div>
    </a>
    <a href="#" class="game-card" data-genres="Horror, Survival">
      <div class="card-art ca-2">🧟</div>
      <div class="card-info">
        <div class="card-name">Dead Sector</div>
        <div class="card-genre">Horror · Survival</div>
        <div class="card-footer"><span class="card-price">€24,99</span></div>
      </div>
    </a>
    <a href="#" class="game-card" data-genres="Indie, Simulatie">
      <div class="card-art ca-3">🌿</div>
      <div class="card-info">
        <div class="card-name">Verdant Valley</div>
        <div class="card-genre">Indie · Simulatie</div>
        <div class="card-footer"><span class="card-price free">Gratis</span></div>
      </div>
    </a>
    <a href="#" class="game-card" data-genres="Strategie, RPG">
      <div class="card-art ca-4">⚔️</div>
      <div class="card-info">
        <div class="card-name">Iron Kingdoms</div>
        <div class="card-genre">Strategie · RPG</div>
        <div class="card-footer"><span class="card-price">€34,99</span><span class="card-disc">-20%</span></div>
      </div>
    </a>
    <a href="#" class="game-card" data-genres="Racing, Sport">
      <div class="card-art ca-5">🏎️</div>
      <div class="card-info">
        <div class="card-name">Turbo Circuit</div>
        <div class="card-genre">Racing · Sport</div>
        <div class="card-footer"><span class="card-price">€14,99</span></div>
      </div>
    </a>
    <a href="#" class="game-card" data-genres="Fantasy, RPG">
      <div class="card-art ca-6">🔮</div>
      <div class="card-info">
        <div class="card-name">Arcane Depths</div>
        <div class="card-genre">Fantasy · RPG</div>
        <div class="card-footer"><span class="card-price">€29,99</span><span class="card-disc">-15%</span></div>
      </div>
    </a>
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
