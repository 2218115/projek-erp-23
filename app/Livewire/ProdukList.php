<?php

namespace App\Livewire;

use App\Models\Produk;
use Livewire\Component;
use Livewire\WithPagination;

class ProdukList extends Component
{
    use WithPagination;

    public $search;

    protected $queryString = ['search'];

    public function render()
    {
        $list_produk = Produk::where('nama', 'like', '%' . $this->search . '%')->simplePaginate(10);

        return view('livewire.produk-list', [
            "list_produk" => $list_produk,
        ]);
    }
}
