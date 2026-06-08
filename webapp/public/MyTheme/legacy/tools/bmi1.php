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
                	<legend>Bmi berechnen</legend>
              		<?php 
              		//EINGABE: Eingaben lesen
              		$pGewicht = $_POST['tfGewicht'];
              		$pGroesse = $_POST['tfGroesse'];
              		$pAlter =  $_POST['tfAlter'];
              		$pGeschlecht =  $_POST['ddGeschlecht'];
              		
              		
              		//Deklaration und Implementierung der Funktion/Methode
              		function berechne_bmi($pGewicht,$pGroesse){
              		    $mGewicht = $pGewicht;
              		    $mGroesse = $pGroesse;
              		    
              		    $mBmi = $mGewicht/($mGroesse*$mGroesse);
              		    return $mBmi;
              		}
              		
              		function ermittle_Kategorie($pBmi, $pGeschlecht){
              		    if($pGeschlecht=="1"){
              		        if($pBmi < 20){
              		            $mKategorie = "Untergewicht";
              		        }elseif($pBmi >= 20 && $pBmi <= 25){
              		            $mKategorie = "Normalgewicht";
              		        }
              		        
              		    }else{
              		        if($pBmi > 19){
              		            $mKategorie = "Untergewicht";
              		        }elseif($pBmi >= 19 && $pBmi <= 24){
              		            $mKategorie = "Normalgewicht";
              		        }
              		    }
              		    return $mKategorie;
              		}
              		
              		function ermittle_Geschlecht($pGeschlecht){
              		    if($pGeschlecht == 1){
              		        $pGeschlecht = "M&auml;lich";
              		    }else{
              		        $pGeschlecht = "Weiblich";
              		    }
              		    
              		    return $pGeschlecht;
              		}
              		
              		function ermittle_OptBmi($pAlter) {
              		    $pOptBmi = "";
              		    if ($pAlter < 19){
              		        $pOptBmi = "keine informationen f&uuml;r Kinder vorhanden";
              		    }elseif ($pAlter >= 19 and $pAlter <= 24){
              		        $pOptBmi = "19-24";
              		    }elseif ($pAlter >= 25 and $pAlter <= 34){
              		        $pOptBmi = "20-25";
              		    }elseif ($pAlter >= 35 and $pAlter <= 44){
              		        $pOptBmi = "21-26";
              		     }elseif ($pAlter >= 45 and $pAlter <= 54){
              		        $pOptBmi = "22-27";
              		     }elseif ($pAlter >= 55 and $pAlter <= 64){
              		        $pOptBmi = "23-28";
              		     }elseif ($pAlter >= 65 ){
              		        $pOptBmi = "24-29";
              		     }
              		    return $pOptBmi;
              		}
              		
              		//Methoden/Funktionsaufruf
              		$pBmi = berechne_bmi($pGewicht,$pGroesse);
              		$pKategorie = ermittle_Kategorie($pBmi, $pGeschlecht);
              		$pGeschlecht = ermittle_Geschlecht($pGeschlecht);
              		$pOptBmi = ermittle_OptBmi($pAlter);
              		
              		//Ausgabe
              		echo "Gewicht (in Kg): <h5>".$pGewicht."</h5>";
              		echo "Gr&ouml;&szlig;e (in m): <h5>".$pGroesse."</h5>";
              		echo "Alter(in Jahren): <h5>".$pAlter."</h5>";
              		echo "Geschlecht: <h5>".$pGeschlecht."</h5>";
              		echo "Kategorie: <h5>".$pKategorie."</h5>";
              		echo "Optimaler BMI: <h5>".$pOptBmi."</h5>";
              		echo "Ergebnis:".round($pBmi,2);
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
        
        	
