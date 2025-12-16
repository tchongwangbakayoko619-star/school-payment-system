<?php

namespace App\Http\Controllers;
use App\Models\students;
use App\Models\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CinetPayController extends Controller
{
    public function markAsPaid($id)
    {
         $student = students::findOrFail($id); // Recherche l'étudiant par ID ou lance une erreur 404 si non trouvé

         $student->paid=true;
         $student->save();
         $classe = Classe::findOrFail($student->class_id);
     
         $classeName =$classe->nom;
    
         return view('cinetpay', compact('student','classeName'));
      
    }
    public function Payment(Request $request)
    {
       $b="907519308681203e8c73a86.94742848";
        
        // 1) Validation simple
        $request->validate([
            'amount'   => 'required|numeric',
            'currency' => 'required|string',
        ]);
    
        // 2) Génération ID
        $transaction_id = 'sdkLaravel-' . now()->format('YmdHis');
    
        // 3) Préparation des données pour CinetPay
        $formData = [
            'api_key'        => $b,
            'site_id'        => 105893659,
            'transaction_id' => $transaction_id,
            'amount'         => $request->input('amount'),
            'currency'       => $request->input('currency'),
            'description'    => 'TEST-Laravel',
            'return_url'     => route('return_url'),
            'notify_url'     => route('notify_url'),
            'metadata'       => 'user001',
            // champs client facultatifs :
            'customer_name'         => '',
            'customer_surname'      => '',
            'customer_email'        => '',
            'customer_phone_number' => '',
            'customer_address'      => '',
            'customer_city'         => '',
            'customer_country'      => '',
            'customer_state'        => '',
            'customer_zip_code'     => '',
        ];
    
        // 4) Appel cURL
        $curl = curl_init('https://api-checkout.cinetpay.com/v2/payment');
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => json_encode($formData),
            CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
            CURLOPT_SSL_VERIFYPEER => false,
        ]);
    
        $response = curl_exec($curl);
        $err      = curl_error($curl);
        curl_close($curl);
    
        // 5) Gestion des erreurs cURL
        if ($err) {
            return back()->withErrors(['msg' => "Erreur cURL : $err"]);
        }
    
        // 6) Décodage JSON et validation
        $body = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return back()->withErrors(['msg' => 'Réponse CinetPay invalide.']);
        }
    
        // 7) Redirection ou affichage d’erreur
        if (isset($body['code']) && $body['code'] === '201') {
            return redirect()->away($body['data']['payment_url']);
        } else {
            $desc = $body['description'] ?? 'Aucune description';
            return back()->withErrors(['msg' => "Une erreur est survenue. Description : $desc"]);
        }
    }
    
    //configuration de l'api la notification
    public function notify_url (Request $request)
    {
        $b="907519308681203e8c73a86.94742848";
      
        /* 1- Recuperation des paramètres postés sur l'url par CinetPay
         * https://docs.cinetpay.com/api/1.0-fr/checkout/notification#les-etapes-pour-configurer-lurl-de-notification
         * */
        if (isset($request->cpm_trans_id))
        {
            // A l'aide de l'identifiant de votre transaction, vérifier que la commande n'a pas encore été traité
            $VerifyStatusCmd = "1"; // valeur du statut à récupérer dans votre base de donnée
            if ($VerifyStatusCmd == '00') {
                // La commande a été déjà traité
                // Arret du script
                die();
            }

           /* 2- Dans le cas contrait, on vérifie l'état de la transaction en cas de tentative de paiement sur CinetPay
            * https://docs.cinetpay.com/api/1.0-fr/checkout/notification#2-verifier-letat-de-la-transaction */
            $cinetpay_check = [
                "apikey" => $b,
                "site_id" => $request->cpm_site_id,
                "transaction_id" => $request->cpm_trans_id
            ];

            $response = $this->getPayStatus($cinetpay_check); // appel fonction de requête pour récupérer le statut

            //On recupère la réponse de CinetPay
            $response_body = json_decode($response,true);
            if($response_body['code'] == '00')
            {
                /* correct, on délivre le service
                 * https://docs.cinetpay.com/api/1.0-fr/checkout/notification#3-delivrer-un-service*/
                echo 'Felicitation, votre paiement a été effectué avec succès';

            }
            else
            {
                // transaction a échoué
                echo 'Echec, code:' . $response_body['code'] . ' Description' . $response_body['description'] . ' Message: ' .$response_body['message'];
            }
            // Mettez à jour la transaction dans votre base de donnée
            /*  $commande->update(); */
        }
        else{
            print("cpm_trans_id non fourni");
        }
    }

    //configuration de l'api de retour
    public function return_url (Request $request)
    {
        $b="907519308681203e8c73a86.94742848";
        dd($b);
        /* 1- recuperation des données postées par CinetPay
         * https://docs.cinetpay.com/api/1.0-fr/checkout/retour#les-etapes-pour-configurer-lurl-de-retour */
        if (isset($request->transaction_id) || isset($request->token))
        {
            /* 2- on vérifie l'état de la transaction sur CinetPay ou dans notre base de donnée
            * https://docs.cinetpay.com/api/1.0-fr/checkout/notification#2-verifier-letat-de-la-transaction */
            $cinetpay_check = [
                "apikey" => $b,
                "site_id" => env("CINETPAY_SITE_ID"),
                "transaction_id" => $request->transaction_id
            ];
            // appel fonction de requête pour récupérer le statut chez CinetPay
            $response = $this->getPayStatus($cinetpay_check);
            //On recupère la réponse de CinetPay
            $response_body = json_decode($response,true);
            if($response_body['code'] == '00')
            {
                /* correct, on redirige le client vers la page souhaité */
                return back()->with('info', 'Felicitation, votre paiement a été effectué avec succès');
            }
            else
            {
                /* correct, on redirige le client vers la page souhaité */
                return back()->with('info', 'Echec, votre paiement a échoué');
            }
        }
        else{
            print("transaction non fourni");
        }
    }

    public function getPayStatus($data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-checkout.cinetpay.com/v2/payment/check',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 45,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTPHEADER => array(
                "content-type:application/json"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err)
         print ($err);
        else
        return ($response);
    }
}