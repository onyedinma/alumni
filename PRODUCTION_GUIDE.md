# Production Deployment Guide — Namecheap Shared Hosting

Complete step-by-step guide to deploy the FGC Ohafia 2007 Alumni Platform on Namecheap shared hosting.

---

## Table of Contents

1. [Pre-Deployment Checklist](#1-pre-deployment-checklist)
2. [Namecheap cPanel Setup](#2-namecheap-cpanel-setup)
3. [Uploading Files](#3-uploading-files)
4. [Environment Configuration](#4-environment-configuration)
5. [Database Setup](#5-database-setup)
6. [Storage & Symlinks](#6-storage--symlinks)
7. [Cron Jobs](#7-cron-jobs)
8. [SSL Certificate](#8-ssl-certificate)
9. [Payment Gateway Setup](#9-payment-gateway-setup)
10. [Email Configuration](#10-email-configuration)
11. [Post-Deployment Optimization](#11-post-deployment-optimization)
12. [Post-Deployment Testing](#12-post-deployment-testing)
13. [Troubleshooting](#13-troubleshooting)
14. [Maintenance](#14-maintenance)

---

## 1. Pre-Deployment Checklist

### Server Requirements

| Requirement   | Minimum | Recommended |
|--------------|---------|-------------|
| PHP          | 8.1     | 8.2+        |
| MySQL        | 5.7     | 8.0+        |
| Memory       | 1GB     | 2GB+        |
| Storage      | 10GB    | 50GB+       |

### Required PHP Extensions
```
php-mbstring    php-xml       php-curl
php-zip         php-gd        php-mysql
php-bcmath      php-json      php-fileinfo
```

### Files to Exclude from Upload

Do NOT upload these files/folders to the server:

| Exclude          | Reason                       |
|-----------------|------------------------------|
| `node_modules/` | Not needed in production      |
| `.git/`         | Version control history       |
| `.env`          | Contains local dev settings   |
| `tests/`        | Not needed in production      |
| `*.xlsx / *.csv`| Data import files             |
| `.vscode/`      | Editor settings               |

### Files You MUST Upload

| Include             | Reason                         |
|--------------------|--------------------------------|
| `vendor/`          | PHP dependencies (required!)   |
| `public/`          | All public assets              |
| `storage/`         | Required directory structure   |
| `.htaccess` (root) | Rewrites requests to public/   |
| `.env.production.example` | Template for server .env |

---

## 2. Namecheap cPanel Setup

### 2.1 Access cPanel
1. Log in to your Namecheap account
2. Go to **Hosting List** → **Manage**
3. Click **Go to cPanel**

### 2.2 Set PHP Version
1. In cPanel, search for **MultiPHP Manager** or **Select PHP Version**
2. Select your domain
3. Set PHP version to **8.2** (or latest 8.x available)
4. Enable these PHP extensions:
   - `bcmath`, `curl`, `fileinfo`, `gd`, `json`, `mbstring`
   - `mysqli`, `openssl`, `pdo`, `pdo_mysql`
   - `tokenizer`, `xml`, `zip`
   
   > **Note**: If you see `nd_mysqli` skipped as conflicting, that's normal — it conflicts with `mysqli` because both provide the same functionality. You only need `mysqli`.
5. Click **Apply**

### 2.3 Create MySQL Database
1. In cPanel, go to **MySQL Databases**
2. Create a new database (e.g., `yourusername_alumni`)
3. Create a new database user with a strong password
4. **Add the user to the database** with **ALL PRIVILEGES**
5. Note down:
   - Database name: `yourusername_alumni`
   - Database user: `yourusername_dbuser`
   - Database password: (your chosen password)

---

## 3. Uploading Files

### Option A: ZIP Upload via File Manager (Recommended)

1. On your local machine, create a ZIP of the entire project:
   ```
   # Exclude unnecessary files
   # ZIP everything except: node_modules, .git, tests, .env
   ```

2. In cPanel **File Manager**, navigate to `public_html/`
   - If deploying to main domain: upload to `public_html/`
   - If deploying to subdomain: upload to the subdomain's document root

3. Upload the ZIP file
4. Right-click → **Extract** → extract to current directory
5. Delete the ZIP file after extraction

### Option B: FTP Upload

1. In cPanel, go to **FTP Accounts**
2. Use credentials with an FTP client (FileZilla recommended)
3. Upload all files to `public_html/` (or subdomain directory)

### Directory Structure on Server

After upload, your server should look like this:

```
public_html/
├── .htaccess           ← Root .htaccess (rewrites to public/)
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
│   ├── .htaccess       ← Laravel's public .htaccess
│   ├── index.php
│   ├── css/
│   ├── js/
│   ├── assets/
│   └── ...
├── resources/
├── routes/
├── storage/
├── vendor/
├── .env                ← Created from .env.production.example
├── artisan
├── composer.json
└── server.php
```

> **Important**: The root `.htaccess` file handles rewriting requests from `public_html/` to `public/`. This is already configured in the project.

---

## 4. Environment Configuration

### 4.1 Create Production .env

1. Copy `.env.production.example` to `.env` on the server
2. In cPanel **File Manager**, right-click `.env.production.example` → **Copy** → name it `.env`
3. Edit `.env` and fill in your values:

```env
APP_NAME="FGC Ohafia 2007 Alumni"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://yourdomain.com

LOG_CHANNEL=single
LOG_LEVEL=warning

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=yourusername_alumni
DB_USERNAME=yourusername_dbuser
DB_PASSWORD=your_db_password

CACHE_DRIVER=file
QUEUE_CONNECTION=database
SESSION_DRIVER=file
SESSION_LIFETIME=120

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-gmail-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"

STORAGE_DRIVER=public
```

### 4.2 Generate Application Key

Via cPanel **Terminal** (or SSH):
```bash
cd ~/public_html
php artisan key:generate
```

This automatically fills in `APP_KEY` in your `.env` file.

---

## 5. Database Setup

### 5.1 Import Existing Database (if migrating)

If you have an existing database dump:
1. In cPanel, go to **phpMyAdmin**
2. Select your database
3. Click **Import** → choose your `.sql` file
4. Click **Go**

### 5.2 Run Migrations (fresh install)

Via cPanel **Terminal**:
```bash
cd ~/public_html
php artisan migrate --force
php artisan db:seed --force    # Only if using seeders
```

### 5.3 Important Migrations

| Migration | Purpose |
|-----------|---------|
| `add_checkin_to_event_tickets` | Event QR check-in |
| `add_alumni_id_to_users` | Alumni ID cards |
| `create_hall_of_fame_table` | Hall of Fame |
| `create_in_memoriam_table` | In Memoriam |
| `create_business_directory_table` | Business Directory |
| `create_bank_transfers_table` | Bank transfers |
| `create_annual_dues_table` | Annual dues |
| `create_history_timelines_table` | Our History timeline |

---

## 6. Storage & Symlinks

### 6.1 Create Storage Symlink

Laravel needs a symlink from `public/storage` to `storage/app/public`.

Via cPanel **Terminal**:
```bash
cd ~/public_html
php artisan storage:link
```

If `php artisan storage:link` fails on shared hosting, create it manually:
```bash
cd ~/public_html/public
ln -s ../storage/app/public storage
```

### 6.2 Set File Permissions

```bash
cd ~/public_html
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

---

## 7. Cron Jobs

### 7.1 Set Up Laravel Scheduler

1. In cPanel, go to **Cron Jobs**
2. Set **Common Settings** to "Once Per Minute"
3. Add this command:

```
cd /home/yourusername/public_html && php artisan schedule:run >> /dev/null 2>&1
```

> **Note**: Replace `yourusername` with your actual cPanel username.

### 7.2 Scheduled Commands

| Command | Schedule | Purpose |
|---------|----------|---------|
| `birthdays:send-wishes` | Daily 6:00 AM | Birthday posts + notifications |
| `rates:update` | Daily 1:00 AM | Exchange rate updates |

### 7.3 Verify Scheduler

```bash
cd ~/public_html
php artisan schedule:list
```

---

## 8. SSL Certificate

### 8.1 Enable Free SSL

1. In cPanel, go to **SSL/TLS Status** or **AutoSSL**
2. Click **Run AutoSSL** for your domain
3. Wait for certificate installation (may take a few minutes)

### 8.2 Force HTTPS

The application already uses URL helper functions that respect `APP_URL`. Make sure your `.env` has:
```
APP_URL=https://yourdomain.com
```

To force HTTPS via .htaccess, the root `.htaccess` can be updated to include:
```apache
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

---

## 9. Payment Gateway Setup

### 9.1 Paystack

1. Login to [Paystack Dashboard](https://dashboard.paystack.com)
2. Go to **Settings → API Keys & Webhooks**
3. Copy **Live** Public Key and Secret Key
4. In the Alumni admin panel: **Settings → Payment Gateways → Paystack**
5. Enter keys, set to **Live** mode, and **Active** status

**Webhook Setup:**

| Setting | Value |
|---------|-------|
| Webhook URL | `https://yourdomain.com/webhook/paystack` |
| Events | `charge.success`, `charge.failed` |

### 9.2 Flutterwave

| Setting | Value |
|---------|-------|
| Webhook URL | `https://yourdomain.com/webhook/flutterwave` |
| Secret Hash | Match your app's encryption key |

### 9.3 Stripe

| Setting | Value |
|---------|-------|
| Webhook URL | `https://yourdomain.com/webhook/stripe` |
| Events | `payment_intent.succeeded`, `payment_intent.payment_failed`, `checkout.session.completed` |
| .env entry | `STRIPE_WEBHOOK_SECRET=whsec_xxxxx` |

---

## 10. Email Configuration

### Gmail SMTP Setup

1. Enable **2-Factor Authentication** on your Google account
2. Go to Google Account → **Security → App Passwords**
3. Generate a new app password for "Mail"
4. Use this app password in `.env` as `MAIL_PASSWORD`

### Test Email

```bash
cd ~/public_html
php artisan tinker
>>> Mail::raw('Test email from Alumni Platform', fn($m) => $m->to('your@email.com'));
```

### Features Using Email
- Birthday notifications
- Bank transfer status updates
- Password reset
- Email verification
- Contact form submissions

---

## 11. Post-Deployment Optimization

Run these commands to optimize the application for production:

```bash
cd ~/public_html

# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# General optimization
php artisan optimize
```

### Clear Caches (if needed after updates)

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear
```

---

## 12. Post-Deployment Testing

### Quick Test Checklist

| # | Feature | URL / Action | Expected | ✓ |
|---|---------|-------------|----------|---|
| 1 | Homepage | `/` | Loads with navigation, hero | ☐ |
| 2 | Our History | `/our-history` | Timeline displays | ☐ |
| 3 | Alumni List | `/all-alumni` | Shows alumni cards | ☐ |
| 4 | Registration | `/register` | Form works | ☐ |
| 5 | Login | `/login` | Admin/user login works | ☐ |
| 6 | Events | `/all-event` | Events list loads | ☐ |
| 7 | News | `/our-news` | News articles load | ☐ |
| 8 | Donations | `/donate` | Donation flow works | ☐ |
| 9 | Hall of Fame | `/hall-of-fame` | Displays correctly | ☐ |
| 10 | In Memoriam | `/in-memoriam` | Displays correctly | ☐ |
| 11 | Admin Panel | `/admin/dashboard` | Admin features work | ☐ |
| 12 | Image Uploads | Upload profile picture | File saves correctly | ☐ |
| 13 | Payment Test | Complete a ₦50 test | Paystack redirect + verify | ☐ |
| 14 | Email Test | Trigger a notification | Email received | ☐ |

### Artisan Test Commands

```bash
# Test birthday command
php artisan birthdays:send-wishes

# Test exchange rate update
php artisan rates:update

# List scheduled tasks
php artisan schedule:list

# Check storage link
ls -la public/storage
```

---

## 13. Troubleshooting

### Common Issues

| Issue | Solution |
|-------|----------|
| **500 Internal Server Error** | Check `storage/logs/laravel.log`. Ensure `APP_DEBUG=false` but `LOG_LEVEL=debug` temporarily |
| **Page not found (404)** | Verify `.htaccess` files exist (both root and `public/`). Check `php artisan route:list` |
| **CSS/JS not loading** | Run `php artisan storage:link`. Check `APP_URL` in `.env` |
| **Database connection error** | Verify DB credentials in `.env`. Check cPanel MySQL user privileges |
| **Permission denied** | Run `chmod -R 775 storage bootstrap/cache` |
| **Session/login issues** | Run `php artisan config:clear` then `php artisan config:cache` |
| **Blank pages** | Enable `APP_DEBUG=true` temporarily to see errors |
| **Upload failures** | Check `upload_max_filesize` and `post_max_size` in PHP settings (cPanel → MultiPHP INI Editor) |
| **Cron not running** | Verify the cron command path. Test with: `php ~/public_html/artisan schedule:list` |

### Viewing Logs

```bash
# View latest error
tail -50 ~/public_html/storage/logs/laravel.log

# Search for specific errors
grep -i "error" ~/public_html/storage/logs/laravel.log | tail -20
```

---

## 14. Maintenance

### Regular Tasks

| Task | Frequency | How |
|------|-----------|-----|
| Database backup | Daily/Weekly | cPanel → Backup Wizard |
| Clear old logs | Weekly | Delete old files in `storage/logs/` |
| Update exchange rates | Automatic | Via cron scheduler |
| Check disk usage | Monthly | cPanel → Disk Usage |

### Updating the Application

When deploying updates:

1. Upload changed files via FTP or File Manager
2. Run migrations (if any):
   ```bash
   php artisan migrate --force
   ```
3. Clear and rebuild caches:
   ```bash
   php artisan optimize:clear
   php artisan optimize
   ```

### Security Reminders

- [ ] `APP_DEBUG` is set to `false`
- [ ] `APP_ENV` is set to `production`
- [ ] SSL certificate is active (HTTPS)
- [ ] Default admin password has been changed
- [ ] Database password is strong
- [ ] Regular database backups are configured

---

**Document Version**: 2.0
**Last Updated**: February 2026
**Platform**: FGC Ohafia 2007 Alumni Platform
**Hosting**: Namecheap Shared Hosting (cPanel)
