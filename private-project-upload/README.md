# Private Projekt-Uploads

Dieses Verzeichnis ist fuer private Altprojekt-Quellen gedacht.

Wichtig:

- Inhalte in Unterordnern werden durch `.gitignore` nicht versioniert.
- Nur diese README bleibt als Hinweisdatei im Repository.

Empfohlener Ablauf:

1. Intake-Struktur erzeugen:

```bash
bash scripts/migration-intake.sh "Mein Altes Projekt"
```

2. Quellcodes hochladen:

- `private-project-upload/<slug>/source/php`
- `private-project-upload/<slug>/source/python`
- `private-project-upload/<slug>/source/java`

3. Audit und Paritaetscheck:

```bash
bash scripts/migration-audit.sh <slug>
```
