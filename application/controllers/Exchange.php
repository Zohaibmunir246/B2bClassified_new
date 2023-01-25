<?php
/**
 * Created by PhpStorm.
 * User: Ali Shan
 * Date: 2/28/2019
 * Time: 1:38 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Exchange extends CI_Controller
{
    private $accessKey = 'f06066375f2597b38bca5bd3a0a74e5f';

	public function __construct()
	{
		parent::__construct();


	}


	public function index()
	{
        /*ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);*/
	    $data = array();
        $bases = [
            'AUD',
            'GBP',
            'CAD',
            'CHF',
            'DKK',
            'EUR',
            'HKD',
            'HUF',
            'INR',
            'JPY',
            'KRW',
            'MYR',
            'MXN',
            'NZD',
            'NOK',
            'PKR',
            'PHP',
            'PLN',
            'RUB',
            'SGD',
            'ZAR',
            'SEK',
            'CHF',
            'TWD',
            'TRY',
            'USD',
        ];
        $symbols = 'USD,EUR,JPY,GBP,CHF,CAD,AUD,HKD';
        $rates = array();
        foreach ($bases as $base){
            $rates[] = $this->realTimeRate($base);
        }
        /*echo '<pre>';
        print_r($rates);
        exit;*/
        $data['rates'] = $rates;
        $this->load->view('frontend/exchange/rates.php', $data);
	}

	private function realTimeRate($base = 'USD',$endPoint = 'latest'){
        $symbols = 'USD,EUR,JPY,GBP,CHF,CAD,AUD,HKD';
        $ch = curl_init('http://data.fixer.io/api/'.$endPoint.'?access_key='.$this->accessKey.'&base='.$base.'&symbols='.$symbols);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $json = curl_exec($ch);
        curl_close($ch);
        $exchangeRates = json_decode($json, true);
        return $exchangeRates;

    }

    private function conversion($from = 'USD',$to = 'EUR',$amount = 1,$endPoint = 'convert'){

        // initialize CURL:
        $ch = curl_init('http://data.fixer.io/api/'.$endPoint.'?access_key='.$this->accessKey.'&from='.$from.'&to='.$to.'&amount='.$amount.'');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // get the JSON data:
        $json = curl_exec($ch);
        curl_close($ch);

        // Decode JSON response:
        $conversionResult = json_decode($json, true);

        return $conversionResult;
    }


}
