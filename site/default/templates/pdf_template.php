<?php 
//namespace App\Controllers;

require('fpdf/fpdf.php');



class PDF extends FPDF
{

	

	function Cell($w, $h=0, $txt="", $border=0, $ln=0, $align='', $fill=false, $link='')
	{
		if (!empty($txt)){
			if (mb_detect_encoding($txt, 'UTF-8', false)){
				$txt = iconv('UTF-8', 'ISO-8859-5', $txt);

			}
		}
		parent::Cell($w, $h, $txt, $border, $ln, $align, $fill, $link);

	} 
	function Header()
	{
	
	//set font
	$this->SetFont('Arial','B',10);
	//set border
	$this->Rect(5, 5, 200, 288, 'D'); //A4
	//first container
	$x_value =100;
	$this->SetY(6);
	$this->Cell(190,27,'',1,0,''); 
	$this->Cell(5,0,$this->Image('exam_assets/fpdf_ssc_header.png', 12, $this->SetY(7), 65),0,0,'false'); 
	$this->SetY(6);$this->SetX($x_value);
	$this->Cell(5,0,'', 0, 0, 'L', false );
	$this->Cell( 0,0, $this->Image('exam_assets/logo.jpg', 88, $this->SetY(7), 25), 0, 0, '', false );
	$this->SetY(10);$this->SetX(120);
	$this->Cell(0,0,'Staff Selection Commission', 0, 0, '', false );

	$this->SetY(15);$this->SetX(120);
	$this->SetFont('Arial','',9);
	$this->Cell(0,0,'Region:', 0, 0, '', false );
	$this->SetY(15);$this->SetX(131);
	$this->SetFont('Arial','B',9);
	$this->Cell(0,0,'Southern Region', 0, 0, '', false );

	$this->SetY(20);$this->SetX(120);
	$this->Cell(0,0,'Website:www.sscsr.gov.in', 0, 0, '', false );

	$this->SetY(25);$this->SetX(120);
	$this->Cell(0,0,'HelplineNo.919445195946 / 044-28251139', 0, 0, '', false );

	$this->SetY(30);$this->SetX(120);
	$this->Cell(0,0,'Email Id:', 0, 0, '', false );
	$this->SetY(30);$this->SetX(134);
	$this->SetFont('Arial','U',9);
	$this->Cell(0,0,'sscsr.tn@nic.in', 0, 0, '', false );



	}

	// Page footer
	function Footer()
	{


		$this->SetY(-21);
		$this->SetFont('Arial','U',8);

		$this->Cell(0, 8, "Note: Please click here to download instructions", 'T', 0, 'C');



	}



	var $B=0;
    var $I=0;
    var $U=0;
    var $HREF='';
    var $ALIGN='';

    function WriteHTML($html)
    {
        //HTML parser
        $html=str_replace("\n",' ',$html);
        $a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
        foreach($a as $i=>$e)
        {
            if($i%2==0)
            {
                //Text
                if($this->HREF)
                    $this->PutLink($this->HREF,$e);
                elseif($this->ALIGN=='center')
                    $this->Cell(0,5,$e,0,1,'C');
                else
                    $this->Write(5,$e);
            }
            else
            {
                //Tag
                if($e[0]=='/')
                    $this->CloseTag(strtoupper(substr($e,1)));
                else
                {
                    //Extract properties
                    $a2=explode(' ',$e);
                    $tag=strtoupper(array_shift($a2));
                    $prop=array();
                    foreach($a2 as $v)
                    {
                        if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                            $prop[strtoupper($a3[1])]=$a3[2];
                    }
                    $this->OpenTag($tag,$prop);
                }
            }
        }
    }

