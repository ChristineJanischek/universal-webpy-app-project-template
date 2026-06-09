# Kleiner Getraenkeautomat mit Python erweitern (Schueler-Anleitung)

## Lernziel

Du erweiterst die MyTheme-App um einen neuen Automaten und wertest die Formulardaten mit Python aus.

Am Ende hast du:

- ein neues Tool im Menue
- eine Python-Funktion fuer die Berechnung
- einen getesteten End-to-End-Ablauf

## Voraussetzungen

1. Repository ist geoeffnet.
2. Docker-Dienste laufen.

```bash
cd /workspaces/universal-webpy-app-project-template
bash scripts/start-services.sh
```

Optionaler Schnelltest:

```bash
bash scripts/test-services.sh
```

## Schritt 1: Tool im Formularschema anlegen

Datei: webapp/public/MyTheme/app/modell/form_schema_modell.php

1. Neues Tool, z. B. getraenkeautomat, eintragen.
2. Felder definieren:
- getraenk (Select)
- groesse (Select)
- menge (Number)

Damit erscheint dein Tool direkt in der Navigation.

## Schritt 2: Python-Funktion bauen

Datei: webapp/public/MyTheme/pyApp/FormEvaluator.py

1. Neue Funktion schreiben, z. B. getraenkeautomat_model(data).
2. Dispatcher evaluate(tool, data) erweitern.
3. Berechnung umsetzen:
- Literpreis je Getraenk
- Flaschenpreis = Literpreis * Groesse
- Gesamtpreis = Flaschenpreis * Menge

Rueckgabeformat wie bei bestehenden Funktionen:

- ok
- title
- rows mit label/value

## Schritt 3: Optional auch PHP-Engine erweitern

Falls das Tool sowohl mit PHP als auch Python laufen soll:

- webapp/public/MyTheme/app/modell/php_engine_modell.php ebenfalls erweitern.

Wenn du nur Python willst, teste im UI mit Engine = Python.

## Schritt 4: Test in der App

1. Browser: http://localhost:8080/MyTheme/app_controller.php
2. Tool getraenkeautomat waehlen.
3. Engine auf Python stellen.
4. Form ausfuellen und Ergebnis pruefen.

Direkter Einstieg:

- http://localhost:8080/MyTheme/routes/getraenkeautomat_controller.php

## Schritt 5: Python-Auswertung direkt testen

Direkt mit dem Skript testen:

```bash
python3 webapp/public/MyTheme/pyApp/FormEvaluator.py <<'EOF'
{"tool":"getraenkeautomat","input":{"getraenk":"Cola","groesse":"0.33","menge":"6"}}
EOF
```

## Schritt 6: Testen mit VNC (optional)

Wenn ihr einen VNC-Desktop im Unterricht nutzt:

1. VNC-Desktop oeffnen.
2. Browser im VNC nutzen.
3. URL oeffnen: http://localhost:8080/MyTheme/app_controller.php
4. Tool mit Engine Python durchtesten.

## Schritt 7: Projektvalidierung

```bash
cd /workspaces/universal-webpy-app-project-template
bash scripts/validate-security.sh
bash scripts/validate-architecture.sh
bash scripts/validate-docs.sh
```

## Mini-Testplan (Beispiel)

1. Wasser, 0.5L, Menge 1
2. Cola, 0.33L, Menge 6
3. Ungueltige Eingabe: Menge -1
4. Leeres Feld: getraenk

Erwartung:
- Gueltige Faelle liefern Ergebniszeilen.
- Ungueltige Faelle liefern eine klare Fehlermeldung.
