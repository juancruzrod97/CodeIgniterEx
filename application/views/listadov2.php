<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" data-show="1">
  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nueva nota
</button>
<p></p>

<table class="table table-bordered">
	<tr>
		<td>Nota id</td>
		<td>Titulo</td>
		<td>Texto</td>
		<td>Fecha</td>
		<td>&nbsp;</td>
	</tr>
	<?php
		if(is_array($notas)){
			foreach($notas as $n){
	?>
	<tr>
		<td><?php echo $n["nota_id"];?></td>
		<td><?php echo $n["titulo"];?></td>
		<td><?php echo $n["texto"];?></td>
		<td>
			<?php 
				$fecha = date_create($n["fecha"]);
				echo date_format($fecha, "d/m/Y H:i");
			?>
        </td>
		<td align="center"><a href="<?php echo site_url('notas/borrar/'.$n['nota_id'])?>" class="btn btn-danger btn-sm">Borrar</a></td>
	</tr>
	<?php
			}
		}
	?>
</table>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="modal_agregarnota">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nueva nota</h4>
      </div>
      <form method="post" action="<?php echo site_url('notas/guardarnota/'); ?>">
      	<div class="modal-body"> 
              <div class="form-group">
                <label for="titulo">Titulo</label>
                <input type="text" class="form-control" name="titulo" id="titulo" required>
              </div>
              <div class="form-group">
                <label for="texto">Texto</label>
                <input type="text" class="form-control" name="texto" id="texto" required>
              </div>
      	</div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
	$(document).ready(function(e) {
		<?php if(isset($nueva)){ ?>
			$("#myModal").modal("show");
		<?php } ?>
    });
</script>