    function OpenTag($tag,$prop)
    {
        //Opening tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,true);
        if($tag=='A')
            $this->HREF=$prop['HREF'];
        if($tag=='BR')
            $this->Ln(5);
        if($tag=='P')
            $this->ALIGN=$prop['ALIGN'];
        if($tag=='HR')
        {
            if( !empty($prop['WIDTH']) )
                $Width = $prop['WIDTH'];
            else
                $Width = $this->w - $this->lMargin-$this->rMargin;
            $this->Ln(2);
            $x = $this->GetX();
            $y = $this->GetY();
            $this->SetLineWidth(0.4);
            $this->Line($x,$y,$x+$Width,$y);
            $this->SetLineWidth(0.2);
            $this->Ln(2);
        }
    }

    function CloseTag($tag)
    {
        //Closing tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,false);
        if($tag=='A')
            $this->HREF='';
        if($tag=='P')
            $this->ALIGN='';
    }

    function SetStyle($tag,$enable)
    {
        //Modify style and select corresponding font
        $this->$tag+=($enable ? 1 : -1);
        $style='';
        foreach(array('B','I','U') as $s)
            if($this->$s>0)
                $style.=$s;
        $this->SetFont('',$style);
    }

    function PutLink($URL,$txt)
    {
        //Put a hyperlink
        $this->SetTextColor(0,0,255);
        $this->SetStyle('U',true);
        $this->Write(5,$txt,$URL);
        $this->SetStyle('U',false);
        $this->SetTextColor(0);
    }
	
