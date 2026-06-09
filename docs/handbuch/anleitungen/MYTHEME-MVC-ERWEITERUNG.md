# MyTheme MVC-Erweiterung (Schueler-Version)

## Ziel

Alle vorhandenen Rechner und Automaten aus MyTheme laufen in einer gemeinsamen, mobilen Webapp mit klaren Rollen:

- Dateien im Ordner routes: oeffentliche Einstiegspfade pro Tool
- Dateien im Ordner app/controller: interne Ablaufsteuerung
- Dateien mit Zusatz view: zeigen die Oberflaeche
- Dateien mit Zusatz modell: enthalten die Fachlogik

So bleibt das Projekt uebersichtlich, wiederverwendbar und leicht erweiterbar.

## Neue Projektstruktur

```text
webapp/public/MyTheme/
|- app_controller.php
|- routes/
|  |- bmi_controller.php
|  |- noten_controller.php
|  |- taschenrechner_controller.php
|  |- rabatt_controller.php
|  |- milchautomat_controller.php
|  |- getraenkeautomat_controller.php
|  |- urlaub_controller.php
|  |- umsatz_controller.php
|  |- volleyball_controller.php
|- app/
|  |- controller/
|  |  |- tools_controller.php
|  |- modell/
|  |  |- form_schema_modell.php
|  |  |- php_engine_modell.php
|  |  |- python_bridge_modell.php
|  |- view/
|     |- app_view.php
|     |- app_view.css
|- phpApp/
|  |- FormEvaluator.php
|- pyApp/
|  |- FormEvaluator.py
```

## Routing-Strategie

Die Einstiegspfade liegen ausschliesslich unter `routes/*_controller.php`.
Alle Routen fuehren konsistent auf `app_controller.php?tool=<name>`.

Beispiel-Mapping:

- routes/bmi_controller.php -> app_controller.php?tool=bmi
- routes/noten_controller.php -> app_controller.php?tool=noten
- routes/taschenrechner_controller.php -> app_controller.php?tool=taschenrechner
- routes/rabatt_controller.php -> app_controller.php?tool=rabatt
- routes/milchautomat_controller.php -> app_controller.php?tool=milchautomat
- routes/getraenkeautomat_controller.php -> app_controller.php?tool=getraenkeautomat
- routes/urlaub_controller.php -> app_controller.php?tool=urlaub
- routes/umsatz_controller.php -> app_controller.php?tool=umsatz
- routes/volleyball_controller.php -> app_controller.php?tool=volleyball

Didaktischer Vorteil:

1. Neue Entwicklung bleibt klar in der MVC-Struktur.
2. Einheitliche Einstiegspunkte vermeiden Redundanzen.
3. Unterrichtsmaterial kann direkt auf die neuen Routen referenzieren.

## Was wurde didaktisch verbessert?

1. Ein klarer Einstiegspunkt pro Tool mit *_controller.php.
2. Einheitliche Benennung nach routes/controller/view/modell.
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

Ausgangspunkt: didaktische Aufgabenstellung im Unterricht definieren und in der neuen MVC-Struktur umsetzen.

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
2. Ausschliesslich die aktuelle MVC-Struktur erweitern.
3. Pro Erweiterung kurze Doku im Handbuch aktualisieren.
4. Bei Teams: eine Person fuer Schema, eine fuer Modell, eine fuer Tests.
