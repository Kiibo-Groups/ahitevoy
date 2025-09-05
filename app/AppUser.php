<?php

namespace App;


use App\Http\Controllers\OpenpayController;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;
use Illuminate\Support\Facades\Mail;
class AppUser extends Authenticatable
{
    protected $table = 'app_user';

    public function addNew($data)
    {
        $count = AppUser::where('email', $data['email'])->count();

        if ($count == 0) {
            if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                try {
                    $add = new AppUser;
                    $add->name = $data['name'];
                    $add->email = $data['email'];
                    $add->phone = isset($data['phone']) ? $data['phone'] : 'null';
                    $add->password = $data['password'];
                    $add->pswfacebook = isset($data['pswfb']) ? $data['pswfb'] : 0;
                    $add->refered = isset($data['refered']) ? $data['refered'] : '';
                    $add->save();

                    return ['msg' => 'done', 'user_id' => $add->id];
                } catch (\Throwable $th) {
                    return ['msg' => $th, 'error' => $th];
                }
            } else {
                return ['msg' => 'Opps! El Formato del Email es invalido'];
            }
        } else {
            return ['msg' => 'Opps! Este correo electrónico ya existe.'];
        }
    }

    public function signupOP($data)
    {
        $openPay = new OpenpayController;
        $addclientOP = $openPay->addClient($data);

        $user = AppUser::find($data['id']);
        $user->customer_id = $addclientOP['data']['id'];
        $user->save();

        return ['msg' => 'done', 'data' => $addclientOP];
    }

    public function chkUser($data)
    {

        if (isset($data['user_id']) && $data['user_id'] != 'null') {
            // Intentamos con el id
            $res = AppUser::find($data['user_id']);

            if (isset($res->id)) {
                /**
                 * Hasta este punto el usuario ya tiene una sesion iniciada, ya comprobo el numero telefonico
                 * y esta intentando registrarlo
                 * Comprobamos que el numero telefonico que intenta agregar no exista con otra cuenta
                 * en caso contrario se le pedira un nuevo numero telefonico
                 */

                $req = AppUser::where('phone', $data['phone'])->first();
                if ($req) {
                    // El numero telefonico existe con otra cuenta
                    return ['msg' => 'phone_exist'];
                } else {
                    // Si el numero telefonico no existe lo Registramos
                    $res->phone = $data['phone'];
                    $res->save();
                    return ['msg' => 'user_exist', 'user_id' => $res->id];
                }

            } else {
                return ['msg' => 'not_exist'];
            }
        } else {
            /**
             * Hasta este punto el usuario ya se registro previamente
             * ingreso un numero telefonico y lo comprobo con codigo SMS
             * verificamos si el numero de telefono existe
             */

            $res = AppUser::where('phone', $data['phone'])->first();
            if ($res) {
                return ['msg' => 'user_exist', 'user_id' => $res->id];
            } else {
                return ['msg' => 'not_exist'];
            }
        }
    }

    public function SignPhone($data)
    {
        $res = AppUser::where('id', $data['user_id'])->first();

        if ($res->id) {
            $res->phone = $data['phone'];
            $res->save();

            $return = ['msg' => 'done', 'user_id' => $res->id];
        } else {
            $return = ['msg' => 'error', 'error' => '¡Lo siento! Algo salió mal.'];
        }

        return $return;
    }

    public function login($data)
    {
        $chk = AppUser::where('email', $data['email'])->where('password', $data['password'])->first();

        if (isset($chk->id)) {
            return ['msg' => 'done', 'user_id' => $chk->id];
        } else {
            return ['msg' => 'Opps! Detalles de acceso incorrectos'];
        }
    }

    public function Newlogin($data)
    {
        $chk = AppUser::where('phone', $data['phone'])->first();

        if (isset($chk->id)) {
            return ['msg' => 'done', 'user_id' => $chk->id];
        } else {
            return ['msg' => 'Opps! El usuario no existe...'];
        }
    }

    public function loginfb($data)
    {
        $chk = AppUser::where('email', $data['email'])->first();

        if (isset($chk->id)) {
            if ($chk->password == $data['password']) {
                // Esta logeado con facebook
                return ['msg' => 'done', 'user_id' => $chk->id];
            } else {
                // Esta logeado normal pero si existe se registra el FB - ID
                $chk->pswfacebook = $data['password'];
                $chk->save();
                // Registramos
                return ['msg' => 'done', 'user_id' => $chk->id];
            }
        } else {
            return ['msg' => 'Opps! Detalles de acceso incorrectos'];
        }
    }

    public function updateInfo($data, $id)
    {
        $count = AppUser::where('id', '!=', $id)->where('email', $data['email'])->count();

        if ($count == 0) {
            $add = AppUser::find($id);
            $add->name = $data['name'];
            $add->email = $data['email'];
            $add->phone = $data['phone'];

            if (isset($data['password'])) {
                $add->password = $data['password'];
            }

            $add->save();

            return ['msg' => 'done', 'user_id' => $add->id, 'data' => $add];
        } else {
            return ['msg' => 'Opps! Este correo electrónico ya existe.'];
        }
    }

    public function forgot($data)
    {
        \Log::info('Iniciando forgot password para: ' . $data['email']);
        try {
            $res = AppUser::where('email', $data['email'])->first();

            if (!isset($res->id)) {
                return [
                    'msg' => 'error',
                    'error' => '¡Lo siento! Este correo electrónico no está registrado con nosotros.'
                ];
            }

            $otp = rand(1111, 9999);
            $res->otp = $otp;
            $res->save();

            Mail::raw("Tu código de verificación es: " . $otp, function ($message) use ($res) {
                $message->from("soporte.desarrollosqv@gmail.com", "AhiTeVoy")
                        ->to($res->email, $res->name)
                        ->subject('Código de acceso - AhiTeVoy');
            });

            return ['msg' => 'done', 'user_id' => $res->id];

        } catch (\Exception $e) {
            \Log::error('Error en forgot password: ' . $e->getMessage());
            return [
                'msg' => 'error',
                'error' => 'Error al enviar el correo. Por favor contacta al administrador.',
                'eq' => $e->getMessage()
            ];
        }

        // $res = AppUser::where('email',$data['email'])->first();

        // if(isset($res->id))
        // {
        //     $otp = rand(1111,9999);
        //     $send = Mail::send(
        //         'emails.forgot', 
        //         array(
        //             'user' => $res,
        //             'otp' => $otp
        //         ), 
        //         function($message) use ($res) {
        //             $message->from("soporte@ahitevoy.com", "AhiTeVoy")
        //                 ->to($res->email, $res->name)
        //                 ->subject('Código de acceso - AhiTeVoy');
        //         }
        //     );

        //     $return = ['msg' => 'done','user_id' => $res->id , 'send' => $send];
        //     // $res->otp = $otp;
        //     // $res->save();

        //     // $para       =   $data['email'];
        //     // $asunto     =   'Codigo de acceso - AhiTeVoy';
        //     // $mensaje    =   "Hola ".$res->name." Un gusto saludarte, se ha pedido un codigo de recuperacion para acceder a tu cuenta en AhiTeVoy";
        //     // $mensaje    .=  ' '.'<br>';
        //     // $mensaje    .=  "Tu codigo es: <br />";
        //     // $mensaje    .=  '# '.$otp;
        //     // $mensaje    .=  "<br /><hr />Recuerda, si no lo has solicitado tu has caso omiso a este mensaje y te recomendamos hacer un cambio en tu contrasena.";
        //     // $mensaje    .=  "<br/ ><br /><br /> Te saluda el equipo de AhiTeVoy";

        //     // $cabeceras = 'From: ahitevoyaltamira@gmail.com' . "\r\n";

        //     // $cabeceras .= 'MIME-Version: 1.0' . "\r\n";

        //     // $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        //     // mail($para, $asunto, utf8_encode($mensaje), $cabeceras);


        // }
        // else
        // {
        //     $return = ['msg' => 'error','error' => '¡Lo siento! Este correo electrónico no está registrado con nosotros.'];
        // }

        // return $return;
    }

    public function verify($data)
    {
        $res = AppUser::where('id', $data['user_id'])->where('otp', $data['otp'])->first();

        if (isset($res->id)) {
            $return = ['msg' => 'done', 'user_id' => $res->id];
        } else {
            $return = ['msg' => 'error', 'error' => '¡Lo siento! OTP no coincide.'];
        }

        return $return;
    }

    public function updatePassword($data)
    {
        $res = AppUser::where('id', $data['user_id'])->first();

        if (isset($res->id)) {
            $res->password = $data['password'];
            $res->save();

            $return = ['msg' => 'done', 'user_id' => $res->id];
        } else {
            $return = ['msg' => 'error', 'error' => '¡Lo siento! Algo salió mal.'];
        }

        return $return;
    }

    public function countOrder($id)
    {
        return Order::where('user_id', $id)->where('status', '>', 0)->count();
    }

    /*
   |--------------------------------------
   |Get all data from db
   |--------------------------------------
   */
    public function getAll($store = 0)
    {
        return AppUser::get();
    }

    /*
    |--------------------------------------
    |Get Report
    |--------------------------------------
    */
    public function getReport($data)
    {
        $res = AppUser::where(function ($query) use ($data) {

            if ($data['user_id']) {
                $query->where('app_user.id', $data['user_id']);
            }

        })->select('app_user.*')
            ->orderBy('app_user.id', 'ASC')->get();

        $allData = [];

        foreach ($res as $row) {

            // Obtenemos el comercio
            $store = User::find($row->ord_store_id);

            $allData[] = [
                'id' => $row->id,
                'status' => $row->status,
                'name' => $row->name,
                'email' => $row->email,
                'Telefono' => $row->phone,
                'refered' => $row->refered
            ];
        }

        return $allData;
    }
}
