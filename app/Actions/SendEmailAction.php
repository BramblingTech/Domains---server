<?php
namespace App\Actions;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class SendEmailAction {
    public function handle()
    {
        $user_params = input()->all(['user_email']);
        $user_email = $user_params['user_email'][0];

        $form_params = input()->all(['form_type']);
        $form_type = $form_params['form_type'][0];

        if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            response()->httpCode(400);
            $data = [
                'success' => false,
                'error' => "Invalid email format"
            ];
            return json_encode($data);
        }

        if ($form_type == '') {
            response()->httpCode(400);
            $data = [
                'success' => false,
                'error' => "specify form_type[]"
            ];
            return json_encode($data);
        }

        $domain = env('SMTP_DOMAIN');

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
//            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                    //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = env('SMTP_HOST');                       //Set the SMTP server to send through
            $mail->SMTPAuth = true;                                     //Enable SMTP authentication
            $mail->Username = env('SMTP_Username');               //SMTP username
            $mail->Password = env('SMTP_Password');               //SMTP password
            $mail->Port = env('SMTP_PORT');                       //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->setFrom($user_email, 'Name');
            $mail->addAddress(env('SMTP_Recipient'));

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $domain.' '.$form_type;
            $mail->Body = 'E-mail from: '.$user_email.' <br>Was received from the form: '.$form_type;

            $mail->send();

            $data = [
                'success' => true,
                'msg' => "Message has been sent to admin"
            ];
            return json_encode($data);
        } catch (Exception $e) {
            response()->httpCode(400);
            $data = [
                'success' => false,
                'msg' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"
            ];
            return json_encode($data);
        }

    }
}