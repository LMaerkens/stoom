# stoom

Dit project bevat een frontend en backend voor een website (Stoom).

## Structuur

- `frontend/`: Bevat de HTML, CSS en JavaScript bestanden voor de frontend.
- `backend/`: Bevat de PHP backend voor XAMPP.
  - `public/index.php`: Ingangspunt voor de backend.
  - `src/`: Bevat de bronbestanden (api, config, models).
  - `database/schema.sql`: Database schema voor MySQL/MariaDB.

## Database Installatie

1. Open XAMPP en start Apache en MySQL.
2. Ga naar `http://localhost/phpmyadmin`.
3. Maak een nieuwe database aan genaamd `stoom`.
4. Importeer het bestand `backend/database/schema.sql` in de nieuwe database.

## Gebruik

- **Frontend**: Open `frontend/index.html` in een browser.
- **Backend**: Serveer de `backend/public` map met een PHP server (bijv. via XAMPP).