
CREATE DATABASE travel;
USE travel;

CREATE TABLE utilisateurs(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    prenom VARCHAR(150) NOT NULL,
    password VARCHAR(200) NOT NULL,
    email VARCHAR(200) UNIQUE NOT NULL
);

CREATE TABLE activite(
    id_activite INT AUTO_INCREMENT PRIMARY KEY,
    vols VARCHAR(150) NOT NULL,
    hotels VARCHAR(150) NOT NULL,
    circuits_touristiques TEXT,
    titre VARCHAR(150) NOT NULL,
    prix DECIMAL(10,2),
    date_debut DATE,
    date_fin DATE
);

CREATE TABLE reservation(
    id_reservation INT AUTO_INCREMENT PRIMARY KEY,
    id_client INT NOT NULL,
    id_activite INT NOT NULL,
    status ENUM('en attente', 'confirmer', 'annuler') DEFAULT 'en attente',
    FOREIGN KEY (id_client) REFERENCES utilisateurs(id) ON DELETE CASCADE,
    FOREIGN KEY (id_activite) REFERENCES activite(id_activite) ON DELETE CASCADE
);

CREATE TABLE roles(
    id_role INT AUTO_INCREMENT PRIMARY KEY,
    id_client INT NOT NULL,
    role ENUM('admin', 'user') NOT NULL,
    FOREIGN KEY (id_client) REFERENCES utilisateurs(id) ON DELETE CASCADE
);

INSERT INTO reservation (id_client, id_activite, status) 
VALUES 
(1, 2, 'en attente'),
(2, 3, 'confirmer'),
(3, 1, 'annuler'),
(4, 2, 'confirmer'),
(1, 3, 'en attente');
INSERT INTO utilisateurs (nom, prenom, password, email)
VALUES
    ('Dupont', 'Jean', SHA2('password123', 256), 'jean.dupont@example.com'),
    ('Durand', 'Claire', SHA2('securePass456', 256), 'claire.durand@example.com'),
    ('Martin', 'Paul', SHA2('hashedPass789', 256), 'paul.martin@example.com'),
    ('Lemoine', 'Sophie', SHA2('randomPass101', 256), 'sophie.lemoine@example.com'),
    ('Moreau', 'Alice', SHA2('strongPass202', 256), 'alice.moreau@example.com');
INSERT INTO activite (vols, hotels, circuits_touristiques, titre, prix, date_debut, date_fin)
VALUES
    ('Vol Paris-Dubai', 'Hotel Burj Al Arab', 'Tour des Dunes', 'Séjour à Dubaï', 2500.00, '2024-01-15', '2024-01-22'),
    ('Vol Paris-New York', 'Hotel Plaza', 'Visite des Musées', 'City Break à New York', 3200.00, '2024-02-10', '2024-02-20'),
    ('Vol Casablanca-Marrakech', 'Riad Luxueux', 'Circuit Désert', 'Découverte du Maroc', 1500.00, '2024-03-01', '2024-03-10'),
    ('Vol Tokyo-Kyoto', 'Hotel Sakura', 'Visite des Temples', 'Voyage au Japon', 4500.00, '2024-04-05', '2024-04-18'),
    ('Vol Rome-Florence', 'Hotel Renaissance', 'Circuit Gastronomique', 'Découverte de l’Italie', 2700.00, '2024-05-10', '2024-05-20');
