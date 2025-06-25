<?php

namespace App\Exports;

use App\Models\Testimonial;
use App\Models\Setting;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\RichText\RichText;

class TestimonialsExport implements FromCollection, WithHeadings, WithEvents, WithCustomStartCell, WithMapping, WithColumnWidths
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        return Testimonial::search($this->request)->get();
    }

    public function map($testimonial): array
    {
        // Convert HTML to RichText object manually (very basic support)
        $richText = new RichText();

        // Split by <br> tags for line breaks
        $lines = preg_split('/<br\s*\/?>/i', $testimonial->text);

        foreach ($lines as $index => $line) {
            $line = trim($line);

            // Bold if <b> tag is found
            if (preg_match('/<b>(.*?)<\/b>/i', $line, $matches)) {
                $bold = $richText->createTextRun(strip_tags($matches[1]));
                $bold->getFont()->setBold(true);
            } else {
                $richText->createText(strip_tags($line));
            }

            // Add newline except for last
            if ($index < count($lines) - 1) {
                $richText->createText("\n");
            }
        }

        return [
            $testimonial->id,
            $testimonial->rating,
            $richText,
            $testimonial->user->first_name . ' ' . $testimonial->user->second_name,
            $testimonial->created_at,
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 10,
            'C' => 70,
            'D' => 25,
            'E' => 20,
        ];
    }

    public function headings(): array
    {
        return ['ID', 'Rating', 'Text', 'User', 'Created_at'];
    }

    public function startCell(): string
    {
        return 'A5';
    }

    public function registerEvents(): array
    {
        $settings = Setting::first();

        return [
            AfterSheet::class => function (AfterSheet $event) use ($settings) {
                $sheet = $event->sheet->getDelegate();

                // Header info
                $sheet->mergeCells('A1:E1');
                $sheet->setCellValue('A1', $settings->website_name ?? 'Company Name');
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);

                $sheet->mergeCells('A2:E2');
                $sheet->setCellValue('A2', $settings->address ?? 'Company Address');

                $sheet->mergeCells('A3:E3');
                $sheet->setCellValue('A3', $settings->website_phone ?? 'Phone Number');

                $sheet->mergeCells('A4:E4');
                $sheet->setCellValue('A4', 'Testimonials Report');
                $sheet->getStyle('A4')->getFont()->setBold(true);

                // Headings styling
                $sheet->getStyle('A1:E4')->getAlignment()->setHorizontal('center');
                $sheet->getStyle('A5:E5')->getFont()->setBold(true);
                $sheet->getStyle('A5:E5')->getFill()
                    ->setFillType('solid')
                    ->getStartColor()->setRGB('D9E1F2');

                // Row styling
                $startRow = 6;
                $endRow = Testimonial::count() + 5;

                for ($row = $startRow; $row <= $endRow; $row++) {
                    $fillColor = $row % 2 === 0 ? 'F2F2F2' : 'FFFFFF';
                    $sheet->getStyle("A{$row}:E{$row}")
                        ->getFill()
                        ->setFillType('solid')
                        ->getStartColor()
                        ->setRGB($fillColor);
                }

                // Global center alignment
                $sheet->getStyle("A{$startRow}:E{$endRow}")
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                    ->setVertical(Alignment::VERTICAL_CENTER);

                // Text column wrap + left/top align
                $sheet->getStyle("C{$startRow}:C{$endRow}")
                    ->getAlignment()
                    ->setWrapText(true)
                    ->setHorizontal(Alignment::HORIZONTAL_LEFT)
                    ->setVertical(Alignment::VERTICAL_TOP);

                // Auto height for rows
                foreach (range($startRow, $endRow) as $row) {
                    $sheet->getRowDimension($row)->setRowHeight(-1);
                }

                // Border styling
                $lastRow = $sheet->getHighestRow();
                $lastColumn = $sheet->getHighestColumn();
                $range = "A5:{$lastColumn}{$lastRow}";

                $sheet->getStyle($range)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => 'A9A9A9'],
                        ],
                    ],
                ]);
            },
        ];
    }
}
