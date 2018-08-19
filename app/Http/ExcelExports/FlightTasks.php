<?php
/**
 * Created by PhpStorm.
 * User: dwanyoike
 * Date: 07-Aug-18
 * Time: 9:46 AM
 */

namespace App\Http\ExcelExports;

use App\Flight;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class FlightTasks implements FromView, WithEvents
{
    use  RegistersEventListeners;

    function __construct(Flight $flight)
    {
        $this->flight = $flight;
    }

    public function view(): View
    {
        return view('report.flight_report_xlsx', [
            'flight' => $this->flight
        ]);
    }


    public static function afterSheet(AfterSheet $event)
    {

        $headingArray = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                ],
                'bottom' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                ],
                'right' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                ],
                'left' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                ],
            ],
        ];
        $styleArray = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        $normalStyle = [
            'font' => [
                'bold' => false,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders'=>[
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'top' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        $event->sheet->getColumnDimension('A')->setWidth(3);
        $event->sheet->getColumnDimension('B')->setWidth(39);
        $event->sheet->getColumnDimension('C')->setWidth(12);
        $event->sheet->getColumnDimension('D')->setWidth(12);
        $event->sheet->getColumnDimension('E')->setWidth(28);
        $event->sheet->getStyle('A1:E2')->applyFromArray($headingArray);
        $event->sheet->getStyle('A4:E4')->applyFromArray($styleArray);
        $count = $event->sheet->getHighestDataRow();
        $event->sheet->getStyle("A5:E{$count}")->applyFromArray($normalStyle);
        $event->sheet->getStyle("A5:E{$count}")->getAlignment()->setWrapText(true);
        for ($x = 5; $x <= $count; $x++) {
            $event->sheet->getRowDimension($x)->setRowHeight(27);
        }
        $event->sheet->getRowDimension(1)->setRowHeight(27);
        $event->sheet->getRowDimension(2)->setRowHeight(27);
        //$event->sheet->getStyle("A2:E{$count}")->setBorderStyle(Border::BORDER_THIN);
    }
}