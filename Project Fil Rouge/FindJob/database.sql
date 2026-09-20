-- ==========================================================
-- FindJob V1 - Database Schema
-- Database Name: FindJob_db
-- ==========================================================

CREATE DATABASE IF NOT EXISTS FindJob_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE FindJob_db;

-- ==========================================================
-- TABLE: users
-- ==========================================================

DROP TABLE IF EXISTS offres;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    date_creation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ==========================================================
-- TABLE: offres
-- ==========================================================

CREATE TABLE offres (
    id_offre INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    titre VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    salaire DECIMAL(10, 2),
    type_contrat ENUM('CDI', 'Anapec', 'CDD') NOT NULL,
    localisation VARCHAR(255) NOT NULL,
    date_creation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_publication DATETIME,
    date_expiration DATETIME,
    statut_offre ENUM('Brouillon', 'Publiée', 'Fermée') NOT NULL DEFAULT 'Publiée',
    CONSTRAINT fk_offre_user
        FOREIGN KEY (id_user)
        REFERENCES users(id_user)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ==========================================================
-- INITIAL ADMIN
-- ==========================================================

INSERT INTO users (
    nom,
    prenom,
    email,
    role
)
VALUES (
    'Admin',
    'FindJob',
    'admin@findjob.ma',
    'admin'
);

-- ==========================================================
-- SAMPLE DEMO DATA (Optional starter data for testing)
-- ==========================================================

INSERT INTO users (nom, prenom, email, role) VALUES
('Benali', 'Yassine', 'yassine.benali@example.com', 'user'),
('Alaoui', 'Sara', 'sara.alaoui@example.com', 'user');

INSERT INTO offres (id_user, titre, description, salaire, type_contrat, localisation, date_publication, date_expiration, statut_offre) VALUES
(1, 'Développeur Full Stack PHP/Vue.js', 'Nous recherchons un développeur Full Stack expérimenté pour concevoir et maintenir des applications web modernes.', 12000.00, 'CDI', 'Casablanca', '2026-09-01 10:00:00', '2026-10-15 23:59:59', 'Publiée'),
(1, 'Stagiaire Concepteur Développeur Web', 'Stage pré-embauche pour participer au développement des interfaces utilisateurs et APIs REST.', 3500.00, 'Anapec', 'Rabat', '2026-09-10 09:30:00', '2026-11-01 18:00:00', 'Publiée'),
(1, 'Chef de Projet Digital', 'Gestion de projets web, coordination des équipes techniques et suivi client.', 15000.00, 'CDI', 'Marrakech', '2026-09-12 14:00:00', '2026-10-31 18:00:00', 'Brouillon'),
(1, 'Administrateur Systèmes & Réseaux', 'Maintenance des serveurs Linux, gestion des accès et monitoring de l infrastructure.', 9000.00, 'CDD', 'Tanger', '2026-08-01 08:00:00', '2026-09-01 18:00:00', 'Fermée');
