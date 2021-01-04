<?php

namespace App\Http\Livewire\MakePc;

use Carbon\Carbon;
use Livewire\Component;

class Filter extends Component
{
    public $key = '', $datefrom = '', $dateto = '', $searchFor = '', $searchForDate = '';

    public function search() {
        $this->emitup('search', array(
            'key' => $this->key,
            'datefrom' => ($this->datefrom == "" ? Carbon::create(1900,1,1)->format('Y-m-d') : $this->datefrom),
            'dateto' => ($this->dateto == "" ? Carbon::now('America/Argentina/Buenos_Aires')->format('Y-m-d') : $this->dateto),
            'searchFor' => $this->searchFor,
            'searchForDate' => $this->searchForDate
        ));

    }

    public function deleteFilter() {
        $this->reset();
        $this->emitUp('deleteFilter');
    }

    public function render()
    {
        return view('livewire.make-pc.filter');
    }
}
