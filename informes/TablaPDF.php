<?php
require('fpdf.php');
include("../config.php");

class TablaPDF extends FPDF{
    var $ProcessingTable=false;
    var $aCols=array();
    var $TableX;
    var $HeaderColor;
    var $RowColors;
    var $ColorIndex;

    function Header(){
        # Imprime el encabezado de la tabla si es necesario
        if($this->ProcessingTable)
            $this->TableHeader();
            # Ensure table header is output
            parent::Header();
    }

    function TableHeader(){
        $this->SetFont('Times','B',16);
        $this->SetX($this->TableX);
        $fill=!empty($this->HeaderColor);
        if($fill)
            $this->SetFillColor($this->HeaderColor[0],$this->HeaderColor[1],$this->HeaderColor[2]);
        foreach($this->aCols as $col)
            $this->Cell($col['w'],6,$col['c'],1,0,'C',$fill);
        $this->Ln();
    }

    function Row($data, $eventos){
        $this->SetX($this->TableX);
        //$ci=$this->ColorIndex;
        //$fill=!empty($this->RowColors[$ci]);
        //if($fill)
           // $this->SetFillColor($this->RowColors[$ci][0],$this->RowColors[$ci][1],$this->RowColors[$ci][2]);
        	$y = $this->GetY();
        	$valor = 48.5;
        foreach($this->aCols as $col)
        {
            $this->MultiCell($col['w'],28,utf8_decode($data[$col['f']]),1,$col['a']);

			/*$this->SetFillColor(255, 255, 255);
            $txt = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
            $this->MultiCell($col['w'], 5, utf8_decode($data[$col['f']]), 1, 'J', 1, 1, 125, 145, true, 0, false, true, 60, 'M', true);*/
            $x = $this->GetX();
            $this->SetY($y);
            $this->SetX($x+$valor);
            $valor = $valor+40;
        }
        
        $this->Ln();
        $this->ColorIndex=1-$ci;
    }

    function CalcWidths($width,$align){
        //Compute the widths of the columns
        $TableWidth=0;
        foreach($this->aCols as $i=>$col){
            $w=$col['w'];
            if($w==-1)
                $w=$width/count($this->aCols);
            elseif(substr($w,-1)=='%')
                $w=$w/100*$width;
            $this->aCols[$i]['w']=$w;
            $TableWidth+=$w;
        }
        //Compute the abscissa of the table
        if($align=='C')
            $this->TableX=max(($this->w-$TableWidth)/2,0);
        elseif($align=='R')
            $this->TableX=max($this->w-$this->rMargin-$TableWidth,0);
        else
            $this->TableX=$this->lMargin;
    }

    function AddCol($field=-1,$width=-1,$caption='',$align='L'){
        //Add a column to the table
        if($field==-1)
            $field=count($this->aCols);
        $this->aCols[]=array('f'=>$field,'c'=>$caption,'w'=>$width,'a'=>$align);
    }
    
