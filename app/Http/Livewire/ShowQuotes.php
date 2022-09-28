<?php

namespace App\Http\Livewire;

use App\Services\ApiService;
use Livewire\Component;

class ShowQuotes extends Component
{
    public function render()
    {
        return view('livewire.show-quotes');
    }
}