	protected $T128;                                         // Tableau des codes 128
protected $ABCset = "";                                  // jeu des caractères éligibles au C128
protected $Aset = "";                                    // Set A du jeu des caractères éligibles
protected $Bset = "";                                    // Set B du jeu des caractères éligibles
protected $Cset = "";                                    // Set C du jeu des caractères éligibles
protected $SetFrom;                                      // Convertisseur source des jeux vers le tableau
protected $SetTo;                                        // Convertisseur destination des jeux vers le tableau
protected $JStart = array("A"=>103, "B"=>104, "C"=>105); // Caractères de sélection de jeu au début du C128
protected $JSwap = array("A"=>101, "B"=>100, "C"=>99);   // Caractères de changement de jeu

//____________________________ Extension du constructeur _______________________
function __construct($orientation='P', $unit='mm', $format='A4') {

    parent::__construct($orientation,$unit,$format);

    $this->T128[] = array(2, 1, 2, 2, 2, 2);           //0 : [ ]               // composition des caractères
    $this->T128[] = array(2, 2, 2, 1, 2, 2);           //1 : [!]
    $this->T128[] = array(2, 2, 2, 2, 2, 1);           //2 : ["]
    $this->T128[] = array(1, 2, 1, 2, 2, 3);           //3 : [#]
    $this->T128[] = array(1, 2, 1, 3, 2, 2);           //4 : [$]
    $this->T128[] = array(1, 3, 1, 2, 2, 2);           //5 : [%]
    $this->T128[] = array(1, 2, 2, 2, 1, 3);           //6 : [&]
    $this->T128[] = array(1, 2, 2, 3, 1, 2);           //7 : [']
    $this->T128[] = array(1, 3, 2, 2, 1, 2);           //8 : [(]
    $this->T128[] = array(2, 2, 1, 2, 1, 3);           //9 : [)]
    $this->T128[] = array(2, 2, 1, 3, 1, 2);           //10 : [*]
    $this->T128[] = array(2, 3, 1, 2, 1, 2);           //11 : [+]
    $this->T128[] = array(1, 1, 2, 2, 3, 2);           //12 : [,]
    $this->T128[] = array(1, 2, 2, 1, 3, 2);           //13 : [-]
    $this->T128[] = array(1, 2, 2, 2, 3, 1);           //14 : [.]
    $this->T128[] = array(1, 1, 3, 2, 2, 2);           //15 : [/]
    $this->T128[] = array(1, 2, 3, 1, 2, 2);           //16 : [0]
    $this->T128[] = array(1, 2, 3, 2, 2, 1);           //17 : [1]
    $this->T128[] = array(2, 2, 3, 2, 1, 1);           //18 : [2]
    $this->T128[] = array(2, 2, 1, 1, 3, 2);           //19 : [3]
    $this->T128[] = array(2, 2, 1, 2, 3, 1);           //20 : [4]
    $this->T128[] = array(2, 1, 3, 2, 1, 2);           //21 : [5]
    $this->T128[] = array(2, 2, 3, 1, 1, 2);           //22 : [6]
    $this->T128[] = array(3, 1, 2, 1, 3, 1);           //23 : [7]
    $this->T128[] = array(3, 1, 1, 2, 2, 2);           //24 : [8]
    $this->T128[] = array(3, 2, 1, 1, 2, 2);           //25 : [9]
    $this->T128[] = array(3, 2, 1, 2, 2, 1);           //26 : [:]
    $this->T128[] = array(3, 1, 2, 2, 1, 2);           //27 : [;]
    $this->T128[] = array(3, 2, 2, 1, 1, 2);           //28 : [<]
    $this->T128[] = array(3, 2, 2, 2, 1, 1);           //29 : [=]
    $this->T128[] = array(2, 1, 2, 1, 2, 3);           //30 : [>]
    $this->T128[] = array(2, 1, 2, 3, 2, 1);           //31 : [?]
    $this->T128[] = array(2, 3, 2, 1, 2, 1);           //32 : [@]
    $this->T128[] = array(1, 1, 1, 3, 2, 3);           //33 : [A]
    $this->T128[] = array(1, 3, 1, 1, 2, 3);           //34 : [B]
    $this->T128[] = array(1, 3, 1, 3, 2, 1);           //35 : [C]
    $this->T128[] = array(1, 1, 2, 3, 1, 3);           //36 : [D]
    $this->T128[] = array(1, 3, 2, 1, 1, 3);           //37 : [E]
    $this->T128[] = array(1, 3, 2, 3, 1, 1);           //38 : [F]
    $this->T128[] = array(2, 1, 1, 3, 1, 3);           //39 : [G]
    $this->T128[] = array(2, 3, 1, 1, 1, 3);           //40 : [H]
    $this->T128[] = array(2, 3, 1, 3, 1, 1);           //41 : [I]
    $this->T128[] = array(1, 1, 2, 1, 3, 3);           //42 : [J]
    $this->T128[] = array(1, 1, 2, 3, 3, 1);           //43 : [K]
    $this->T128[] = array(1, 3, 2, 1, 3, 1);           //44 : [L]
    $this->T128[] = array(1, 1, 3, 1, 2, 3);           //45 : [M]
    $this->T128[] = array(1, 1, 3, 3, 2, 1);           //46 : [N]
    $this->T128[] = array(1, 3, 3, 1, 2, 1);           //47 : [O]
    $this->T128[] = array(3, 1, 3, 1, 2, 1);           //48 : [P]
    $this->T128[] = array(2, 1, 1, 3, 3, 1);           //49 : [Q]
    $this->T128[] = array(2, 3, 1, 1, 3, 1);           //50 : [R]
    $this->T128[] = array(2, 1, 3, 1, 1, 3);           //51 : [S]
    $this->T128[] = array(2, 1, 3, 3, 1, 1);           //52 : [T]
    $this->T128[] = array(2, 1, 3, 1, 3, 1);           //53 : [U]
    $this->T128[] = array(3, 1, 1, 1, 2, 3);           //54 : [V]
    $this->T128[] = array(3, 1, 1, 3, 2, 1);           //55 : [W]
    $this->T128[] = array(3, 3, 1, 1, 2, 1);           //56 : [X]
    $this->T128[] = array(3, 1, 2, 1, 1, 3);           //57 : [Y]
    $this->T128[] = array(3, 1, 2, 3, 1, 1);           //58 : [Z]
    $this->T128[] = array(3, 3, 2, 1, 1, 1);           //59 : [[]
    $this->T128[] = array(3, 1, 4, 1, 1, 1);           //60 : [\]
    $this->T128[] = array(2, 2, 1, 4, 1, 1);           //61 : []]
    $this->T128[] = array(4, 3, 1, 1, 1, 1);           //62 : [^]
    $this->T128[] = array(1, 1, 1, 2, 2, 4);           //63 : [_]
    $this->T128[] = array(1, 1, 1, 4, 2, 2);           //64 : [`]
    $this->T128[] = array(1, 2, 1, 1, 2, 4);           //65 : [a]
    $this->T128[] = array(1, 2, 1, 4, 2, 1);           //66 : [b]
    $this->T128[] = array(1, 4, 1, 1, 2, 2);           //67 : [c]
    $this->T128[] = array(1, 4, 1, 2, 2, 1);           //68 : [d]
    $this->T128[] = array(1, 1, 2, 2, 1, 4);           //69 : [e]
    $this->T128[] = array(1, 1, 2, 4, 1, 2);           //70 : [f]
    $this->T128[] = array(1, 2, 2, 1, 1, 4);           //71 : [g]
    $this->T128[] = array(1, 2, 2, 4, 1, 1);           //72 : [h]
    $this->T128[] = array(1, 4, 2, 1, 1, 2);           //73 : [i]
    $this->T128[] = array(1, 4, 2, 2, 1, 1);           //74 : [j]
    $this->T128[] = array(2, 4, 1, 2, 1, 1);           //75 : [k]
    $this->T128[] = array(2, 2, 1, 1, 1, 4);           //76 : [l]
    $this->T128[] = array(4, 1, 3, 1, 1, 1);           //77 : [m]
    $this->T128[] = array(2, 4, 1, 1, 1, 2);           //78 : [n]
    $this->T128[] = array(1, 3, 4, 1, 1, 1);           //79 : [o]
    $this->T128[] = array(1, 1, 1, 2, 4, 2);           //80 : [p]
    $this->T128[] = array(1, 2, 1, 1, 4, 2);           //81 : [q]
    $this->T128[] = array(1, 2, 1, 2, 4, 1);           //82 : [r]
    $this->T128[] = array(1, 1, 4, 2, 1, 2);           //83 : [s]
    $this->T128[] = array(1, 2, 4, 1, 1, 2);           //84 : [t]
    $this->T128[] = array(1, 2, 4, 2, 1, 1);           //85 : [u]
    $this->T128[] = array(4, 1, 1, 2, 1, 2);           //86 : [v]
    $this->T128[] = array(4, 2, 1, 1, 1, 2);           //87 : [w]
    $this->T128[] = array(4, 2, 1, 2, 1, 1);           //88 : [x]
    $this->T128[] = array(2, 1, 2, 1, 4, 1);           //89 : [y]
    $this->T128[] = array(2, 1, 4, 1, 2, 1);           //90 : [z]
    $this->T128[] = array(4, 1, 2, 1, 2, 1);           //91 : [{]
    $this->T128[] = array(1, 1, 1, 1, 4, 3);           //92 : [|]
    $this->T128[] = array(1, 1, 1, 3, 4, 1);           //93 : [}]
    $this->T128[] = array(1, 3, 1, 1, 4, 1);           //94 : [~]
    $this->T128[] = array(1, 1, 4, 1, 1, 3);           //95 : [DEL]
    $this->T128[] = array(1, 1, 4, 3, 1, 1);           //96 : [FNC3]
    $this->T128[] = array(4, 1, 1, 1, 1, 3);           //97 : [FNC2]
    $this->T128[] = array(4, 1, 1, 3, 1, 1);           //98 : [SHIFT]
    $this->T128[] = array(1, 1, 3, 1, 4, 1);           //99 : [Cswap]
    $this->T128[] = array(1, 1, 4, 1, 3, 1);           //100 : [Bswap]                
    $this->T128[] = array(3, 1, 1, 1, 4, 1);           //101 : [Aswap]
    $this->T128[] = array(4, 1, 1, 1, 3, 1);           //102 : [FNC1]
    $this->T128[] = array(2, 1, 1, 4, 1, 2);           //103 : [Astart]
    $this->T128[] = array(2, 1, 1, 2, 1, 4);           //104 : [Bstart]
    $this->T128[] = array(2, 1, 1, 2, 3, 2);           //105 : [Cstart]
    $this->T128[] = array(2, 3, 3, 1, 1, 1);           //106 : [STOP]
    $this->T128[] = array(2, 1);                       //107 : [END BAR]

    for ($i = 32; $i <= 95; $i++) {                                            // jeux de caractères
        $this->ABCset .= chr($i);
    }
    $this->Aset = $this->ABCset;
    $this->Bset = $this->ABCset;
    
    for ($i = 0; $i <= 31; $i++) {
        $this->ABCset .= chr($i);
        $this->Aset .= chr($i);
    }
    for ($i = 96; $i <= 127; $i++) {
        $this->ABCset .= chr($i);
        $this->Bset .= chr($i);
    }
    for ($i = 200; $i <= 210; $i++) {                                           // controle 128
        $this->ABCset .= chr($i);
        $this->Aset .= chr($i);
        $this->Bset .= chr($i);
    }
    $this->Cset="0123456789".chr(206);

    for ($i=0; $i<96; $i++) {                                                   // convertisseurs des jeux A & B
        @$this->SetFrom["A"] .= chr($i);
        @$this->SetFrom["B"] .= chr($i + 32);
        @$this->SetTo["A"] .= chr(($i < 32) ? $i+64 : $i-32);
        @$this->SetTo["B"] .= chr($i);
    }
    for ($i=96; $i<107; $i++) {                                                 // contrôle des jeux A & B
        @$this->SetFrom["A"] .= chr($i + 104);
        @$this->SetFrom["B"] .= chr($i + 104);
        @$this->SetTo["A"] .= chr($i);
        @$this->SetTo["B"] .= chr($i);
    }
}

//________________ Fonction encodage et dessin du code 128 _____________________
function Code128($x, $y, $code, $w, $h) {
    $Aguid = "";                                                                      // Création des guides de choix ABC
    $Bguid = "";
    $Cguid = "";
    for ($i=0; $i < strlen($code); $i++) {
        $needle = substr($code,$i,1);
        $Aguid .= ((strpos($this->Aset,$needle)===false) ? "N" : "O"); 
        $Bguid .= ((strpos($this->Bset,$needle)===false) ? "N" : "O"); 
        $Cguid .= ((strpos($this->Cset,$needle)===false) ? "N" : "O");
    }

    $SminiC = "OOOO";
    $IminiC = 4;

    $crypt = "";
    while ($code > "") {
                                                                                    // BOUCLE PRINCIPALE DE CODAGE
        $i = strpos($Cguid,$SminiC);                                                // forçage du jeu C, si possible
        if ($i!==false) {
            $Aguid [$i] = "N";
            $Bguid [$i] = "N";
        }

        if (substr($Cguid,0,$IminiC) == $SminiC) {                                  // jeu C
            $crypt .= chr(($crypt > "") ? $this->JSwap["C"] : $this->JStart["C"]);  // début Cstart, sinon Cswap
            $made = strpos($Cguid,"N");                                             // étendu du set C
            if ($made === false) {
                $made = strlen($Cguid);
            }
            if (fmod($made,2)==1) {
                $made--;                                                            // seulement un nombre pair
            }
            for ($i=0; $i < $made; $i += 2) {
                $crypt .= chr(strval(substr($code,$i,2)));                          // conversion 2 par 2
            }
            $jeu = "C";
        } else {
            $madeA = strpos($Aguid,"N");                                            // étendu du set A
            if ($madeA === false) {
                $madeA = strlen($Aguid);
            }
            $madeB = strpos($Bguid,"N");                                            // étendu du set B
            if ($madeB === false) {
                $madeB = strlen($Bguid);
            }
            $made = (($madeA < $madeB) ? $madeB : $madeA );                         // étendu traitée
            $jeu = (($madeA < $madeB) ? "B" : "A" );                                // Jeu en cours

            $crypt .= chr(($crypt > "") ? $this->JSwap[$jeu] : $this->JStart[$jeu]); // début start, sinon swap

            $crypt .= strtr(substr($code, 0,$made), $this->SetFrom[$jeu], $this->SetTo[$jeu]); // conversion selon jeu

        }
        $code = substr($code,$made);                                           // raccourcir légende et guides de la zone traitée
        $Aguid = substr($Aguid,$made);
        $Bguid = substr($Bguid,$made);
        $Cguid = substr($Cguid,$made);
    }                                                                          // FIN BOUCLE PRINCIPALE

    $check = ord($crypt[0]);                                                   // calcul de la somme de contrôle
    for ($i=0; $i<strlen($crypt); $i++) {
        $check += (ord($crypt[$i]) * $i);
    }
    $check %= 103;

    $crypt .= chr($check) . chr(106) . chr(107);                               // Chaine cryptée complète

    $i = (strlen($crypt) * 11) - 8;                                            // calcul de la largeur du module
    $modul = $w/$i;

    for ($i=0; $i<strlen($crypt); $i++) {                                      // BOUCLE D'IMPRESSION
        $c = $this->T128[ord($crypt[$i])];
        for ($j=0; $j<count($c); $j++) {
            $this->Rect($x,$y,$c[$j]*$modul,$h,"F");
            $x += ($c[$j++]+$c[$j])*$modul;
        }
    }
}
	
}

