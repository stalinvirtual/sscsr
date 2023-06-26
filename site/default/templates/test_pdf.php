<?php 
//namespace App\Controllers;
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */
require('fpdf/fpdf.php');
require('functions.php');
require_once("fpdf/phpqrcode/qrlib.php");



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
	 if ( $this->PageNo() == 1 ) {
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

	}

	// Page footer
	function Footer()
	{

 if ( $this->PageNo() == 1 ) {
		$this->SetY(-21);
		$this->SetFont('Arial','U',8);

		$this->Cell(0, 8, "Note: Please click here to download instructions", 'T', 0, 'C');

 }

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
//$pdf->Image("https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2Fwww.google.com%2F&choe=UTF-8", 40, 43, 20, 20, "png");


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
$paper = "";
$subject ="";
$date ="";
$shift ="";
$time ="";
$max_mark ="";
$important_instructions ="";

############## Paper 1 ##################

$subject_value_count = countSubject($admitcardresults->subject1);
$paper1 = valueAdded($admitcardresults->paper1);
$subject1 =  valueAdded($admitcardresults->subject1);
$date1 =  valueAdded($admitcardresults->date1);
$shift1 =  valueAdded($admitcardresults->shift1);
$time1 =  valueAdded($admitcardresults->time1);
$mark1 =  valueAdded($admitcardresults->mark1);

$mark1 = valueAdded( $admitcardresults->mark1);

############## Paper 1 ##################

##################  Paper 2 #########


$paper2 = $admitcardresults->paper2;
$subject2 = $admitcardresults->subject2;
$date2 =  $admitcardresults->date2;
$shift2 =  $admitcardresults->shift2;
$time2 =  $admitcardresults->time2;
$mark2 = $admitcardresults->mark2;

##################  Paper 2 #########

##################  Paper 3 #########


$paper3 = $admitcardresults->paper3;
$subject3 =  $admitcardresults->subject3;
$date3 =  $admitcardresults->date3;
$shift3 =  $admitcardresults->shift3;
$time3 =  $admitcardresults->time3;
$mark3 =  $admitcardresults->mark3;

##################  Paper 3 #########



##################  Paper 4 #########


$paper4 = $admitcardresults->paper4;
$subject4 = $admitcardresults->subject4;
$date4 =  $admitcardresults->date4;
$shift4 =  $admitcardresults->shift4;
$time4 = $admitcardresults->time4;
$mark4 =  $admitcardresults->mark4;

##################  Paper 4 #########


$exam_name_based_tier_year = $exam_name->exam_name." (".$exam_name->table_exam_year ." ) ".$admitcardresults->tier_name;





//$important_image = $admitcardresults->image_attachment;





$pdf->AddPage();	
$pdf->Ln(2);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(190,14,'',0,0,'C');
$pdf->Ln(1);
$pdf->Cell(190,5,'e-ADMISSION CERTIFICATE for',0,1,'C');
$pdf->Cell(190,5,$exam_name_based_tier_year ,0,1,'C');

//$pdf->Image("https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=".$reg_no."&choe=UTF-8%22%20title=%22Link%20to%20Google.com", 40, 43, 20, 20, "png");

//RegNo & Barcode
$pdf->SetY(43);$pdf->SetX(10);
$pdf->Code128(35,47,$reg_no,50,10);
$pdf->Cell(95,21,'', 1, 0, 'C', false );
$pdf->Cell(95,21,'',1,0,'C');
$pdf->SetY(43);$pdf->SetX(10);
$pdf->Cell(95,8,'',0,0,'L');
$pdf->Cell(95,8,'Reg. No:     '.$reg_no,0,0,'L');
$pdf->SetY(52);$pdf->SetX(10);
$pdf->Cell(95,8,'',0,0,'L');
$pdf->Cell(95,12,'Roll. No:     '.$roll_no,1,0,'L');
$pdf->SetY(54);$pdf->SetX(10);
$pdf->Cell(95,8,'',0,0,'L');
$pdf->SetFont('Arial','',9);
$pdf->Cell(95,15,'(to be used as User ID)',0,0,'L');

$pdf->SetFont('Arial','B',10);
//Roll Number & Opted for Scribe
$pdf->SetY(64);$pdf->SetX(10);
$pdf->Cell(95,8,'Ticket No:		'.$admitcardresults->ticket_no,0,0,'L');
$pdf->Cell(95,14,'',1,0,'');
$pdf->SetY(64);$pdf->SetX(10);
$pdf->SetFont('Arial','',9);
$pdf->Cell(95,14,'',1,0,'L');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(95,8,'Opted for Scribe:			'.$scribe_opted_medium,0,0,'L');

//PassWord & gender
$pdf->SetY(78);$pdf->SetX(10);
$pdf->Cell(95,8,'Password for Examination:',0,0,'L');
$pdf->Cell(95,15,'',1,0,'');
$pdf->SetY(78);$pdf->SetX(10);
$pdf->Cell(95,15,'',1,0,'L');
$pdf->Cell(95,8,'Gender :     '.$admitcardresults->gender,0,0,'L');

//Exam Date & repoting time & entry closing time
$pdf->SetY(93);$pdf->SetX(10);
$pdf->Cell(95,8,'Post No(s) or Post Preference:',0,0,'L');
$pdf->SetFont('Arial','B',9);
$pdf->Cell(47,8,'Reporting Time:'.$admitcardresults->repotime,0,0,'');
$pdf->Cell(48,8,'Entry Closing Time:'.$admitcardresults->gateclose,0,0,'');
$pdf->SetY(93);$pdf->SetX(10);
$pdf->Cell(95,16,'',1,0,'C');
$pdf->Cell(47,16,'',1,0,'C');
$pdf->Cell(48,16,'',1,0,'C');
$pdf->SetFont('Arial','',10);
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
$pdf->Cell(0,0,$pdf->Image("exam_assets/PHOTO/".$photo_id),0,0,'');

$pdf->SetY(109);$pdf->SetX(10);
$pdf->Cell(142,18,$candidate_name,0,0,'C');

$pdf->SetY(112);$pdf->SetX(10);
$pdf->Cell(142,32,"Candidate's New or Changed Name:",0,0,'L');
$pdf->Cell(48,32,'',0,0,'');

$pdf->SetY(115);$pdf->SetX(10);
$pdf->Cell(142,39,$candidate_name,0,0,'C');
$pdf->Cell(48,39,'',0,0,'');

$pdf->SetY(109);$pdf->SetX(10);
$pdf->Cell(142,39,'',1,0,'C');
$pdf->Cell(48,39,'',1,0,'');


//dob & category & sign
$pdf->SetY(148);$pdf->SetX(10);
$pdf->Cell(47,8,'DOB:',0,0,'L');
$pdf->Cell(95,8,'Category:',0,0,'L');
$pdf->Cell(48,8,$pdf->Image("exam_assets/SIGN/".$sign_id, 155,148, 30),0,0,'C');
$pdf->SetY(148);$pdf->SetX(10);
$pdf->Cell(47,12,$new_date_format,0,0,'C');
$pdf->Cell(95,12,$admitcardresults->category,0,0,'C');
$pdf->Cell(48,15,'',0,0,'L');
$pdf->SetY(148);$pdf->SetX(10);
$pdf->Cell(47,15,'',1,0,'L');
$pdf->Cell(95,15,'',1,0,'L');
$pdf->Cell(48,15,'',1,0,'L');


//Candidate Address
$pdf->SetY(163);$pdf->SetX(10);
$pdf->Cell(190,10,"Candidate's Address:" ,0,0,'L');
$pdf->SetY(163);$pdf->SetX(15);
$pdf->SetFont('Arial','',10);
$pdf->Cell(190,19,$admitcardresults->candidate_address,0,0,'L');
$pdf->SetY(163);$pdf->SetX(10);
$pdf->SetFont('Arial','',10);
$pdf->Cell(190,19,'',1,0,'L');

//Examination venue
$pdf->SetFont('Arial','B',10);
$pdf->SetY(182);$pdf->SetX(10);
$pdf->Cell(190,10,"Examination Venue:" ,0,0,'L');
$pdf->SetY(182);$pdf->SetX(15);
$pdf->SetFont('Arial','',8);
$pdf->Cell(190,19,$admitcardresults->examvenue1,0,0,'C');
$pdf->SetY(182);$pdf->SetX(10);
$pdf->Cell(190,28,$admitcardresults->examvenue2,1,0,'C');
$pdf->SetFont('Arial','',10);

//Subject Details
$pdf->SetFont('Arial','',9);
$pdf->SetY(202);$pdf->SetX(10);
$pdf->Cell(30,8,'Paper',1,0,'C');
$pdf->Cell(75,8,'Subject',1,0,'C');
$pdf->Cell(20,8,'Date',1,0,'C');
$pdf->Cell(10,8,'Shift',1,0,'C');
$pdf->Cell(40,8,'Time',1,0,'C');
$pdf->Cell(15,8,'Mark',1,0,'C');

 /**
  * @author Stalin
  * @subject  Paper1
  */
if($paper1 != "Nill" && $paper2 == "Nill")  {
	$date_height = 28;
	$shift_height = 28;
	$time_height = 28;
}else{
	$date_height = 7;
	$shift_height = 7;
	$time_height = 7;
}

if($paper1 != "Nill"){


$pdf->SetY(210);$pdf->SetX(10);
$pdf->MultiCell(30,7, utf8_decode($paper1),1,'C');
$pdf->SetY(210);$pdf->SetX(40);
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(75,7,utf8_decode($subject1),1,'C');
$pdf->SetY(210);$pdf->SetX(115);
$pdf->MultiCell(20,$date_height,utf8_decode(date("d-m-Y", strtotime($date1))),1,'C');
$pdf->SetY(210);$pdf->SetX(135);
$pdf->MultiCell(10,$shift_height,utf8_decode($shift1),1,'C');
$pdf->SetY(210);$pdf->SetX(145);
$pdf->SetFont('Arial','',7);
$pdf->MultiCell(40,$time_height,utf8_decode($time1),1,'C');
$pdf->SetFont('Arial','',9);
$pdf->SetY(210);$pdf->SetX(185);
$pdf->MultiCell(15,7,utf8_decode($mark1),1,'C');
	
}
else{
	
}
 /**
  * @author Stalin
  * @subject  Paper2
  */
if($paper2 != "Nill"){
	

		
$pdf->SetY(217);$pdf->SetX(10);
$pdf->MultiCell(30,7, utf8_decode($paper2),1,'C');
$pdf->SetY(217);$pdf->SetX(40);
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(75,7,utf8_decode($subject2),1,'C');
$pdf->SetY(217);$pdf->SetX(115);
$pdf->MultiCell(20,7,utf8_decode($date2),1,'C');
$pdf->SetY(217);$pdf->SetX(135);
$pdf->MultiCell(10,7,utf8_decode($shift2),1,'C');
$pdf->SetY(217);$pdf->SetX(145);
$pdf->SetFont('Arial','',7);
$pdf->MultiCell(40,7,utf8_decode($time2 ),1,'C');
$pdf->SetFont('Arial','',9);
$pdf->SetY(217);$pdf->SetX(185);
$pdf->MultiCell(15,7,utf8_decode($mark2),1,'C');
}
else{
	
}
 /**
  * @author Stalin
  * @subject  Paper3
  */
if($paper3 != "Nill"){
	
	

		
$pdf->SetY(224);$pdf->SetX(10);
$pdf->MultiCell(30,7, utf8_decode($paper3),1,'C');
$pdf->SetY(224);$pdf->SetX(40);
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(75,7,utf8_decode($subject3),1,'C');
$pdf->SetY(224);$pdf->SetX(115);
$pdf->MultiCell(20,7,utf8_decode($date3),1,'C');
$pdf->SetY(224);$pdf->SetX(135);
$pdf->MultiCell(10,7,utf8_decode($shift3),1,'C');
$pdf->SetY(224);$pdf->SetX(145);
$pdf->SetFont('Arial','',7);
$pdf->MultiCell(40,7,utf8_decode($time3 ),1,'C');
$pdf->SetFont('Arial','',9);
$pdf->SetY(224);$pdf->SetX(185);
$pdf->MultiCell(15,7,utf8_decode($mark3),1,'C');
}
else{
	
}
 /**
  * @author Stalin
  * @subject  Paper4
  */
if($paper4 != "Nill"){
$pdf->SetY(231);$pdf->SetX(10);
$pdf->MultiCell(30,7, utf8_decode($paper4),1,'C');
$pdf->SetY(231);$pdf->SetX(40);

$pdf->MultiCell(75,7,utf8_decode($subject4),1,'C');
$pdf->SetY(231);$pdf->SetX(115);
$pdf->MultiCell(20,7,utf8_decode($date4),1,'C');
$pdf->SetY(231);$pdf->SetX(135);
$pdf->MultiCell(10,7,utf8_decode($shift4),1,'C');
$pdf->SetY(231);$pdf->SetX(145);
$pdf->SetFont('Arial','',7);
$pdf->MultiCell(40,7,utf8_decode($time4 ),1,'C');
$pdf->SetFont('Arial','',9);
$pdf->SetY(231);$pdf->SetX(185);
$pdf->MultiCell(15,7,utf8_decode($mark4),1,'C');
}
else{
	
}

 /**
  * Adding 2nd page with content
  * 
  */


/* $pdf->AddPage();	
$pdf->Ln(2);
$pdf->SetFont('Arial','U',10);
$pdf->Cell(190,14,'',0,0,'C');
$pdf->Ln(1);
$pdf->Cell(190,5,'Important Instructions',0,1,'C');
$pdf->SetFont('Arial','B',10);

$pdf->Ln(1);
$content = preg_replace("/&#?[a-z0-9]+;/i","",$important_instructions);
$pdf->Cell(60,8,$pdf->WriteHTML($content),0,0,''); */

//PDF name 
/* $file_name = "stalin" . ".pdf";
$pdf->Output( $file_name,'I'); */


/*  *
  * Adding 2nd page with image
  *  */
if($admitcardresults->image_attachment !=""){
	$pdf->AddPage();
//QRcode::png("coded number here",'/home/apache2438/htdocs/citizen_new//sscsr/office/important_instructions/'.$important_image);

$pdf->Image('/home/apache2438/htdocs/citizen_new//sscsr/office/important_instructions/'.$admitcardresults->image_attachment, 0,0,210,297);
}

$file_name = $reg_no;
$pdf->Output( $file_name,'I');
?>
