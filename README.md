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
   ```sh
   git clone https://github.com/m1ch93l/report-rater.git
   ```
2. Navigate to the project directory:
   ```sh
   cd report-rater
   ```
3. Set up the database:
   - Create a MySQL database and import the `report-rater.sql` file provided in the project.
4. Configure the database connection:
   - Edit the `config/database.php` file with your database credentials.
5. Execute the following commands to install the required dependencies:
   ```sh
   npm install 
   ```
6. Start a local server:
   - You can use xampp or any other local server setup.
   - Place the project files in the server's root directory (e.g., `htdocs` for XAMPP).
   - Access the application via your web browser at `http://localhost/report-rater`.

## Usage
- Navigate to the application in your web browser.
- You will be prompted to log in or register as a user.
   default credentials are:
   - Username: `123`
   - Password: `123`
- You will see a list of reports.
- Click on a report to view its details and provide ratings.
- Use the rating system to give feedback on the report.