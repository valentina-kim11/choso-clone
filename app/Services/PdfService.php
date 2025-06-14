<?php

namespace App\Services;

use setasign\Fpdi\Fpdi;

class PdfService
{
    public function addWatermark(string $source, string $output, string $text): void
    {
        $pdf = new Fpdi();
        $pageCount = $pdf->setSourceFile($source);

        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $tplId = $pdf->importPage($pageNo);
            $size = $pdf->getTemplateSize($tplId);
            $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
            $pdf->useTemplate($tplId);

            $pdf->SetFont('Helvetica', '', 12);
            $pdf->SetTextColor(150, 150, 150);
            $pdf->SetXY(10, $size['height'] - 15);
            $pdf->Cell(0, 10, $text, 0, 0, 'L');
        }

        $pdf->Output($output, 'F');
    }
}
