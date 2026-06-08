


	<div id="content">
        <form name="bmirechnerformular"
        method="post" action="bmi1.php">
        	 <fieldset>
                <legend>BMI ausrechnen</legend>
             <label for="tfGewicht">
				Gewicht (in Kg):
			 </label> <br />
             <input type="number" 
             	name="tfGewicht" 
				id="tfGewicht" 
				placeholder="##" 
				required="required"
				autofocus="autofocus"/><br /><br />
             <label for="tfGroesse">
				Gr&ouml;&szlig;e (in m):
			 </label> <br />
              <input type="number"  step="0.01"
             	name="tfGroesse" 
				id="tfGroesse" 
				placeholder="#.##" 
				required="required"/><br /><br />       
			 <label for="tfAlter">
				Alter (in Jahren):
			 </label> <br />
              <input type="number"  step="1"
             	name="tfAlter" 
				id="tfAlter" 
				placeholder="##" 
				required="required"/><br /><br /> 
           	  <label for="ddGeschlecht">Geschlecht w&auml;hlen:</label><br /> 

                <select name="ddGeschlecht" id="ddGeschlecht">
                  <option value="1">M&auml;nnlich</option>
                  <option value="2">Weiblich</option>
                </select><br /><br />  
           	
           	
           	<input type="submit" 
					value="Ausrechnen" name='bmiAusrechnen'/>
            <?php echo"<input type='button' value='Zur&uuml;ck' 
                onClick='history.back()' />" ?> 
                        
             </fieldset>
        	 
        </form>           
	</div>	


