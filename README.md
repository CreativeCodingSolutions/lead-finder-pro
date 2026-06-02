# Lead Finder Pro — Micro-SaaS für Lead-Generierung

**Automatisch Leads finden. Filtern. Validieren. Exportieren.**

Lead Finder Pro ist ein Laravel-basiertes Micro-SaaS Tool, das Unternehmern und Freelancern hilft, qualifizierte Geschäftskontakte aus OpenStreetMap (Overpass API) zu finden — ohne Google Maps API oder teure Tools.

## Features

- 🔍 **Branchen-Suche**: 40+ Branchen (Gesundheit, Handwerk, IT, Gastronomie, etc.)
- 📍 **Standort-Filter**: Stadt, PLZ, Radius (AT/DE/CH)
- ✅ **Qualitäts-Filter**: Nur Leads mit Webseite, Email, Telefon oder Name
- 🌐 **Website-Validierung**: Prüft ob Webseiten erreichbar sind
- 📊 **Dashboard**: Übersicht über Leads, Suchen, Statistiken
- 📥 **CSV-Export**: Semikolon-getrennt, Excel-kompatibel (UTF-8 BOM)
- 🔐 **Auth-System**: Registrierung, Login, persönlicher Bereich
- 📱 **Responsive**: Mobile-first Design mit Tailwind CSS
- 🆓 **Keine API Keys**: Nutzt Overpass API (OpenStreetMap) — kostenlos

## Demo

- **Email:** demo@example.com
- **Passwort:** password

## Systemanforderungen

- PHP >= 8.2
- Extensions: mbstring, xml, curl, sqlite3, zip, bcmath, tokenizer, json
- Composer
- Apache/Nginx mit URL-Rewriting

## Installation (Shared Hosting)

### Schritt 1: Dateien hochladen

```bash
# Auf deinem lokalen Rechner:
composer install --no-dev --optimize-autoloader
zip -r lead-finder-pro.zip . -x "*.git*" "node_modules/*" "tests/*"

# ZIP auf Shared Hosting hochladen und entpacken
# ODER via FTP/Git alle Dateien hochladen
```

### Schritt 2: .env konfigurieren

```bash
cp .env.example .env
php artisan key:generate
```

Passe in `.env` an:
```
APP_URL=https://deine-domain.at
DB_DATABASE=/pfad/zu/storage/database.sqlite
```

### Schritt 3: Datenbank einrichten

```bash
touch storage/database.sqlite
php artisan migrate --seed
```

### Schritt 4: Berechtigungen setzen

```bash
chmod -R 775 storage bootstrap/cache
```

### Schritt 5: Apache/Nginx Konfiguration

**Apache:** Die `.htaccess` Datei ist bereits im `public/` Ordner.

**Nginx:**
```nginx
server {
    listen 80;
    server_name deine-domain.at;
    root /var/www/lead-finder-pro/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

### Schritt 6: Fertig!

Öffne `https://deine-domain.at` im Browser.
Melde dich mit **demo@example.com / password** an.

## Installation (VPS/Dedicated)

```bash
git clone <repo-url> /var/www/lead-finder-pro
cd /var/www/lead-finder-pro
composer install --no-dev --optimize-autoloader
cp .env.example .env
php artisan key:generate
touch storage/database.sqlite
php artisan migrate --seed
chmod -R 775 storage bootstrap/cache
```

## Shared Hosting Anbieter (getestet/empfohlen)

| Anbieter | PHP 8.2 | SQLite | Composer | Preis |
|----------|---------|--------|----------|-------|
| [ALL-INKL.COM](https://all-inkl.com) | ✅ | ✅ | ✅ (SSH) | ab €5/Monat |
| [Hetzner](https://hetzner.com) | ✅ | ✅ | ✅ | ab €3/Monat (vServer) |
| [Cyon](https://cyon.ch) | ✅ | ✅ | ✅ | ab CHF 10/Monat |
| [Hostpoint](https://hostpoint.ch) | ✅ | ✅ | ✅ | ab CHF 10/Monat |
| [Strato](https://strato.de) | ✅ | ✅ | ❌ | ab €5/Monat |
| [IONOS](https://ionos.de) | ✅ | ✅ | ❌ | ab €4/Monat |

> **Tipp:** Für Composer-Zugang brauchst du SSH. ALL-INKL und Hetzner bieten das günstigstens.

## Upgrade auf Vollversion

Die MVP-Version enthält:
- 40+ vorkonfigurierte Branchen
- Overpass API Integration
- Website-Validierung
- CSV-Export
- Dashboard

**Geplante Pro-Features:**
- API-Zugang für externe Tools
- Automatische Follow-up Erinnerungen
- Lead-Scoring Algorithmus
- Mehrere Nutzer pro Team
- White-Label Option

## Support

Bei Fragen oder Problemen:
- Email: support@deine-domain.at
- Dokumentation: https://deine-domain.at/docs

## Lizenz

Lead Finder Pro — Alle Rechte vorbehalten.
Kauflizenz für die Nutzung auf einer Domain.
Weiterverboten ohne schriftliche Genehmigung.

---

Erstellt mit ❤️ und Laravel 11
