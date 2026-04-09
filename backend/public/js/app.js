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
const searchInput = document.querySelector('.nav-search input');

function applyHomeFilters() {
  const activeChip = document.querySelector('.chip.active');
  const genre = activeChip ? activeChip.textContent.trim().toLowerCase() : 'alle';
  const searchValue = searchInput?.value.trim().toLowerCase() || '';

  gameCards.forEach(card => {
    const cardGenres = card.dataset.genres.toLowerCase().split(',').map(g => g.trim());
    const cardName = card.querySelector('.card-name')?.textContent.toLowerCase() || '';
    const cardGenreText = card.querySelector('.card-genre')?.textContent.toLowerCase() || '';

    const genreMatch = genre === 'alle' || cardGenres.includes(genre);
    const searchMatch = !searchValue || cardName.includes(searchValue) || cardGenreText.includes(searchValue);

    card.style.display = genreMatch && searchMatch ? '' : 'none';
  });
}

document.querySelectorAll('.chip').forEach(chip => {
  chip.addEventListener('click', () => {
    document.querySelectorAll('.chip').forEach(c => c.classList.remove('active'));
    chip.classList.add('active');
    applyHomeFilters();
  });
});

if (searchInput) {
  searchInput.addEventListener('input', applyHomeFilters);
}

document.getElementById('refreshBtn').addEventListener('click', function () {
  this.style.transition = 'transform 0.55s ease';
  this.style.transform  = 'rotate(360deg)';
  setTimeout(() => { this.style.transform = 'rotate(0deg)'; }, 600);
});

applyHomeFilters();