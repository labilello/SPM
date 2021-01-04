<?php

namespace App\Http\Livewire\MakePc;

use App\Makepc;
use Livewire\Component;
use Livewire\WithPagination;

class All extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $searchFor, $key, $searchForDate, $dateFrom, $dateTo;

    protected $listeners = ['search', 'deleteFilter'];

    public function search($data) {
        $this->searchFor = $data['searchFor'];
        $this->searchForDate = $data['searchForDate'];
        $this->key = $data['key'];
        $this->dateFrom = $data['datefrom'];
        $this->dateTo = $data['dateto'];

        $this->resetPage();
    }

    public function deleteFilter() {
        $this->reset();
        $this->resetPage();
    }

    public function render()
    {
        $filterPc = Makepc::query();

        if( $this->searchFor != '' )
            $filterPc = $filterPc->where($this->searchFor, 'LIKE', "%{$this->key}%");

        if( $this->searchForDate != '' )
            $filterPc = $filterPc->whereDate($this->searchForDate, '>=', $this->dateFrom)
                ->whereDate($this->searchForDate, '<=', $this->dateTo);


        $filterPc = $filterPc->orderBy('updated_at', 'DESC')->paginate(15);

        return view('livewire.make-pc.all', [
            'makepcs' => $filterPc
        ])->extends('layouts.layout')
            ->section('content');
    }
}
