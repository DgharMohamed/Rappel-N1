CREATE DATABASE FindJob_db;
USE FindJob_db;

CREATE TABLE offres (
    id_offre INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    salaire DECIMAL(10, 2),
    type_contrat ENUM('CDI', 'Anapec', 'CDD') NOT NULL,
    localisation VARCHAR(255) NOT NULL,
    date_creation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_publication DATETIME,
    date_expiration DATETIME,
    statut_offre ENUM('Brouillon', 'Publiée', 'Fermée') NOT NULL DEFAULT 'Publiée'
);
