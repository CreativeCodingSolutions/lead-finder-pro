# Deployment Guide — Lead Finder Pro

## Quick Start (Shared Hosting mit SSH)

### 1. ZIP erstellen und hochladen

```bash
# Lokal:
cd lead-finder-pro
composer install --no-dev --optimize-autoloader
zip -r lead-finder-pro.zip . -x "*.git*" "node_modules/*" "tests/*" ".env"

# Hochladen (via SCP):
scp lead-finder-pro.zip user@your-hosting.de:/var/www/html/

# Auf Server entpacken:
ssh user@your-hosting.de
cd /var/www/html/
unzip lead-finder-pro.zip -d lead-finder-pro
cd lead-finder-pro
```

### 2. .env einrichten

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env`:
```
APP_URL=https://your-domain.de
DB_DATABASE=/home/youruser/leadfinder/database.sqlite
```

### 3. Datenbank

```bash
mkdir -p /home/youruser/leadfinder
touch /home/youruser/leadfinder/database.sqlite
php artisan migrate --seed
```

### 4. Permissions

```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### 5. Apache .htaccess

Bereits in `public/.htaccess` enthalten. Falls `public/` nicht das
Document Root ist, entweder:
- Document Root auf `public/` setzen (empfohlen)
- ODER alle Dateien aus `public/` ins Hauptverzeichnis kopieren

### 6. Fertig!

→ Öffne `https://your-domain.de`
→ Login: `demo@example.com` / `password`

---

## Shared Hosting OHNE SSH (nur FTP/cPanel)

1. ZIP lokal erstellen (ohne `composer install` — das muss auf dem Server laufen)
2. Alle Dateien via FTP hochladen
3. In cPanel → Terminal (falls verfügbar):
   ```bash
   cd ~/public_html/lead-finder-pro
   php -d memory_limit=256M /opt/cpanel/composer/bin/composer install --no-dev
   cp .env.example .env
   php artisan key:generate
   touch storage/database.sqlite
   php artisan migrate --seed
   chmod -R 775 storage bootstrap/cache
   ```
4. Falls kein Terminal: Lade `vendor/` Ordner separat hoch (von einem
   System mit Composer erstellt)

---

## Troubleshooting

| Problem | Lösung |
|---------|--------|
| 500 Error | `storage/logs/laravel.log` prüfen |
| CSS nicht geladen | `APP_URL` in `.env` prüfen |
| DB Error | `storage/database.sqlite` existiert? Beschreibbar? |
| Composer Memory | `php -d memory_limit=512M composer install` |
| .htaccess funktioniert nicht | `mod_rewrite` aktivieren |

---

## Updates

```bash
git pull origin main  # oder ZIP neu hochladen
composer install --no-dev --optimize-autoloader
php artisan migrate
php artisan optimize
```
