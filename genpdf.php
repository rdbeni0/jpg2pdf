<?php
require('fpdf/fpdf.php');

class PDF extends FPDF {
    // ustawienia obrazkow, nalezy operowac tymi wartosciami:
    const DPI = 24;
    const MM_IN_INCH = 25.4;
    const A4_HEIGHT = 190; //214
    const A4_WIDTH = 150;
    //  ustawienia obrazkow ciag dalszy, sa to domyslne wartosci A4:
    const MAX_WIDTH = 210;
    const MAX_HEIGHT = 180;

    function pixelsToMM($val) {
        return $val * self::MM_IN_INCH / self::DPI;
    }

    function resizeToFit($imgFilename) {
        list($width, $height) = getimagesize($imgFilename);

        $widthScale = self::MAX_WIDTH / $width;
        $heightScale = self::MAX_HEIGHT / $height;

        $scale = min($widthScale, $heightScale);

        return array(
            round($this->pixelsToMM($scale * $width)),
            round($this->pixelsToMM($scale * $height))
        );
    }

    function centreImage($img) {
        list($width, $height) = $this->resizeToFit($img);

        $this->Image(
            $img, (self::A4_HEIGHT - $width) / 2,
            (self::A4_WIDTH - $height) / 2,
            $width,
            $height
        );
    }
}
$pdf1 = new PDF();
$pliki = glob('uploads/*.{jpg,png,gif}', GLOB_BRACE);

foreach($pliki as $obrazek) {

 if (count($pliki) > 0) {
 $pdf1->AddPage();
 $pdf1->resizeToFit("./$obrazek");
 $pdf1->centreImage("./$obrazek");
   }
}

 $pdffilename="./tmp/test.pdf";
 $pdf1->Output($pdffilename,'F');

?>
