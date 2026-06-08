# Legacy Tools (Altstand)

In diesem Ordner liegen die historischen Einzeldateien aus dem alten funktionalen Aufbau.

## Volleyball-Mapping

- volleyball_form_view_legacy.php: alte Formular-Ansicht (frueher volleyball.php)
- volleyball_modell_legacy.php: alte Verarbeitungslogik (frueher volleyball1.php)

Die aktiven Einstiegspunkte fuer die aktuelle App sind:

- controler/*_controler.php pro Tool (z. B. controler/volleyball_controler.php)
- app_controler.php mit tool-Parameter

Hinweis: Alte Root-Wrapper wurden entfernt, um die aktive Struktur eindeutig zu halten.
