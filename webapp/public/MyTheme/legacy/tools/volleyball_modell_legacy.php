
<?php
include ("head.php");
?>
<div id="wrapper">
<?php
include ("header.php");
?>
	<div id="content">
		<form>
			<fieldset>

				<legend>Ergebnis anzeigen</legend>

				<?php
    // ####EINGABE:#####
    // Eingaben lesen
    $pAnzeigewunsch = $_POST['rbSpieler'];

    // Deklaration und Initialisierung eines Arrays
    $spieler = array(
        "Armin",
        "Batu",
        "Kai",
        "Sven",
        "Paul",
        "Milan"
    );
    $ersatz = array(
        "Chris",
        "Dennis",
        "Emin",
        "Goran",
        "Luca",
        "Nico"
    );

    // Addieren zweier Mengen (Arrays -> Merge)
    $kader = array_merge($spieler, $ersatz);

    // Globale Variable deklarieren
    $GLOBALS['spieler'] = $spieler;
    $GLOBALS['ersatz'] = $ersatz;
    $GLOBALS['kader'] = $kader;

    // VERARBEITUNG
    // Verhaltensweise: Methode/Funktion

    // Prüfen und lesen der Eingabe aus einem Radiobutton
    // Prüfung: Wurde ein Radio-Button ausgewählt?
    function pruefe()
    {
        // Ist ein Radio-Button ausgewäht?
        if (isset($_POST['rbSpieler'])) {
            // Fall-Ja: übernehme den Wert (value) in die Variable
            $pOption = $_POST['rbSpieler'];
        } else {
            // Fall-Sonst: übernehme den Wert 0 (value) für die Variable
            $pOption = 0;
        }
        // Gebe den ermittelten Wert zurück
        return $pOption;
    }

    function zeigeStartaufstellung($pSpieler)
    {
        $spieler = $pSpieler;
        print("######STARTAUFSTELLUNG#######<br>");
        for ($i = 0; $i < sizeof($spieler); $i ++) {
            print "<br>" . $spieler[$i] . "<br>";
        }
    }

    function zeigeErsatzspieler($pErsatz)
    {
        $ersatz = $pErsatz;
        print("######ERSATZSPIELER#######");
        for ($i = 0; $i < sizeof($ersatz); $i ++) {
            print "<br>" . $ersatz[$i] . "<br>";
        }
    }

    function zeigeKader($pKader)
    {
        $kader = $pKader;
        print("######KADER#######");
        for ($i = 0; $i < sizeof($kader); $i ++) {
            print "<br>" . $kader[$i] . "<br>";
        }
    }

    function mannschaft_umstellen_pos($spieler)
    {
        // Optional
        zeigeStartaufstellung($spieler);

        // Eingabe
        $position_von = $_POST['tfVon'];
        $position_nach = $_POST['tfNach'];

        // Verarbeitung: Tauschen
        $parkplatz = $spieler[$position_von - 1];
        $spieler[$position_von - 1] = $spieler[$position_nach - 1];
        $spieler[$position_nach - 1] = $parkplatz;

        // Ausgabe
        print("#####################<br>");
        print("NEUE STARTAUFSTELLUNG<br>");
        print("#####################<br>");
        print("Position " . $position_von . " wurde mit Position " . $position_nach . " getauscht!<br><br>");
        for ($i = 0; $i < sizeof($spieler); $i ++) {
            print("<br>" . $spieler[$i] . "<br>");
        }
    }

    // Einfügen
    // Deklaration und Implementierung der Funktion/Methode
    // Hilfsmethode
    function lese_Liste($pOption)
    {
        // prüfe ob die gewählte Option gleich "..." ist
        if ($pOption == "Spielerliste") {
            // Fall: Spieleriste
            return $GLOBALS['spieler'];
            // Ansonsten prüfe weiter
        } elseif ($pOption == "Ersatzspieler") {
            // Fall: Ersatzspieler
            return $GLOBALS['ersatz'];
        } elseif ($pOption == "Kaderliste") {
            // Fall: Kaderliste
            return $GLOBALS['kader'];
        }
    }

    function spieler_einfuegen()
    {
        // Deklaration und Einlesen
        // Lese Wert von der GUI
        $mListe = $_POST['ddListe'];

        // Aufruf
        // Verwendung der Hilfsmethode um die Liste zu ermitteln
        $liste = lese_Liste($mListe);

        // Deklaration und Einlesen
        // Lese Spielername und Position
        $mSpielername = $_POST['tfSpielername'];
        $mPosition = $_POST['tfPosition_insert'];

        // Deklaration und Initialisierung:
        // Anzahl/Länge der Elemente in der Liste ermitteln
        $laenge = COUNT($liste);

        // Anhängen (hinten) von Element an eine bestehende Liste/Array (dyn. Liste)
        // Zuweisung: pListe = spielername
        array_push($liste, $mSpielername);

        // Wiederhole von $i = laenge solange $i > 0, Schrittweite -1
        for ($i = $laenge; $i > 0; $i --) {
            // Starte hinten: Rücke linkes Element nach Rechts, um Platz zu schaffen
            $liste[$i] = $liste[$i - 1];
            // Prüfe bei jedem Durchlauf, ob die Position erreicht ist
            if (($i) == $mPosition) {
                // JA-Fall: Falls das so ist, füge den Spielenrname ein
                // Zuweisung: pListe[position] = spielername
                $liste[$mPosition] = $mSpielername;
                // Sprunglabel end: Springe zur Sprungmarke ende
                goto end;
            }
            // SONST-Fall: Leer (else fehlt)
        }
        // Sprungmarke ende
        end:

        // Ausgabe
        print("<br>################################<br>");
        print("Element wurde an Position " . $mPosition . " der Liste eingef&uuml;gt!<br>");
        print("################################<br>");
        // Wiederhole von $i = 0 solange $i < 0, Schrittweite 1
        for ($j = 0; $j < COUNT($liste); $j ++) {
            // Starte vorne
            // Ausgabe: Aktuelles Element der liste an der Stelle
            echo $liste[$j] . "<br>";
        }
    }

    function spieler_entfernen()
    {
        // Deklaration und Einlesen
        // Lese Wert von der GUI
        $mListe = $_POST['ddListe'];

        // Aufruf
        // Verwendung der Hilfsmethode um die Liste zu ermitteln
        $liste = lese_Liste($mListe);

        // Deklaration und Einlesen
        // Lese Position
        $mPosition = $_POST['tfPosition_delete'];

        // Wiederhole von position bis zum Ende
        for ($i = $mPosition + 1; $i < COUNT($liste); $i++) {

            // schreibe linkes um 1 Stelle nach rechts
            $liste[$i - 1] = $liste[$i];
            echo "Durch lauf mit i=".$i.":";
            echo liste_toString($liste);
        }
        // Überschreibe abschließend das letzte Element mit Nichts
        $liste[COUNT($liste) - 1] = "";

        // Ausgabe: "Aktualisierte Liste ohne das Element an der Position" + postion + "!"
        print("<br>################################<br>");
        print("Aktualisierte Liste ohne das Element an der Position " . $mPosition . "!<br>");
        print("<br>################################<br>");
        // Wiederhole von $i = 0 solange $i < 0, Schrittweite 1
        for ($j = 0; $j < COUNT($liste); $j ++) {
            // Starte vorne
            // Ausgabe: Aktuelles Element der liste an der Stelle
            echo $liste[$j] . "<br>";
        }
    }

    
   //Sortieren
    function spieler_sortieren()
    {
        // Deklaration und Einlesen
        // Lese Wert von der GUI
        $mListe = $_POST['ddListe'];

        // Aufruf
        // Verwendung der Hilfsmethode um die Liste zu ermitteln
        $liste = lese_Liste($mListe);
        
        
        //Eingabe aus den Drop-Down Menü für den Algorithmus wählen
        $mSortieren_mit = $_POST['ddSortieren'];
        
        if($mSortieren_mit == "BubbleSort"){
            bubbleSort($liste);
        }else if($mSortieren_mit == "SelectionSort"){
            selectionSort($liste);
        }
        
    }

    //Hilfsfunktion
    function bubbleSort($pListe){
                
        //Ermittle die Anzahl der Elemente der liste 
        $laenge = COUNT($pListe);
        
        //Wiederhole von... solange..., Schrittweite
        for($i = 1; $i < $laenge; $i++){
            //Ausgabe: Bubble Phase 
            echo "Bubble Phase ".$i.":";
            echo liste_toString($pListe);
            
            //Wiederhole von... solange..., Schrittweite
            for($j = 0; $j < $laenge-$i; $j++){
                
                if($pListe[$j] > $pListe[$j+1] ){
                    //Tauschen
                    //Parke linkes Element
                    $parkplatz = $pListe[$j];
                    //Schreibe rechtes Element auf die Position links
                    $pListe[$j] = $pListe[$j+1];
                    //Schreibe geparktes Element auf Position rechts
                    $pListe[$j+1] = $parkplatz;
                }
                
            } 
        }
        //Ausgabe elementweise
        // Ausgabe: "Aktualisierte Liste ohne das Element an der Position" + postion + "!"
        print("<br>################################<br>");
        print("Spieler  wurden mit dem BubbleSort Algorithmus sortiert !<br>");
        print("<br>################################<br>");
        for($k = 0; $k < $laenge; $k++){
            echo $pListe[$k] . "<br>";
        }
        return $pListe;
    }
    
    function selectionSort($pListe){
        //Ermittle die Anzahl der Elemente der liste
        $laenge = COUNT($pListe);
        
        //Wiederhole von... solange..., Schrittweite
        for($akt_index = 0; $akt_index < $laenge; $akt_index++){
            //Position des Minimum festlegen
            $min_index = $akt_index;
            for($j = $akt_index +1; $j < $laenge-$akt_index; $j++){
                //Prüfe ob aktueller Wert kleiner als Minimum ist
                if($pListe < $pListe[$akt_index]){
                    //Zuweisung: Position des neuen Minimums 
                    $min_index = $j;
                }
            }
            
            //Prüfe ob sich die Position des Minimums geändert hat
            if($akt_index != $min_index){
                //Tausche die Werte und lege damit ein neues Minimum fest
                $zwischenspeicher = $pListe[$akt_index];
                $pListe[$akt_index] = $pListe[$min_index];
                $pListe[$min_index] = $zwischenspeicher;
            }
        }
        print("<br>################################<br>");
        print("Spieler  wurden mit dem SelectionSort Algorithmus sortiert !<br>");
        print("<br>################################<br>");
        //Ausgabe nutzt Hilfsmethode um Ausgabestring zu erzeugen
        $ausgabe = liste_toString($pListe);
        
        print($ausgabe);
        
        return $pListe;
    }
    
    //Hilfsmethode für die Ausgabe der Liste in einer Zeile
    function liste_toString($pListe){
        $listen_string = "|";
        for($i = 0; $i < COUNT($pListe); $i++){
            $listen_string = $listen_string.$pListe[$i]. "|";
        }
        return $listen_string."<br>";
    }
    
    //suchen
    function spieler_suchen()
    {
        // Deklaration und Einlesen
        // Lese Wert von der GUI
        $mListe = $_POST['ddListe'];
        $mName = $_POST['tfName_search'];
        
        // Aufruf
        // Verwendung der Hilfsmethode um die Liste zu ermitteln
        $liste = lese_Liste($mListe);
        
        
        //Eingabe aus den Drop-Down Menü für den Algorithmus wählen
        $mSuchen_mit = $_POST['ddSuchen'];
        
        if($mSuchen_mit == "LineareSuche"){
            sucheLinear($liste, $mName);
        }else if($mSuchen_mit == "BinaereSuche"){
            sucheBinaer($liste, $mName);
        }
        
    }
    //Lineare Suche
    function sucheLinear($pListe, $pName){
        //flag für gefunden auf falsch setzen
        $gefunden = false;
        
        //Anfangsposition Deklarieren iund initialisieren
        $index_anfang = 0;
        
        //Endposition Deklarieren iund initialisieren
        $laenge = COUNT($pListe);
        
        //Wiederhole von... solange..., Schrittweite
        for($i = 0; $i < $laenge; $i++){
            if($pListe[$i] == $pName){
                $gefunden = true;
            }
        }
        //Ausgabe
        print("<br>################################<br>");
        print("Gesuchter Spieler: " .$pName. " wurde Linear gesucht <br>");
        print("<br>################################<br>");
        //prüfe ob der Wert gefunden wurde
        if($gefunden){
            print("Spieler ist Mitglied!");
        }else{
            print("Spieler ist kein Mitglied!");
        } 
        
    }
    
    //Binaer Suche
    function sucheBinaer($pListe, $pName){
        //Liste zuvor sortieren
        $liste = bubbleSort($pListe);
        
        //flag für gefunden auf falsch setzen
        $gefunden = false;
        
        //Anfangsposition Deklarieren iund initialisieren
        $index_anfang = 0;
        
        //Endposition Deklarieren iund initialisieren
        $index_ende = COUNT($liste)-1;
        
        //Wiederhole vom Anfang bis zum Ende,
        //solange der gesuchte Wert noch nicht gefunden wurde UND
        //die Liste noch ncht Durchlaufen wurde
        while(!$gefunden && $index_anfang <= $index_ende){
            //Ermittle in jedem Durchlauf die Neue Mitte (Restliste)
            $index_mitte = ROUND(($index_anfang+$index_ende)/2);
                        
            //Prüfe dabei 
            
            if($liste[$index_mitte] == $pName){
                $gefunden = true;
            }else{
                //Prüfe weiter
                print($liste[$index_mitte] .">". $pName);
                if($liste[$index_mitte] > $pName ){
                    //Suche Links der Mitte
                    $index_ende = $index_mitte-1;
                }else{                    
                    $index_anfang = $index_mitte +1;
                }
            }
        }
        //Ausgabe
        print("<br>################################<br>");
        print("Gesuchter Spieler: ".$pName. " wurde bin&auml;r gesucht!<br>");
        print("<br>################################<br>");
        //prüfe ob der Wert gefunden wurde
        if($gefunden == true){
            print("Spieler ist Mitglied!");
        }else{
            print("Spieler ist kein Mitglied!");
        }        
    }
    
    // Prüfung: Wurde ein Radio-Button ausgewählt?
    function pruefe_und_ermittle($pAnzeigewunsch, $pSpieler, $pErsatz, $pKader)
    {
        $anzeigewunsch = $pAnzeigewunsch;
        $spieler = $pSpieler;
        $ersatz = $pErsatz;
        $kader = $pKader;

        if ($anzeigewunsch == 1) {
            $ergebnis = zeigeStartaufstellung($spieler);
            $operation = "Startaufstellung anzeigen";
        } elseif ($anzeigewunsch == 2) {
            $ergebnis = zeigeErsatzspieler($ersatz);
            $operation = "Ersatzspieler anzeigen";
        } elseif ($anzeigewunsch == 3) {
            $ergebnis = zeigeKader($kader);
            $operation = "Kader anzeigen";
        } elseif ($anzeigewunsch == 4) {
            $ergebnis = mannschaft_umstellen_pos($spieler);
            $operation = "Spieler tauschen";
        } elseif ($anzeigewunsch == 5) {
            $ergebnis = spieler_einfuegen();
            $operation = "Spieler einf&uuml;gen";
        } elseif ($anzeigewunsch == 6) {
            $ergebnis = spieler_entfernen();
            $operation = "Spieler entfernen";
        } elseif ($anzeigewunsch == 7) {
            $ergebnis = spieler_sortieren();
            $operation = "Spieler sortieren";
        }elseif ($anzeigewunsch == 8) {
            $ergebnis = spieler_suchen();
            $operation = "Spieler suchen";
        }else {
            $ergebnis = 0;
            $operation = "";
        }

        return $operation;
    }

    // Methoden- bzw. Funktionsaufrufe: Reihenfolge relevant
    $anzeigeoption = pruefe();
    $operation = pruefe_und_ermittle($anzeigeoption, $spieler, $ersatz, $kader);

    // ####AUSGABE#######
    echo "<br><br>Anzeigewunsch: <h5>" . $pAnzeigewunsch . "</h5>";
    echo "Operation: <h5>" . $operation . "</h5>";
    ?>

			</fieldset>
			<!--Fieldset-Box schließen-->
		</form>
		<!--Form-Box schließen-->
	</div>
	<!--Content-Box schließen-->

	<?php
include ("sidebar.php");
?>

	<?php
include ("footer.php");
?>
	</div>
<!--Wrapper-Box schließen-->