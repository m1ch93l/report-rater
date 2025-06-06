# report-rater
 Simple Rater System for Class Reporter built with HTMX [https://htmx.org/] and PHP [https://www.php.net/]
This project is a simple rater system designed for class reporters to rate and provide feedback on reports. It utilizes HTMX for dynamic content loading, PHP for backend logic, and MySQL for database management. The frontend is styled using Bootstrap for a responsive design.

## Features
- HTMX for dynamic content loading
- PHP for backend logic
- MySQL for database management
- Bootstrap for responsive design

## Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/m1ch93l/report-rater.git
   ```
2. Navigate to the project directory:
   ```bash
   cd report-rater
   ```
3. Set up the database:
   - Create a MySQL database and import the `report-rater.sql` file provided in the project.
4. Configure the database connection:
   - Edit the `database.php` file with your database credentials.

5. Start a local server:
- You can use xampp, wamp, or any other local server setup.
   - Place the project files in the server's root directory (e.g., `htdocs` for XAMPP).
   - Access the application via your web browser at `http://localhost/report-rater`.