$pdf = new PDF();
$x_value = 15;
$reg_no = $admitcardresults->reg_no;
$roll_no = $admitcardresults->roll_no;
$scribe_opted_medium = $admitcardresults->scribe_opted_medium;
$ticketno = $admitcardresults->ticket_no !="" ?$admitcardresults->ticket_no:"";
$password_for_exam = "";
$post = "";
$reporting_time = "";
$entry_closing__time = "";
$candidate_name = $admitcardresults->cand_name;
$candidate_changed_name = $admitcardresults->cand_name;
#########   For DOB Format ############
$date = $admitcardresults->dob;
$var_day = substr($date,0,2);
// Get the month
$var_month = substr($date,2,2);
// Get the year
$var_year = substr($date,4,4);
// Change the date from ddmmyyyy to yyyymmdd
$new_date_format = $var_day."-".$var_month."-".$var_year ;
#########   For DOB Format ############
$category = "";
$candidate_address = "";
$photo_id =$admitcardresults->photo_id;
$sign_id =$admitcardresults->sign_id;
$examination_venue =$admitcardresults->exam_center;

/* $roll_no = $admitcardresults->roll_no;
$ticketno = $admitcardresults->ticket_no;
$exam_date = $admitcardresults->exam_date;
$exam_time = $admitcardresults->exam_time;


$repo_time = $admitcardresults->repo_time;
$dob = $admitcardresults->dob;
$gate_close = $admitcardresults->gate_close;
$app_name = $admitcardresults->app_name;
$gender = $admitcardresults->sex;
$category = $admitcardresults->category;
$photoid = $admitcardresults->photoid;
$signid = $admitcardresults->signid;
$landmark = $admitcardresults->landmark;
$venuname =  $admitcardresults->venu_name . ",\n" . $admitcardresults->venu_add1 . ",\n" . $admitcardresults->venu_add2 . ", " . $admitcardresults->venu_add3.".";

$c_address =  $admitcardresults->cor_add1 . ",\n" . $admitcardresults->cor_add2 . "," . $admitcardresults->cor_add3 . "," . $admitcardresults->cor_add4.".";

$scribe_opt = $admitcardresults->scribe_opt;
$app_no = $admitcardresults->app_no; */



