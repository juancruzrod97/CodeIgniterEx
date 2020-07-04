<?php
	class Notas_model extends CI_Model{
		
		function __construct(){
			parent::__construct();
		}
		
		function obtener_por_id($nota_id=""){
			$this->db->where("nota_id",$nota_id);
			$this->db->limit(1);
			$res=$this->db->get("notas");
			if($res->num_rows()){
				return $res->row_array();
			}else{
				return false;
			}
		}
		
		function alta($datos=false){//No es recomendable pasar dato por dato, ya que en caso de que quiera agregar un dato mas a la tabla, tendria que cambiar todas las funciones,agregando asi el nuevo dato, por eso usamos array
			if(is_array($datos))
			{
				$this->db->insert("notas",$datos);//En caso de que quiera ingresar mas de un dato junto, como un array con arrays, utilizamos insert_batch
				if($id=$this->db->insert_id()){
					return $id;
				}else{
					return false;
				}
			}else{
				echo "(ノಠ益ಠ)ノ彡┻━┻";
				return false;
			}
		}
		
		function guardar($datos=false,$nota_id){
			if(is_array($datos))
			{
				$this->db->where("nota_id",$nota_id);
				$this->db->update("notas",$datos);
				if($this->db->affected_rows()){//Affected_rows devuelve la cantidad de filas afectadas
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		
		function borrar($nota_id="")
		{
			if(intval($nota_id))
			{
				$this->db->where("nota_id",$nota_id);
				$this->db->delete("notas");
				if($this->db->affected_rows()){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		
		function listar_todo($usuario_id="")
		{
			$this->db->order_by("fecha","desc");
			$this->db->where("usuario_id",$usuario_id);
			$res=$this->db->get("notas");
			if($res->num_rows())
			{
				return $res->result_array();//Como devuelve mas de un resultado, usamos result_array
			}else
			{
				return false;
			}
		}
	}
?>