<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerList extends Component
{
    use WithPagination;

    public $search = '';

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $customer_list = Customer::with(['r_provinsi', 'r_kota'])
            ->where('nama', 'like', '%' . $this->search . '%')
            ->orWhere('nama_perusahaan', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orderBy('nama', 'asc')
            ->paginate(10);

        return view('livewire.customer-list', [
            'customer_list' => $customer_list,
        ]);
    }
}
