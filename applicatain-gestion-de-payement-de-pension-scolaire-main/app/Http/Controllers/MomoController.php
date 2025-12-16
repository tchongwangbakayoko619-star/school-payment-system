<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class MomoController extends Controller
{
    protected $client;
    protected $baseUrl;
    protected $primaryKey;
    protected $userId;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = env('MOMO_BASE_URL');
        $this->primaryKey = env('MOMO_PRIMARY_KEY');
        $this->userId = env('MOMO_API_USER_ID');
        $this->apiKey = env('MOMO_API_KEY');
    }

    // Générer un token d'accès
    public function getAccessToken()
    {
        $response = $this->client->post("{$this->baseUrl}/collection/token/", [
            'headers' => [
                'Ocp-Apim-Subscription-Key' => $this->primaryKey,
                'Authorization' => 'Basic ' . base64_encode("{$this->userId}:{$this->apiKey}"),
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['access_token'];
    }

    // Demander un paiement
    public function requestPayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'currency' => 'required|string',
            'payerNumber' => 'required|string',
            'externalId' => 'required|string',
            'payerMessage' => 'nullable|string',
            'payeeNote' => 'nullable|string',
        ]);

        $accessToken = $this->getAccessToken();

        $response = $this->client->post("{$this->baseUrl}/collection/v1_0/requesttopay", [
            'headers' => [
                'Authorization' => "Bearer {$accessToken}",
                'X-Reference-Id' => $request->externalId,
                'X-Target-Environment' => env('MOMO_ENV'),
                'Ocp-Apim-Subscription-Key' => $this->primaryKey,
            ],
            'json' => [
                'amount' => $request->amount,
                'currency' => $request->currency,
                'externalId' => $request->externalId,
                'payer' => [
                    'partyIdType' => 'MSISDN',
                    'partyId' => $request->payerNumber,
                ],
                'payerMessage' => $request->payerMessage,
                'payeeNote' => $request->payeeNote,
            ],
        ]);

        return response()->json(json_decode($response->getBody(), true));
    }

    // Gérer les callbacks
    public function handleCallback(Request $request)
    {
        // Traitez les données de la notification ici
        $data = $request->all();
        // Enregistrez ou traitez les données selon vos besoins
        return response()->json(['status' => 'success']);
    }
}