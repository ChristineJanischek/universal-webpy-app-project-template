package volleyball;

import java.util.ArrayList;
import java.util.List;

/**
 * Model-Klasse: Verwaltet alle Spielerlisten des Volleyball-Teams.
 *
 * <p>Enthält die gesamte Geschäftslogik (Business Logic) des Team-Managers:</p>
 * <ul>
 *   <li>Verwaltung der Startaufstellung ({@link Kaderspieler})</li>
 *   <li>Verwaltung der Ersatzspieler ({@link Ersatzspieler})</li>
 *   <li>Tauschen von Spielerpositionen</li>
 *   <li>Einfügen neuer Spieler</li>
 *   <li>Kaderübersicht (alle Spieler kombiniert)</li>
 * </ul>
 *
 * <p><strong>MVC-Rolle:</strong> Model – enthält keine UI-Logik.</p>
 *
 * <p><strong>Assoziation:</strong> Dieser Manager wird einmalig im {@link MainWindow}
 * erzeugt und als gemeinsame Instanz an alle Sub-Fenster weitergegeben.</p>
 */
public class VolleyballspielerTeamManager {

    private static final List<String> STANDARD_STARTAUFSTELLUNG = List.of(
        "Armin", "Batu", "Kai", "Sven", "Paul", "Milan"
    );

    private static final List<String> STANDARD_ERSATZBANK = List.of(
        "Chris", "Dennis", "Emin", "Goran", "Luca", "Nico"
    );

    /** Liste der Kaderspieler (aktive Startaufstellung) */
    private final ArrayList<Kaderspieler> startaufstellung;

    /** Liste der Ersatzspieler (Ersatzbank) */
    private final ArrayList<Ersatzspieler> ersatzBank;

    // ---- Konstruktor ----

    /**
     * Standard-Konstruktor: Initialisiert die Listen mit Standard-Spielern.
     */
    public VolleyballspielerTeamManager() {
        startaufstellung = new ArrayList<>();
        for (String name : STANDARD_STARTAUFSTELLUNG) {
            startaufstellung.add(new Kaderspieler(name));
        }

        ersatzBank = new ArrayList<>();
        for (String name : STANDARD_ERSATZBANK) {
            ersatzBank.add(new Ersatzspieler(name));
        }
    }

    // ---- Lesender Zugriff ----

    /**
     * Gibt die Startaufstellung zurück.
     *
     * @return ArrayList der Kaderspieler
     */
    public ArrayList<Kaderspieler> getStartaufstellung() {
        return new ArrayList<>(startaufstellung);
    }

    /**
     * Gibt die Ersatzbank zurück.
     *
     * @return ArrayList der Ersatzspieler
     */
    public ArrayList<Ersatzspieler> getErsatzBank() {
        return new ArrayList<>(ersatzBank);
    }

    /**
     * Gibt die Spielerliste anhand der Auswahl-Nummer zurück.
     *
     * @param auswahl 1 = Startaufstellung, 2 = Ersatzspieler
     * @return Die entsprechende Spielerliste oder {@code null} bei ungültiger Auswahl
     */
    public List<? extends Spieler> holeSpielerliste(int auswahl) {
        return switch (auswahl) {
            case 1 -> List.copyOf(startaufstellung);
            case 2 -> List.copyOf(ersatzBank);
            default -> List.of();
        };
    }

    // ---- Geschäftslogik ----

    /**
     * Tauscht zwei Spieler an den angegebenen Positionen innerhalb einer Liste.
     *
     * @param auswahl 1 = Startaufstellung, 2 = Ersatzspieler
     * @param von     Index des ersten Spielers (0-basiert)
     * @param nach    Index des zweiten Spielers (0-basiert)
     */
    public void tausche(int auswahl, int von, int nach) {
        switch (auswahl) {
            case 1 -> tauschen(startaufstellung, von, nach);
            case 2 -> tauschen(ersatzBank, von, nach);
            default -> {
                // Keine Aktion fuer ungueltige Auswahlen.
            }
        }
    }

    /**
     * Generische Hilfsmethode: Tauscht zwei Elemente in einer ArrayList.
     *
     * @param liste Die Liste, in der getauscht wird
     * @param von   Index des ersten Elements (0-basiert)
     * @param nach  Index des zweiten Elements (0-basiert)
     * @param <T>   Spieler-Typ (Kaderspieler oder Ersatzspieler)
     */
    private <T extends Spieler> void tauschen(ArrayList<T> liste, int von, int nach) {
        if (von >= 0 && nach >= 0 && von < liste.size() && nach < liste.size()) {
            T zwischenspeicher = liste.get(von);
            liste.set(von, liste.get(nach));
            liste.set(nach, zwischenspeicher);
        }
    }

    /**
     * Fügt einen neuen Spieler an der angegebenen Position in eine Liste ein.
     *
     * @param auswahl     1 = Startaufstellung, 2 = Ersatzspieler
     * @param spielerName Name des neuen Spielers
     * @param stelle      Einfügeposition (0-basiert)
     */
    public void einfuegen(int auswahl, String spielerName, int stelle) {
        String validierterName = spielerName == null ? "" : spielerName.trim();
        if (validierterName.isEmpty()) {
            throw new IllegalArgumentException("Spielername darf nicht leer sein.");
        }

        if (auswahl == 1 && stelle >= 0 && stelle <= startaufstellung.size()) {
            startaufstellung.add(stelle, new Kaderspieler(validierterName));
        } else if (auswahl == 2 && stelle >= 0 && stelle <= ersatzBank.size()) {
            ersatzBank.add(stelle, new Ersatzspieler(validierterName));
        } else {
            throw new IllegalArgumentException("Ungueltige Auswahl oder Einfuegeposition.");
        }
    }

    /**
     * Gibt den gesamten Kader zurück: Startaufstellung + Ersatzspieler.
     *
     * @return ArrayList aller Spieler im Kader
     */
    public List<Spieler> getKader() {
        ArrayList<Spieler> kader = new ArrayList<>();
        kader.addAll(startaufstellung);
        kader.addAll(ersatzBank);
        return List.copyOf(kader);
    }

    // ---- Ausgabe-Methoden ----

    /**
     * Erstellt einen formatierten String der Startaufstellung.
     *
     * @return Zeilenweise Auflistung der Kaderspieler
     */
    public String zeigeStartaufstellung() {
        return spielerlisteAlsString(startaufstellung);
    }

    /**
     * Erstellt einen formatierten String der Ersatzspieler.
     *
     * @return Zeilenweise Auflistung der Ersatzspieler
     */
    public String zeigeErsatzspieler() {
        return spielerlisteAlsString(ersatzBank);
    }

    /**
     * Erstellt einen formatierten String des gesamten Kaders.
     *
     * @return Zeilenweise Auflistung aller Kadermitglieder
     */
    public String zeigeKader() {
        return spielerlisteAlsString(getKader());
    }

    /**
     * Hilfsmethode: Wandelt eine Spielerliste in einen zeilengetrennten String um.
     *
     * @param liste Die zu formatierende Spielerliste
     * @return Zeilengetrennter String aller Spielernamen
     */
    private String spielerlisteAlsString(List<? extends Spieler> liste) {
        StringBuilder sb = new StringBuilder();
        for (Spieler spieler : liste) {
            sb.append(spieler.getName()).append("\n");
        }
        return sb.toString();
    }
}
