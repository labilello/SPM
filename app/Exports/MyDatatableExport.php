<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MyDatatableExport implements FromCollection, ShouldAutoSize, WithHeadings,
    WithStyles, WithEvents, WithColumnFormatting, WithMapping
{
    use Exportable;

    public $collection;
    public $columns;
    public $booleanColumns = [];

    public function __construct($collection, $columns = null)
    {
        $this->collection = $collection;
        $this->columns = $columns;
//        dd($columns, $collection);
    }

    public function collection()
    {
        return $this->collection;
    }


    public function headings(): array
    {
        $formatedColumns = [];

        foreach ($this->columns as $n=>$column) {
            if( str_contains( $column['label'], 'Acciones' ) ) {
                unset($this->columns[$n]);
                continue;
            }

            if( $column[ 'type' ] == 'boolean' )
                array_push($this->booleanColumns, $n);

            array_push($formatedColumns, $column['label']);
        }

        return $formatedColumns;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $this->setHeaderStyle($event->sheet);
                foreach ($this->booleanColumns as $columnNumber)
                    $this->createBooleanConditionalStyle($event->sheet, $columnNumber);

            },
        ];
    }

    private function setHeaderStyle( $sheet ) {
        // Freeze frist row
        $sheet->freezePane('A2', 'A2');

        // Aplico el estilo a toda la primera fila (segun cantidad de columnas)
        $style = $sheet->getStyle('A1:' . chr(65 + count($this->columns) - 1) . '1');
        $style->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('363636');
        $style->getFont()->getColor()->setRGB('FFFFFF');
        $sheet->getRowDimension('1')->setRowHeight(24);

        // Aplico un autofiltro
        $sheet->setAutoFilter('A1:' . chr(65 + count($this->columns) - 1) . '1');
    }

    private function createBooleanConditionalStyle( $sheet, $columnNumber ) {
        $conditionalStyles = [ new \PhpOffice\PhpSpreadsheet\Style\Conditional(), new \PhpOffice\PhpSpreadsheet\Style\Conditional(), new \PhpOffice\PhpSpreadsheet\Style\Conditional() ];

        // Style para elemento "verdadero"
        $conditionalStyles[0]->setConditionType(\PhpOffice\PhpSpreadsheet\Style\Conditional::CONDITION_CELLIS);
        $conditionalStyles[0]->setOperatorType(\PhpOffice\PhpSpreadsheet\Style\Conditional::OPERATOR_EQUAL);
        $conditionalStyles[0]->addCondition('"Verdadero"');
        $conditionalStyles[0]->getStyle()->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getEndColor()->setARGB('38C172');
        $conditionalStyles[0]->getStyle()->getFont()->getColor()->setRGB('FFFFFF');

        // Style para elemento "falso"
        $conditionalStyles[1]->setConditionType(\PhpOffice\PhpSpreadsheet\Style\Conditional::CONDITION_CELLIS);
        $conditionalStyles[1]->setOperatorType(\PhpOffice\PhpSpreadsheet\Style\Conditional::OPERATOR_EQUAL);
        $conditionalStyles[1]->addCondition('"Falso"');
        $conditionalStyles[1]->getStyle()->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getEndColor()->setARGB('E3342F');
        $conditionalStyles[1]->getStyle()->getFont()->getColor()->setRGB('FFFFFF');

        // Style para elemento "desconocido"
        $conditionalStyles[2]->setConditionType(\PhpOffice\PhpSpreadsheet\Style\Conditional::CONDITION_CELLIS);
        $conditionalStyles[2]->setOperatorType(\PhpOffice\PhpSpreadsheet\Style\Conditional::OPERATOR_EQUAL);
        $conditionalStyles[2]->addCondition('"Desconocido"');
        $conditionalStyles[2]->getStyle()->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getEndColor()->setARGB('6CB2EB');
        $conditionalStyles[2]->getStyle()->getFont()->getColor()->setRGB('FFFFFF');

        $sheet->getStyle( chr(65 + $columnNumber) )->setConditionalStyles($conditionalStyles);
        $sheet->getStyle( chr(65 + $columnNumber) )->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Styling a specific cell by coordinate.
            'A1:Z1' => [
                'font' => [
                    'bold' => true,
                    'size' => 12
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => false,
                    'shrinkToFit' => true,
                ],
            ],
            'A2:Z' . ($this->collection->count()+1) => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                    'shrinkToFit' => true,
                ],
            ],
        ];
    }

    public function columnFormats(): array
    {
        $columns = [];
        for($i = 0; $i < count( $this->columns ); $i++ ) {
            $columnAxes = chr(65 + $i) . "2:" . chr(65 + $i) . ($this->collection->count() + 1);
            $columns[ $columnAxes ] = $this->columns[ $i ][ 'type' ] == 'date' ? NumberFormat::FORMAT_DATE_DDMMYYYY : NumberFormat::FORMAT_NUMBER;
        }
        return $columns;
    }

    public function map($object) :array
    {
        $newObject = [];

        for($i = 0; $i < count( $this->columns ); $i++ ){

            if( $this->columns[ $i ][ 'type' ] == 'boolean' ) {
                if ( $object->{ $this->columns[$i]['name'] } === 1 )
                    array_push($newObject, "Verdadero");
                elseif ( $object->{ $this->columns[$i]['name'] } === 0 )
                    array_push($newObject, "Falso");
                else
                    array_push($newObject, "Desconocido");
            } else
                array_push($newObject, $object->{ $this->columns[$i]['name'] } );

        }

        return $newObject;
    }

}
