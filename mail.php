<?php
require 'session.php';
require 'PHPMailer/PHPMailerAutoload.php';

// -- Start Session if not already started
// if ((function_exists('session_status') && session_status() == PHP_SESSION_NONE) || session_id() == '')
//     session_start();

// print_r($_FILES);exit;

$mail = new PHPMailer;



try {

    $mail->SMTPDebug = 0;				// Disable debug output for production


    $mail->isSMTP();                                            //Send using SMTP

    $mail->Host       = 'SSL0.OVH.NET';                     //Set the SMTP server to send through

    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication

    $mail->Username   = 'abdeladim@blinkagency.ma';                     //SMTP username

    $mail->Password   = 'Abdel2020BLK';                               //SMTP password

    $mail->SMTPSecure = 'ssl';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_STARTTLS` encouraged
    // $mail->SMTPSecure = 'ssl';
    // $mail->Port       = 25; 
    $mail->Port       = 465;                                    //TCP port to connect to, use 587 for `PHPMailer::ENCRYPTION_STARTTLS` above



    //Recipients

    $mail->setFrom('abdeladim@blinkagency.ma', 'Boti Site Web');     

    $mail->addAddress('saadmnhm@gmail.com');            //Add a recipient    
    


    
    //Attachments

    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments

    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name



    //Content

    $mail->isHTML(true);                                  //Set email format to HTML

    switch($_POST['op']){

        case 'contact':
         $mail->Subject = 'Nouveau Message Recu';

         $mail->Body    = '



        <table style="width:100%;">

        

            <tr>

                <th style="width:20%;border:1px solid black;">Nom Complet</td>


                <th style="width:20%;border:1px solid black;">Email</td>

                <th style="width:20%;border:1px solid black;">Téléphone</td>

                <th style="width:20%;border:1px solid black;">Services</td>

                <th style="width:60%;border:1px solid black;">Message</td>

            </tr>

            <tr>

                <td style="border:1px solid black;">'.$_POST['nomcomplet'].'</td>

                <td style="border:1px solid black;">'.$_POST['email'].'</td>

                <td style="border:1px solid black;">'.$_POST['tel'].'</td>

                <td style="border:1px solid black;">'.$_POST['services'].'</td>

                <td style="border:1px solid black;">'.$_POST['message'].'</td>

            </tr>

        

        </table>';

        $mail->AltBody = 'Nom Complet :'.$_POST['nomcomplet'].' | Email : '.$_POST['email'].' | Téléphone : '.$_POST['tel'].' | Services : '.$_POST['services'].' | Message : '.$_POST['message'];



        $mail->send();

        $data = ['nomcomplet'=>$_POST['nomcomplet'],'email'=>$_POST['email'],'message'=>$_POST['message']];

        $fp = fopen('contacts.json', 'a');

        fwrite($fp, json_encode($data));

        fclose($fp);

        $_SESSION['result'] = 'success';
        echo('<script> window.location.href = "contact.php";</script>');


        break;

        case 'stepper':
         // Clear any previous recipients
         $mail->clearAddresses();
         $mail->addAddress('saadmnhm@gmail.com');
         
         $mail->Subject = 'Nouvelle Inscription - Formulaire Stepper';

         $mail->Body    = '
        <h2>Nouvelle Inscription Reçue</h2>
        <table style="width:100%; border-collapse: collapse;">
            <tr>
                <th style="width:30%;border:1px solid black;padding:8px;background:#f0f0f0;">Champ</th>
                <th style="width:70%;border:1px solid black;padding:8px;background:#f0f0f0;">Valeur</th>
            </tr>
            <tr>
                <td style="border:1px solid black;padding:8px;"><strong>Nom</strong></td>
                <td style="border:1px solid black;padding:8px;">'.(isset($_POST['lastName']) ? $_POST['lastName'] : '').'</td>
            </tr>
            <tr>
                <td style="border:1px solid black;padding:8px;"><strong>Prénom</strong></td>
                <td style="border:1px solid black;padding:8px;">'.(isset($_POST['firstName']) ? $_POST['firstName'] : '').'</td>
            </tr>
            <tr>
                <td style="border:1px solid black;padding:8px;"><strong>Email</strong></td>
                <td style="border:1px solid black;padding:8px;">'.(isset($_POST['email']) ? $_POST['email'] : '').'</td>
            </tr>
            <tr>
                <td style="border:1px solid black;padding:8px;"><strong>Téléphone</strong></td>
                <td style="border:1px solid black;padding:8px;">'.(isset($_POST['phone']) ? $_POST['phone'] : '').'</td>
            </tr>
            <tr>
                <td style="border:1px solid black;padding:8px;"><strong>Adresse</strong></td>
                <td style="border:1px solid black;padding:8px;">'.(isset($_POST['address']) ? $_POST['address'] : '').'</td>
            </tr>
            <tr>
                <td style="border:1px solid black;padding:8px;"><strong>Budget</strong></td>
                <td style="border:1px solid black;padding:8px;">'.(isset($_POST['budget']) ? $_POST['budget'] : '0').'</td>
            </tr>
            <tr>
                <td style="border:1px solid black;padding:8px;"><strong>Option Étape 1</strong></td>
                <td style="border:1px solid black;padding:8px;">'.(isset($_POST['step1']) ? $_POST['step1'] : '').'</td>
            </tr>
            <tr>
                <td style="border:1px solid black;padding:8px;"><strong>Préférence Étape 2</strong></td>
                <td style="border:1px solid black;padding:8px;">'.(isset($_POST['step2']) ? $_POST['step2'] : '').'</td>
            </tr>
        </table>';

        $mail->AltBody = 'Nom: '.(isset($_POST['lastName']) ? $_POST['lastName'] : '').' | Prénom: '.(isset($_POST['firstName']) ? $_POST['firstName'] : '').' | Email: '.(isset($_POST['email']) ? $_POST['email'] : '').' | Téléphone: '.(isset($_POST['phone']) ? $_POST['phone'] : '').' | Adresse: '.(isset($_POST['address']) ? $_POST['address'] : '').' | Budget: '.(isset($_POST['budget']) ? $_POST['budget'] : '0').' | Option: '.(isset($_POST['step1']) ? $_POST['step1'] : '').' | Préférence: '.(isset($_POST['step2']) ? $_POST['step2'] : '');

        if($mail->send()) {
            $data = [
                'firstName' => isset($_POST['firstName']) ? $_POST['firstName'] : '',
                'lastName' => isset($_POST['lastName']) ? $_POST['lastName'] : '',
                'email' => isset($_POST['email']) ? $_POST['email'] : '',
                'phone' => isset($_POST['phone']) ? $_POST['phone'] : '',
                'address' => isset($_POST['address']) ? $_POST['address'] : '',
                'budget' => isset($_POST['budget']) ? $_POST['budget'] : '0',
                'step1' => isset($_POST['step1']) ? $_POST['step1'] : '',
                'step2' => isset($_POST['step2']) ? $_POST['step2'] : '',
                'date' => date('Y-m-d H:i:s')
            ];
            $fp = fopen('contacts.json', 'a');
            fwrite($fp, json_encode($data)."\n");
            fclose($fp);
            
            echo json_encode(['status' => 'success', 'message' => 'Email sent successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to send email: ' . $mail->ErrorInfo]);
        }
        break;

        case 'enjoyia_contact':
         // Clear any previous recipients
         $mail->clearAddresses();
         $mail->addAddress('saadmnhm@gmail.com');
         
         $mail->Subject = 'Nouvelle Demande - Formulaire Enjoy AI';

         $mail->Body    = '
        <h2>Nouvelle Demande Reçue - Enjoy AI</h2>
        <table style="width:100%; border-collapse: collapse;">
            <tr>
                <th style="width:30%;border:1px solid black;padding:8px;background:#f0f0f0;">Champ</th>
                <th style="width:70%;border:1px solid black;padding:8px;background:#f0f0f0;">Valeur</th>
            </tr>
            <tr>
                <td style="border:1px solid black;padding:8px;"><strong>Établissement</strong></td>
                <td style="border:1px solid black;padding:8px;">'.(isset($_POST['etablissement']) ? $_POST['etablissement'] : '').'</td>
            </tr>
            <tr>
                <td style="border:1px solid black;padding:8px;"><strong>Ville</strong></td>
                <td style="border:1px solid black;padding:8px;">'.(isset($_POST['ville']) ? $_POST['ville'] : '').'</td>
            </tr>
            <tr>
                <td style="border:1px solid black;padding:8px;"><strong>Cycles</strong></td>
                <td style="border:1px solid black;padding:8px;">'.(isset($_POST['cycles']) ? $_POST['cycles'] : '').'</td>
            </tr>
            <tr>
                <td style="border:1px solid black;padding:8px;"><strong>Nombre d\'élève</strong></td>
                <td style="border:1px solid black;padding:8px;">'.(isset($_POST['nombre_eleve']) ? $_POST['nombre_eleve'] : '').'</td>
            </tr>
            <tr>
                <td style="border:1px solid black;padding:8px;"><strong>Nom</strong></td>
                <td style="border:1px solid black;padding:8px;">'.(isset($_POST['nom']) ? $_POST['nom'] : '').'</td>
            </tr>
            <tr>
                <td style="border:1px solid black;padding:8px;"><strong>Fonction</strong></td>
                <td style="border:1px solid black;padding:8px;">'.(isset($_POST['fonction']) ? $_POST['fonction'] : '').'</td>
            </tr>
            <tr>
                <td style="border:1px solid black;padding:8px;"><strong>Email</strong></td>
                <td style="border:1px solid black;padding:8px;">'.(isset($_POST['email']) ? $_POST['email'] : '').'</td>
            </tr>
            <tr>
                <td style="border:1px solid black;padding:8px;"><strong>Téléphone</strong></td>
                <td style="border:1px solid black;padding:8px;">'.(isset($_POST['telephone']) ? $_POST['telephone'] : '').'</td>
            </tr>
            <tr>
                <td style="border:1px solid black;padding:8px;"><strong>Objet</strong></td>
                <td style="border:1px solid black;padding:8px;">'.(isset($_POST['objet']) ? $_POST['objet'] : '').'</td>
            </tr>
            <tr>
                <td style="border:1px solid black;padding:8px;"><strong>Message</strong></td>
                <td style="border:1px solid black;padding:8px;">'.(isset($_POST['message']) ? $_POST['message'] : '').'</td>
            </tr>
        </table>';

        $mail->AltBody = 'Établissement: '.(isset($_POST['etablissement']) ? $_POST['etablissement'] : '').' | Ville: '.(isset($_POST['ville']) ? $_POST['ville'] : '').' | Cycles: '.(isset($_POST['cycles']) ? $_POST['cycles'] : '').' | Nombre d\'élève: '.(isset($_POST['nombre_eleve']) ? $_POST['nombre_eleve'] : '').' | Nom: '.(isset($_POST['nom']) ? $_POST['nom'] : '').' | Fonction: '.(isset($_POST['fonction']) ? $_POST['fonction'] : '').' | Email: '.(isset($_POST['email']) ? $_POST['email'] : '').' | Téléphone: '.(isset($_POST['telephone']) ? $_POST['telephone'] : '').' | Objet: '.(isset($_POST['objet']) ? $_POST['objet'] : '').' | Message: '.(isset($_POST['message']) ? $_POST['message'] : '');

        if($mail->send()) {
            // Save to JSON file only if email sent successfully
            $data = [
                'etablissement' => isset($_POST['etablissement']) ? $_POST['etablissement'] : '',
                'ville' => isset($_POST['ville']) ? $_POST['ville'] : '',
                'cycles' => isset($_POST['cycles']) ? $_POST['cycles'] : '',
                'nombre_eleve' => isset($_POST['nombre_eleve']) ? $_POST['nombre_eleve'] : '',
                'nom' => isset($_POST['nom']) ? $_POST['nom'] : '',
                'fonction' => isset($_POST['fonction']) ? $_POST['fonction'] : '',
                'email' => isset($_POST['email']) ? $_POST['email'] : '',
                'telephone' => isset($_POST['telephone']) ? $_POST['telephone'] : '',
                'objet' => isset($_POST['objet']) ? $_POST['objet'] : '',
                'message' => isset($_POST['message']) ? $_POST['message'] : '',
                'date' => date('Y-m-d H:i:s')
            ];
            $fp = fopen('contacts.json', 'a');
            fwrite($fp, json_encode($data)."\n");
            fclose($fp);
            
            echo json_encode(['status' => 'success', 'message' => 'Email sent successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to send email: ' . $mail->ErrorInfo]);
        }
        break;

        default: 
            echo json_encode(['status' => 'error', 'message' => 'Invalid operation']);
            break;

    }
    
    
} 


catch (Exception $e) {

    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

} ?>



