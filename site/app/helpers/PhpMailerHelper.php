<?php
namespace App\Helpers;
use App\Models\Admitcard as Admitcard;
require(__DIR__ . "/../../PHPMailer-master/vendor/autoload.php");
require(__DIR__ . "/../../PHPMailer-master/PHPMailer-master/src/PHPMailer.php");

use PHPMailer\PHPMailer\PHPMailer;
class PhpMailerHelper extends PHPMailer
{
    public static function AdminCardofBulkEmail()
    {

        $selectedTableFormat = $_POST['selectedTableFormat'];
			$selectedTableFormatValue =  explode('_', 	$selectedTableFormat);
			$exam_type = $selectedTableFormatValue[1];

			$table_name = $_POST['examname']."_".$_POST['exam_year']."_".$exam_type;
			$tier_id = $_POST['selectedtier'];
			$data_array = array(
				"table_name" => $table_name,
				"tier_id" => $tier_id
			);


            // print_R($data_array);
            // exit;
            $admitcard = new Admitcard();

            $admitcardresults = $admitcard->getAdmitcardforTierSendEmail($data_array);

           // $re = count( $admitcardresults );

           // echo $re;
           // exit;


            // echo "<pre>";

            // print_r($admitcardresults);
           //  exit;


       
        if (empty($errors)) {
           					    //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch
        
            try {
                //$mail= new PHPMailer();



                //echo "<pre>";
                //print_r($admitcardresults);
               // exit;
                 

            foreach($admitcardresults as $value )
            {
               
            
                        $mail= new PHPMailer();
                                                                                // Enable verbose debug output
                        //$mail->SMTPDebug = 3;                               	// Enable verbose debug output
                        $mail->isSMTP();                                        // Set mailer to use SMTP
                       // $mail->Host = 'smtp.gmail.com'; 					    // Specify main and backup SMTP servers
                        $mail->Host = 'email.gov.in'; 					    // Specify main and backup SMTP servers
                        $mail->SMTPAuth = true;                                 // Enable SMTP authentication
                        // $mail->Username = 'stalingalaxy@gmail.com';              // SMTP username
                        // $mail->Password = '#';  
                        
                         $mail->Username = 'j.jeevitha@nic.in';              // SMTP username
                         $mail->Password = 'Jeeva#51286';  // SMTP password
                        $mail->SMTPSecure = 'ssl';                              // Enable TLS encryption, `ssl` also accepted
                        $mail->Port = 465;                                      // TCP port to connect to
                      //  $mail->setFrom('stalingalaxy@gmail.com', 'Stalin Thomas');

                        $mail->setFrom('j.jeevitha@nic.in', 'SSC Admit Card');

                        

                    
                        


                        $email = $value->emailid;

                        //echo $email;
                        $cand_name = $value->cand_name;
                        $reg_no = $value->reg_no;
                        $dob = $value->dob;
                        $roll_no = $value->roll_no;
                        $mail->addAddress($email); 
                        $mail->addReplyTo($email);

                        $newdir = 'cgle_2021';
                        $curdir = getcwd();
                        $dir = $curdir."/exam_assets/ftp";
                        $directory = $dir."/$newdir/"; 
                        $extension = '.pdf';

                        $attach =  $directory. $reg_no.$extension;

                       // echo  $attach;


                        $mail->addAttachment( $attach);

                        $mail->isHTML(true);                                    // Set email format to HTML
                        $mail->Subject = 'Download Your AdmitCard for SSC';
                        $mail->Body = "<table width='400' border='1' cellpadding='5px'><tr><th>Candidate Name</th><th>Reg No</th><th>Dob</th><th>Roll No</th></tr>";
                        $mail->Body .= "
                        <tr>
                        <td>".$cand_name."</td><td>". $reg_no."</td><td>". $dob ."  </td><td>".$roll_no."</td>
                        </tr> "; 
                    
                    
                    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                        if(!$mail->send()) {
                            echo 'Message could not be sent.';
                            echo 'Mailer Error: ' . $mail->ErrorInfo;
                            $sends=0;
                        } else {
                            //echo 'Message has been sent';
                            $sends=1;
                        }
                        $errors[] = "Send mail sucsessfully";

            }
                 $mail->Body .= "</table>";
       






            if($sends==1)
            echo '<script>("Message has been sent"); window.location.href="http://localhost/rd/sscsr/dataentry/admitcard_mail.php"
            </script>';
            } catch (phpmailerException $e) {
                $errors[] = $e->errorMessage(); //Pretty error messages from PHPMailer
            } catch (Exception $e) {
                $errors[] = $e->getMessage(); //Boring error messages from anything else!
            }
        }
    }
}
?>