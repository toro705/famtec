	<div id="topmenu"></div>
</div>

<div id="wrapper">
	<div id="content" class="login">
    
		<h3>Ingrese su usuario y contrase&ntilde;a</h3>
        
        <form id="form" action="<?php echo base_url() ?>login/dologin" method="post">
 			<fieldset>
				<label for="user">Usuario:</label> 
				<input type="text" name="user" id="user">
			</fieldset>
			
			<fieldset>
				<label for="password">Contraseña:</label>
				<input type="password" name="password" id="password">
			</fieldset>

			<div align="center">
			  <button type="submit">Ingresar</button> 
			</div>
        </form>
		
		<?php 
		if ($error) {echo '<div class="error">'.$error.'</div>';} ?>
	</div>
</div>
