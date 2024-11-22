<?php

namespace App\Livewire;

use App\Models\RFQ;
use App\Models\RFQDetail;
use App\Models\RFQStatus;
use Livewire\Component;

class RfqList extends Component
{
    public $search;
    public $status;

    protected $queryString = ['search', 'status'];

    public function render()
    {
        $status_list = RFQStatus::all();
        $rfq_list = RFQ::whereHas('vendor', function ($query) {
            if (isset($this->search)) {
                $query->where('nama', 'like', '%' . $this->search . '%');
            }
        })->where(function ($query) {
            if ($this->status != '') {
                $query->where('id_status', '=', $this->status);
            }
        })->paginate(10);

        return view('livewire.rfq-list', [
            'status_list' => $status_list,
            'rfq_list' => $rfq_list,
        ]);
    }
}
