	<div id="content">
        <form name="taschenrechnerformular"
        method="post" action="trechner1.php">
        	 <fieldset>
                <legend>Taschenrechner</legend>
             <label for="tfZahl1">
				Zahl 1:
			 </label> <br />
             <input type="number" step="0.01"
             	name="tfZahl1" 
				id="tfZahl1" 
				placeholder="##.##" 
				required="required"
				autofocus="autofocus"/><br /><br />
             <label for="tfZahl2">
				Zahl 2:
			 </label> <br />
              <input type="number"  step="0.01"
             	name="tfZahl2" 
				id="tfZahl2" 
				placeholder="##.##" 
				required="required"/><br /><br />       

                        
             </fieldset>
			<fieldset>
                <legend>Operationen ausw&auml;hlen</legend>
                <div id="left">
                    <input type="radio" name="rbOperator" value="1"/>+ (addieren)<br/><br/>
                    <input type="radio" name="rbOperator" value="2"/>- (subtrahieren)<br/><br/>
                    <input type="radio" name="rbOperator" value="5"/>^ (potenzieren)<br/><br/>
                </div>
                <div id="right">
					<input type="radio" name="rbOperator" value="3"/>* (multiplizieren)<br/><br/>
					<input type="radio" name="rbOperator" value="4"/>/ (dividieren)<br/><br/>         
					<input type="submit" 
						value="Ausrechnen" name='Ausrechnen'/>
           			<?php echo"<input type='button' value='Zur&uuml;ck' 
                onClick='history.back()' />" ?> 
                </div>       	
        	</fieldset> 
        </form>           
	</div>	


