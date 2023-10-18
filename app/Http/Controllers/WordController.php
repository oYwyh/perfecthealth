<?php

namespace App\Http\Controllers;

use DOMXPath;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;
use PhpOffice\PhpWord\IOFactory;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\Session;

class WordController extends Controller
{
    public function wordToPDF()
    {
        ini_set('max_execution_time', '300');
        ini_set("pcre.backtrack_limit", "5000000");
        $phpWord = IOFactory::load(public_path('word/' . Session::get('document_name')));
        $objWriter = IOFactory::createWriter($phpWord, 'HTML');
        $objWriter->save('temp/temp.html');
        $htmlContent = file_get_contents('temp/temp.html');
        $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $mpdf->WriteHTML($htmlContent);
        $mpdf->Output(public_path('pdf/result.pdf'), Destination::FILE);
        Toast::title('lol');
        return redirect()->back();
    }
}
