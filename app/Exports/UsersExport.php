<?php

namespace App\Exports;

use App\Models\user;
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
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Border;

class usersExport implements FromCollection, WithHeadings, WithEvents, WithCustomStartCell, WithMapping, WithColumnWidths
{

    protected $request;

    public function __construct($request)
    {

        $this->request = $request;
    }
    public function collection()
    {
        $users = user::search($this->request);

        return $users->get();
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->first_name
                . ' ' . $user->second_name,
            $user->date_birth,
            asset($user->image),
            $user->email,
            $user->phone,
            $user->type,
            $user->email_verified_at ? 'Activated' : 'Deactivated',
            $user->building->name,
            $user->unit->name,
            $user->created_at->format('m-d-Y')
        ];
    }
    public function drawings()
    {
        $drawings = [];
        $users = user::all();

        foreach ($users as $index => $user) {
            if ($user->image && file_exists(public_path($user->image))) {
                $drawing = new Drawing();
                $drawing->setName('user Image');
                $drawing->setDescription('user Image');
                $drawing->setPath(public_path($user->image)); // image path
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
            'H' => 20,
            'I' => 20,
            'J' => 20,
            'K' => 20,
            'L' => 20,

        ];
    }

    public function headings(): array
    {
        return ['#ID', 'Name',   'Date Of Birth',   'Image',  'Email', 'Phone',   'Type',  'Verified',  'Building',    'Unit',  'created_at'];
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
                $sheet->setCellValue('A4', 'users Report');
                $sheet->getStyle('A4:O4')->getFont()->setBold(true);
                // تنسيق العناوين والتوسيط
                $sheet->getStyle('A1:O4')->getAlignment()->setHorizontal('center');
                $sheet->getStyle('A5:O5')->getFont()->setBold(true);
                $sheet->getStyle('A5:O5')->getFill()->setFillType('solid')->getStartColor()->setRGB('D9E1F2'); // أزرق فاتح
                // تمييز الصفوف الفردية والزوجية
                for ($row = 6; $row <= user::count() + 5; $row++) {
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
