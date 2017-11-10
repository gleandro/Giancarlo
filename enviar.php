<?php include("inc.aplication_top.php");
require("aplication/utilities/phpmailer/class.phpmailer.php");
require("aplication/utilities/phpmailer/class.smtp.php");



 $mens='<p><span style="font-size:18px;"><b>Nueva consulta:</b></p><br />
    <table width="490" border="0">
      <tr>
        <td width="135"><b>Nombre:</b></td>
        <td width="339">'.$_GET["nombre"].'</td>
      </tr>
        <td><b>Telefono:</b></td>
        <td>'.$_GET["telefono"].'</td>
      </tr>
      <tr>
        <td><b>Email:</b></td>
        <td>'.$_GET["email"].'</td>
      </tr>
      <tr>
        <td><b>Comentarios:</b></td>
        <td>'.$_GET["comentario"].'</td>
      </tr>
    </table>
    <p>&nbsp;</p>';

    //$headers .= "Content-type: text/html; charset=UTF-8\n";
    //$headers .= "from: DAYMA S.A.C. <".$email_array[$i].">";

/*for ($i = 0; $i < count($email_array); $i++) {
    $mail = mail($email_array[$i], 'DAYMA S.A.C. : Nueva consulta', $mens, $headers);
}*/

$mail = new PHPMailer();

$mail->IsSMTP();  // telling the class to use SMTP
$mail->Host     = "mail.dayma.com.pe"; // SMTP server mail.develoweb.net
$mail->Port 	= 25;
$mail->CharSet	= "UTF-8";
$mail->From     = 'info@dayma.com.pe';
$mail->FromName = "DAYMA S.A.C.";
$mail->Subject = "Contacto - DAYMA S.A.C.";
//$mail->AddReplyTo('chita@chitafilms.com', 'Novedades Chitafilms');

$email = EMAIL_CONTACTENOS;
$email_array = explode(",", $email);

for($i=0;$i<count($email_array);$i++){
        $mail->AddAddress($email_array[$i]);
}
//$mail->AddAddress('fer@chitafilms.com');

//$mail->Username = "develowe";  // SMTP username
//$mail->Password = '5(e*H?!NozQG'; // SMTP password
$mail->Username = "info@dayma.com.pe";
$mail->Password = 'SVagyewTI450';
$mail->SMTPAuth = true;
$mail->IsHTML(true);
$mail->Body =$mens;


if(!$mail->Send()){
    echo "0 : ERROR:".$mail->ErrorInfo;//Error
}  else {
    echo "1";//Correcto
}



/*$clientes = new SimpleXMLElement('dwlista.xml', null, true);
$not = $clientes->addChild('cliente');
foreach($_POST as $i=>$u)
	$not->addChild($i, $u);
$clientes->asXML('dwlista.xml');  */




?>
