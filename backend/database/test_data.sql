-- Test Data for Stoom
-- Populate genres
INSERT IGNORE INTO genres (name) VALUES 
('Action'),
('RPG'),
('Adventure'),
('Simulation'),
('Strategy'),
('Indie'),
('Sports'),
('Puzzle'),
('Racing'),
('Horror');

-- Populate platforms
INSERT IGNORE INTO platforms (name) VALUES 
('PC'),
('PlayStation 5'),
('Xbox Series X'),
('Nintendo Switch'),
('Steam Deck'),
('Mobile');

-- Populate games
INSERT INTO games (title, description, cover_image, release_date) VALUES 
('Elden Ring', 'Rise, Tarnished, and be guided by grace to brandish the power of the Elden Ring and become an Elden Lord in the Lands Between.', 'https://shared.fastly.steamstatic.com/store_apps/1245620/header.jpg', '2022-02-25'),
('The Witcher 3: Wild Hunt', 'The Witcher: Wild Hunt is a story-driven open world RPG set in a visually stunning fantasy universe full of meaningful choices and impactful consequences.', 'https://shared.fastly.steamstatic.com/store_apps/292030/header.jpg', '2015-05-18'),
('Stardew Valley', 'Youve inherited your grandfathers old farm plot in Stardew Valley. Armed with hand-me-down tools and a few coins, you set out to begin your new life.', 'https://shared.fastly.steamstatic.com/store_apps/413150/header.jpg', '2016-02-26'),
('Cyberpunk 2077', 'Cyberpunk 2077 is an open-world, action-adventure RPG set in the megalopolis of Night City, where you play as a cyberpunk mercenary wrapped in a do-or-die fight for survival.', 'https://shared.fastly.steamstatic.com/store_apps/1091500/header.jpg', '2020-12-10'),
('Hades', 'Defy the god of the dead as you hack and slash out of the Underworld in this rogue-like dungeon crawler from the creators of Bastion.', 'https://shared.fastly.steamstatic.com/store_apps/1145360/header.jpg', '2020-09-17'),
('Grand Theft Auto V', 'When a young street hustler, a retired bank robber and a terrifying psychopath find themselves entangled with some of the most frightening and deranged elements of the criminal underworld, the U.S. government and the entertainment industry, they must pull off a series of dangerous heists to survive in a ruthless city in which they can trust nobody, least of all each other.', 'https://shared.fastly.steamstatic.com/store_apps/271590/header.jpg', '2015-04-14'),
('Red Dead Redemption 2', 'Winner of over 175 Game of the Year Awards and recipient of over 250 perfect scores, Red Dead Redemption 2 is an epic tale of honor and loyalty at the dawn of the modern age.', 'https://shared.fastly.steamstatic.com/store_apps/1174180/header.jpg', '2019-12-05'),
('Factorio', 'Factorio is a game in which you build and maintain factories. You will be mining resources, researching technologies, building infrastructure, automating production and fighting enemies.', 'https://shared.fastly.steamstatic.com/store_apps/427520/header.jpg', '2020-08-14'),
('Civilization VI', 'Civilization VI offers new ways to interact with your world: cities now physically expand across the map, active research in technology and culture unlocks new potential, and competing leaders will pursue their own agendas based on their historical traits as you race for one of five ways to achieve victory in the game.', 'https://shared.fastly.steamstatic.com/store_apps/289070/header.jpg', '2016-10-21'),
('Minecraft', 'Explore your own unique world, survive the night, and create anything you can imagine!', 'https://img.itch.zone/aW1hZ2UvNjg3MzgvMzEyOTc0LnBuZw==/347x500/O%2FfB%2B0.png', '2011-11-18');

-- Link Games to Genres
-- Elden Ring: Action, RPG
INSERT INTO game_genres (game_id, genre_id) SELECT id, (SELECT id FROM genres WHERE name = 'Action') FROM games WHERE title = 'Elden Ring';
INSERT INTO game_genres (game_id, genre_id) SELECT id, (SELECT id FROM genres WHERE name = 'RPG') FROM games WHERE title = 'Elden Ring';