// Show the new date in yyyymmdd format
//echo $new_date_format;



$pdf->AddPage();	
$pdf->Ln(2);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(190,14,'',0,0,'C');
$pdf->Ln(1);
$pdf->Cell(190,5,'e-ADMISSION CERTIFICATE for',0,1,'C');
$pdf->Cell(190,5,'COMBINED GRADUATE LEVEL EXAMINATION, 2020 (TIER-I)',0,1,'C');

//RegNo & Barcode


//$pdf->EAN13(35,47,'12345678901',10,0.5,9);// Barcode($x, $y, $barcode, $h, $w, $fSize, $len)
//$pdf->Image("https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=".$qr."&choe=UTF-8%22%20title=%22Link%20to%20Google.com", 40, 43, 20, 20, "png");
$pdf->Cell(95,20,'', 1, 0, 'C', false );
$pdf->Cell(95,20,'',1,0,'C');
$pdf->SetY(43);$pdf->SetX(10);
$pdf->Cell(95,8,'',0,0,'L');
$pdf->Cell(95,8,'Reg. No:     '.$reg_no,0,0,'L');

//Roll Number & Opted for Scribe
$pdf->SetY(63);$pdf->SetX(10);
$pdf->Cell(95,8,'Roll No:      426 ',0,0,'L');
$pdf->Cell(95,15,'',1,0,'');
$pdf->SetY(63);$pdf->SetX(10);
$pdf->Cell(95,15,'(to be used as User ID)',1,0,'L');
$pdf->Cell(95,8,'Opted for Scribe:     ',0,0,'L');

