<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Lotofacil;

class UserLotteries extends Component
{
    public $dataSorteio;
    public $resultados;
    public $statusMessage;

    public function buscar()
    {
        $this->resultados = [];
        $lotofacil = Lotofacil::whereDate('data', $this->dataSorteio)->first();

        $this->statusMessage = null;
       
        if (!$lotofacil) {
            $this->statusMessage = 'Nenhum resultado para esta data.';
            
            return;
        }

        
        $bolasSorteadas = $lotofacil->getNumbers();

        foreach (Auth::user()->lotteries as $lottery) {
            $acertos = 0;
            $numerosAcertados = [];
            for ($i = 1; $i <= 15; $i++) {
                if (in_array($lottery["number_$i"], $bolasSorteadas)) {
                    $acertos++;
                    $numerosAcertados[] = $lottery["number_$i"];
                }
            }
            $this->resultados[] = ['lottery' => $lottery, 'acertos' => $acertos, 'acertados' => $numerosAcertados];
        }
       
    }
public function editar($id)
{
    // Aqui você pode redirecionar para a página de edição ou abrir um modal de edição, etc.
    // Este é apenas um exemplo de redirecionamento
    return redirect()->route('lottery.edit', ['id' => $id]);
}

public function excluir($id)
{
    // Aqui você pode deletar a loteria diretamente ou abrir um modal de confirmação de exclusão, etc.
    // Este é apenas um exemplo de deletar diretamente
    $lottery = Auth::user()->lotteries()->find($id);
    if ($lottery) {
        $lottery->delete();
    }

    // Atualize a visualização para remover a loteria excluída
    $this->render();
}


    public function render()
    {
        $lotteries = Auth::user()->lotteries;
        
        return view('livewire.user-lotteries', [
            'lotteries' => $lotteries, 
            'resultados' => $this->resultados
        ]);
    }
}
