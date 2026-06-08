	<div id="content">
        <form name="urlaubstagerechnerformular"
        method="post" action="urlaub1.php">
        	 <fieldset>
                <legend>Urlaubstagerechner</legend>
             <div id = "left">
                 <label for="tfAlter">
    				Alter:
    			 </label> <br />
                 <input type="number" step="1"
                 	name="tfAlter" 
    				id="tfAlter" 
    				placeholder="##" 
    				required="required"
    				autofocus="autofocus"/><br /><br />    
             </div>
             <div id = "left">
                  	<label for="ddBehinderung">Behinderungsgrad > 50%:</label>
    
                    <select name="ddBehinderung" id="ddBehinderung">
                      <option value="Ja">Ja</option>
                      <option value="Nein">Nein</option>
                    </select> <br /><br /> 
     
					<input type="submit"value="Ausrechnen" name='Ausrechnen'/>
           			<?php echo"<input type='button' value='Zur&uuml;ck' 
                onClick='history.back()' />" ?> 
                </div>       	
        	</fieldset> 
        </form>           
	</div>	


