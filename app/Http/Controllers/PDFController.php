<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Artista;

class PDFController extends Controller
{
    public function index(){

        $pdf = new Fpdf();
        $pdf->AddPage();
        
        //contenmido del pdf

        $pdf->SetXY(10,10);
        
        // Color de fondo
        $pdf->SetFillColor(226, 252, 255 );
        // Título
        $pdf->SetFont('Arial','',14);
        // Ancho, Alto, Contenid, borde, celda, orientacion, color
        $pdf->Cell(0,10,"Autor: Brayhan Fabian Avila Rozo",0,0,'C',true);
        $pdf->Ln(14);
        $pdf->SetX(25);
        $pdf->SetFillColor(0, 14, 182 );
        $pdf->SetDrawColor(0, 5, 60 );
        $pdf->SetTextColor(255, 255, 255 );
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(110,8,"Nombre Artista",1,0,'C',true);

        $pdf->Cell(50,8,"Numero De albumes",1,1,'C',true);

        $Artista = new Artista();
        
        $Listado = $Artista::All();
        
        
        $pdf->SetFont('Arial','i',12);
        $pdf->SetFillColor(123, 123, 232 );
        $pdf->SetDrawColor(0, 5, 60 );
        $pdf->SetTextColor(0, 0, 0 );
        foreach($Listado as $li){
            $pdf->SetX(25);
            $pdf->Cell(110,8, substr(utf8_decode($li->Name), 0 ,50) ,1,0,'L',false);

            $pdf->Cell(50,8, $li->albumes()->count() ,1,1,'C',true);
        }
        
        // Salto de línea
        $pdf->Ln(4);

        //configurar de salida de datos (Objeto response)
        $response = response($pdf->Output());
        //definir el tipo mine
        $response->header("Content-Type", "	application/pdf");
        //retornar respuesta al navegador
        return $response;
    }
}
