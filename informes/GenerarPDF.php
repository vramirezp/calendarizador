<?php
    include_once("PDF.php");
    include("../config.php");

    $id = 1;//$_REQUEST['id'];

    switch($id)
    {
        case 1:
            
            $user  = $_SESSION['usuario'];

            if(isset($_REQUEST['mes']) && isset($_REQUEST['anio']))
            {
                $month   = $_REQUEST['mes'];
                $anio  = $_REQUEST['anio'];
                $_SESSION['anio']=$anio;
                $_SESSION['mes']=$month;
            }
            else
            {
                $month   = $_SESSION['mes'];
                $anio  = $_SESSION['anio'];
            }

            $mes=$month;
            if(strlen($month) == 1)$mes='0'.$month;
            $fecha = $anio.'-'.$mes.'-01';

            $meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

            $pdf=new PDF('L','mm','A4');
            $pdf->AddPage();
            $pdf->SetMargins(0,0);

            //Título
            $pdf->addLine($meses[$month].' '.$anio, 'C', 60);
            $pdf->addLine(' ', 'C', 40);
            $pdf->addLine(' ', 'C', 20);
            $pdf->SetAutoPageBreak(true, 0);

            $ancho = 40;

            //Titulos de la tabla
            $pdf->AddCol('1',$ancho,'Lunes','R');
            $pdf->AddCol('2',$ancho,'Martes','R');
            $pdf->AddCol('3',$ancho,utf8_decode('Miércoles'),'R');
            $pdf->AddCol('4',$ancho,'Jueves','R');
            $pdf->AddCol('5',$ancho,'Viernes','R');
            $pdf->AddCol('6',$ancho,utf8_decode('Sábado'),'R');
            $pdf->AddCol('7',$ancho,'Domingo','R');
            
            $prop=array('HeaderColor'=>array(255,255,255),
                          'color1'=>array(224,224,224),
                          'color2'=>array(255,255,255),
                          'padding'=>2);

            $pdf->Table($conexion, "SELECT ev_nombre,ev_fecha FROM evento WHERE us_user = '$user' AND Month(ev_fecha) = Month('$fecha') AND Year(ev_fecha) = Year('$fecha')");

            $pdf->Output($meses[$month].' '.$anio.'.pdf','D');
            break;
    }
?>