-- Supprimer les tables si elles existent déjà (ordre inverse des dépendances)
DROP TABLE IF EXISTS EVALUATIONS;
DROP TABLE IF EXISTS FAVORIS;
DROP TABLE IF EXISTS PRODUITS;
DROP TABLE IF EXISTS CATEGORIES;
DROP TABLE IF EXISTS UTILISATEURS;

-- Création de la table UTILISATEURS
CREATE TABLE UTILISATEURS (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom_utilisateur VARCHAR(50) UNIQUE NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  mot_de_passe_hash VARCHAR(255) NOT NULL,
  prenom VARCHAR(50),
  nom VARCHAR(50),
  telephone VARCHAR(20),
  date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
  date_modification DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  image_profil VARCHAR(255),
  bio TEXT,
  est_admin BOOLEAN DEFAULT FALSE
);

-- Création de la table CATEGORIES
CREATE TABLE CATEGORIES (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(50) NOT NULL,
  icone VARCHAR(50),
  description TEXT
);

-- Création de la table PRODUITS
CREATE TABLE PRODUITS (
  id INT AUTO_INCREMENT PRIMARY KEY,
  utilisateur_id INT NOT NULL,
  categorie_id INT NOT NULL,
  titre VARCHAR(100) NOT NULL,
  description TEXT NOT NULL,
  prix DECIMAL(10,2) NOT NULL,
  etat ENUM('Neuf', 'Comme neuf', 'Très bon état', 'Bon état', 'État moyen') NOT NULL,
  date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
  date_modification DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  est_actif BOOLEAN DEFAULT TRUE,
  est_vendu BOOLEAN DEFAULT FALSE,
  nombre_vues INT DEFAULT 0,
  FOREIGN KEY (utilisateur_id) REFERENCES UTILISATEURS(id) ON DELETE CASCADE,
  FOREIGN KEY (categorie_id) REFERENCES CATEGORIES(id)
);

-- Création de la table FAVORIS
CREATE TABLE FAVORIS (
  id INT AUTO_INCREMENT PRIMARY KEY,
  utilisateur_id INT NOT NULL,
  produit_id INT NOT NULL,
  date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (utilisateur_id) REFERENCES UTILISATEURS(id) ON DELETE CASCADE,
  FOREIGN KEY (produit_id) REFERENCES PRODUITS(id) ON DELETE CASCADE,
  UNIQUE KEY (utilisateur_id, produit_id)
);

-- Création de la table EVALUATIONS
CREATE TABLE EVALUATIONS (
  id INT AUTO_INCREMENT PRIMARY KEY,
  vendeur_id INT NOT NULL,
  acheteur_id INT NOT NULL,
  produit_id INT NOT NULL,
  note INT NOT NULL CHECK (note BETWEEN 1 AND 5),
  commentaire TEXT,
  date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (vendeur_id) REFERENCES UTILISATEURS(id),
  FOREIGN KEY (acheteur_id) REFERENCES UTILISATEURS(id),
  FOREIGN KEY (produit_id) REFERENCES PRODUITS(id) ON DELETE CASCADE,
  UNIQUE KEY (acheteur_id, produit_id)
);

-- Insertion des données pour UTILISATEURS
-- Pour l'utilisateur admin (admin@popbazaar.com) : admin123
-- Pour l'utilisateur bleponge (bob.leponge@exemple.com) : password123
-- Pour l'utilisateur pletoile (patrick.letoile@exemple.com) : password123
INSERT INTO UTILISATEURS (nom_utilisateur, email, mot_de_passe_hash, prenom, nom, telephone, bio, est_admin) VALUES
('admin', 'admin@popbazaar.com', '$2y$10$YCQ5bLQOQh1jKRGiYZNzWeY3SZQXhX4Wpy.nhFyQJtY5sMeqw97eO', 'Admin', 'Système', '514-123-4567', 'Administrateur du site PopBazaar', TRUE),
('bleponge', 'bob.leponge@exemple.com', '$2y$10$XAZ4vH5m5VLLx4QpbUvHR.WbHxgRupI2W5TyvkQbF9LwI5NWnOTI.', 'Bob', 'Leponge', '514-555-1234', 'Passionné de jeux vidéo et collectionneur de figurines', FALSE),
('pletoile', 'patrick.letoile@exemple.com', '$2y$10$OoO5z/NqSc9sFBnOkUqWxeJdcJ1N1XeHZqD/JvZ1X5yYG3f/xZl5K', 'Marie', 'Simard', '438-555-6789', 'Fan de séries TV et de films cultes des années 80-90', FALSE);

