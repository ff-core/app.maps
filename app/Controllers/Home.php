<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{	
		return view('welcome_message');
	}

	public function reverse($format = '', $lat = '', $lon = '', $zoom = '', $addressdetails = ''){
		helper('form');
		
		$map = "";

		if ($this->request->getMethod() === 'get'){
			
			$json = "https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=".$lat."&lon=".$lon."&zoom=".$zoom."&addressdetails=".$addressdetails;
			$ch = curl_init($json);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:59.0) Gecko/20100101 Firefox/59.0");
			$jsonfile = curl_exec($ch);
			curl_close($ch);
			if ($format === 'json')
				die($jsonfile);
			else if($format === 'show'){
				$map = json_decode($jsonfile,true);
			}
			
			
		} else if ($this->request->getMethod() === 'post'&& $this->validate(['lat' => 'required','lon'  => 'required'])){
			$format = 'jsonv2';
			$zoom = '18';
			$addressdetails = 1;
			$lat = $this->request->getPost('lat');
			$lon = $this->request->getPost('lon');
			$json = "https://nominatim.openstreetmap.org/reverse?format=".$format."&lat=".$lat."&lon=".$lon."&zoom=".$zoom."&addressdetails=".$addressdetails;
			$ch = curl_init($json);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:59.0) Gecko/20100101 Firefox/59.0");
			$jsonfile = curl_exec($ch);
			curl_close($ch);
			$map = json_decode($jsonfile,true);
		}
	

		$data['map'] = $map;
		$data['lat'] = $lat;
		$data['lon'] = $lon;

		return view('maps/mapa', $data);
	}

	/**
	 * format retorno json
	  Array
	(
		[place_id] => 130503263
		[licence] => Data © OpenStreetMap contributors, ODbL 1.0. https://osm.org/copyright
		[osm_type] => way
		[osm_id] => 171451182
		[lat] => -21.17093310811398
		[lon] => -47.81423685674214
		[place_rank] => 26
		[category] => highway
		[type] => residential
		[importance] => 0.1
		[addresstype] => road
		[name] => Rua Padre Feijó
		[display_name] => Rua Padre Feijó, Centro, Ribeirão Preto, Região Imediata de Ribeirão Preto, Região Metropolitana de Ribeirão Preto, Região Geográfica Intermediária de Ribeirão Preto, São Paulo, Região Sudeste, 14050-350, Brasil
		[address] => Array
			(
				[road] => Rua Padre Feijó
				[suburb] => Centro
				[city_district] => Ribeirão Preto
				[city] => Ribeirão Preto
				[municipality] => Região Imediata de Ribeirão Preto
				[county] => Região Metropolitana de Ribeirão Preto
				[state_district] => Região Geográfica Intermediária de Ribeirão Preto
				[state] => São Paulo
				[region] => Região Sudeste
				[postcode] => 14050-350
				[country] => Brasil
				[country_code] => br
			)

		[boundingbox] => Array
			(
				[0] => -21.1742118
				[1] => -21.1706098
				[2] => -47.8172862
				[3] => -47.8139324
			)

	)
	 */
}
