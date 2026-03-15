## SDMS – Secure Document Management System

SDMS is a Secure Document Management System built with Laravel.  
It is designed for managing engineering documents with role-based access, document reservation, and supervisor activity reporting.

---

## Features

- **User registration and login**
- **Email OTP multi-factor authentication** for login
- **Single active session per user** (logs out old sessions when a new login happens)
- **Role-based access**:
  - Engineer
  - Manager
  - Supervisor
- **Document management**
  - Upload engineering documents
  - Search and filter documents
  - View document details
  - Download stored files
- **Document reservation and edit flow**
  - Reserve a document for editing (engineer/manager)
  - Prevent conflicts when multiple users try to edit
  - Track last editor
- **Activity logging**
  - Logs key actions like login, upload, download, reserve, release, edit
- **Supervisor activity reports**
  - Supervisor-only page with filters and summary cards

---

## Tools and Technologies Used

- **Laravel** (PHP web framework)
- **PHP**
- **MySQL** (relational database)
- **Composer** (PHP dependency manager)
- **Node.js & npm** (for frontend build tooling if needed)
- **Bootstrap** (frontend UI framework)
- **Bootstrap Icons**
- **Mailtrap** (for testing email OTP in development)

---

## Important Shared Project Note

To keep the shared project size small, the following folders were **intentionally removed** before sharing:

- `vendor/` (Laravel + PHP dependencies installed via Composer)
- `node_modules/` (Node/NPM frontend dependencies)

These folders will be **recreated automatically** when you run:

```bash
composer install
npm install (optional - currently not needed for this project)
```

If you open the project and see errors like “Class not found” or missing JS/CSS, it usually means `vendor/` or `node_modules/` still need to be installed.

---

## Requirements

Make sure you have these installed:

- **PHP** (version supported by your Laravel install, e.g. PHP 8.1+)
- **Composer**
- **MySQL** (or MariaDB) database server
- **Node.js and npm**
- **Git** (optional but recommended)
- **A Mailtrap account** (for testing OTP emails)

You do **not** need to install Laravel globally; it comes via Composer inside the project.

---

## Installation Steps

Follow these steps on a fresh machine or after downloading the project.

### 1. Clone or copy the project

```bash
git clone <your-sdms-repo-url> sdms
cd sdms
```

If you received a `.zip`:

1. Extract in htdocs folder of xampp.
2. Open a terminal in the extracted project folder.

### 2. Install PHP dependencies

```bash
composer install
```

This recreates the `vendor/` directory.

### 3. Install Node.js dependencies (optional but recommended)

```bash
npm install
```

This recreates the `node_modules/` directory and installs frontend tooling.

### 5. Generate application key for `.env` file

```bash
php artisan key:generate
```

This sets `APP_KEY` in `.env`.

### 6. Configure database and `.env` (including Mailtrap)

In this step you will (1) prepare the database, (2) import the SQL if you have it, and (3) configure `.env` for both database and Mailtrap.

1. **Create a MySQL database**
   - Example name: `sdms_db` (you can choose another name if you like).
   - You can create it using phpMyAdmin or the MySQL command line.

2. **(Optional) Import SQL file using phpMyAdmin**
   - If you have a provided SQL export for SDMS:
     - Open phpMyAdmin.
     - Select the database you just created.
     - Use the **Import** tab and upload the SQL file.
   - If you do not have a SQL file, just rely on `php artisan migrate` to create the tables.

3. **Update `.env` with application, database, and Mailtrap settings**

   Example application and URL:

   ```env
   APP_NAME="sdms_project"
   APP_ENV=local
   APP_KEY=base64:generated-by-artisan
   APP_DEBUG=true
   APP_URL=http://127.0.0.1:8000
   ```

   Example database section (adjust to match your local MySQL setup):

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=sdms_project
   DB_USERNAME=root
   DB_PASSWORD=your_mysql_password_here
   ```

   Example Mailtrap SMTP settings for OTP emails:

   ```env
   MAIL_MAILER=smtp
   MAIL_HOST=sandbox.smtp.mailtrap.io
   MAIL_PORT=2525
   MAIL_USERNAME=your_mailtrap_username
   MAIL_PASSWORD=your_mailtrap_password
   MAIL_ENCRYPTION=null
   MAIL_FROM_ADDRESS=your_test_email@example.com
   MAIL_FROM_NAME="${APP_NAME}"
   ```

   - Mailtrap is recommended for **development and testing** of OTP emails.
   - For real deployments you could switch to Gmail SMTP or another provider.

4. **Run database migrations (only if you did not import a full SQL dump)**

   ```bash
   php artisan migrate
   ```

5. **(Optional) Storage symlink**

   If documents are stored in `storage/app` and you want them accessible via the browser:

   ```bash
   php artisan storage:link
   ```

6. **Build frontend assets (optional but recommended)**

   ```bash
   npm run dev
   ```

   If the project does not rely heavily on compiled assets, this step might only be needed once.

---

## How to Set Up Mailtrap Sandbox (for OTP emails)

1. **Create a Mailtrap account**
   - Go to `https://mailtrap.io` and sign up for a free account.

2. **Log in and open Email Testing**
   - After logging in, go to the **Email Testing** section.

3. **Create or open a sandbox inbox**
   - You can use the default inbox or create a new one named like “SDMS OTP”.

4. **Copy SMTP credentials**
   - Inside the inbox, look for SMTP settings.
   - Select the **Laravel / PHP** integration if available, or just copy:
     - host
     - port
     - username
     - password

5. **Paste credentials into `.env`**
   - Update the `MAIL_*` values shown above using the Mailtrap values.

6. **Test OTP**
   - Start the app with `php artisan serve`.
   - Go to the login page and sign in using a demo account (see below).
   - When the system sends an OTP email, it will appear in your Mailtrap inbox.
   - Open the message in Mailtrap, copy the OTP code, and paste it into the OTP screen in SDMS.

This approach avoids sending real emails and keeps everything safe for testing.

---

## Demo Accounts

These demo accounts are useful for quickly testing the roles and flows:

- **Engineer**
  - Email: `engineer@gmail.com`
  - Password: `12345678`
- **Manager**
  - Email: `manager@gmail.com`
  - Password: `12345678`
- **Supervisor**
  - Email: `supervisor@gmail.com`
  - Password: `12345678`

Notes:

- After entering email and password, the system will send an **OTP email**.
- Open the corresponding Mailtrap inbox, find the OTP, and enter it on the OTP verification screen.

---

## Running the Project

To run SDMS after installation:

```bash
php artisan serve
```

Then open your browser at:

```text
http://127.0.0.1:8000
```

Log in using one of the demo accounts listed above.

---

## Common Troubleshooting

- **Missing `vendor/`**
  - Run:
    ```bash
    composer install
    ```

- **Missing `node_modules/` or frontend build errors**
  - Run:
    ```bash
    npm install
    npm run dev
    ```

- **Blank page or strange errors after changing `.env`**
  - Clear caches and config:
    ```bash
    php artisan optimize:clear
    ```

- **OTP email not arriving**
  - Check `.env` `MAIL_*` settings.
  - Confirm you copied the correct Mailtrap host/port/username/password.
  - Make sure Mailtrap inbox is open in Email Testing, not in a different project.

- **OTP email sent but not visible**
  - Refresh your Mailtrap inbox.
  - Confirm you are looking at the correct inbox used by the SMTP credentials.

- **Uploaded documents not accessible**
  - Make sure the storage symlink exists:
    ```bash
    php artisan storage:link
    ```

---
