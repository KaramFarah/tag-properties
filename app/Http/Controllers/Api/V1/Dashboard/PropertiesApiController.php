<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use Gate;
use Illuminate\Http\Request;
use App\Models\Dashboard\Tag;
use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\PropertiesResource;
use App\Http\Resources\Dashboard\UserResource;
use Symfony\Component\HttpFoundation\Response;


class PropertiesApiController extends Controller
{
    public function sendEmails(){

        // subject     name    phone   email   message
        $body = 'You received new message from your website contact form' . "\n";

        $body .= '=======================================================' . "\n";
    
        $body .= '- Sender: ' . trim(request()->mailer['name']) . "\n";
    
                    $body .= '- Sender Phone: ' . trim(request()->mailer['phone']) . "\n";

                    $body .= '- Sender Email: ' . trim(request()->mailer['email']) . "\n";
    
                    $body .= '- Message: ' . "\n" . strip_tags(trim(request()->mailer['message']), '<a><p><br>') . "\n";
        
        $receiving_email_address = 'TagProperties.reciver@gmail.com';
        $subject = 'New Customer (' . request()->mailer['name'] . ') Is Intersted in A Property';

        if(mail($receiving_email_address, $subject, $body)){
            return 
            response()->setStatusCode(Response::HTTP_ACCEPTED);
        }else{
            return response()->setStatusCode(Response::HTTP_NO_CONTENT);
        }
    }
}
