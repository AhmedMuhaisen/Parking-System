<?php
namespace App\Exports;

use App\Models\Category;
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

class CategoriesExport implements FromCollection, WithHeadings, WithEvents, WithCustomStartCell,WithMapping,WithColumnWidths
{

        protected $request;

    public function __construct($request)
    {

        $this->request = $request;
    }
    public function collection()
    {
     $categories=Category::search($this->request);

    return $categories->get();




}

 public function map($category): array
    {
        return [
            $category->id,
            $category->name,
            $category->work_method,
            $category->status,
            $category->created_at->format('Y-m-d H:i'), // ← تنسيق التاريخ
        ];
    }

       public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 20,
            'C' => 25,
            'D' => 15,
            'E' => 30,
        ];
    }

    public function headings(): array
    {
        return ['ID', 'Name', 'Work Method', 'Status', 'Created At'];
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
                $sheet->mergeCells('A1:E1');
                $sheet->setCellValue('A1', $settings->website_name ?? 'Company Name');
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);

                $sheet->mergeCells('A2:E2');
                $sheet->setCellValue('A2', $settings->address ?? 'Company Address');

                $sheet->mergeCells('A3:E3');
                $sheet->setCellValue('A3', $settings->website_phone ?? 'Phone Number');
  $sheet->mergeCells('A4:E4');
                $sheet->setCellValue('A4', 'Categories Report');
                 $sheet->getStyle('A4:E4')->getFont()->setBold(true);
                // تنسيق العناوين والتوسيط
                $sheet->getStyle('A1:E4')->getAlignment()->setHorizontal('center');
                 $sheet->getStyle('A5:E5')->getFont()->setBold(true);
                $sheet->getStyle('A5:E5')->getFill()->setFillType('solid')->getStartColor()->setRGB('D9E1F2'); // أزرق فاتح
       // تمييز الصفوف الفردية والزوجية
            for ($row = 6; $row <= Category::count() + 5; $row++) {
                $fillColor = $row % 2 == 0 ? 'F2F2F2' : 'FFFFFF'; // رمادي فاتح للزوجي، أبيض للفردي
                $sheet->getStyle("A{$row}:E{$row}")
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
