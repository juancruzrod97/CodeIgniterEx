<table class="table table-bordered">
	<tr>
		<td>Usuario ID</td>
		<td>Usuario</td>
		<td>Estado</td>
		<td>&nbsp;</td>
	</tr>
	<?php
		if(is_array($usuarios)){
			foreach($usuarios as $n){
	?>
	<tr>
		<td><?php echo $n["usuario_id"];?></td> <!--?holas  -->
		<td><?php echo $n["usuario"];?></td>
		<td><?php echo $n["activo"];?></td>
        <td>chan</td>
	</tr>
	<?php
			}
		}
	?>
</table>