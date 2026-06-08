# Kleiner Getraenkeautomat mit PHP erweitern (Schueler-Anleitung)

## Lernziel

Du erweiterst die MyTheme-App um einen neuen Automaten und testest alles in der laufenden Docker-Umgebung.

Am Ende hast du:

- ein neues Tool im Menue
- eine PHP-Auswertung im Modell
- einen getesteten Ablauf in der Webapp

## Voraussetzungen

1. Repository ist lokal oder im Codespace geoeffnet.
2. Docker laeuft.
3. Dienste sind gestartet.

```bash
cd /workspaces/universal-webpy-app-project-template
bash scripts/start-services.sh
```

Optionaler Schnelltest:

```bash
bash scripts/test-services.sh
```

## Schritt 1: Neuen Automaten im Schema eintragen

Datei: webapp/public/MyTheme/app/modell/form_schema_modell.php

1. In get_tool_schema_modell() einen neuen Eintrag erstellen, z. B. getraenkeautomat.
2. title, description und fields setzen.
3. Sinnvolle Felder:
- getraenk (Select)
- groesse (Select)
- menge (Number)

Beispielwerte:
- getraenk: Wasser, Saft, Cola
- groesse: 0.33, 0.50, 1.00

## Schritt 2: PHP-Modelllogik bauen

Datei: webapp/public/MyTheme/app/modell/php_engine_modell.php

1. In evaluate_with_php_modell() einen neuen case hinzufuegen.
2. Funktion anlegen, z. B. getraenkeautomat_modell(array $input): array
3. Rechenlogik:
- Preis pro Liter je Getraenk bestimmen
- Flaschenpreis = Literpreis * Groesse
- Gesamtpreis = Flaschenpreis * Menge
- Optional Rabatt ab Menge >= 10

Rueckgabeformat wie bei den anderen Tools:

- ok
- title
- rows mit label/value

## Schritt 3: Test in der Webapp

1. Browser oeffnen: http://localhost:8080/MyTheme/app_controler.php
2. Neuen Automaten im Menue waehlen.
3. Beispielwerte eintragen und Auswerten klicken.
4. Ergebnis pruefen.

Direkter Einstieg:

- http://localhost:8080/MyTheme/controler/getraenkeautomat_controler.php

## Schritt 4: Optionalen API-Test via Terminal

Mit curl kannst du die PHP-Auswertung direkt pruefen:

```bash
curl -s -X POST \
  -H "Content-Type: application/json" \
  -d '{"tool":"getraenkeautomat","input":{"getraenk":"Wasser","groesse":"0.5","menge":"4"}}' \
  http://localhost:8080/MyTheme/phpApp/FormEvaluator.php
```

## Schritt 5: Testen mit VNC (optional)

Falls in eurer Schulumgebung ein VNC-Desktop bereitsteht:

1. VNC-Desktop oeffnen.
2. Dort im Browser die URL aufrufen:
- http://localhost:8080/MyTheme/app_controler.php
3. Gleiche Testfaelle wie lokal durchklicken.

Hinweis: VNC ist nur eine alternative Anzeigeumgebung. Die Logik bleibt gleich.

## Schritt 6: Qualitaetscheck

```bash
cd /workspaces/universal-webpy-app-project-template
bash scripts/validate-security.sh
bash scripts/validate-architecture.sh
bash scripts/validate-docs.sh
```

## Didaktischer Tipp

Arbeite in 3 Rollen im Team:

1. Person A: Formularschema
2. Person B: Modelllogik
3. Person C: Testfaelle und Ergebnisprotokoll

So wird MVC praktisch und verstaendlich geuebt.