-- Insertion des données pour CATEGORIES
INSERT INTO CATEGORIES (nom, icone, description) VALUES
('Jeux vidéo', 'fas fa-gamepad', 'Consoles, jeux, accessoires et goodies'),
('Super-héros', 'fas fa-mask', 'Figurines, comics et objets de collection'),
('Films cultes', 'fas fa-film', 'DVDs, affiches et produits dérivés'),
('Séries TV', 'fas fa-tv', 'Coffrets, vêtements et accessoires');

-- Insertion de données pour PRODUITS - Jeux vidéo (Catégorie 1)
INSERT INTO PRODUITS (utilisateur_id, categorie_id, titre, description, prix, etat) VALUES
(2, 1, 'Nintendo Switch + Zelda BOTW', 'Console Nintendo Switch avec jeu Zelda Breath of the Wild inclus. Très bon état, peu utilisée.', 259.99, 'Très bon état'),
(3, 1, 'PS5 Édition Digitale', 'PlayStation 5 Digitale, comme neuve avec manette et câbles originaux.', 399.99, 'Comme neuf'),
(2, 1, 'Xbox Series X 1TB', 'Console Xbox Series X avec disque dur 1TB et 2 manettes. En parfait état.', 429.99, 'Très bon état'),
(3, 1, 'Collection Mario sur Switch', 'Lot de 5 jeux Mario pour Nintendo Switch incluant Mario Odyssey et Mario Kart 8 Deluxe.', 149.99, 'Bon état'),
(2, 1, 'PlayStation 4 Pro', 'PS4 Pro 1TB avec 2 manettes et 5 jeux. Quelques rayures sur le boitier.', 199.99, 'Bon état'),
(3, 1, 'Nintendo 3DS XL', 'Console Nintendo 3DS XL édition Pokémon avec 3 jeux Pokémon.', 129.99, 'Bon état'),
(2, 1, 'Manette PS5 DualSense', 'Manette sans fil PlayStation 5 DualSense. Quasiment jamais utilisée.', 59.99, 'Comme neuf'),
(3, 1, 'Collection Final Fantasy PS4', 'Collection complète des jeux Final Fantasy disponibles sur PS4.', 179.99, 'Très bon état'),
(2, 1, 'Nintendo Switch Lite Turquoise', 'Console Nintendo Switch Lite couleur turquoise. Parfait état avec pochette de protection.', 149.99, 'Comme neuf'),
(3, 1, 'Gaming PC RTX 3070', 'PC Gamer avec RTX 3070, i7 10700K, 32GB RAM, 1TB SSD', 999.99, 'Neuf'),
(2, 1, 'Oculus Quest 2 128GB', 'Casque VR Oculus Quest 2 avec 128GB de stockage et tous les accessoires.', 249.99, 'Très bon état'),
(3, 1, 'The Legend of Zelda Collection', 'Collection de jeux Zelda pour différentes consoles Nintendo.', 199.99, 'Bon état'),
(2, 1, 'Pokemon Editions Complete', 'Collection complète des éditions Pokemon de la Gameboy Color à la Switch.', 349.99, 'Bon état'),
(3, 1, 'Razer Gaming Mouse et Clavier', 'Ensemble souris et clavier gaming Razer pour PC.', 89.99, 'Très bon état'),
(2, 1, 'Manettes Xbox Série Limitée', 'Collection de manettes Xbox en série limitée.', 149.99, 'Neuf'),
(3, 1, 'PlayStation VR Set Complet', 'PlayStation VR avec caméra et manettes Move.', 179.99, 'Très bon état'),
(2, 1, 'Nintendo GameCube', 'Console GameCube avec 4 manettes et 8 jeux classiques.', 129.99, 'État moyen'),
(3, 1, 'Gaming Headset Logitech', 'Casque gaming sans fil Logitech haut de gamme.', 69.99, 'Comme neuf'),
(2, 1, 'Grand Theft Auto Collection', 'Collection complète de tous les jeux GTA.', 89.99, 'Bon état'),
(3, 1, 'Nintendo Switch Animal Crossing', 'Console Nintendo Switch édition spéciale Animal Crossing.', 279.99, 'Neuf'),
(2, 1, 'Minecraft Collection', 'Collection des différentes éditions de Minecraft.', 39.99, 'Très bon état'),
(3, 1, 'Mass Effect Legendary Edition', 'Mass Effect Legendary Edition pour PS5. Version complète.', 29.99, 'Neuf'),
(2, 1, 'Assassins Creed Collection', 'Tous les jeux Assassins Creed pour PS4/PS5.', 99.99, 'Bon état'),
(3, 1, 'Nintendo 64 avec jeux', 'Console Nintendo 64 vintage avec 6 jeux dont Mario 64 et Zelda.', 139.99, 'État moyen'),
(2, 1, 'The Witcher Collection', 'Collection complète des jeux The Witcher.', 59.99, 'Très bon état'),
(3, 1, 'Steam Deck 512GB', 'Console portable Steam Deck avec 512GB de stockage.', 499.99, 'Comme neuf'),
(2, 1, 'Call of Duty Collection', 'Collection complète de la série Call of Duty.', 149.99, 'Bon état'),
(3, 1, 'PlayStation Classic Mini', 'Console PlayStation Classic Mini avec 20 jeux préinstallés.', 49.99, 'Comme neuf'),
(2, 1, 'The Last of Us Collection', 'The Last of Us 1 et 2 éditions spéciales.', 59.99, 'Neuf'),
(3, 1, 'Nintendo Amiibo Collection', 'Collection de 25 figurines Amiibo Nintendo.', 199.99, 'Très bon état'),
(2, 1, 'Gaming PC RTX 2060', 'PC Gamer avec RTX 2060, i5, 16GB RAM, 500GB SSD', 799.99, 'Bon état'),
(3, 1, 'Xbox One X 1TB', 'Console Xbox One X 1TB avec manette et jeux.', 229.99, 'Bon état'),
(2, 1, 'Final Fantasy VII Remake', 'Final Fantasy VII Remake Deluxe Edition pour PS4.', 39.99, 'Neuf'),
(3, 1, 'Super Mario 3D World', 'Super Mario 3D World + Bowsers Fury pour Switch.', 44.99, 'Comme neuf'),
(2, 1, 'Resident Evil Collection', 'Collection complète des jeux Resident Evil.', 149.99, 'Très bon état'),
(3, 1, 'PlayStation 5 Charging Dock', 'Station de charge officielle pour 2 manettes PS5.', 24.99, 'Neuf'),
(2, 1, 'The Elder Scrolls Collection', 'Collection des jeux Elder Scrolls dont Skyrim édition spéciale.', 79.99, 'Bon état'),
(3, 1, 'Nintendo Pro Controller', 'Manette Pro Controller pour Nintendo Switch.', 59.99, 'Très bon état'),
(2, 1, 'Borderlands Collection', 'Collection complète des jeux Borderlands.', 69.99, 'Comme neuf'),
(3, 1, 'Retro Gaming Console', 'Console rétro avec 500 jeux préinstallés.', 59.99, 'Neuf'),
(2, 1, 'Sega Mega Drive Mini', 'Console Sega Mega Drive Mini avec 42 jeux.', 69.99, 'Comme neuf'),
(3, 1, 'Dark Souls Trilogy', 'Collection Dark Souls Trilogy pour PS4.', 49.99, 'Très bon état'),
(2, 1, 'Mario Kart 8 Deluxe', 'Mario Kart 8 Deluxe pour Nintendo Switch.', 39.99, 'Neuf'),
(3, 1, 'PlayStation 5 Media Remote', 'Télécommande multimédia pour PlayStation 5.', 19.99, 'Neuf'),
(2, 1, 'Cyberpunk 2077 Collectors', 'Édition collector de Cyberpunk 2077 avec figurine.', 99.99, 'Neuf'),
(3, 1, 'Nintendo Game & Watch', 'Collection Game & Watch édition Mario et Zelda.', 39.99, 'Comme neuf'),
(2, 1, 'Metal Gear Solid Collection', 'Collection complète Metal Gear Solid.', 89.99, 'Très bon état'),
(3, 1, 'Animal Crossing New Horizons', 'Animal Crossing New Horizons pour Switch.', 39.99, 'Neuf'),
(2, 1, 'Xbox Elite Controller', 'Manette Xbox Elite Series 2.', 99.99, 'Comme neuf');

