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
                	<legend>Rabatt- und Zahlungsbetrag berechnen</legend>
              		<?php 
              		//EINGABE: Eingaben lesen
              		$pBetrag = $_POST['tfBetrag'];
              		$pMenge = $_POST['tfMenge'];
              		
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
              		function ermittle_Rabattsatz($pMenge){
              		    $mRabattsatz = 0;
              		    //prüfe ob die Menge Größer gleich 150 ist
              		    if($pMenge >= 150){
              		        //Falls dem so ist setze den Rabattsatz auf 12%
              		        $mRabattsatz = 12;
              		    //Ansonsten prüfe weiter
              		    }elseif ($pMenge >= 100){
              		        $mRabattsatz = 10;
              		    }elseif ($pMenge >= 50){
              		        $mRabattsatz = 8;
              		    }elseif ($pMenge >= 20){
              		        $mRabattsatz = 6;              		        
              		    //sonst setze für alle Anderen Fälle den Rabattsatz auf 0
              		    }else{
              		        $mRabattsatz = 0;
              		    }

              		    return $mRabattsatz;
              		}

              		function berechne_Rabattbetrag($pRabattsatz,$pBetrag){
              		    $mRabattbetrag = $pBetrag/100 * $pRabattsatz;
              		    return $mRabattbetrag;
              		}
              		
              		function berechne_Zahlungsbetrag($pBetrag,$pRabattbetrag){
              		    $mZahlungsbetrag = $pBetrag - $pRabattbetrag;          		                 		    
              		    return $mZahlungsbetrag;
              		}
              		
              		//Methoden/Funktionsaufruf
              		$pRabattsatz = ermittle_Rabattsatz($pMenge);
              		$pRabattbetrag = berechne_Rabattbetrag($pRabattsatz,$pBetrag);
              		$pZahlungsbetrag = berechne_Zahlungsbetrag($pBetrag,$pRabattbetrag);
              		
              		//Ausgabe
              		echo "Betrag (in &euro;):<h5>".$pBetrag." &euro;</h5>";
              		echo "Menge (in St&uuml;ck): <h5>".$pMenge." St&uuml;ck</h5>";
              		echo "Rabattsatz (in %): <h5>".$pRabattsatz." %</h5>";
              		echo "Rabattbetrag (in &euro;): <h5>".$pRabattbetrag." &euro;</h5>";
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
        
        	
