<?php


namespace App\Helpers;

use Codedge\Fpdf\Fpdf\Fpdf;

class MyFpdf extends Fpdf
{
    function Circle($x, $y, $r)
    {
        $this->Ellipse($x, $y, $r, $r);
    }

    function Ellipse($x, $y, $rx, $ry)
    {
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(1);
        $this->Oval($x, $y, $rx, $ry);
    }

    function Oval($x, $y, $rx, $ry)
    {
        // Método para desenhar oval baseado em curvas
        $this->_Arc($x - $rx, $y, $x, $y - $ry, $x + $rx, $y, $x, $y + $ry);
    }

    function _Arc($x1, $y1, $x2, $y2, $x3, $y3, $x4, $y4)
    {
        $k = $this->k;
        $hp = $this->h;
        $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F %.2F %.2F c', 
            $x1 * $k, ($hp - $y1) * $k, $x2 * $k, ($hp - $y2) * $k, 
            $x3 * $k, ($hp - $y3) * $k, $x4 * $k, ($hp - $y4) * $k));
    }
}
