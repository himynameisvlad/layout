<?php
    	if($_POST){
            
            require_once 'vars.php';
            $subject = filter_var($_POST['type'], FILTER_SANITIZE_STRING);;
            $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
            
            if ($phone != ""){

                
                $phone = stripslashes($phone);
                $phone = html_entity_decode($phone);
                $phone = strip_tags($phone);

            
            require_once '/dist/mailer/PHPMailerAutoload.php';
            $mail = new PHPMailer;
            
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "ssl";
            $mail->Port = 465;
            $mail->Charset = "UTF-8";
            $mail->SMTPDebug = 0;
    
            $mail->Username = $from;  // SMTP usr
            $mail->Password = $pass;    // SMTP pass
            $mail->SMTPKeepAlive = true;   
            $mail->From = $from; 
            $mail->FromName = "Форма";  
            $mail->Subject = $subject;
            $mail->WordWrap = 50; 
            $mail->AddAddress($email_to_1);
            $mail->AddAddress($email_to_2);
            $mail->IsHTML(true);                                  
            $mail->Body    = "Телефон: $phone<br />";
            
            if ($mail->Send()) {

                 header("Location: /спасибо__.php");

            }else{
                echo $mail->ErrorInfo;
            }
                
                
        }else{
            echo '<h4 style="text-align:center">Ошибка. Попробуйте еще раз</h4>';
            echo "<center><input name='back' type='button' value='Вернуться' onclick= 'javascript:history.back()'></center>";
        }
        
    }
	    


?>