-- Insertion de données pour PRODUITS - Super-héros (Catégorie 2)
INSERT INTO PRODUITS (utilisateur_id, categorie_id, titre, description, prix, etat) VALUES
(2, 2, 'Figurine Iron Man Hot Toys', 'Figurine collector Iron Man Mark 50 de Hot Toys, édition limitée. Jamais déballée.', 249.99, 'Neuf'),
(3, 2, 'Collection comics Batman', 'Collection de 15 comics Batman incluant Court of Owls, Dark Knight Returns et plus.', 120.00, 'Bon état'),
(2, 2, 'Casque Iron Man échelle 1:1', 'Réplique officielle du casque Iron Man Mark III, échelle 1:1, avec effets lumineux.', 199.99, 'Neuf'),
(3, 2, 'Figurine Spider-Man Hot Toys', 'Figurine Hot Toys de Spider-Man édition limitée, détails incroyables, hauteur 30 cm.', 280.00, 'Neuf'),
(2, 2, 'LEGO Marvel Avengers Tower', 'Set LEGO Avengers Tower complet avec 8 mini-figurines.', 149.99, 'Comme neuf'),
(3, 2, 'Intégrale comics Spider-Man', 'Intégrale des comics Spider-Man de 2000 à 2010.', 199.99, 'Bon état'),
(2, 2, 'Bouclier Captain America', 'Réplique du bouclier de Captain America taille réelle.', 179.99, 'Très bon état'),
(3, 2, 'Statue Batman Dark Knight', 'Statue collector Batman The Dark Knight Returns.', 249.99, 'Neuf'),
(2, 2, 'Gants Infinity Thanos', 'Réplique des gants Infinity de Thanos, taille réelle avec effets lumineux.', 129.99, 'Comme neuf'),
(3, 2, 'Comics X-Men collection', 'Collection complète des comics X-Men des années 90.', 180.00, 'Bon état'),
(2, 2, 'Costume Deadpool officiel', 'Costume Deadpool officiel Marvel taille L.', 159.99, 'Très bon état'),
(3, 2, 'Figurine Thor Endgame', 'Figurine Thor version Endgame Hot Toys.', 219.99, 'Neuf'),
(2, 2, 'Collection Funko Pop Marvel', 'Collection de 25 Funko Pop Marvel en parfait état.', 299.99, 'Comme neuf'),
(3, 2, 'BD Batman Année Un', 'Edition collector Batman Année Un de Frank Miller.', 49.99, 'Très bon état'),
(2, 2, 'Poster Avengers signé', 'Poster Avengers Endgame signé par Robert Downey Jr.', 499.99, 'Très bon état'),
(3, 2, 'Marteau Thor Mjolnir', 'Réplique du marteau Mjolnir de Thor.', 89.99, 'Neuf'),
(2, 2, 'Masque Black Panther', 'Réplique du masque de Black Panther électronique.', 79.99, 'Comme neuf'),
(3, 2, 'Figurine Wonder Woman', 'Figurine Wonder Woman édition Justice League.', 129.99, 'Neuf'),
(2, 2, 'Collection Marvel Phase 1-3', 'Collection complète des films Marvel Phase 1 à 3 en blu-ray.', 169.99, 'Très bon état'),
(3, 2, 'Comics Walking Dead', 'Collection complète Comics The Walking Dead.', 249.99, 'Bon état'),
(2, 2, 'Figurine Joker Heath Ledger', 'Figurine du Joker version Heath Ledger Hot Toys.', 289.99, 'Neuf'),
(3, 2, 'Casque Star-Lord', 'Réplique du casque de Star-Lord des Gardiens de la Galaxie.', 99.99, 'Comme neuf'),
(2, 2, 'Gant Batman', 'Réplique des gantelets de Batman version Dark Knight.', 59.99, 'Très bon état'),
(3, 2, 'Statue Superman', 'Statue collector Superman en vol, 45cm de hauteur.', 199.99, 'Neuf'),
(2, 2, 'Collection DC Extended Universe', 'Collection complète des films DC Extended Universe en blu-ray.', 129.99, 'Très bon état'),
(3, 2, 'Figurine Hulk Gladiator', 'Figurine Hulk version Gladiateur de Thor Ragnarok.', 149.99, 'Neuf'),
(2, 2, 'T-shirt collection Marvel', 'Collection de 10 t-shirts Marvel officiels taille M.', 99.99, 'Comme neuf'),
(3, 2, 'Intégrale Watchmen', 'Edition collector intégrale Watchmen.', 69.99, 'Très bon état'),
(2, 2, 'Badge SHIELD', 'Réplique du badge du SHIELD version Agents of SHIELD.', 29.99, 'Neuf'),
(3, 2, 'Lego Batman Batmobile', 'Lego Batmobile édition 1989.', 159.99, 'Comme neuf'),
(2, 2, 'Masque Iron Man électronique', 'Masque Iron Man électronique avec effets sonores et lumineux.', 89.99, 'Très bon état'),
(3, 2, 'Ceinture Batman', 'Réplique de la ceinture de Batman avec accessoires.', 69.99, 'Bon état'),
(2, 2, 'Gant Wolverine', 'Réplique des griffes de Wolverine version X-men.', 59.99, 'Neuf'),
(3, 2, 'Statue Joker', 'Statue collector du Joker version Jack Nicholson.', 189.99, 'Comme neuf'),
(2, 2, 'Poster Marvel Infinity War', 'Poster Marvel Infinity War format géant.', 29.99, 'Neuf'),
(3, 2, 'Costume Spider-Man', 'Costume Spider-Man complet haute qualité taille M.', 149.99, 'Très bon état'),
(2, 2, 'Collection Hellboy', 'Collection comics Hellboy édition intégrale.', 119.99, 'Bon état'),
(3, 2, 'Batarang Batman', 'Réplique du Batarang de Batman échelle 1:1.', 49.99, 'Neuf'),
(2, 2, 'Figurine Winter Soldier', 'Figurine Winter Soldier édition Civil War.', 129.99, 'Comme neuf'),
(3, 2, 'BD V pour Vendetta', 'Edition collector V pour Vendetta.', 59.99, 'Très bon état'),
(2, 2, 'Casque Ant-Man', 'Réplique du casque Ant-Man avec effets lumineux.', 79.99, 'Neuf'),
(3, 2, 'Collection Flash', 'Collection complète des comics Flash Rebirth.', 109.99, 'Bon état'),
(2, 2, 'Statue Black Widow', 'Statue Black Widow édition Avengers.', 149.99, 'Neuf'),
(3, 2, 'Boîte Marvel Collector', 'Boîte collector Marvel avec produits exclusifs.', 99.99, 'Comme neuf'),
(2, 2, 'Ceinture utilité Batman', 'Ceinture d\'utilité Batman avec gadgets.', 69.99, 'Très bon état'),
(3, 2, 'Comics Sandman', 'Collection complète des comics Sandman de Neil Gaiman.', 159.99, 'Bon état'),
(2, 2, 'Figurine Doctor Strange', 'Figurine Doctor Strange avec effets lumineux cape.', 129.99, 'Neuf'),
(3, 2, 'Masque Venom', 'Masque Venom avec langue articulée.', 69.99, 'Comme neuf'),
(2, 2, 'BD Sin City', 'Collection complète BD Sin City de Frank Miller.', 89.99, 'Très bon état');

