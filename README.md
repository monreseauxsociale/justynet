# Justy (PHP, MySQL, Bootstrap, JS)

Requirements: PHP 8+, MySQL 8+, Apache (WAMP/XAMPP), Composer (optional).

Setup:
1. Create database `justy`.
2. Import `database/schema.sql` into MySQL.
3. Update `config/config.php` with your DB credentials.
4. Place the project in Apache docroot so that `public/` is the web root.
   - Example Apache DocumentRoot: `.../Justy/public`
5. Ensure `public/.htaccess` has rewrite enabled. If using global `.htaccess`, move the rules to `public/.htaccess`.
6. Visit `/` to open the app. Register and explore.

Notes:
- Upload directories reside under `public/uploads/*` and must be writable by Apache.
- Web notifications require user permission.
- Service worker and manifest provide mobile-like experience.