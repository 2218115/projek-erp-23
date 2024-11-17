<?php

namespace App\Livewire;

use App\Models\Bom;
use Livewire\Component;

class BomList extends Component
{
    public function render()
    {
        $bom_list = Bom::with('bahan_baku')->get();

        return view('livewire.bom-list', compact('bom_list'));
    }
}