-- Insertion des données pour CATEGORIES
INSERT INTO CATEGORIES (nom, icone, description) VALUES
('Jeux vidéo', 'fas fa-gamepad', 'Consoles, jeux, accessoires et goodies'),
('Super-héros', 'fas fa-mask', 'Figurines, comics et objets de collection'),
('Films cultes', 'fas fa-film', 'DVDs, affiches et produits dérivés'),
('Séries TV', 'fas fa-tv', 'Coffrets, vêtements et accessoires');

-- Insertion de données pour PRODUITS - Jeux vidéo (Catégorie 1)
INSERT INTO PRODUITS (utilisateur_id, categorie_id, titre, description, prix, etat) VALUES
(2, 1, 'Nintendo Switch + Zelda BOTW', 'Console Nintendo Switch avec jeu Zelda Breath of the Wild inclus. Très bon état, peu utilisée.', 259.99, 'Très bon état'),
(3, 1, 'PS5 Édition Digitale', 'PlayStation 5 Digitale, comme neuve avec manette et câbles originaux.', 399.99, 'Comme neuf'),
(2, 1, 'Xbox Series X 1TB', 'Console Xbox Series X avec disque dur 1TB et 2 manettes. En parfait état.', 429.99, 'Très bon état'),
(3, 1, 'Collection Mario sur Switch', 'Lot de 5 jeux Mario pour Nintendo Switch incluant Mario Odyssey et Mario Kart 8 Deluxe.', 149.99, 'Bon état'),
(2, 1, 'PlayStation 4 Pro', 'PS4 Pro 1TB avec 2 manettes et 5 jeux. Quelques rayures sur le boitier.', 199.99, 'Bon état'),
(3, 1, 'Nintendo 3DS XL', 'Console Nintendo 3DS XL édition Pokémon avec 3 jeux Pokémon.', 129.99, 'Bon état'),
(2, 1, 'Manette PS5 DualSense', 'Manette sans fil PlayStation 5 DualSense. Quasiment jamais utilisée.', 59.99, 'Comme neuf'),
(3, 1, 'Collection Final Fantasy PS4', 'Collection complète des jeux Final Fantasy disponibles sur PS4.', 179.99, 'Très bon état'),
(2, 1, 'Nintendo Switch Lite Turquoise', 'Console Nintendo Switch Lite couleur turquoise. Parfait état avec pochette de protection.', 149.99, 'Comme neuf'),
(3, 1, 'Gaming PC RTX 3070', 'PC Gamer avec RTX 3070, i7 10700K, 32GB RAM, 1TB SSD', 999.99, 'Neuf'),
(2, 1, 'Oculus Quest 2 128GB', 'Casque VR Oculus Quest 2 avec 128GB de stockage et tous les accessoires.', 249.99, 'Très bon état'),
(3, 1, 'The Legend of Zelda Collection', 'Collection de jeux Zelda pour différentes consoles Nintendo.', 199.99, 'Bon état'),
(2, 1, 'Pokemon Editions Complete', 'Collection complète des éditions Pokemon de la Gameboy Color à la Switch.', 349.99, 'Bon état'),
(3, 1, 'Razer Gaming Mouse et Clavier', 'Ensemble souris et clavier gaming Razer pour PC.', 89.99, 'Très bon état'),
(2, 1, 'Manettes Xbox Série Limitée', 'Collection de manettes Xbox en série limitée.', 149.99, 'Neuf'),
(3, 1, 'PlayStation VR Set Complet', 'PlayStation VR avec caméra et manettes Move.', 179.99, 'Très bon état'),
(2, 1, 'Nintendo GameCube', 'Console GameCube avec 4 manettes et 8 jeux classiques.', 129.99, 'État moyen'),
(3, 1, 'Gaming Headset Logitech', 'Casque gaming sans fil Logitech haut de gamme.', 69.99, 'Comme neuf'),
(2, 1, 'Grand Theft Auto Collection', 'Collection complète de tous les jeux GTA.', 89.99, 'Bon état'),
(3, 1, 'Nintendo Switch Animal Crossing', 'Console Nintendo Switch édition spéciale Animal Crossing.', 279.99, 'Neuf'),
(2, 1, 'Minecraft Collection', 'Collection des différentes éditions de Minecraft.', 39.99, 'Très bon état'),
(3, 1, 'Mass Effect Legendary Edition', 'Mass Effect Legendary Edition pour PS5. Version complète.', 29.99, 'Neuf'),
(2, 1, 'Assassins Creed Collection', 'Tous les jeux Assassins Creed pour PS4/PS5.', 99.99, 'Bon état'),
(3, 1, 'Nintendo 64 avec jeux', 'Console Nintendo 64 vintage avec 6 jeux dont Mario 64 et Zelda.', 139.99, 'État moyen'),
(2, 1, 'The Witcher Collection', 'Collection complète des jeux The Witcher.', 59.99, 'Très bon état'),
(3, 1, 'Steam Deck 512GB', 'Console portable Steam Deck avec 512GB de stockage.', 499.99, 'Comme neuf'),
(2, 1, 'Call of Duty Collection', 'Collection complète de la série Call of Duty.', 149.99, 'Bon état'),
(3, 1, 'PlayStation Classic Mini', 'Console PlayStation Classic Mini avec 20 jeux préinstallés.', 49.99, 'Comme neuf'),
(2, 1, 'The Last of Us Collection', 'The Last of Us 1 et 2 éditions spéciales.', 59.99, 'Neuf'),
(3, 1, 'Nintendo Amiibo Collection', 'Collection de 25 figurines Amiibo Nintendo.', 199.99, 'Très bon état'),
(2, 1, 'Gaming PC RTX 2060', 'PC Gamer avec RTX 2060, i5, 16GB RAM, 500GB SSD', 799.99, 'Bon état'),
(3, 1, 'Xbox One X 1TB', 'Console Xbox One X 1TB avec manette et jeux.', 229.99, 'Bon état'),
(2, 1, 'Final Fantasy VII Remake', 'Final Fantasy VII Remake Deluxe Edition pour PS4.', 39.99, 'Neuf'),
(3, 1, 'Super Mario 3D World', 'Super Mario 3D World + Bowsers Fury pour Switch.', 44.99, 'Comme neuf'),
(2, 1, 'Resident Evil Collection', 'Collection complète des jeux Resident Evil.', 149.99, 'Très bon état'),
(3, 1, 'PlayStation 5 Charging Dock', 'Station de charge officielle pour 2 manettes PS5.', 24.99, 'Neuf'),
(2, 1, 'The Elder Scrolls Collection', 'Collection des jeux Elder Scrolls dont Skyrim édition spéciale.', 79.99, 'Bon état'),
(3, 1, 'Nintendo Pro Controller', 'Manette Pro Controller pour Nintendo Switch.', 59.99, 'Très bon état'),
(2, 1, 'Borderlands Collection', 'Collection complète des jeux Borderlands.', 69.99, 'Comme neuf'),
(3, 1, 'Retro Gaming Console', 'Console rétro avec 500 jeux préinstallés.', 59.99, 'Neuf'),
(2, 1, 'Sega Mega Drive Mini', 'Console Sega Mega Drive Mini avec 42 jeux.', 69.99, 'Comme neuf'),
(3, 1, 'Dark Souls Trilogy', 'Collection Dark Souls Trilogy pour PS4.', 49.99, 'Très bon état'),
(2, 1, 'Mario Kart 8 Deluxe', 'Mario Kart 8 Deluxe pour Nintendo Switch.', 39.99, 'Neuf'),
(3, 1, 'PlayStation 5 Media Remote', 'Télécommande multimédia pour PlayStation 5.', 19.99, 'Neuf'),
(2, 1, 'Cyberpunk 2077 Collectors', 'Édition collector de Cyberpunk 2077 avec figurine.', 99.99, 'Neuf'),
(3, 1, 'Nintendo Game & Watch', 'Collection Game & Watch édition Mario et Zelda.', 39.99, 'Comme neuf'),
(2, 1, 'Metal Gear Solid Collection', 'Collection complète Metal Gear Solid.', 89.99, 'Très bon état'),
(3, 1, 'Animal Crossing New Horizons', 'Animal Crossing New Horizons pour Switch.', 39.99, 'Neuf'),
(2, 1, 'Xbox Elite Controller', 'Manette Xbox Elite Series 2.', 99.99, 'Comme neuf');

