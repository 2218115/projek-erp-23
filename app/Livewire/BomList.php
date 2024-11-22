<?php

namespace App\Livewire;

use App\Models\Bom;
use Livewire\Component;
use Livewire\WithPagination;

class BomList extends Component
{
    use WithPagination;

    public $search = '';

    protected $queryString = ['search'];

    public function render()
    {
        $bom_list = Bom::with('bahan_baku')->where('nama', 'like', '%' . $this->search . '%')->paginate(10);

        return view('livewire.bom-list', compact('bom_list'));
    }
}
