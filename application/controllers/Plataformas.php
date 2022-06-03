<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plataformas extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Plataforma_model", "plataforma");
	}


	//LISTAR PLATAFORMA
	public function index()
	{
		$data['plataformas'] = $this->plataforma->index();
		// print_r($data);
		$data['title'] = 'Dashboard de Plataformas';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav-top', $data);
		$this->load->view('pages/plataformas', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('templates/js', $data);
	}



	// INSERT PLATAFORMA
	public function cadastrar()
	{
		$data["title"] = 'Adicionar Plataforma';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav-top', $data);
		$this->load->view('pages/formulario', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('templates/js', $data);
	}

	public function inserir()
	{
		$plataforma = $_POST;
		$return = $this->plataforma->inserir($plataforma);
		redirect("plataformas");
	}

	


	// UPDATE PLATAFORMA
	public function atualizar($id)
	{
		$data["title"] = 'Atualizar Plataforma';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav-top', $data);
		$this->load->view('pages/formulario', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('templates/js', $data);
	}

	public function mostrar($id)
	{
		$data["title"] = 'Atualizar Plataforma';
		$data["plataforma"] = $this->plataforma->mostrar($id);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav-top', $data);
		$this->load->view('pages/formulario', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('templates/js', $data);
	}

	public function editar($id) 
	{
		$plataforma = $_POST;
		$this->plataforma->editar($id, $plataforma);
		redirect("plataformas");
	}




	//DELETE PLATAFORMA
	public function deletar($id)
	{
		$this->plataforma->deletar($id, $plataforma);
		redirect('plataformas');
	}




	//Consulta ANUNCIO API
	public function consulta()
	{  
		$data['title'] = 'Consulta de Dados dos Anúncios';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav-top', $data);
		$this->load->view('pages/consulta', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('templates/js', $data);
	}
	

	//LISTA TABELA ANUNCIO API
	public function listaTabela()
	{
		$mlb = $this->input->post('mlb');
		$explodir = explode("/", $mlb);
		$html= ""; //para obter o acesso dentro do foreach

		foreach($explodir as $isMlb){
	
			$getErros = $this->getDados($isMlb);
			$dados = json_decode($getErros->body);

			if($getErros->httpCode != 200) 
			{
				echo "O MLB inserido não foi encontrado";
				return;
			} 
		
			$html .=
			
				"<tr>
				<td>{$dados->id}</td>
				<td>{$dados->site_id}</td>
				<td>{$dados->title}</td>
				<td>{$dados->seller_id}</td>
				<td>{$dados->category_id}</td>
				<td>{$dados->price}</td>
				<td>{$dados->currency_id}</td>
				</tr>"; 


			foreach($dados->sale_terms as $sale) {
				$html .= "
				<tr>
					
					<td><b>Tempo/Tipo de Garatia: </b>{$sale->value_name}</td>
				</tr>
				";
			}

			foreach($dados->pictures as $img){
				$html .= "

				<tr>
				<td id='img_url'><a><img style='width: 100px;' src={$img->url}></a></td>
				</tr>
				";
			}
		
		}
		echo json_encode(['html' => $html]);		  
}

	//API BUSCA ANUNCIO
	public function getDados($mlb) {
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.mercadolibre.com/items/$mlb",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		));

		$response = curl_exec($curl);
		$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);
		return (object) [
			'httpCode' => $code,
			'body' => $response
		];


	
	}


	public function consultacliente()
	{
		$data['title'] = 'Consultando o Cliente';
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav-top', $data);
		$this->load->view('pages/consulta-cliente', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('templates/js', $data);
	}


	public function listaTabelaCliente()
	{
		$clienteid = $this->input->post('recebeIdCliente');
		
		//idclientesparateste = 202593498,670174328,3484260
		$buscaVariosClientes = explode(",", $clienteid);
		$html =  "";
		
		foreach($buscaVariosClientes as $idCliente){
			$data = $this->getCliente($idCliente);
			
			$html .=
			"<tr>
			<td>{$data->id}</td>
			<td>{$data->nickname}</td>
			<td>{$data->registration_date}</td>
			<td>{$data->country_id}</td>
			<td>{$data->address->city}</td>
			<td>{$data->address->state}</td>
			<td>{$data->user_type}</td>
			<td>{$data->tags[0]}</td>
			<td>{$data->tags[1]}</td>
			<td>{$data->logo}</td>
			<td>{$data->points}</td>
			<td>{$data->site_id}</td>
			<td>{$data->permalink}</td>
			<td>{$data->seller_reputation->level_id}</td>
			<td>{$data->seller_reputation->power_seller_status}</td>
			<td>{$data->seller_reputation->transactions->canceled}</td>
			<td>{$data->seller_reputation->transactions->completed}</td>
			<td>{$data->seller_reputation->transactions->period}</td>
			<td>{$data->seller_reputation->transactions->ratings->negative}</td>
			<td>{$data->seller_reputation->transactions->ratings->neutral}</td>
			<td>{$data->seller_reputation->transactions->ratings->negative}</td>
			<td>{$data->seller_reputation->transactions->total}</td>
			<td>{$data->status->site_status}</td>

			</tr>
			";

		}

		echo json_encode(['html' => $html]);

	}

	//API BUSCA CLIENTE
	public function getCliente($idCliente) {
		
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.mercadolibre.com/users/$idCliente",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		));

		$response = curl_exec($curl);
		curl_close($curl);
		return json_decode($response);
	}



	public function consultaviapelido() {

		$data['title'] = 'Consulta de Cliente via Apelido';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav-top', $data);
		$this->load->view('pages/outraconsulta', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('templates/js', $data);

	}

	//CONSULTAR CLIENTE ID ATRAVÉS DO APELIDO
	public function consultaidcliente() {

		$curl = curl_init();
		// TETE2870021
		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://api.mercadolibre.com/sites/MLA/search?nickname= ',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		));

		$response = curl_exec($curl);

		curl_close($curl);
		echo $response;

	}
}



