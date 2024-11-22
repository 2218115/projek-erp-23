<?php

namespace App\Livewire;

use App\Models\MO;
use App\Models\MOStatus;
use Livewire\Component;
use Livewire\WithPagination;

class MOList extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';

    protected $queryString = ['search', 'status'];

    public function mount()
    {
        // $this->status = MOStatus::first()->id;
    }

    public function render()
    {
        $mo_list = null;
        if ($this->status == '') {
            $mo_list = MO::whereHas('produk', function ($query) {
                $query->where('nama', 'like', '%' . $this->search . '%');
            })->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $mo_list = MO::orderBy('created_at', 'desc')->where('id_status', 'like', $this->status)->paginate(10);
        }

        $status_list = MOStatus::all();

        return view('livewire.m-o-list', [
            'mo_list' => $mo_list,
            'status_list' => $status_list,
        ]);
    }
}
