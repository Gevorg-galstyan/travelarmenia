<?php

namespace App\Http\Controllers\Admin;

use App\Mail\SendSubscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function subscribers(Request $request)
    {
        try{
        Mail::bcc(['xazaryan.89@mail.ru', 'areg.terxazaryan@gmail.com'])
            ->queue(new SendSubscriber($request->all()));
        return response()->json(['success' => true, 'message' => 'письма подписчикам отправлено ']);
        }catch (\Exception $exception){
            return response()->json('произошло  ошибка сообщение не отправлены попробуете ешь раз ');
        }
    }
}
