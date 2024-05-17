<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../vendor/phpoffice/phpspreadsheet/src/Bootstrap.php';
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Exel
{
    public static function createExel($date,$num,$fournisseur,$nom,$prenom,$mail): void
    {
        $scriptPath = dirname(__FILE__);
        $exelFilePath = $scriptPath . '/../../assets/exel/Bon de Commande.xlsx';
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($exelFilePath);
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('B8' , $num);
        $sheet->setCellValue('C4' , $date);
        $sheet->setCellValue('B5' , $fournisseur);
        $sheet->setCellValue('B6' , $nom);
        $sheet->setCellValue('B6' , $prenom);
        $sheet->setCellValue('B7' , $mail);

        $writer = new Xlsx($spreadsheet);
        $writer->save($scriptPath . '/../../assets/exel/Bon de Commande' . " " .$date . '.xlsx');
    }
}