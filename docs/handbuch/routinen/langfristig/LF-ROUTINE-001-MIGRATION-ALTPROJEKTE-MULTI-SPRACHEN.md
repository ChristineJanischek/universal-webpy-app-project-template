# LF-ROUTINE-001: Migration Altprojekte Multi-Sprachen

### Metadata

| Feld | Wert |
|------|------|
| **ID** | LF-ROUTINE-001 |
| **Name** | Migration Altprojekte Multi-Sprachen |
| **Kategorie** | `langfristig` |
| **Haeufigkeit** | monatlich |
| **Zeitaufwand** | 2-4 Stunden |
| **Verantwortlicher** | App-Maintainer |
| **Sichtbarkeit** | intern |
| **Status** | aktiv |
| **Version** | 1.0 |
| **Erstellt am** | 09.06.2026 |
| **Letzte Aktualisierung** | 09.06.2026 |

### Ziel & Ueberblick

Alte Rechner-/Automaten-Projekte werden standardisiert in die neue MyTheme-MVC-Struktur ueberfuehrt.
Jedes migrierte Projekt wird in PHP, Python und Java fachlich abgebildet.

### Vorbedingungen & Kontext

- Docker laeuft.
- Zugriff auf Altprojekt-Quellen liegt vor.
- Private Upload-Struktur ist vorbereitet.

### Schritte

**Schritt 1: Intake anlegen**

```bash
bash scripts/migration-intake.sh "Projektname"
```

**Schritt 2: Quellen ablegen**

- PHP nach `private-project-upload/<slug>/source/php`
- Python nach `private-project-upload/<slug>/source/python`
- Java nach `private-project-upload/<slug>/source/java`

**Schritt 3: Audit ausfuehren**

```bash
bash scripts/migration-audit.sh <slug>
```

**Schritt 4: Implementierung in MyTheme**

- Tool-Schema erweitern: `webapp/public/MyTheme/app/modell/form_schema_modell.php`
- PHP-Engine erweitern: `webapp/public/MyTheme/app/modell/php_engine_modell.php`
- Python-Engine erweitern: `webapp/public/MyTheme/pyApp/FormEvaluator.py`

**Schritt 5: Qualitaetsgates**

```bash
bash scripts/test-services.sh
bash scripts/validate-security.sh
bash scripts/validate-architecture.sh
bash scripts/validate-docs.sh
```

### Erfolgskriterien

- [ ] Intake und Upload je Projekt vollstaendig
- [ ] Tool-Paritaet fuer Schema/PHP/Python ist gruen
- [ ] Service- und Validierungschecks sind erfolgreich
- [ ] Migrationsplan im privaten Projektordner aktualisiert

### Changelog

| Version | Datum | Autor | Aenderungen |
|---------|-------|-------|------------|
| 1.0 | 09.06.2026 | Copilot | Initiale Routine erstellt |
