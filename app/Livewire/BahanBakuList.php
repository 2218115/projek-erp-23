<?php

namespace App\Livewire;

use App\Models\BahanBaku;
use Livewire\Component;

class BahanBakuList extends Component
{

    public $search;

    protected $queryString = ['search'];

    public function render()
    {
        $bahan_baku_list = BahanBaku::where('nama', 'like', '%' . $this->search . '%')->simplePaginate(10);;
        return view('livewire.bahan-baku-list', compact('bahan_baku_list'));
    }
}
