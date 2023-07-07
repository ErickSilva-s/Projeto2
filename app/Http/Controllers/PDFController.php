<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;

class PDFController extends Controller
{
    // public function gerarPDF()
    // {
    //     $html = '<html><body><h1>Meu PDF</h1></body></html>';

    //     $dompdf = new Dompdf();
    //     $dompdf->loadHtml($html);
    //     $dompdf->render();
    //     $dompdf->stream("meu_pdf.pdf");
    // }

    // public function makePDF()
    // {
    // public function makePDF()
    // {
    //     // Crie uma nova instância do Dompdf
    //     $options = new Options();
    //     $options->set('defaultFont', 'Arial'); // Define a fonte padrão (opcional)
    //     $dompdf = new Dompdf($options);

    //     // Renderize a sua view em uma variável
    //     $html = view('resumo-compra')->render();

    //     // Carregue o conteúdo HTML no Dompdf
    //     $dompdf->loadHtml($html);

    //     // Renderize o PDF
    //     $dompdf->render();

    //     // Defina o nome do arquivo PDF
    //     $filename = 'resumo_compra.pdf';

    //     // Salve o PDF em algum diretório (opcional)
    //     $dompdf->save('caminho/para/salvar/' . $filename);

    //     // Ou envie o PDF para download
    //     $dompdf->stream($filename);
    // }


    public function makePDF()
    {
        // Crie uma nova instância do Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Arial'); // Define a fonte padrão (opcional)
        $dompdf = new Dompdf($options);

        // Renderize a sua view em uma variável
        $html = view('sumary-checkout')->render();

        // $html = '<img src="' . public_path('public/logo.png') . '" alt="Logo"> ' . $html;

        // Carregue o conteúdo HTML no Dompdf
        $dompdf->loadHtml($html);

        // Renderize o PDF
        $dompdf->render();

        // Defina o nome do arquivo PDF
        $filename = 'resumo_compra.pdf';

        // Salve o PDF em algum diretório (opcional)
     

        // Ou envie o PDF para download
        $dompdf->stream($filename);
    }
}
