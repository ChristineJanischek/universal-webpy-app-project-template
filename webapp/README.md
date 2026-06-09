# Webapp (MyTheme) - Kurzhandbuch

Dieses Dokument erklaert nur den Webapp-Teil.
Alle allgemeinen Projektinformationen bleiben im Haupt-README und im Handbuch.

## Dokumentationskonvention

Auch dieser Doku-Bereich folgt der Regel, dass Markdown-Dateien in GROSSBUCHSTABEN benannt werden.
Neue Webapp-Dokumente sollen diese Schreibweise direkt verwenden.

## Ziel (didaktisch)

Die Webapp zeigt Rechner und Automaten in einer gemeinsamen, mobilen MVC-Struktur.
Schueler lernen dabei die Trennung von:

- View (Oberflaeche)
- Routes (oeffentliche Einstiegspunkte)
- Controller (interne Ablaufsteuerung)
- Modell (Fachlogik)

## Verzeichnisuebersicht

```text
webapp/
|- Dockerfile
|- public/
   |- MyTheme/
      |- app_controller.php
      |- routes/                    # Einstiegspunkte pro Tool
      |- app/
      |  |- controller/             # zentrale Ablaufsteuerung
      |  |- modell/                 # PHP-Logik + Python-Bridge
      |  |- view/                   # HTML/CSS der App
      |- phpApp/                    # PHP-Auswertung
      |- pyApp/                     # Python-Auswertung
```

## Starten und testen

Vom Projektroot aus:

```bash
bash scripts/start-services.sh
```

Webapp aufrufen:

- http://localhost:8080/MyTheme/

Schnelltest aller Dienste:

```bash
bash scripts/test-services.sh
```

## Wie Schueler erweitern

1. Neues Tool im Schema eintragen:
- `public/MyTheme/app/modell/form_schema_modell.php`

2. Logik implementieren:
- PHP: `public/MyTheme/app/modell/php_engine_modell.php`
- Python: `public/MyTheme/pyApp/FormEvaluator.py`

3. Einstieg pruefen:
- `public/MyTheme/routes/<tool>_controller.php`

4. Im Browser testen (Engine PHP oder Python waehlen).

## Weiterfuehrende Anleitungen

- `docs/handbuch/anleitungen/MYTHEME-MVC-ERWEITERUNG.md`
- `docs/handbuch/anleitungen/GETRAENKEAUTOMAT-PHP-SCHRITT-FUER-SCHRITT.md`
- `docs/handbuch/anleitungen/GETRAENKEAUTOMAT-PYTHON-SCHRITT-FUER-SCHRITT.md`
