create database travel;
USE travel;
CREATE TABLE utilisateurs(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    prenom VARCHAR(150) NOT NULL,
    email VARCHAR(200) UNIQUE NOT NULL,
    
);
CREATE TABLE activite(
    id_activite INT AUTO_INCREMENT PRIMARY KEY, 
    id_user INT,
    vols VARCHAR(150) NOT NULL,
    hotels VARCHAR(150) , NOT NULL,
    circuits_touristiques TEXT ,
    FOREIGN KEY id_user REFFERENCE
);

