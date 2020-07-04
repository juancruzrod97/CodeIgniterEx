<?php
	class Usuarios_model extends CI_Model{
		
		function __construct(){
			parent::__construct();
		}
		function obtener_por_id($usuario_id=""){
			$this->db->where("usuario_id",$usuario_id);
			$this->db->limit(1);
			$res=$this->db->get("usuarios");
			if($res->num_rows()){
				return $res->row_array();
			}else{
				return false;
			}
		}
		
		function borrar($usuario_id="")
		{
			if(intval($usuario_id))
			{
				$this->db->where("usuario_id",$usuario_id);
				$this->db->delete("usuarios");
				if($this->db->affected_rows()){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		
		function listar_todo()
		{
			$this->db->order_by("usuario","asc");
			$res=$this->db->get("usuarios");
			if($res->num_rows())
			{
				return $res->result_array();//Como devuelve mas de un resultado, usamos result_array
			}else
			{
				return false;
			}
		}
		
		function checklogin($usuario="",$password=""){
			$this->db->where("usuario",$usuario);
			$this->db->where("password",$password);
			$this->db->limit(1);
			$resultado = $this->db->get("usuarios");
			if($resultado->num_rows()){
				return $resultado->row_array(); //Para resultados simples(solo devuelve esa fila de datos)
			}else{
				return false;
			}
		}
	}
?>