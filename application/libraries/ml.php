<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Ml {

	const GET = 'GET';
    const POST = 'POST';
    private $url = null;

    public function __construct() {

		$this->url = 'https://api.mercadolibre.com/';

    }


	//Busca anúncio através do MLB
	public function getDados($mlb) 
	{
		return $this->executaCURL(self::GET, "items/$mlb");
	}

	//Busca cliente através do ID
	public function getCliente($idCliente)
	{
		return $this->executaCURL(self::GET, "users/$idCliente");
	}

	public function executaCURL($metodo, $uri) {

		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => $this->url . $uri,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => $metodo,
		));

		$response = curl_exec($curl);
		$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);
		return (object) [
			'httpCode' => $code,
			'body' => $response
		];

	}

} 