<?php

namespace App\Livewire;

use App\Models\Vendor;
use Livewire\Component;
use Livewire\WithPagination;

class VendorList extends Component
{
    use WithPagination;

    public $search = '';

    protected $query = ['search'];

    public function mount() {}

    public function render()
    {
        $vendor_list = Vendor::where('nama', 'like', '%' . $this->search . '%')->paginate(10);

        return view('livewire.vendor-list', [
            'vendor_list' => $vendor_list,
        ]);
    }
}
