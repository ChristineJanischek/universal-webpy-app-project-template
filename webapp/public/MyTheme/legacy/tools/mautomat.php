	<div id="content">
        <form name="milchautomatformular"
        method="post" action="mautomat1.php">
        	 <fieldset>
                <legend>Milchautomat</legend>
             <div id = "left">
                 <label for="tfMenge">
    				Menge:
    			 </label> <br />
                 <input type="number" step="1"
                 	name="tfMenge" 
    				id="tfMenge" 
    				placeholder="##" 
    				required="required"
    				autofocus="autofocus"/><br /><br />    
             </div>
             <div id = "right">
              	<label for="ddMilchtyp">Milchtyp w&auml;hlen:</label>

                <select name="ddMilchtyp" id="ddMilchtyp">
                  <option value="Vollmilch">Vollmilch</option>
                  <option value="Laktosefreie Milch">Laktosefreie Milch</option>
                  <option value="Fettarme Milch">Fettarme Milch</option>
                  <option value="Sojamilch">Sojamilch</option>
                </select> 
             </div>           
                <div id="left">
                    <input type="radio" name="rbOperator" value="1"/>Gro&szlig;e Flasche (1,5 Liter)<br/><br/>
                    <input type="radio" name="rbOperator" value="2"/>Mittlere Flasche (0,7 Liter)<br/><br/>
                </div>
                <div id="right">
					<input type="radio" name="rbOperator" value="3"/>Normale Flasche (1 Liter)<br/><br/>
					<input type="radio" name="rbOperator" value="4"/>Kleine Flasche (0,5 Liter)<br/><br/>         
					<input type="submit"value="Ausrechnen" name='Ausrechnen'/>
           			<?php echo"<input type='button' value='Zur&uuml;ck' 
                onClick='history.back()' />" ?> 
                </div>       	
        	</fieldset> 
        </form>           
	</div>	


