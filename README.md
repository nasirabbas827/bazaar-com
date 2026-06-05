# Bazaar.com_final  

A lightweight e‑commerce prototype built with PHP, featuring a product catalog, shopping cart, and email notifications powered by **PHPMailer**. The repository contains the source code, database schema, and all necessary PHPMailer assets.

---  

## Overview  

`Bazaar.com_final` demonstrates a simple online marketplace where users can browse items, add them to a cart, and place orders. Upon order placement, a confirmation email is sent to the customer using PHPMailer’s SMTP/OAuth capabilities. The project is intended for educational purposes (Fall 2023 CS 619) and can serve as a starting point for more feature‑rich applications.

---  

## Features  

| ✅ | Feature |
|---|---|
| ✔️ | **Product Catalog** – List, view, and search items stored in MySQL. |
| ✔️ | **Shopping Cart** – Session‑based cart with add/remove functionality. |
| ✔️ | **Order Processing** – Store orders in the database and generate a summary. |
| ✔️ | **Email Notifications** – Order confirmation sent via PHPMailer (SMTP/OAuth). |
| ✔️ | **Responsive UI** – Basic HTML/CSS layout that works on desktop and mobile. |
| ✔️ | **Database Migration** – `bazaar_db.sql` provides the initial schema and sample data. |

---  

## Tech Stack  

| Component | Description |
|-----------|-------------|
| **PHP 8.x** | Core application logic and server‑side rendering. |
| **MySQL** | Relational database for products, users, and orders. |
| **PHPMailer** | Robust mailing library (included in `PHPMailer/`). |
| **Composer** | Dependency manager for PHPMailer and future packages. |
| **HTML5 / CSS3** | Front‑end markup and styling. |
| **Git** | Version control (this repository). |

---  

## Installation  

1. **Clone the repository**  

   ```bash
   git clone https://github.com/your-username/Bazaar.com_final.git
   cd Bazaar.com_final
   ```

2. **Set up the database**  

   - Create a new MySQL database (e.g., `bazaar_db`).  
   - Import the schema and sample data:  

     ```bash
     mysql -u your_user -p bazaar_db < Database/bazaar_db.sql
     ```

3. **Configure PHP**  

   - Ensure PHP 8.x and the `mysqli` extension are installed.  
   - Copy `config.sample.php` to `config.php` (or create your own) and update the following constants:  

     ```php
     define('DB_HOST', 'localhost');
     define('DB_USER', 'YOUR_DB_USER');
     define('DB_PASS', 'YOUR_DB_PASSWORD');
     define('DB_NAME', 'bazaar_db');

     // PHPMailer SMTP settings
     define('SMTP_HOST', 'smtp.example.com');
     define('SMTP_PORT', 587);
     define('SMTP_USER', 'YOUR_SMTP_USER');
     define('SMTP_PASS', 'YOUR_SMTP_PASSWORD');   // or use OAuth token
     ```

4. **Install PHPMailer via Composer (optional)**  

   PHPMailer is already bundled, but you can manage it with Composer for future updates:

   ```bash
   cd PHPMailer
   composer install
   ```

5. **Set up a web server**  

   - Place the project in your web root (e.g., `htdocs` or `public_html`).  
   - Ensure the server points to