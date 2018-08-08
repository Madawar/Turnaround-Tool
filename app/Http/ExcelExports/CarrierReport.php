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

class CarrierReport implements FromView, WithEvents
{
    use  RegistersEventListeners;

    function __construct($carrier,$request,$from,$to)
    {
        $this->carrier = $carrier;
        $this->request = $request;
        $this->from = $from;
        $this->to = $to;
    }

    public function view(): View
    {
        return view('report.carrier_report_xlsx', [
          'carrier'=>$this->carrier,
          'request'=>$this->request,
          'from'=>$this->from,
          'to'=>$this->to,
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
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
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
        $event->sheet->getColumnDimension('B')->setWidth(11);
        $event->sheet->getColumnDimension('C')->setWidth(12);
        $event->sheet->getColumnDimension('D')->setWidth(8);
        $event->sheet->getColumnDimension('E')->setWidth(8);
        $event->sheet->getColumnDimension('F')->setWidth(8);
        $event->sheet->getColumnDimension('G')->setWidth(8);
        $event->sheet->getColumnDimension('H')->setWidth(12);
        $event->sheet->getColumnDimension('I')->setWidth(12);
        $event->sheet->getColumnDimension('J')->setWidth(12);
        $event->sheet->getColumnDimension('K')->setWidth(12);
        $event->sheet->getStyle('A1:L2')->applyFromArray($headingArray);
        $event->sheet->getStyle('A4:L4')->applyFromArray($styleArray);
        $count = $event->sheet->getHighestDataRow();
        $event->sheet->getStyle("A5:L{$count}")->applyFromArray($normalStyle);
        for ($x = 5; $x <= $count; $x++) {
            $event->sheet->getRowDimension($x)->setRowHeight(27);
        }
        $event->sheet->getRowDimension(1)->setRowHeight(27);
        $event->sheet->getRowDimension(2)->setRowHeight(27);
        //$event->sheet->getStyle("A2:E{$count}")->setBorderStyle(Border::BORDER_THIN);
    }
}