//PassWord & gender
$pdf->SetY(78);$pdf->SetX(10);
$pdf->Cell(95,8,'Password for Examination:',0,0,'L');
$pdf->Cell(95,15,'',1,0,'');
$pdf->SetY(78);$pdf->SetX(10);
$pdf->Cell(95,15,'',1,0,'L');
$pdf->Cell(95,8,'Gender :     ',0,0,'L');

//Exam Date & repoting time & entry closing time
$pdf->SetY(93);$pdf->SetX(10);
$pdf->Cell(95,8,'Exam Date:',0,0,'L');
$pdf->Cell(47,8,'Reporting Time:',0,0,'');
$pdf->Cell(48,8,'Entry Closing Time:',0,0,'');
$pdf->SetY(93);$pdf->SetX(10);
$pdf->Cell(95,16,'',1,0,'C');
$pdf->Cell(47,16,'',1,0,'C');
$pdf->Cell(48,16,'',1,0,'C');

$pdf->SetY(96);$pdf->SetX(10);
$pdf->Cell(95,16,"",0,0,'C');
$pdf->Cell(47,16,"$repo_time",0,0,'C');
$pdf->Cell(48,16,"$gate_close",0,0,'C');

//candidate name & photo 
$pdf->SetY(109);$pdf->SetX(10);
$pdf->Cell(142,8,"Candidate's Name:",0,0,'L');
$pdf->Cell(48,8,'',0,0,'');

