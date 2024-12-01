<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Usuario;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use TCPDF;

require 'plb/vendor/autoload.php';



class ExportDocument extends Controller{
    public function exportExcel() {
        $usuario = new Usuario();
        $datos = $usuario->orderBy('id', 'ASC')->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Nombre');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'Password');

        $row = 2;
        foreach ($datos as $dato) {
            $sheet->setCellValue('A' . $row, $dato['id']);
            $sheet->setCellValue('B' . $row, $dato['nombre']);
            $sheet->setCellValue('C' . $row, $dato['email']);
            $sheet->setCellValue('D' . $row, $dato['password']);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'usuarios_export.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function exportWord() {
        $usuario = new Usuario();
        $datos = $usuario->orderBy('id', 'ASC')->findAll();
    
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $section->addText('Usuarios Export');
    
        // Añadir una tabla
        $table = $section->addTable();
        $table->addRow();
        $table->addCell(2000)->addText('ID');
        $table->addCell(4000)->addText('Nombre');
        $table->addCell(4000)->addText('Email');
        $table->addCell(4000)->addText('Password');
    
        foreach ($datos as $dato) {
            $table->addRow();
            $table->addCell(2000)->addText($dato['id']);
            $table->addCell(4000)->addText($dato['nombre']);
            $table->addCell(4000)->addText($dato['email']);
            $table->addCell(4000)->addText($dato['password']);
        }
    
        $filename = 'usuarios_export.docx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
    
        $writer = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save('php://output');
    }

    public function exportPdf() {
        $usuario = new Usuario();
        $datos = $usuario->orderBy('id', 'ASC')->findAll();
    
        $pdf = new \TCPDF();
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 12);
    
        $html = '<h1>Usuarios Export</h1>';
        $html .= '<table border="1" cellspacing="3" cellpadding="4">';
        $html .= '<tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Password</th>
                  </tr>';
    
        foreach ($datos as $dato) {
            $html .= '<tr>
                        <td>' . $dato['id'] . '</td>
                        <td>' . $dato['nombre'] . '</td>
                        <td>' . $dato['email'] . '</td>
                        <td>' . $dato['password'] . '</td>
                      </tr>';
        }
    
        $html .= '</table>';
    
        $pdf->writeHTML($html, true, false, true, false, '');
    
        $filename = 'usuarios_export.pdf';
        $pdf->Output($filename, 'D');
    }
}