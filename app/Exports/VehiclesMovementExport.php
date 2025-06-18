<?php
namespace App\Exports;

use App\Models\Setting;
use App\Models\VehiclesMovement;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Border;

class VehiclesMovementExport implements FromCollection, WithHeadings, WithEvents, WithCustomStartCell,WithMapping,WithColumnWidths
{

        protected $request;

    public function __construct($request)
    {

        $this->request = $request;
    }
    public function collection()
    {
     $vehiclesMovement=VehiclesMovement::search($this->request);

    return $vehiclesMovement->get();


}

 public function map($vehiclesMovement): array
    {
        return [
             $vehiclesMovement->id,
            $vehiclesMovement->vehicle->vehicle_number
           , $vehiclesMovement->gate->name
           , $vehiclesMovement->type_Movement
           , $vehiclesMovement->method_passage
           , $vehiclesMovement->vehicle->user->first_name
           .' '.$vehiclesMovement->vehicle->user->second_name
           , $vehiclesMovement->date
           , $vehiclesMovement->time
        ];
    }
  public function drawings()
    {
        $drawings = [];
        $vehiclesMovement = VehiclesMovement::all();

        foreach ($vehiclesMovement as $index => $vehicle) {
            if ($vehicle->image && file_exists(public_path($vehicle->image))) {
                $drawing = new Drawing();
                $drawing->setName('Vehicle Image');
                $drawing->setDescription('Vehicle Image');
                $drawing->setPath(public_path($vehicle->image)); // image path
                $drawing->setHeight(50);
                $drawing->setCoordinates('D' . ($index + 2)); // column D (image), row index + 2 (after headings)
                $drawings[] = $drawing;
            }
        }

        return $drawings;
    }
       public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 20,
            'C' => 10,
            'D' => 20,
            'E' => 20,
                'F' => 20,
            'G' => 20,


        ];
    }

    public function headings(): array
    {
        return [ '#ID','Vehicle Number',   'Gate',  ' Movement Type',	'Open Method',  'Onr Name',    'Date ',  'time'];
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
                $sheet->mergeCells('A1:O1');
                $sheet->setCellValue('A1', $settings->website_name ?? 'Company Name');
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);

                $sheet->mergeCells('A2:O2');
                $sheet->setCellValue('A2', $settings->address ?? 'Company Address');

                $sheet->mergeCells('A3:O3');
                $sheet->setCellValue('A3', $settings->website_phone ?? 'Phone Number');
  $sheet->mergeCells('A4:O4');
                $sheet->setCellValue('A4', 'vehiclesMovement Report');
                 $sheet->getStyle('A4:O4')->getFont()->setBold(true);
                // تنسيق العناوين والتوسيط
                $sheet->getStyle('A1:O4')->getAlignment()->setHorizontal('center');
                 $sheet->getStyle('A5:O5')->getFont()->setBold(true);
                $sheet->getStyle('A5:O5')->getFill()->setFillType('solid')->getStartColor()->setRGB('D9E1F2'); // أزرق فاتح
       // تمييز الصفوف الفردية والزوجية
            for ($row = 6; $row <= vehiclesMovement::count() + 5; $row++) {
                $fillColor = $row % 2 == 0 ? 'F2F2F2' : 'FFFFFF'; // رمادي فاتح للزوجي، أبيض للفردي
                $sheet->getStyle("A{$row}:O{$row}")
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