$pdf->SetY(112);$pdf->SetX(20);
$pdf->Cell(142,8,'',0,0,'L');
$pdf->Cell(0,0,"",0,0,'');

$pdf->SetY(109);$pdf->SetX(10);
$pdf->Cell(142,18,"$app_name",0,0,'C');

$pdf->SetY(112);$pdf->SetX(10);
$pdf->Cell(142,32,"Candidate's New or Changed Name:",0,0,'L');
$pdf->Cell(48,32,'',0,0,'');

$pdf->SetY(115);$pdf->SetX(10);
$pdf->Cell(142,39,"$app_name",0,0,'C');
$pdf->Cell(48,39,'',0,0,'');

$pdf->SetY(109);$pdf->SetX(10);
$pdf->Cell(142,39,'',1,0,'C');
$pdf->Cell(48,39,'',1,0,'');


//dob & category & sign
$pdf->SetY(148);$pdf->SetX(10);
$pdf->Cell(47,8,'DOB:',0,0,'L');
$pdf->Cell(95,8,'Category:',0,0,'L');
$pdf->Cell(48,8,"", 155,148, 30,0,0,'C');
$pdf->SetY(148);$pdf->SetX(10);
$pdf->Cell(47,12,"$new_date_format",0,0,'C');
$pdf->Cell(95,12,"$category",0,0,'C');
$pdf->Cell(48,15,'',0,0,'L');
$pdf->SetY(148);$pdf->SetX(10);
$pdf->Cell(47,15,'',1,0,'L');
$pdf->Cell(95,15,'',1,0,'L');
$pdf->Cell(48,15,'',1,0,'L');


