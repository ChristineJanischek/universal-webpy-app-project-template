


	<div id="content">
        <form name="rabattrechnerformular"
        method="post" action="rabatt1.php">
        	 <fieldset>
                <legend>Rabatt- und Zahlungsbetrag berechnen</legend>
             <label for="tfBetrag">
				Betrag (in €):
			 </label> <br />
             <input type="number" 
             	name="tfBetrag" 
				id="tfBetrag" 
				placeholder="###.##" 
				required="required"
				autofocus="autofocus"/><br /><br />
             <label for="tfMenge">
				Menge (in St&uuml;ck):
			 </label> <br />
              <input type="number"  step="1.00"
             	name="tfMenge" 
				id="tfMenge" 
				placeholder="#.##" 
				required="required"/><br /><br />       
           	<input type="submit" 
					value="Ausrechnen" name='rabattAusrechnen'/>
            <?php echo"<input type='button' value='Zur&uuml;ck' 
                onClick='history.back()' />" ?> 
                        
             </fieldset>
        	 
        </form>           
	</div>	