-- Witcher 3: RPG, Adventure
INSERT INTO game_genres (game_id, genre_id) SELECT id, (SELECT id FROM genres WHERE name = 'RPG') FROM games WHERE title = 'The Witcher 3: Wild Hunt';
INSERT INTO game_genres (game_id, genre_id) SELECT id, (SELECT id FROM genres WHERE name = 'Adventure') FROM games WHERE title = 'The Witcher 3: Wild Hunt';

-- Stardew Valley: Simulation, Indie
INSERT INTO game_genres (game_id, genre_id) SELECT id, (SELECT id FROM genres WHERE name = 'Simulation') FROM games WHERE title = 'Stardew Valley';
INSERT INTO game_genres (game_id, genre_id) SELECT id, (SELECT id FROM genres WHERE name = 'Indie') FROM games WHERE title = 'Stardew Valley';

-- Cyberpunk 2077: Action, RPG
INSERT INTO game_genres (game_id, genre_id) SELECT id, (SELECT id FROM genres WHERE name = 'Action') FROM games WHERE title = 'Cyberpunk 2077';
INSERT INTO game_genres (game_id, genre_id) SELECT id, (SELECT id FROM genres WHERE name = 'RPG') FROM games WHERE title = 'Cyberpunk 2077';

-- Hades: Action, Indie
INSERT INTO game_genres (game_id, genre_id) SELECT id, (SELECT id FROM genres WHERE name = 'Action') FROM games WHERE title = 'Hades';
INSERT INTO game_genres (game_id, genre_id) SELECT id, (SELECT id FROM genres WHERE name = 'Indie') FROM games WHERE title = 'Hades';

-- Minecraft: Adventure, Simulation
INSERT INTO game_genres (game_id, genre_id) SELECT id, (SELECT id FROM genres WHERE name = 'Adventure') FROM games WHERE title = 'Minecraft';
INSERT INTO game_genres (game_id, genre_id) SELECT id, (SELECT id FROM genres WHERE name = 'Simulation') FROM games WHERE title = 'Minecraft';

-- Link Games to Platforms
-- Elden Ring: PC, PS5, Xbox Series X
INSERT INTO game_platforms (game_id, platform_id) SELECT id, (SELECT id FROM platforms WHERE name = 'PC') FROM games WHERE title = 'Elden Ring';
INSERT INTO game_platforms (game_id, platform_id) SELECT id, (SELECT id FROM platforms WHERE name = 'PlayStation 5') FROM games WHERE title = 'Elden Ring';
INSERT INTO game_platforms (game_id, platform_id) SELECT id, (SELECT id FROM platforms WHERE name = 'Xbox Series X') FROM games WHERE title = 'Elden Ring';

-- Stardew Valley: PC, Switch, Mobile
INSERT INTO game_platforms (game_id, platform_id) SELECT id, (SELECT id FROM platforms WHERE name = 'PC') FROM games WHERE title = 'Stardew Valley';
INSERT INTO game_platforms (game_id, platform_id) SELECT id, (SELECT id FROM platforms WHERE name = 'Nintendo Switch') FROM games WHERE title = 'Stardew Valley';
INSERT INTO game_platforms (game_id, platform_id) SELECT id, (SELECT id FROM platforms WHERE name = 'Mobile') FROM games WHERE title = 'Stardew Valley';

-- Factorio: PC, Switch
INSERT INTO game_platforms (game_id, platform_id) SELECT id, (SELECT id FROM platforms WHERE name = 'PC') FROM games WHERE title = 'Factorio';
INSERT INTO game_platforms (game_id, platform_id) SELECT id, (SELECT id FROM platforms WHERE name = 'Nintendo Switch') FROM games WHERE title = 'Factorio';
