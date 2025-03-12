<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Twilio\Rest\Client;
use App\Admin;
use App\Language;
class NodejsServer extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 
     * Integracion de Pedidos y Seguimiento 
     * 
    */
    
    function newOrder($data)
    {
        return $this->CurlGet($data,"https://us-central1-ahitevoy-app.cloudfunctions.net/app/api/newOrder/");
    }

    function orderStatus($data)
    {
        return $this->CurlGet($data,"https://us-central1-ahitevoy-app.cloudfunctions.net/app/api/orderStatus/");
    }
    
    function setStaffDelivery($data)
    {
        return $this->CurlGet($data,"https://us-central1-ahitevoy-app.cloudfunctions.net/app/api/setStaffDelivery/");
    }

    /**
     * 
     * Integracion de agregado de repartidores 
     * 
    */
    function newStaffDelivery($data)
    {
        return $this->CurlGet($data,"https://us-central1-ahitevoy-app.cloudfunctions.net/app/api/newStaff/");
    }

    function updateStaffDelivery($data)
    {
        return $this->CurlGet($data,"https://us-central1-ahitevoy-app.cloudfunctions.net/app/api/updateStaff/");
    }

    /**
     * 
     * Integracion de mandaditos 
     * 
    */

    // Realizamos la peticion de nuevo mandadito
    function NewOrderComm($data)
    {
        $fields = array(
            'id_order' => isset($data['id_order']) ? $data['id_order'] : ''
        );
    
        return $this->CurlGet($fields,"https://us-central1-ahitevoy-app.cloudfunctions.net/app/api/newOrderComm/");
    }

    // Cron para termino del pedido
    function notifyClient($data)
    {
        $fields = array(
            'id_order' => isset($data['order_id']) ? $data['order_id'] : 0
        );
        
        return $this->CurlGet($fields,"https://us-central1-ahitevoy-app.cloudfunctions.net/app/api/InitCronOrder/");
    }

      // Get Biometrics
      function getBiometrics($data)
      { 
         try {
            $arrContextOptions=array(
                "ssl"=>array(
                    "verify_peer"=>false,
                    "verify_peer_name"=>false,
                ),
            );  
            

            $fields = array(
                'gallery'   =>  [
                   base64_encode(file_get_contents($data['OriginPic']))
                ],
                'probe'     => [
                    base64_encode($data['BiometricPic'])
                ],
                "search_mode" => "FAST"
            );
    
            $fields = json_encode($fields);
    
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://us.opencv.fr/compare');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            $headers = array();
            $headers[] = 'Accept: application/json';
            $headers[] = 'X-Api-Key: elDorzxMDRlNzk1YTUtODFlZi00MTY4LWE4MDctZGE5YzYyYmQ2ODdh';
            $headers[] = 'Content-Type: application/json';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);
     
            $biometrics = json_decode($result, true);
            $msg = 'Sin coincidencias';
            $status = false;
            
            if (isset($biometrics['score'])) {
                if ($biometrics['score'] == 1.0) {
                    $msg = "Reconocimiento biometrico exitoso";
                    $status = true;
                }else {
        
                    if ($biometrics['score'] >= 0.7) { // 
                        $msg = "Reconocimiento biometrico exitoso";
                        $status = true;
                    }
                }
            }else {
                $msg = $biometrics;
                $status = false;
            }
    
            return [
                'status' => $status,
                'msg' => $msg
            ];
         } catch (\Exception $th) {
            return [
                'status' => false,
                'msg' => $th->getMessage(),
                "data" => $data
            ];
         }
      }
    
    
    /**
     * Realizamos la peticion
     */
    function CurlGet($fields,$url)
    {
        $fields = json_encode($fields);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        $req = json_decode($response,true);

        return $req;
    }
}
