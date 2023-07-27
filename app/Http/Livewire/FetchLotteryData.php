<?php

namespace App\Http\Livewire;

use Livewire\Component;
use GuzzleHttp\Client;
use App\Models\Lotofacil;
use App\Models\SorteiosMunicipio;
use App\Models\SorteiosPremio;
use Carbon\Carbon;

class FetchLotteryData extends Component
{
    public function render()
    {
        return view('livewire.fetch-lottery-data');
    }

    public function fetchLotteryData()
    {
        //$client = new Client();
        $client = new Client(['verify' => false]);
        $response = $client->request('GET', 'https://servicebus2.caixa.gov.br/portaldeloterias/api/lotofacil/');
    
        $sorte = json_decode($response->getBody()->getContents(), true);
        $datanova = Carbon::createFromFormat('d/m/Y', $sorte['dataApuracao'])->format('Y-m-d');
    
        $sorteioData = Lotofacil::where('Data', $datanova)->first();
    
        if (!$sorteioData) 
        {
            $datanova2 = Carbon::createFromFormat('d/m/Y', $sorte['dataApuracao'])->subDay()->format('Y-m-d');
            $concurso = Lotofacil::where('Data', $datanova2)->first();
    
            $acumulado = $sorte['acumulado'] ? 1 : 0;
    
            $jogo = Lotofacil::create([
                'Concurso' => $sorte['numero'],
                'B1' => $sorte['dezenasSorteadasOrdemSorteio'][0],
                'B2' => $sorte['dezenasSorteadasOrdemSorteio'][1],
                'B3' => $sorte['dezenasSorteadasOrdemSorteio'][2],
                'B4' => $sorte['dezenasSorteadasOrdemSorteio'][3],
                'B5' => $sorte['dezenasSorteadasOrdemSorteio'][4],
                'B6' => $sorte['dezenasSorteadasOrdemSorteio'][5],
                'B7' => $sorte['dezenasSorteadasOrdemSorteio'][6],
                'B8' => $sorte['dezenasSorteadasOrdemSorteio'][7],
                'B9' => $sorte['dezenasSorteadasOrdemSorteio'][8],
                'B10' => $sorte['dezenasSorteadasOrdemSorteio'][9],
                'B11' => $sorte['dezenasSorteadasOrdemSorteio'][10],
                'B12' => $sorte['dezenasSorteadasOrdemSorteio'][11],
                'B13' => $sorte['dezenasSorteadasOrdemSorteio'][12],
                'B14' => $sorte['dezenasSorteadasOrdemSorteio'][13],
                'B15' => $sorte['dezenasSorteadasOrdemSorteio'][14],
                'data' => $datanova,
                'acumulado' => $acumulado,
            ]);
            
    
            if ($jogo) 
            {
                foreach ($sorte['listaMunicipioUFGanhadores'] as $value)
                {
                    SorteiosMunicipio::create([
                        'municipio' => $value['municipio'],
                        'uf' => $value['uf'],
                        'data' => $datanova,
                        'concurso' => $sorte['numero'],
                    ]);
                }
    
                foreach ($sorte['listaRateioPremio'] as $value)
                {
                    SorteiosPremio::create([
                        'descricaoFaixa' => $value['descricaoFaixa'],
                        'numeroDeGanhadores' => $value['numeroDeGanhadores'],
                        'valorPremio' => $value['valorPremio'],
                        'concurso' => $sorte['numero'],
                    ]);
                }
            }
        }
    }
}
