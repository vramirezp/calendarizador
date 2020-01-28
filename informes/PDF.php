<?php
    require('TablaPDF.php');
    
    class PDF extends TablaPDF
    {    
        function Header(){
            # Ensure table header is output
            parent::Header();
        }

        function addLine($texto, $o, $e)
        {
            $this->SetFont('Times','B',$e);
            $this->Cell(0,6,$texto,0,1,$o);
        }
    }
?>
