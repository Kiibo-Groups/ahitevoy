<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Newsletters;


class HomeController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    /**
     * Summary of services
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function services()
    {
        return view('website/services');
    }
    
    /**
     * Summary of clients
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function clients()
    {
        return view('website/clients');
    }

    /**
     * Summary of contact
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function contact()
    {
        return view('website/contact');
    }


    /**
     * Summary of newsletter
     * @param $request
     * @return void
     */
    public function newsletter(Request $request)
    {
        $data = $request->all();

        $input['email'] = $data['email'];
        $input['status'] = 'verify';
        $input['verify_token'] = md5($data['_token'].now());

        $valid = false;
        $msg = '';

        if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
            $msg = '¡Por favor proporcione una dirección de correo electrónico válida!';    
        }

        if (Newsletters::where('email', $input['email'])->first()) {
            $msg = '¡Este correo electrónico ya se encuentra registrado!';
        }

        if ($msg == '') {
            $valid = true;
            Newsletters::create($input);
            $msg = 'Te enviaremos información relevante cada semana para que no te pierdas ninguna de nuestras promociones y descuentos...';
        }

        return response()->json([
            'status' => $valid,
            'data' => $msg
        ]);
    }
}