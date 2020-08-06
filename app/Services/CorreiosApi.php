<?php
namespace App\Services;

use GuzzleHttp;
use DOMDocument;

// Turn off all error reporting
error_reporting(0);

class CorreiosApi
{
    protected $client;

    public function __construct(GuzzleHttp\Client $client)
    {
        $this->client = $client;
    }

    public function requisicao($parametro)
    {
        $response = $this->client->request('POST', env('CORREIOS_URL'), [
                'form_params' => [
                    env('CORREIOS_FORM_CEP') => $parametro
                ]
        ]);

        $body = $response->getBody(true);
        return $body;
    }
    public function buscar($parametro)
    {
        $htmlResponse = $this->requisicao($parametro);

        libxml_use_internal_errors(true);
        $dom = new DOMDocument;
        $dom->preserveWhiteSpace = false;
        $dom->loadHTML($htmlResponse);
        // $rows = $dom->getElementsByTagName('td');
        $Header = $dom->getElementsByTagName('th');
        $Detail = $dom->getElementsByTagName('td');
       
        if ($Detail->length <= 1) {
            return [
                'error' => true,
                'message' => 'Nenhum endereço encontrado'
            ];
        }
        if ($Detail->length >= 8) {
            return [
                'error' => true,
                'message' => 'Nenhum CEP encontrado'
            ];
        }
        //#Get header name of the table
        foreach($Header as $NodeHeader) 
        {
            $aDataTableHeaderHTML[] = trim($NodeHeader->textContent);
        }
        //print_r($aDataTableHeaderHTML); die(); - debug
    
        //#Get row data/detail table without header name as key
        $i = 0;
        $j = 0;
        $teste = [];
        foreach($Detail as $sNodeDetail) 
        {
            $aDataTableDetailHTML[$j][] = trim($sNodeDetail->textContent);
            $i = $i + 1;
            $j = $i % count($aDataTableHeaderHTML) == 0 ? $j + 1 : $j;
        }
        //print_r($aDataTableDetailHTML); die();
        
        //#Get row data/detail table with header name as key and outer array index as row number
        for($i = 0; $i < count($aDataTableDetailHTML); $i++)
        {
            for($j = 0; $j < count($aDataTableHeaderHTML); $j++)
            {
                $aTempData[$i][$aDataTableHeaderHTML[$j]] = $aDataTableDetailHTML[$i][$j];
        }
             array_push($aDataTableDetailHTMl);
        }
        $aDataTableDetailHTML = $aTempData; unset($aTempData);


        return [
            'error' => false,
            'addresses' => $aDataTableDetailHTML
        ];
    }
}
?>
