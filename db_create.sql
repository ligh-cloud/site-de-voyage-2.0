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