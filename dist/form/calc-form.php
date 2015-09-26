<?php 

    if($_POST){

            require_once 'vars.php';
            $subject ="Форма получить расчет стоимости";

            $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
            $city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);

            $len = filter_var($_POST['len'], FILTER_SANITIZE_STRING);
            $wid = filter_var($_POST['wid'], FILTER_SANITIZE_STRING);
            $fls = filter_var($_POST['fls'], FILTER_SANITIZE_STRING);
            $hfls = filter_var($_POST['hfls'], FILTER_SANITIZE_STRING);
            $winds = filter_var($_POST['winds'], FILTER_SANITIZE_STRING);
            $drs = filter_var($_POST['drs'], FILTER_SANITIZE_STRING);
            $roof = filter_var($_POST['roof'], FILTER_SANITIZE_STRING);

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
            $mail->Body= "Имя: $name<br />Телефон: $phone<br />Email: $email<br />Город: $city<br />Длина дома: $len<br />Ширина дома: $wid<br />К-во этажей: $fls
                            <br />Высота этажа: $hfls<br />К-во окон: $winds<br />К-во дверей: $drs<br />К-во скатов крыши: $roof<br />";
            
            if ($mail->Send()) {
                   header("Location: /спасибо.php");
            }else{
                echo $mail->ErrorInfo;
            }
        
        }else{
            echo '<h4 style="text-align:center">Ошибка. Попробуйте еще раз</h4>';
            echo "<center><input name='back' type='button' value='Вернуться' onclick= 'javascript:history.back()'></center>";
        }
        
    }

?>