<?php 

namespace App\Controllers;

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;


class EmailPessoaController
{

    public function enviaEmail(string $emailDestinatario, string $senha)
    {
        
        $mailer = new PHPMailer();
        $mailer->IsSMTP();
        // $mailer->SMTPDebug = 1;
        $mailer->CharSet = 'UTF-8';
        $mailer->Port = 587; //Indica a porta de conexão para a saída de e-mails. Utilize obrigatoriamente a porta 587.
        
        // $mailer->Host = 'smtp.office365.com';
        $mailer->Host = 'smtp.gmail.com'; //google
        
        //Descomente a linha abaixo caso revenda seja 'Plesk 11.5 Linux'
        $mailer->SMTPSecure = 'tls';
        
        $mailer->SMTPAuth = true; //Define se haverá ou não autenticação no SMTP
        $mailer->Username = 'natanbandeira18@gmail.com'; //Informe o e-mai o completo
        $mailer->Password = 'Natan1223#'; //Senha da caixa postal
        $mailer->FromName = 'Doe Vidas'; //Nome que será exibido para o destinatário
        $mailer->From = 'natanbandeira18@gmail.com'; //Obrigatório ser a mesma caixa postal indicada em "username"
        $mailer->AddAddress($emailDestinatario); //Destinatários
        $mailer->Subject = 'Cadastro no sistema Doe Vidas - '.date("d/m/Y");
        $mailer->Body = '
                        <h2>Doe Vidas</h2>
                        <b>Orientação ao usuario:</b><br>
                        <p><font color="red">Com o aplicativo Doe Vidas voce podera acompanhar seu processo de cadastro, 
                        triagem e doação em um unico lugar, gerando comodidade para você.</font><p>
                        
                        Para acessar o aplicativo e verificar seus status clique no link a seguir: <br>

                        Link: <a href="doevidas.com"> doevidas.com</a><br>

                        Seu usuário de acesso: '.$emailDestinatario.' <br>
                        Sua senha de acesso: '.$senha.'
                        
                        <p>
                        A equipe do site Doe Vidas agradece a sua iniciativa.<br>
                        <b>Contato:</b> (92) 3232-3232 / 3232-3232 <br>
                        <b>E-mail:</b> contato@doevidas.com
                        </p>
            ';
        $mailer->isHTML(true);
        $mailer->Send();

        // if($mailer->Send())
        // {
        //     $response = $response->withJson([
        //                 "message" => 'E-mail encaminhado com sucesso'
        //             ]);
        // }else{
        //     $response = $response->withJson([
        //         "message" => 'E-mail não encaminhado'
        //     ]);

        // }

        // return $response;

    }  
}