# Prompt used to generate this project (FindJob)

Copy the prompt below and give it to an AI to recreate the same project:

---

Create a complete web application called **FindJob** for managing job offers, using plain PHP (no framework) with MySQL via PDO, with a French-language user interface. Requirements:

## 1) Database (database.sql file, database named FindJob_db)

- `users` table:
  - `id_user` INT AUTO_INCREMENT PRIMARY KEY
  - `nom` VARCHAR(100) NOT NULL
  - `prenom` VARCHAR(100) NOT NULL
  - `email` VARCHAR(255) NOT NULL UNIQUE
  - `role` ENUM('admin','user') NOT NULL DEFAULT 'user'
  - `date_creation` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
- `offres` table:
  - `id_offre` INT AUTO_INCREMENT PRIMARY KEY
  - `id_user` INT NOT NULL (foreign key to users(id_user) with ON DELETE CASCADE and ON UPDATE CASCADE)
  - `titre` VARCHAR(255) NOT NULL
  - `description` TEXT NOT NULL
  - `salaire` DECIMAL(10,2) nullable
  - `type_contrat` ENUM('CDI','Anapec','CDD') NOT NULL
  - `localisation` VARCHAR(255) NOT NULL
  - `date_creation` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
  - `date_publication` DATETIME NULL
  - `date_expiration` DATETIME NULL
  - `statut_offre` ENUM('Brouillon','Publiée','Fermée') NOT NULL DEFAULT 'Publiée'
- Insert a default admin user (admin@findjob.ma), regular users, and 4 realistic sample job offers (web developer, internship, project manager, sysadmin).

## 2) Project structure

- `config/database.php` : PDO connection to MySQL (localhost, root) with charset utf8mb4, ERRMODE_EXCEPTION and FETCH_ASSOC
- `includes/header.php`, `includes/sidebar.php`, `includes/footer.php`
- `index.php`, `login.php`, `dashboard.php`
- `users/index.php`, `users/create.php`, `users/edit.php`, `users/delete.php`
- `offres/index.php`, `offres/create.php`, `offres/edit.php`, `offres/delete.php`
- `assets/css/style.css`, `assets/js/script.js`

## 3) Pages and features

- **index.php (public visitor page):** displays offers with status 'Publiée' that are still valid (date_publication <= NOW or NULL, and date_expiration >= NOW or NULL), sorted newest first, in an offer-grid / offer-card layout. Each card shows: a colored badge depending on contract type (CDI / Anapec / CDD), publication date in d/m/Y format, title, description, location, and salary formatted as "12 000,00 DH" or "Salaire à négocier" if empty. Include an offer counter, an "Aucune offre disponible" empty state, and a header with the FindJob logo and an "Espace administration" button linking to login.php.
- **login.php:** login card with a gradient background, FindJob logo, welcome message, and a CONNEXION button that redirects to dashboard.php (simplified V1 version without real authentication).
- **dashboard.php:** admin dashboard with 5 colored stat cards (Total Users, Total Offres, Publiees, Brouillons, Fermees) computed with COUNT queries, a table of the 5 most recent offers with status badges, and a "+ Ajouter une offre" button.
- **users/ (full CRUD):** list table (ID, Nom, Prenom, Email, Role as badge, Date de creation, Modifier / Supprimer buttons), create page and edit page with a form (nom, prenom, email, role) and French validation messages, direct delete via delete.php.
- **offres/ (full CRUD):** list with all fields plus a LEFT JOIN on users to show the offer owner, dates in d/m/Y format, create/edit form with all fields (titre, description, salaire, type_contrat, localisation, date_publication, date_expiration, statut_offre) with input validation, direct delete. Redirect after every operation.

## 4) Design (UI)

- Modern admin dashboard design: fixed dark navy sidebar (#0a192f) containing the FindJob logo (the word "Job" in blue #0077b6), an "Admin" role badge, and links separated by dividers: Dashboard / Users / Offres / Add User / Add Offre.
- Header above the content with a ☰ button to toggle the sidebar on mobile with an overlay, and the username on the right.
- Tables inside content-card blocks and forms inside form-card blocks; btn-primary / btn-cancel / btn-edit / btn-delete buttons; colored badges per contract type and offer status (Publiée green, Brouillon orange, Fermée red); empty states when there is no data; subtle shadows; 8px rounded corners; responsive layout.
- A single `style.css` file for all styles (using CSS variables in :root), and a `script.js` file handling: mobile sidebar toggle, a confirm() dialog before deleting elements with the .confirm-delete class, and highlighting the active sidebar link.

## 5) Technical constraints

- Use Prepared Statements for all queries and htmlspecialchars when displaying any data.
- Redirect with header('Location: ...') after POST operations and deletes.
- Error and validation messages in French.
- No framework or external libraries: PHP + MySQL + CSS + JS only (must run on XAMPP/WAMP).

Give me the complete code for each file, one by one.

---
