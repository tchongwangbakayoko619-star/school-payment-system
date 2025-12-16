<?php
namespace App\Services;
use Illuminate\Support\Facades\Http;

class CinetpayService
{
    protected $site_id;
    protected $apikey;
    protected $verifySsl;

    public function __construct($site_id, $apikey, $verifySsl = true)
    {
        $this->site_id = $site_id;
        $this->apikey = $apikey;
        $this->verifySsl = $verifySsl;
    }

    public function generatePaymentLink(array $data)
    {
        $url = "https://api-checkout.cinetpay.com/v2/payment";

        $response = Http::withoutVerifying()
            ->withHeaders(['Content-Type' => 'application/json'])
            ->post($url, array_merge($data, [
                'apikey' => $this->apikey,
                'site_id' => $this->site_id,
            ]));

        return $response->json();
    }
}
