<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ShipRepairsExport implements FromCollection, WithMapping, ShouldAutoSize, WithHeadings,
    WithColumnFormatting, WithStyles, WithEvents, WithCustomStartCell
{
    private $shipment;
    private $writerType = Excel::XLSX;

    public function __construct($shipment)
    {
        $this->shipment = $shipment;
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->shipment->repairs;
    }

    /**
     *
     */
    public function map($repair): array
    {
        return [
            $repair->id,
            $repair->product->id,
            $repair->product->descripcion,
            Date::dateTimeToExcel($repair->date_in),
            $repair->nro_serie,
            ($repair->is_repair) ? 'Si' : 'No',
            $repair->note
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Codigo Unix',
            'Descripcion',
            'Fecha de Ingreso',
            'Nro. Serie',
            '¿Reparado?',
            'Notas de reparacion',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'E1:E1' => NumberFormat::FORMAT_DATE_DATETIME,
            'E2:E2' => NumberFormat::FORMAT_NUMBER,
            'D5:D3000' => NumberFormat::FORMAT_DATE_DATETIME,
        ];
    }


    public function styles(Worksheet $sheet)
    {
        return [

            // Styling a specific cell by coordinate.
            'A4:G4' => [
                'font' => [
                    'bold' => true,
                    'size' => 13
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => false,
                    'shrinkToFit' => true,
                ],
            ],
            'A5:F3000' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                    'shrinkToFit' => true,
                ],
            ],
            'G5:G3000' => [
                'alignment' => [
                    'wrapText' => true,
                    'shrinkToFit' => true,
                ],
            ],
            'B1:B2' => [
                'font' => [
                    'bold' => true,
                    'size' => 11,
                    'color' => ['rgb' => 'C00000'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => false,
                    'shrinkToFit' => true,
                ],
            ],
            'D1:D2' => [
                'font' => [
                    'bold' => true,
                    'size' => 11,
                    'color' => ['rgb' => 'C00000'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => false,
                    'shrinkToFit' => true,
                ],
            ],
            'F1:F1' => [
                'font' => [
                    'bold' => true,
                    'size' => 11,
                    'color' => ['rgb' => 'C00000'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => false,
                    'shrinkToFit' => true,
                ],
            ],
            'C1:C2' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => false,
                    'shrinkToFit' => true,
                ],
            ],
            'E1:E2' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => false,
                    'shrinkToFit' => true,
                ],
            ],
            'G1:G1' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => false,
                    'shrinkToFit' => true,
                ],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [

            AfterSheet::class => function(AfterSheet $event) {
                //Freeze frist row
                $event->getDelegate()->getDelegate()->getCell('B1', true)->setValue( 'Remito Nro.:' );
                $event->getDelegate()->getDelegate()->getCell('C1', true)->setValue( $this->shipment->name );

                $event->getDelegate()->getDelegate()->getCell('D1', true)->setValue( 'Fecha Preparacion:' );
                $event->getDelegate()->getDelegate()->getCell('E1', true)->setValue( $this->shipment->updated_at );

                $event->getDelegate()->getDelegate()->getCell('F1', true)->setValue( 'Remito Interno:' );
                $event->getDelegate()->getDelegate()->getCell('G1', true)->setValue( $this->shipment->nro_interno );

                $event->getDelegate()->getDelegate()->getCell('B2', true)->setValue( 'Destino:' );
                $event->getDelegate()->getDelegate()->getCell('C2', true)->setValue( $this->shipment->shipto );

                $event->getDelegate()->getDelegate()->getCell('D2', true)->setValue( 'Cant. Productos:' );
                $event->getDelegate()->getDelegate()->getCell('E2', true)->setValue( count($this->shipment->repairs) );

                $event->sheet->freezePane('A5', 'A5');

//                if ($count[1])
//                    foreach ($drawings as $k => $drawing_temp) {
//                        if ($drawing_temp) {
//                            if ($img_file = StoreImageUrlTmp($drawing_temp . '-h100')) {
//                                $drawing = new Drawing();
//                                $drawing->setName('image');
//                                $drawing->setDescription('image');
//                                $drawing->setPath($img_file);
//                                $drawing->setHeight(70);
//                                $drawing->setOffsetX(5);
//                                $drawing->setOffsetY(5);
//                                $drawing->setCoordinates('A' . ($k + 2));
//                                $drawing->setWorksheet($event->sheet->getDelegate());
//                            }
//                        }
//                    }
            },
        ];
    }

//    public function drawings()
//    {
//        $drawing = new Drawing();
//        $drawing->setName('Logo');
//        $drawing->setDescription('This is my logo');
//        $drawing->setPath(public_path('/images/logo-techgo-web.svg'));
//        $drawing->setHeight(60);
//        $drawing->setCoordinates('B1');
//
//        return $drawing;
//    }

    public function startCell(): string
    {
        return 'A4';
    }


}
