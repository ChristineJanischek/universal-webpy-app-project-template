# MyTheme MVC-Erweiterung (Schueler-Version)

## Ziel

Alle vorhandenen Rechner und Automaten aus MyTheme laufen in einer gemeinsamen, mobilen Webapp mit klaren Rollen:

- Dateien mit Zusatz controler: steuern den Ablauf
- Dateien mit Zusatz view: zeigen die Oberflaeche
- Dateien mit Zusatz modell: enthalten die Fachlogik

So bleibt das Projekt uebersichtlich, wiederverwendbar und leicht erweiterbar.

## Neue Projektstruktur

```text
webapp/public/MyTheme/
|- app_controler.php
|- controler/
|  |- bmi_controler.php
|  |- noten_controler.php
|  |- taschenrechner_controler.php
|  |- rabatt_controler.php
|  |- milchautomat_controler.php
|  |- getraenkeautomat_controler.php
|  |- urlaub_controler.php
|  |- umsatz_controler.php
|  |- volleyball_controler.php
|- legacy/
|  |- README.md
|  |- tools/
|- app/
|  |- controler/
|  |  |- tools_controler.php
|  |- modell/
|  |  |- form_schema_modell.php
|  |  |- php_engine_modell.php
|  |  |- python_bridge_modell.php
|  |- view/
|     |- app_view.php
|     |- app_view.css
|- phpApp/
|  |- FormEvaluator.php
|  |- VolleyballManager.php
|- pyApp/
|  |- FormEvaluator.py
```

## Legacy-Strategie (Uebergang)

Die bisherigen Einzeldateien wurden nach legacy/tools verschoben.
Die alten Root-Dateien wurden entfernt, damit nur noch die neue Controller-Struktur aktiv ist.

Beispiel-Mapping:

- controler/bmi_controler.php -> app_controler.php?tool=bmi
- controler/noten_controler.php -> app_controler.php?tool=noten
- controler/taschenrechner_controler.php -> app_controler.php?tool=taschenrechner
- controler/rabatt_controler.php -> app_controler.php?tool=rabatt
- controler/milchautomat_controler.php -> app_controler.php?tool=milchautomat
- controler/getraenkeautomat_controler.php -> app_controler.php?tool=getraenkeautomat
- controler/urlaub_controler.php -> app_controler.php?tool=urlaub
- controler/umsatz_controler.php -> app_controler.php?tool=umsatz
- controler/volleyball_controler.php -> app_controler.php?tool=volleyball

Spezielle Klarstellung Volleyball:

- legacy/tools/volleyball_form_view_legacy.php = alte Formularsicht
- legacy/tools/volleyball_modell_legacy.php = alte funktionale Logik
- controler/volleyball_controler.php = neuer klarer Einstiegspunkt in die MVC-App

Didaktischer Vorteil:

1. Alte Lernstaende bleiben sichtbar.
2. Neue Entwicklung bleibt klar in der MVC-Struktur.
3. Alte Links aus Unterrichtsmaterialien funktionieren weiterhin.

## Was wurde didaktisch verbessert?

1. Ein klarer Einstiegspunkt pro Tool mit *_controler.php.
2. Einheitliche Benennung nach controler/view/modell.
3. Keine doppelte Formularlogik pro Rechner.
4. Auswertung per PHP oder Python umschaltbar.
5. Mobile Bedienung mit einfachem Toggle-Menue.

## Ablauf in der App

1. In der Navigation Tool waehlen (z. B. Rabattrechner).
2. Engine waehlen: PHP oder Python.
3. Formular ausfuellen.
4. Auswerten klicken.
5. Ergebnis wird als Tabelle angezeigt.

## Schritt-fuer-Schritt: neuen Rechner oder Automaten ergaenzen

## 1) Erweiterung mit PHP

1. Tool-Schema erweitern:
- Datei: webapp/public/MyTheme/app/modell/form_schema_modell.php
- Neues Tool mit Titel, Beschreibung und Feldern eintragen.

2. Fachlogik bauen:
- Datei: webapp/public/MyTheme/app/modell/php_engine_modell.php
- Neue Funktion anlegen, z. B. getraenkeautomat_modell(array $input): array
- Rueckgabeformat einhalten:
  - ok: true/false
  - title: Titel
  - rows: Liste mit label/value

3. Router verbinden:
- In evaluate_with_php_modell das neue Tool auf die neue Funktion mappen.

4. Testen:
- Tool in der Navigation anklicken.
- Engine PHP waehlen.
- Plausible und unplausible Eingaben pruefen.

## 2) Erweiterung mit Python

1. Python-Logik ergaenzen:
- Datei: webapp/public/MyTheme/pyApp/FormEvaluator.py
- Neue Funktion anlegen, z. B. getraenkeautomat_model(data)

2. Dispatcher erweitern:
- In evaluate(tool, data) das neue Tool mappen.

3. Testen:
- Engine Python waehlen.
- Gleiche Testfaelle wie in PHP pruefen.

## Beispielidee: kleiner Getraenkeautomat

Ausgangspunkt: Inhalte aus docs/handbuch/legacy-analysis/Getraenkeautomat_lsg.zip didaktisch uebernehmen.

Vorschlag fuer Felder:
- getraenk (Select: Wasser, Saft, Cola)
- groesse (Select: 0.33, 0.5, 1.0)
- menge (Number)

Typische Logik:
1. Preis pro Liter je Getraenk bestimmen.
2. Preis pro Flasche = Preis pro Liter * Groesse.
3. Gesamtpreis = Preis pro Flasche * Menge.
4. Optional Rabatt ab bestimmter Menge.

## Sicherheits- und Qualitaetsregeln

1. Eingaben immer validieren (z. B. keine negativen Mengen).
2. Ausgaben HTML-escaped anzeigen.
3. Keine internen Fehlermeldungen direkt an Nutzer geben.
4. Rueckgabeformat der Modelle immer gleich halten.
5. Neue Tools nur an einer Stelle pro Schicht erweitern (SSOT).

## Wartungstipps

1. Erst Modelllogik sauber entwickeln, dann View-Felder anpassen.
2. Alte Einzeldateien nur im legacy-Ordner halten.
3. Pro Erweiterung kurze Doku im Handbuch aktualisieren.
4. Bei Teams: eine Person fuer Schema, eine fuer Modell, eine fuer Tests.
