<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Lottery;
use Illuminate\Support\Facades\Auth;

class LotteryForm extends Component
{
    public $selectedNumbers = [];
    public $statusMessage = '';

    
    public function render()
    {
        return view('livewire.lottery-form');
    }

    public function toggleNumber($number)
    {
        if(in_array($number, $this->selectedNumbers)) {
            $this->selectedNumbers = array_diff($this->selectedNumbers, [$number]);
        }
        else if(count($this->selectedNumbers) < 15) {
            $this->selectedNumbers[] = $number;
        }
    }

    public function save()
    {
        $numbers = $this->selectedNumbers;
        if (is_array($numbers) && count($numbers) == 15) {
            $lottery = new Lottery();
            for ($i = 1; $i <= 15; $i++) {
                $lottery->{"number_$i"} = $numbers[$i - 1];
            }
            $lottery->user_id = Auth::id();
            $lottery->save();

            $this->reset('selectedNumbers');
            $this->statusMessage = 'Escolhas de loteria salvas com sucesso!';
            $this->dispatchBrowserEvent('clear-message', ['timeout' => 3000]); // Limpa a mensagem após 5 segundos

        } else {
            $this->statusMessage = 'Números inválidos';
            $this->dispatchBrowserEvent('clear-message', ['timeout' => 3000]); // Limpa a mensagem após 5 segundos

        }
    
    }
    public function isNumberDisabled($number)
    {
        return count($this->selectedNumbers) >= 15 && !in_array($number, $this->selectedNumbers);
    }
    public function randomSelect()
{
    $this->selectedNumbers = [];

    while (count($this->selectedNumbers) < 15) {
        $randomNumber = rand(1, 25);

        if (!in_array($randomNumber, $this->selectedNumbers)) {
            $this->selectedNumbers[] = $randomNumber;
        }
    }
}

       
}

