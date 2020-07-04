<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');//Impedir que traten de acceder al archivo directamente

class Notas extends CI_Controller {//Nombre de la clase igual a la del archivo
	
	function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata("usuario_id")){
			$this->session->set_flashdata("op","prohibido");
			redirect("login");
		}
		$this->load->model("notas_model");
	}
	
	public function index()
	{
		//echo "Este es el controlador de usuarios";
		//$this->load->view("vistausuarios");
		redirect("notas/listado","refresh");
	}
	
	public function ver()
	{
		//$this->output->enable_profiler(true);
		$datos=array();
		//$this->db->where("usuario_id",$usuario_id);
		//$resultado = $this->db->get("notas");
		$resultado=$this->notas_model->listar_todo();
		$this->load->library("table");
		$heading=array("Nota id","Titulo","Texto","Usuario id","Fecha");
		
		$this->table->set_template(array("table_open"=>"<TABLE class='table table-hover'>"));
		//$this->table->set_heading("Nota id","Titulo","Texto","Usuario id","Fecha");
		$this->table->set_heading($heading);
		$datos["tabla"]=$this->table->generate($resultado);
		//echo $this->db->last_query();
		$this->mostrar("listado",$datos);
	}
	
	
	
	public function listado()
	{
		$this->db->order_by("titulo");
		//$resultado = $this->db->get("notas");
		$resultado=$this->notas_model->listar_todo();
		$this->load->library("table");
		echo $this->table->generate($resultado);
	}
	
	public function listadocompleto()
	{
		$datos=array();
		$datos["notas"]=$this->notas_model->listar_todo($this->session->userdata["usuario_id"]);
		if($this->session->flashdata("nueva")){
			$datos["nueva"]=true;
		}
		//$resultado=$this->notas_model->listar_todo();
		$this->mostrar("listadov2",$datos);
	}
	
	function guardarnota(){
		$datos = $this->input->post();
		$datos["usuario_id"] = $this->session->userdata("usuario_id");
		$this->notas_model->alta($datos);
		redirect("notas/listadocompleto","refresh");
	}
	
	function nuevanota(){
		$this->session->set_flashdata("nueva",true);
		redirect("notas/listadocompleto");
	}
	
	function borrar($nota_id="")
	{
		if(intval($nota_id))
		{
			$this->notas_model->borrar($nota_id);
		}
		redirect("notas/listadocompleto");
	}
	
	private function mostrar($vista="",$datos=array())
	{
		$this->load->view("tema/cabecera");
		$this->load->view($vista,$datos);
		$this->load->view("tema/pie");
	}
	
	public function webservice()
		{
			header('Content-Type: application/json');
			$datos=$this->notas_model->listar_todo();
			echo json_encode($datos);
		}
}