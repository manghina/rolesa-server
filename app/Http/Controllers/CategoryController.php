<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Storage;
use App\Mail\Mailer;
use Illuminate\Support\Facades\Mail;
class CategoryController extends Controller
{

    public function send()
    {
        $data = [
           'subject' => 'Registrazione',
           'to' => 'manghina.dario@gmail.com',
           'view' => 'mail.test-email',
           'name' => 'TRE'
        ];
        Mail::to($data['to'])->send(new Mailer($data));

        return response()->json([
            'data' =>"test"
        ], 200);
    }


}
