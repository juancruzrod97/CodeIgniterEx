<div class="row">
	<div class="col-md-4 col-md-offset-4">
        <form class="form-horizontal" method="post" name="nuevousuario" action="<?php echo site_url("usuarios/nuevo");?>">
            <?php //echo validation_errors(); //para mostrar todos los errores arriba?>
            
            <div class="form-group <?php echo (form_error("usuario"))?"has-error":"";?>">
                <label for="nombreusuario">Nombre del usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" value="<?php echo set_value('usuario'); ?>">
                <span class="help-block"><?php echo form_error('usuario'); ?></span> 
            </div>
            <div class="form-group <?php echo (form_error("usuario"))?"has-error":"";?>">
                <label for="exampleInputPassword1">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <span class="help-block"><?php echo form_error('password'); ?></span> 
            </div>
            <div class="form-group <?php echo (form_error("usuario"))?"has-error":"";?>">
                <label for="contrasenia">Confirmar contraseña</label>
                <input type="password" class="form-control" id="passconf" name="passconf" placeholder="Confirmar password">
                <span class="help-block"><?php echo form_error('passconf'); ?></span> 
            </div>
            <div class="checkbox" id="activo">
                <label>
                  <input type="checkbox" checked="si"> Activo
                </label>
            </div>
            <button type="submit" class="btn btn-default">Crear</button>
        </form>
	</div>
</div>