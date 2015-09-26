<?php 

    if($_POST){

            require_once 'vars.php';
            $subject ="Форма получить бесплатно. 1 экран";
            $email_subject = "Тема письма";
            $email_text = "После заполнения формы, автоматически на почту человека (которую он ввел) высылаются файлы (не архивом!). Текст письма будет готов позже, поэтому можно пока, что-нибудь временное написать для примера";

            $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
            $city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
            if (($name != "")  or ($phone != "") or ($email != "") or ($city != "")){
                
                $name = stripslashes($name);
                $name = html_entity_decode($name);
                $name = strip_tags($name);
                
                $phone = stripslashes($phone);
                $phone = html_entity_decode($phone);
                $phone = strip_tags($phone);
                
                $email = stripslashes($email);
                $email = html_entity_decode($email);
                $email = strip_tags($email);
                
                $city = stripslashes($city);
                $city = html_entity_decode($city);
                $city = strip_tags($city);
            
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
            $mail->Subject = "Получить расчет стоимости";
            $mail->WordWrap = 50; 
            $mail->AddAddress($email_to_1);
            $mail->AddAddress($email_to_2);
            $mail->IsHTML(true);                                  
            $mail->Body    = "Имя: $name<br />Телефон: $phone<br />Email: $email<br />Город: $city<br />";
            
            if ($mail->Send()) {
                sleep(5);
                
                $mail->ClearAllRecipients(); 
                $mail->ClearReplyTos();
                $mail->ClearCustomHeaders();
                
                $mail->From = $from;
                $mail->FromName = $from;    
                $mail->AddAddress($email);
                $mail->Subject = $email_subject;
                $mail->IsHTML(true);          
                $mail->addAttachment("/dist/files/proekt.jpg", "proekt.jpg");
                $mail->addAttachment("/dist/files/model.jpg", "model.jpg");
                $mail->addAttachment("/dist/files/visual.jpg", "visual.jpg");
                $mail->addAttachment("/dist/files/history.pdf", "history.pdf");
                $mail->addAttachment("/dist/files/instrukcia.pdf", "instrukcia.pdf");
                $mail->addAttachment("/dist/files/price.pdf", "price.pdf");
                $mail->addAttachment("/dist/files/stoimost.pdf", "stoimost.pdf");
                $mail->Body    = "<h2>$email_text</h2>";
                
                if ($mail->Send()) {
                   header("Location: /спасибо.php");
                }else{
                    echo $mail->ErrorInfo;
                }
            }else{
                echo $mail->ErrorInfo;
            }
        
                
                
        }else{
            echo '<h4 style="text-align:center">Ошибка. Попробуйте еще раз</h4>';
            echo "<center><input name='back' type='button' value='Вернуться' onclick= 'javascript:history.back()'></center>";
        }
        
    }

?>