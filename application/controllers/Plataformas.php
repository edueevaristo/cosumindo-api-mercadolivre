<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plataformas extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('ml');

	}


	//Inicial
	public function index()
	{
		$data['title'] = 'Tipos de Consultas';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav-top', $data);
		$this->load->view('pages/dashboard', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('templates/js', $data);
	}


	//Consulta ANUNCIO via MLB
	public function consulta()
	{  
		$data['title'] = 'Consulta de Dados dos Anúncios';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav-top', $data);
		$this->load->view('pages/consulta', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('templates/js', $data);
	}
	

	public function listaTabela()
	{
		
		$mlb = $this->input->post('mlb');
		$explodir = explode(",", $mlb);
		$html= "";

		foreach($explodir as $isMlb){

			$getErros = $this->ml->getDados($isMlb);
			$dados = json_decode($getErros->body);

			if($getErros->httpCode != 200) 
			{
				echo "O MLB inserido não foi encontrado";
				return;
			} 
		
			$html .=
			
				"<tr>
				<td>{$dados->id}</td>
				<td>{$dados->title}</td>
				<td><a target='_blank' href={$dados->permalink}>{$dados->permalink}</a></td>
				<td>{$dados->seller_id}</td>
				<td>{$dados->category_id}</td>
				<td style='width:90px'><p> R$ {$dados->price}</p></td>
				"; 

			foreach($dados->sale_terms as $sale) {
				$html .= "
					<td>{$sale->value_name}</td>

				";
			}
				
				$html .= "
				<td id='img_url'><a><img style='
				width: 100px; 
				display: block; 
				float: right; 
				margin-right: 10px;' src={$dados->thumbnail}></a></td>
				</tr>
				";
		
		}
		echo json_encode(['html' => $html]);		  
}



	public function consultacliente()
	{
		$data['title'] = 'Consulta de Clientes via ID';
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav-top', $data);
		$this->load->view('pages/consulta-cliente', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('templates/js', $data);
	}


	public function listaTabelaCliente()
	{
		$clienteid = $this->input->post('recebeIdCliente');
		
		$explodir = explode(",", $clienteid);
		$html =  "";
		
		foreach($explodir as $idCliente){
			$data = $this->ml->getCliente($idCliente);
			$conteudo = json_decode($data->body);


			// Tratar link
			$linkAcesso = $conteudo->permalink;
			$link = str_replace('http://perfil.mercadolivre.com.br/', 'http://mercadolivre.com.br/perfil/', $linkAcesso);


			//Tratar status (tradução)
			$statusConta = $conteudo->status->site_status;
			if($statusConta === 'active') {
				$status = str_replace("active", "ativo", $statusConta);
			} else {
				$status = str_replace("deactive", "inativo", $statusConta);
			}
			

			$html .=
			"<tr>
			<td>{$conteudo->id}</td>
			<td>{$conteudo->nickname}</td>
			<td>{$conteudo->registration_date}</td>
			<td>{$conteudo->country_id}</td>
			<td>{$conteudo->address->state}</td>
			<td>{$conteudo->address->city}</td>
			<td>{$conteudo->user_type}</td>
			<td>{$conteudo->seller_reputation->power_seller_status}</td>
			<td><a target='_blank' href={$link}>{$link}</a></td>
			<td>{$status}</td>
			</tr>
			";

		}

		echo json_encode(['html' => $html]);

	}

	

	public function consultaviapelido() {

		$data['title'] = 'Consulta de ClienteID via Apelido';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav-top', $data);
		$this->load->view('pages/consultaviapelido', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('templates/js', $data);

	}

	/* Operator "??"..
	It's a null coalescing operator. It's a shorthand for:
	<code> = explode("," , isset() ?  : '');
	</code> 
	*/
	// public function listaTabelaId()
	// {
	// 	$apelido = $this->input->post('buscaDadosCliente');
	// 	$busca = explode("," , $apelido ?? '');

	// 	$html = "";
		
	// 	foreach($busca as $userid){
	// 		$getDados = $this->ml->getProdutos($userid);
	// 		$dados = json_decode($getDados->body);

	// 		var_dump(json_encode($dados));
	// 		die;

			
	// 		$html .=
	// 		"<tr>
	// 			<td>{}</td>
	// 			<td>{}</td>
	
	// 		</tr>
	// 		";

	// 	}

	// 	echo json_encode(['html' => $html]);
	
	// }
}