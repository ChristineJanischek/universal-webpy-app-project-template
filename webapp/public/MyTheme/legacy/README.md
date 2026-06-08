# Legacy-Bereich MyTheme

Dieser Ordner enthaelt die alten Einzeldateien (vor der MVC-Umstrukturierung).

## Zweck

- Historie nachvollziehbar halten
- Vergleich alt/neu im Unterricht ermoeglichen
- Neue Entwicklung auf die zentrale MVC-App fokussieren

## Struktur

- legacy/tools/: alte Formular- und Auswerte-Dateien (funktional)

## Wichtige Regel

Neue Features werden nicht mehr in legacy umgesetzt.
Neue Features werden nur noch in der MVC-Struktur umgesetzt:

- app/controler/
- app/modell/
- app/view/
- phpApp/
- pyApp/

## Rueckwaertskompatibilitaet

Die alten Dateipfade im Wurzelordner MyTheme bleiben erhalten und leiten auf app_controler.php weiter.
So funktionieren alte Links weiterhin.
