<?php

namespace App\Livewire;

use App\Models\BahanBaku;
use Livewire\Component;
use Livewire\WithPagination;

class BahanBakuList extends Component
{
    use WithPagination;

    public $search;

    protected $queryString = ['search'];

    public function render()
    {
        $bahan_baku_list = BahanBaku::where('nama', 'like', '%' . $this->search . '%')->paginate(10);

        return view('livewire.bahan-baku-list', compact('bahan_baku_list'));
    }
}
