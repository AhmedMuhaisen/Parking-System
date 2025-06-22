<?php

namespace App\Exports;

use App\Models\Building;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class BuildingsExport implements FromCollection, WithHeadings, WithEvents, WithCustomStartCell, WithMapping, WithColumnWidths
{

    protected $request;

    public function __construct($request)
    {

        $this->request = $request;
    }
    public function collection()
    {
        $buildings = Building::search($this->request);

        return $buildings->get();
    }

    public function map($building): array
    {
        return [
            $building->id,
            $building->name,
            $building->user->first_name . ' ' . $building->user->second_name,
             $building->parking->name,
            $building->max_units,

            $building->max_users,
            $building->max_vehicles,

            $building->max_spots,
            $building->max_guests,

        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 20,
            'C' => 20,
            'D' => 20,
            'E' => 20,
            'F' => 20,
            'G' => 20,
            'H' => 20,
            'I' => 20,

        ];
    }

    public function headings(): array
    {
        return ['ID', 'Name', "Onr Name" ,'parking'   ,'max_units'  ,'max_users'  ,'max_vehicles'  ,'max_spots'   ,'max_guests'      ];
    }


    public function startCell(): string
    {
        return 'A5'; // تبدأ البيانات من هنا
    }


    public function registerEvents(): array
    {
        $settings = Setting::first();

        return [
            AfterSheet::class => function (AfterSheet $event) use ($settings) {
                $sheet = $event->sheet->getDelegate();

                // الترويسة العلوية
                $sheet->mergeCells('A1:K1');
                $sheet->setCellValue('A1', $settings->website_name ?? 'Company Name');
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);

                $sheet->mergeCells('A2:K2');
                $sheet->setCellValue('A2', $settings->address ?? 'Company Address');

                $sheet->mergeCells('A3:K3');
                $sheet->setCellValue('A3', $settings->website_phone ?? 'Phone Number');
                $sheet->mergeCells('A4:K4');
                $sheet->setCellValue('A4', 'buildings Report');
                $sheet->getStyle('A4:K4')->getFont()->setBold(true);
                // تنسيق العناوين والتوسيط
                $sheet->getStyle('A1:K4')->getAlignment()->setHorizontal('center');
                $sheet->getStyle('A5:K5')->getFont()->setBold(true);
                $sheet->getStyle('A5:K5')->getFill()->setFillType('solid')->getStartColor()->setRGB('D9E1F2'); // أزرق فاتح
                // تمييز الصفوف الفردية والزوجية
                for ($row = 6; $row <= Building::count() + 5; $row++) {
                    $fillColor = $row % 2 == 0 ? 'F2F2F2' : 'FFFFFF'; // رمادي فاتح للزوجي، أبيض للفردي
                    $sheet->getStyle("A{$row}:K{$row}")
                        ->getFill()
                        ->setFillType('solid')
                        ->getStartColor()
                        ->setRGB($fillColor);
                }
                $lastRow = $sheet->getHighestRow();     // آخر صف يحتوي على بيانات
                $lastColumn = $sheet->getHighestColumn(); // آخر عمود يحتوي على بيانات

                // تحديد نطاق الجدول بالكامل (مثلاً من A5 إلى E[آخر صف])
                $range = 'A5:' . $lastColumn . $lastRow;

                $sheet->getStyle($range)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => 'A9A9A9'], // أسود
                        ],
                    ],
                ]);
            }
        ];
    }
}
