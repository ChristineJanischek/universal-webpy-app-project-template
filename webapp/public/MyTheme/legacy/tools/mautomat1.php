	<?php
	    include ("head.php");
	?>

<body>

	<div id="wrapper">
    	<?php
    	    include ("header.php");
    	?>
    
        <div id="content">
            <form>
                <fieldset>
                	<legend>Betrag berechnen</legend>
              		<?php 
              		//EINGABE: Eingaben lesen
              		$pMenge = $_POST['tfMenge'];
              		$pMilchtyp = $_POST['ddMilchtyp'];
              		
              		//Deklaration und Implementierung der Funktion/Methode
              		//Prüfung: Wurde ein Radio-Button ausgewählt?
              		function pruefe(){
              		    // Für den Fall, dass ein Radio-Button ausgewählt wurde..
              		    if(isset($_POST['rbOperator'])){
              		        /* Soll der Wert (value) von rbOperator(1-5) in eine lokale Variable
              		         * (Platzhalter für Wert) übernommen werden (Zuweisung)*/
              		        $pOption = $_POST['rbOperator'];
              		        /*Ansonsten*/
              		    }else{
              		        /* Soll der Wert 0 zugewiesen werden*/
              		        $pOption = 0;
              		    }
              		    /*Abschließend soll der Wert von $pOption zurückgegeben werden*/
              		    return $pOption;
              		}
              		
              		//Deklaration und Implementierung der Funktion/Methode
              		//Ermittle den Rabattsatz anhand der Menge
              		function ermittle_Milchpreis($pMilchtyp){
              		    $mMilchpreis = 1.3;
              		    //prüfe ob der milchtyp gleich "Vollmilch" ist
              		    if($pMilchtyp == "Vollmilch"){
              		        //Falls dem so ist setze den Milchpreis auf 1.3
              		        $mMilchpreis = 1.3;
              		        //Ansonsten prüfe weiter
              		    }elseif ($pMilchtyp == "Laktosefreie Milch"){
              		        $mMilchpreis = 1.45;
              		    }elseif ($pMilchtyp == "Fettarme Milch"){
              		        $mMilchpreis = 1.10;      		        
              		    }elseif ($pMilchtyp == "Sojamilch"){
              		        $mMilchpreis = 1.5;   
              		    }else{
              		        $mMilchpreis = 0.0;
              		    }
              		    
              		    return $mMilchpreis;
              		}
              		 
              		//Ermittle anhand des Values (Angabe aus dem Radiobuttonmenü)
              		function ermittle_Flaschengroesse($pValue){
              		    
              		    $mFlaschengroesse = 0.0;
              		    //Für den Fall, dass der Value GLEICH 1 ist
              		    if($pValue == "1"){
              		        //Beträgt die Flaschengröße 1.5
              		        $mFlaschengroesse = 1.5;
              		        //Anderenfalls prüfe weiter
              		    }elseif($pValue == "2"){
              		        $mFlaschengroesse = 0.7;
              		    }elseif($pValue == "3"){
              		        $mFlaschengroesse = 1.0;
              		    }elseif($pValue == "4"){
              		        $mFlaschengroesse = 0.5;
              		    }else{
              		        $mFlaschengroesse = "Bitte w&auml;hlen Sie eine Flaschengr&ouml;&szlig;e aus!";
              		    }             		    
              		    return $mFlaschengroesse;
              		}
              		
              		//Berechne anhand des Milpreises und der Flaschengröße
              		function berechne_Flaschenpreis($pMilchpreis,$pFlaschengroesse){
              		    $mFlaschenpreis = $pMilchpreis *$pFlaschengroesse;
              		    return $mFlaschenpreis;
              		}
              		
              		//Berechne anhand des Flaschenpreises und der Menge
              		function berechne_Zahlungsbetrag($pFlaschenpreis,$pMenge){
              		    $mZahlungsbetrag = $pFlaschenpreis * $pMenge;
              		    return $mZahlungsbetrag;
              		}
              		
              		//Todo-Plan: Methoden/Funktionsaufruf
              		$pValue = pruefe();
              		$pFlaschengroesse = ermittle_Flaschengroesse($pValue);
              		$pMilchpreis = ermittle_Milchpreis($pMilchtyp);
              		$pFlaschenpreis = berechne_Flaschenpreis($pMilchpreis,$pFlaschengroesse);
              		$pZahlungsbetrag = berechne_Zahlungsbetrag($pFlaschenpreis,$pMenge);
              		
              		//Ausgabe
              		echo "Menge (in St&uuml;ck): <h5>".$pMenge." St&uuml;ck</h5>";
              		echo "Milchtyp: <h5>".$pMilchtyp." </h5>";
              		echo "Flaschengr&ouml;&szlig;e: <h5>".$pFlaschengroesse." Liter Flaschen</h5>";
              		echo "Flaschenpreis: <h5>".$pFlaschenpreis." &euro;</h5>";
              		echo "Ergebnis:".round($pZahlungsbetrag,2)." &euro;";
              		?>
              		
              	
              	
              	</fieldset>
          	</form>
        </div><!-- Content-Box -->
        <?php
            include ("sidebar.php"); 
        ?>
        
        <?php
            include ("footer.php"); 
        ?>
        
     </div>  <!-- Wrapper-Box -->
</body> 
</html>
        
        	
