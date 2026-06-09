# Legacy Tools (Altstand)

In diesem Ordner liegen die historischen Einzeldateien aus dem alten funktionalen Aufbau.

## Volleyball-Mapping

- volleyball_form_view_legacy.php: alte Formular-Ansicht (frueher volleyball.php)
- volleyball_modell_legacy.php: alte Verarbeitungslogik (frueher volleyball1.php)

Die aktiven Einstiegspunkte fuer die aktuelle App sind:

- routes/*_controller.php pro Tool (z. B. routes/volleyball_controller.php)
- app_controller.php mit tool-Parameter

Hinweis: Der Ordner controler/*_controler.php bleibt als Legacy-Redirect fuer alte Links erhalten.
