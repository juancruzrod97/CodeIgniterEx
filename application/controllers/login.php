<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');//Impedir que traten de acceder al archivo directamente

class Login extends CI_Controller {//Nombre de la clase igual a la del archivo
	
	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->mostrar("login");
	}
	
	public function ingresar()
	{
		$usuario=$this->input->post("usuario");
		$password=$this->input->post("password");
		$this->load->model("usuarios_model"); //carga la libreria de usuarios, si se necesita en todas las funciones se carga directamente en el constructor para que este disponible para todas ellas
		
		/*if($usuario=="admin" and $password=="1234"){
			$this->session->set_userdata("usuario_id",1);
			$this->session->set_userdata("usuario","admin");
			redirect("notas/listadocompleto"); sin conexion a la base*/
			
		if($usr=$this->usuarios_model->checklogin($usuario,$password)){ //con conexion a la base
			$this->session->set_userdata("usuario_id",$usr["usuario_id"]);
			$this->session->set_userdata("usuario",$usr["usuario"]);
			redirect("notas/listadocompleto");
		}else{
			$this->session->set_flashdata("op","error");
			redirect("login");
		}
	}
	
	public function salir(){
		$this->session->sess_destroy();
		$this->session->set_flashdata("op","salir");
		redirect("login");
	}
	
	private function mostrar($vista="",$datos=array())
	{
		$this->load->view("tema/cabecera_login"); //para que no muestre la barra
		$this->load->view($vista,$datos);
		$this->load->view("tema/pie");
	}
	
}