-- Insertion de données pour PRODUITS - Super-héros (Catégorie 2)
INSERT INTO PRODUITS (utilisateur_id, categorie_id, titre, description, prix, etat) VALUES
(2, 2, 'Figurine Iron Man Hot Toys', 'Figurine collector Iron Man Mark 50 de Hot Toys, édition limitée. Jamais déballée.', 249.99, 'Neuf'),
(3, 2, 'Collection comics Batman', 'Collection de 15 comics Batman incluant Court of Owls, Dark Knight Returns et plus.', 120.00, 'Bon état'),
(2, 2, 'Casque Iron Man échelle 1:1', 'Réplique officielle du casque Iron Man Mark III, échelle 1:1, avec effets lumineux.', 199.99, 'Neuf'),
(3, 2, 'Figurine Spider-Man Hot Toys', 'Figurine Hot Toys de Spider-Man édition limitée, détails incroyables, hauteur 30 cm.', 280.00, 'Neuf'),
(2, 2, 'LEGO Marvel Avengers Tower', 'Set LEGO Avengers Tower complet avec 8 mini-figurines.', 149.99, 'Comme neuf'),
(3, 2, 'Intégrale comics Spider-Man', 'Intégrale des comics Spider-Man de 2000 à 2010.', 199.99, 'Bon état'),
(2, 2, 'Bouclier Captain America', 'Réplique du bouclier de Captain America taille réelle.', 179.99, 'Très bon état'),
(3, 2, 'Statue Batman Dark Knight', 'Statue collector Batman The Dark Knight Returns.', 249.99, 'Neuf'),
(2, 2, 'Gants Infinity Thanos', 'Réplique des gants Infinity de Thanos, taille réelle avec effets lumineux.', 129.99, 'Comme neuf'),
(3, 2, 'Comics X-Men collection', 'Collection complète des comics X-Men des années 90.', 180.00, 'Bon état'),
(2, 2, 'Costume Deadpool officiel', 'Costume Deadpool officiel Marvel taille L.', 159.99, 'Très bon état'),
(3, 2, 'Figurine Thor Endgame', 'Figurine Thor version Endgame Hot Toys.', 219.99, 'Neuf'),
(2, 2, 'Collection Funko Pop Marvel', 'Collection de 25 Funko Pop Marvel en parfait état.', 299.99, 'Comme neuf'),
(3, 2, 'BD Batman Année Un', 'Edition collector Batman Année Un de Frank Miller.', 49.99, 'Très bon état'),
(2, 2, 'Poster Avengers signé', 'Poster Avengers Endgame signé par Robert Downey Jr.', 499.99, 'Très bon état'),
(3, 2, 'Marteau Thor Mjolnir', 'Réplique du marteau Mjolnir de Thor.', 89.99, 'Neuf'),
(2, 2, 'Masque Black Panther', 'Réplique du masque de Black Panther électronique.', 79.99, 'Comme neuf'),
(3, 2, 'Figurine Wonder Woman', 'Figurine Wonder Woman édition Justice League.', 129.99, 'Neuf'),
(2, 2, 'Collection Marvel Phase 1-3', 'Collection complète des films Marvel Phase 1 à 3 en blu-ray.', 169.99, 'Très bon état'),
(3, 2, 'Comics Walking Dead', 'Collection complète Comics The Walking Dead.', 249.99, 'Bon état'),
(2, 2, 'Figurine Joker Heath Ledger', 'Figurine du Joker version Heath Ledger Hot Toys.', 289.99, 'Neuf'),
(3, 2, 'Casque Star-Lord', 'Réplique du casque de Star-Lord des Gardiens de la Galaxie.', 99.99, 'Comme neuf'),
(2, 2, 'Gant Batman', 'Réplique des gantelets de Batman version Dark Knight.', 59.99, 'Très bon état'),
(3, 2, 'Statue Superman', 'Statue collector Superman en vol, 45cm de hauteur.', 199.99, 'Neuf'),
(2, 2, 'Collection DC Extended Universe', 'Collection complète des films DC Extended Universe en blu-ray.', 129.99, 'Très bon état'),
(3, 2, 'Figurine Hulk Gladiator', 'Figurine Hulk version Gladiateur de Thor Ragnarok.', 149.99, 'Neuf'),
(2, 2, 'T-shirt collection Marvel', 'Collection de 10 t-shirts Marvel officiels taille M.', 99.99, 'Comme neuf'),
(3, 2, 'Intégrale Watchmen', 'Edition collector intégrale Watchmen.', 69.99, 'Très bon état'),
(2, 2, 'Badge SHIELD', 'Réplique du badge du SHIELD version Agents of SHIELD.', 29.99, 'Neuf'),
(3, 2, 'Lego Batman Batmobile', 'Lego Batmobile édition 1989.', 159.99, 'Comme neuf'),
(2, 2, 'Masque Iron Man électronique', 'Masque Iron Man électronique avec effets sonores et lumineux.', 89.99, 'Très bon état'),
(3, 2, 'Ceinture Batman', 'Réplique de la ceinture de Batman avec accessoires.', 69.99, 'Bon état'),
(2, 2, 'Gant Wolverine', 'Réplique des griffes de Wolverine version X-men.', 59.99, 'Neuf'),
(3, 2, 'Statue Joker', 'Statue collector du Joker version Jack Nicholson.', 189.99, 'Comme neuf'),
(2, 2, 'Poster Marvel Infinity War', 'Poster Marvel Infinity War format géant.', 29.99, 'Neuf'),
(3, 2, 'Costume Spider-Man', 'Costume Spider-Man complet haute qualité taille M.', 149.99, 'Très bon état'),
(2, 2, 'Collection Hellboy', 'Collection comics Hellboy édition intégrale.', 119.99, 'Bon état'),
(3, 2, 'Batarang Batman', 'Réplique du Batarang de Batman échelle 1:1.', 49.99, 'Neuf'),
(2, 2, 'Figurine Winter Soldier', 'Figurine Winter Soldier édition Civil War.', 129.99, 'Comme neuf'),
(3, 2, 'BD V pour Vendetta', 'Edition collector V pour Vendetta.', 59.99, 'Très bon état'),
(2, 2, 'Casque Ant-Man', 'Réplique du casque Ant-Man avec effets lumineux.', 79.99, 'Neuf'),
(3, 2, 'Collection Flash', 'Collection complète des comics Flash Rebirth.', 109.99, 'Bon état'),
(2, 2, 'Statue Black Widow', 'Statue Black Widow édition Avengers.', 149.99, 'Neuf'),
(3, 2, 'Boîte Marvel Collector', 'Boîte collector Marvel avec produits exclusifs.', 99.99, 'Comme neuf'),
(2, 2, 'Ceinture utilité Batman', 'Ceinture d\'utilité Batman avec gadgets.', 69.99, 'Très bon état'),
(3, 2, 'Comics Sandman', 'Collection complète des comics Sandman de Neil Gaiman.', 159.99, 'Bon état'),
(2, 2, 'Figurine Doctor Strange', 'Figurine Doctor Strange avec effets lumineux cape.', 129.99, 'Neuf'),
(3, 2, 'Masque Venom', 'Masque Venom avec langue articulée.', 69.99, 'Comme neuf'),
(2, 2, 'BD Sin City', 'Collection complète BD Sin City de Frank Miller.', 89.99, 'Très bon état');