    function Table($conexion,$query,$prop=array())
    {
        //Issue query
        $res=mysqli_query($conexion, $query) or die('Error: '.mysql_error()."<BR>Query: $query");
        //Add all columns if none was specified
        if(count($this->aCols)==0){
            $nb=mysql_num_fields($res);
            for($i=0;$i<$nb;$i++)
                $this->AddCol();
        }
        //Retrieve column names when not specified
        foreach($this->aCols as $i=>$col){
            if($col['c']==''){
                if(is_string($col['f']))
                    $this->aCols[$i]['c']=ucfirst($col['f']);
                else
                    $this->aCols[$i]['c']=ucfirst(mysql_field_name($res,$col['f']));
            }
        }
        //Handle properties
        if(!isset($prop['width'])) $prop['width']=0;
        if($prop['width']==0) $prop['width']=$this->w-$this->lMargin-$this->rMargin;
        if(!isset($prop['align'])) $prop['align']='C';
        if(!isset($prop['padding'])) $prop['padding']=$this->cMargin;

        $cMargin=$this->cMargin;
        $this->cMargin=$prop['padding'];

        if(!isset($prop['HeaderColor'])) $prop['HeaderColor']=array();

        $this->HeaderColor=$prop['HeaderColor'];
        if(!isset($prop['color1'])) $prop['color1']=array();
        if(!isset($prop['color2'])) $prop['color2']=array();

        $this->RowColors=array($prop['color1'],$prop['color2']);
        //Compute column widths
        $this->CalcWidths($prop['width'],$prop['align']);
        //Print header
        $this->TableHeader();
        //Print rows
        $this->SetFont('Times','B',12);
        $this->ColorIndex=0;
        $this->ProcessingTable=true;

        $month= $_SESSION['mes'];
        $year= $_SESSION['anio'];

        # Obtenemos el último día del mes
		$ultimoDiaMes=date("d",(mktime(0,0,0,$month+1,1,$year)-1));

		# Obtenemos el día de la semana en el que empieza el mes
		# Devuelve 0 para domingo, 6 para sabado
		$diaSemana=date("w",mktime(0,0,0,$month,1,$year));
		$colum=7;

		if($ultimoDiaMes == 31)
		{
			if($diaSemana == 6 || $diaSemana == 7)
			{
				$colum=0;
			}
		}
		elseif($ultimoDiaMes == 30)
		{
			if($diaSemana == 7)
			{
				$colum=0;
			}
		}

		$diaSemana=date("w",mktime(0,0,0,$month,1,$year))+$colum;
         
        $meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
        "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

        $last_cell=$diaSemana+$ultimoDiaMes;

        $j = 1;

        // hacemos un bucle hasta 42, que es el m�ximo de valores que puede
        // 6 columnas de 7 dias
        for($i=1;$i<=6;$i++)
        {
            $array = array
            (
                '1' => '',
                '2' => '',
                '3' => '',
                '4' => '',
                '5' => '',
                '6' => '',
                '7' => '',
             );

            for($e=1;$e<=7;$e++)
            {

                if($j==$diaSemana)
                {
                    // determinamos en que día empieza
                    $day=1;
                }
                //Determinamos si la celda está vacía
                if($j<$diaSemana || $j>=$last_cell)
                {
                    $array[''.$e] = ' ';
                }
                else
                {
                    if($res->num_rows > 0)
                    {
                        $mes1= $_SESSION['mes'];
                        $anio= $_SESSION['anio'];

                        if(strlen($day)==1) $dia2='0'.$day;
                        else $dia2=$day;

                        if(strlen($mes1)==1) $mes='0'.$mes1;
                        else $mes=$mes1;

                        //Arrays que guarda los eventos del dia
                        $eventosdia='';

                        $sql=mysqli_query($conexion, $query);

                        $contador=0;

                        while($dato = $sql->fetch_assoc()) 
                        {
                            $id_ev    = $dato['ev_id'];
                            $evento   = $dato['ev_nombre'];
                            $fecha_ev = $dato['ev_fecha'];
                            $tipo_ev  = $dato['ev_tipo'];
                            $anio_ev  = substr($fecha_ev, 0,4);
                            $mes_ev   = substr($fecha_ev,5,2);
                            $dia_ev   = substr($fecha_ev,8,2);

                            if($dia_ev==$dia2 && $anio==$anio_ev)
                            {
                                //Evento del día
                                //$eventosdia = $eventosdia . " " . $evento;
                                //$eventosdia[$contador] = $evento;
                            }
                            $contador=$contador+1;
                        }
                    }
                    $array[''.$e] = $day.$eventosdia;
                }

                $day++;
                $j++;
            }

            $this->Row($array);
        }

        $this->ProcessingTable=false;
        $this->cMargin=$cMargin;
        $this->aCols=array();

    }
}
?>
