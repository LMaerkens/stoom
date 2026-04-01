const slides = document.querySelectorAll('.slide');
const dots   = document.querySelectorAll('.dot');
let cur = 0;

function goTo(n) {
  slides[cur].classList.remove('active');
  dots[cur].classList.remove('active');
  cur = (n + slides.length) % slides.length;
  slides[cur].classList.add('active');
  dots[cur].classList.add('active');
}

document.getElementById('prevBtn').addEventListener('click', () => goTo(cur - 1));
document.getElementById('nextBtn').addEventListener('click', () => goTo(cur + 1));

dots.forEach(d => d.addEventListener('click', () => goTo(+d.dataset.i)));
setInterval(() => goTo(cur + 1), 5000);

const gameCards = document.querySelectorAll('.game-card[data-genres]');

document.querySelectorAll('.chip').forEach(chip => {
  chip.addEventListener('click', () => {
    document.querySelectorAll('.chip').forEach(c => c.classList.remove('active'));
    chip.classList.add('active');
    const genre = chip.textContent.trim();

    gameCards.forEach(card => {
      if (genre === 'Alle') {
        card.style.display = '';
        return;
      }

      const genres = card.dataset.genres.split(',').map(g => g.trim().toLowerCase());
      card.style.display = genres.includes(genre.toLowerCase()) ? '' : 'none';
    });
  });
});

document.getElementById('refreshBtn').addEventListener('click', function () {
  this.style.transition = 'transform 0.55s ease';
  this.style.transform  = 'rotate(360deg)';
  setTimeout(() => { this.style.transform = 'rotate(0deg)'; }, 600);
});