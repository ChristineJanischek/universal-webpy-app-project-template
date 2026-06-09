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

- app/controller/
- app/modell/
- app/view/
- phpApp/
- pyApp/

## Rueckwaertskompatibilitaet

Die alten Dateipfade im Wurzelordner MyTheme bleiben erhalten und leiten auf app_controller.php weiter.
Der bisherige Dateiname app_controler.php bleibt als kompatibler Wrapper erhalten.
So funktionieren alte Links weiterhin.
