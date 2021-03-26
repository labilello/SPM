<?php

namespace App\Http\Livewire\Components;

use Carbon\Carbon;
use Livewire\Component;

class Filter extends Component
{
    public $key = '', $datefrom = '', $dateto = '', $searchFor = '', $searchForDate = '';
    public $searchForFields, $searchForDateFields;

    public function mount($fields) {
        foreach ($fields as $field) {
            switch ($field['type']) {
                case 'date':
                    $this->searchForDateFields[] = $field;
                    break;

                case 'string':
                    $this->searchForFields[] = $field;
                    break;
            }
        }
    }

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
        $this->reset(['key', 'datefrom', 'dateto', 'searchFor', 'searchForDate']);
        $this->emitUp('deleteFilter');
    }

    public function render()
    {
        return view('livewire.components.filter');
    }
}
