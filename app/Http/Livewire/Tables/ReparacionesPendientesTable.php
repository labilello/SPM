<?php

namespace App\Http\Livewire\Tables;

use App\Repair;
use App\Status;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;

class ReparacionesPendientesTable extends LivewireDatatable
{
    public $hideable = 'select';
    public $exportable = true;
//    public $afterTableSlot = 'components.selected';

    public function builder()
    {
//        return Repair::query();
        return Repair::with('product')->with('status')
            ->where('status_id', Status::where('descripcion', 'Ingresado')->get()->first()->id);
    }

    public function columns()
    {
        return [

            NumberColumn::name('id')->label('#')->filterable(),
//                ->linkTo('repair', 6)

            Column::name('product.descripcion')->label('Producto')->searchable()->filterable(),

            DateColumn::name('date_in')->label('Fecha de Ingreso')->filterable()->format("d/m/Y H:i:s"),

            Column::name('product.familia')->label('Familia')->searchable()->filterable(),

            Column::name('nro_serie')->label('Nro. Serie')->searchable()->filterable()->editable(),

            Column::callback(['id'], function ($id) {
                return view('reparaciones.table-actions', ['id' => $id]);
            })->label('Acciones'),

//            Column::name('planets.name')
//                ->label('Planet')
//                ->filterable($this->planets)->alignRight(),

//            Column::name('planet.region.name')
//                ->label('Region')
//                ->filterable($this->regions)
//                ->searchable(),

//            Column::name('nro_serie')
//                ->filterable()
//                ->editable(),

//            Column::name('comrades.name')
//                ->label('Planet Mates')
//                ->truncate()
//                ->filterable(),
//
//            Column::name('car.model')
//                ->label('Car')
//                ->alignCenter()
//                ->filterable(['Audi', 'BMW', 'Caterham', 'Dodge', 'Ferrari', 'Jaguar', 'Lamborghini', 'Porsche']),
//
//            NumberColumn::name('posts.id:count')
//                ->label('Post Count')
//                ->filterable()
//                ->alignRight(),

//            Column::name('weapons.name')
//                ->filterable($this->weapons->pluck('name'))
//                ->label('Weapon Names'),
//
//            NumberColumn::name('weapons.id')
//                ->filterable()
//                ->label('Weapon Count'),
//
//            Column::callback(['id', 'planet.name'], function ($id, $planetName) {
//                return "User $id hails from $planetName";
//            })->label('Computed (php closure)')
//                ->filterable(),
//
//            Column::raw('CONCAT("User ", users.id, " hails from ", planets.name) AS planetName')
//                ->label('Computed (raw SQL)')
//                ->filterable(),

//            BooleanColumn::name('email_verified_at')
//                ->label('Email Verified')
//                ->filterable(),

//            DateColumn::name('dob')
//                ->label('DOB')
//                ->filterable(),

//            DateColumn::raw('dob AS dob2')
//                ->label('Birthday')
//                ->format('jS F')
//                ->sortBy(DB::raw('DATE_FORMAT(users.dob, "%m%d%Y")')),

//            NumberColumn::raw('FLOOR(DATEDIFF(NOW(), users.dob)/365) AS Age')
//                ->filterable(),

//            NumberColumn::name('planet.orbital_period')
//                ->filterable(),

//            Column::raw("IF(planets.orbital_period REGEXP '^-?[0-9]+$', CONCAT(ROUND(DATEDIFF(NOW(), users.dob) / planets.orbital_period, 1), ' ', planets.name, ' years'), '---') AS native_age")
//                ->filterable()
//                ->hide(),

//            TimeColumn::name('bedtime')
//                ->filterable(),

//            Column::callback('bedtime', 'computeBedtime')
//                ->label('Go to bed')
//                ->hide(),

//            Column::name('email')
//                ->searchable()
//                ->filterable(),
//                ->view('components.email'),

//            Column::name('bio')
//                ->truncate(20)
//                ->filterable(),
//
//            Column::name('role')
//                ->searchable()
//                ->filterable([
//                    'Stormtrooper',
//                    'AT-AT Pilot',
//                    'AT-ST Driver',
//                    'Imperial Guard',
//                    'Shock Trooper',
//                    'Shadow Trooper',
//                    'Purge Trooper',
//                    'Jumptrooper'
//                ]),

//            Column::scope('selectGroupedWeaponNames', 'Weapons')
//                ->filterable($this->weapons, 'filterWeaponNames'),
//
//            BooleanColumn::scope('hasLightSaber', 'Light Saber')
//                ->filterable(null, 'filterHasLightSaber')
        ];
    }

//    public function getPlanetsProperty()
//    {
//        return Planet::pluck('name');
//    }
//
//    public function getRegionsProperty()
//    {
//        return Region::pluck('name');
//    }
//
//    public function getWeaponsProperty()
//    {
//        return Weapon::all();
//    }

//    public function computeBedtime($date)
//    {
//        if (!$date) {
//            return;
//        }
//        return Carbon::parse($date)->isPast()
//            ? Carbon::parse($date)->addDay()->diffForHumans(['parts' => 2])
//            : Carbon::parse($date)->diffForHumans(['parts' => 2]);
//    }
    public function delete( $id ) {
//        dd($this->columns);
        $repair = Repair::findOrFail( $id );
        foreach ($repair->movements as $movement) {
            $movement->delete();
        }
        $repair->delete();
    }
}