//Candidate Address
$pdf->SetY(163);$pdf->SetX(10);
$pdf->SetFont('Arial','',9);
$pdf->Cell(190,19,"",1);
$pdf->SetY(163);$pdf->SetX(15);
$pdf->MultiCell(190,6,"Candidate's Address:\n" ,0);


//Exam Date & time
$pdf->SetY(182);$pdf->SetX(10);
$pdf->Cell(60,8,$pdf->WriteHTML("<u><p align='left'>Date & Time of Examination</p></u>"),0,0,'');
$pdf->SetY(188);$pdf->SetX(10);
$pdf->Cell(60,8,$exam_date,0,0,'C');
$pdf->SetY(188);$pdf->SetX(10);
$pdf->Cell(60,16,$exam_time,0,0,'C');
$pdf->SetY(182);$pdf->SetX(10);
$pdf->Cell(60,20,'',1,0,'C');

//Examination venue
$pdf->SetY(182);$pdf->SetX(70);
$pdf->Cell(0,20,'',1,0,'');
$pdf->SetY(183);$pdf->SetX(75);
$pdf->MultiCell(130,4,"Examination Venue:\n" ,0);

// Rules & Regulation
$pdf->SetY(202);$pdf->SetX(10);
$pdf->Cell(190,37,'',1,0,'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(190,1,'',0,1,'C');
$pdf->Cell($pdf->SetX(12),5,'1. Candidate without valid date on the photograph, as per Notice of Recruitment, will not be allowed for the examination.',0,1,'L');
$pdf->Cell($pdf->SetX(12),5,'2. Candidate must carry an original photo identity card having the same Date of Birth (including Date, Month & Year) as',0,1,'L');
$pdf->Cell($pdf->SetX(12),5,'    printed on the Admission Certificate.',0,1,'L');
$pdf->Cell($pdf->SetX(12),5,'3. If photo identity card does not have the same Date of Birth (including Date, Month & Year) then the candidate must ',0,1,'L');
$pdf->Cell($pdf->SetX(12),5,'    carry an additional certificate (in original) as proof of their Date of Birth.',0,1,'L');
$pdf->Cell($pdf->SetX(12),5,'4. In case of mismatch in the Date of Birth mentioned in the Admission Certificated and photo ID/the certificate brought',0,1,'L');
$pdf->Cell($pdf->SetX(12),5,'    in support of Date of Birth, the candidate will not be allowed to appear in the examination.',0,1,'L');


//Subject Details
$pdf->SetY(240);$pdf->SetX(10);
$pdf->Cell(35,8,'Tier-1',1,0,'C');
$pdf->Cell(120,8,'Subject',1,0,'C');
$pdf->Cell(35,8,'Marks',1,0,'C');
$pdf->SetY(248);$pdf->SetX(10);
$pdf->MultiCell(35,7,"\nComputer\nBased\nExamination",1,'C');
$pdf->SetY(248);$pdf->SetX(45);
$pdf->MultiCell(120,7,"A. General Inteligence & Reasoning\nB. General Awareness\nC. Quantitative Aptitude\nD. English Comprehension",1);
$pdf->SetY(248);$pdf->SetX(165);
$pdf->MultiCell(35,7,"50\n50\n50\n50",1,'C');





//PDF name 
$file_name = "stalin" . ".pdf";
$pdf->Output( $file_name,'I');

?>