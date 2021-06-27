<?php
namespace App\Services;

use Mailjet\Client;
use App\Entity\User;
use Mailjet\Resources;
use App\Entity\EmailModel;

class EmailSender{


    public function sendEmailNotificationByMailJet(User $user, EmailModel $email){
        $mj = new Client($_ENV["MJ_APIKEY_PUBLIC"], $_ENV["MJ_APIKEY_PRIVATE"],true,['version' => 'v3.1']);

        $body = [
            'Messages' => [
            [
                'From' => [
                'Email' => "aliexprasshopping@gmail.com",
                'Name' => "AliExprass Contact"
                ],
                'To' => [
                [
                    'Email' => $user->getEmail(),
                    'Name' => $user->getFullName()
                ]
                ],
                'TemplateID' => 2339202,
                'TemplateLanguage' => true,
                'Subject' => $email->getSubject(),
                'Variables' => [
                    'title' => $email->getTitle(),
                    'content' => $email->getContent()
                ]
            ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
       // $response->success() && dd($response->getData());
    }


}