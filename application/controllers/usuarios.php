<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');//Impedir que traten de acceder al archivo directamente

class Usuarios extends CI_Controller {//Nombre de la clase igual a la del archivo

	public function __construct(){
		parent:: __construct();
		if(!$this->session->userdata("usuario_id")){
			$this->session->set_flashdata("op","prohibido");
			redirect("login");
		}
		$this->load->model("usuarios_model");
	}
	
	public function index()
	{
		//echo "Este es el controlador de usuarios";
		//$this->load->view("vistausuarios");
		redirect("usuarios/listado","refresh");
	}
	
	public function ver($usuario_id="")
	{
		$datos=array();
		$this->db->where("usuario_id",$usuario_id);
		$resultado = $this->db->get("usuarios");
		//$usuario=$resultado->row_array();
		$this->load->library("table");
		$this->table->set_template(array("table_open"=>"<TABLE class='table table-bordered'>"));
		//echo $this->table->generate($resultado);
		$datos["tabla"]=$this->table->generate($resultado);
		//print_r($usuario);
		$this->mostrar("listado",$datos);
	}
	
	public function nuevo(){
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		$this->form_validation->set_rules('usuario', 'Usuario', 'trim|required'); //(sobre que campo actua, como se va a mostrar y luego las reglas a cumplir separadas por |
		$this->form_validation->set_rules('password', 'Contraseña', 'trim|required');
		$this->form_validation->set_rules('passconf','Confirmar contraseña','trim|required|matches[password]');
		if ($this->form_validation->run() === FALSE){
			$this->mostrar("nuevousuario");
		}else{
			$this->guardadoconexito();
		}
	}
	
	public function guardadoconexito(){
		$this->mostrar("mensaje");
	}
	
	public function listado(){
		$this->db->order_by("usuario");
		$resultado = $this->db->get("usuarios");
		$this->load->library("table");
		$this->table->set_template(array("table_open"=>"<TABLE class='table table-bordered'>"));
		$this->mostrar("listado",$resultado);
	}
	
	public function listadocompleto(){
		$datos=array();
		$datos["usuarios"]=$this->usuarios_model->listar_todo();
		//$resultado=$this->notas_model->listar_todo();
		$this->mostrar("listado",$datos);
	}
	
	private function mostrar($vista="",$datos=array())
	{
		$this->load->view("tema/cabecera");
		$this->load->view($vista,$datos);
		$this->load->view("tema/pie");
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */