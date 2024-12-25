

CREATE DATABASE travel;
USE travel;

CREATE TABLE utilisateurs(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    prenom VARCHAR(150) NOT NULL,
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
    id_reservation INT(11) AUTO_INCREMENT PRIMARY KEY,
    id_client INT(11),
    id_activite INT(11) NOT NULL,
    date_reservation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('en attente', 'confirmer', 'annuler') DEFAULT 'en attente',
    FOREIGN KEY (id_client) REFERENCES utilisateurs(id),
    FOREIGN KEY (id_activite) REFERENCES activite(id_activite)
);
CREATE TABLE user_reservation(
    id_reservation INT(11) AUTO_INCREMENT PRIMARY KEY,
    id_client INT(11),
    id_reservation INT(11),
    FOREIGN KEY (id_client) REFERENCES utilisateurs(id),
    FOREIGN KEY (id_reservation) REFERENCES reservation(id_reservation)
);

CREATE TABLE roles(
    id_role INT AUTO_INCREMENT PRIMARY KEY,
    id_client INT,
    FOREIGN KEY (id_client) REFERENCES utilisateurs(id),
    role ENUM('admin', 'user')
);

