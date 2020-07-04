<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<div class="panel panel-default">
  			<div class="panel-heading">Ingreso al sistema</div>			
            <div class="panel-body">
			<?php
			if($this->session->flashdata("op")){
				switch($this->session->flashdata("op")){
					case "error":
						$msj = "Usuario y/o contraseña incorrecta";
						break;
					case "salir":
						$msj = "Cerraste sesion";
						break;
					case "prohibido":
						$msj = "No has iniciado sesion";
						break;
					default:
						$msj = "Error desconocido ???";
				}?>
				<div class="alert alert-danger" role="alert" align="center" id="mensaje"><?php echo $msj; ?></div>
			<?php } ?>
    			<form method="post" action="<?php echo site_url("login/ingresar")?>">
				  <div class="form-group">
					<label for="usuariov2">Usuario</label>
					<input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario">
				  </div>
				  <div class="form-group">
					<label for="passwordv2">Password</label>
					<input type="password" class="form-control" id="password" name="password" placeholder="Password">
				  </div>
				  <button type="submit" class="btn btn-danger">Ingresar</button>
				</form>
  			</div>
		</div>
	</div>
</div>
<script>
	<?php
		if($this->session->flashdata("op")){ ?>
		$("#mensaje").delay(2000).hide("slow");
	<?php }?>
</script>