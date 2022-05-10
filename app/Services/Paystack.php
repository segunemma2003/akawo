<?php
namespace App\Services;
use Illuminate\Support\Facades\Http;

use Log;
class Paystack{


    public function verification($reference)
    {
        $response = Http::withHeaders([
            'Authorization'=> 'Bearer '. env('PAYSTACK_SECRET')
        ])->get('https://api.paystack.co/transaction/verify/'. $reference);
        if($response->status() == 200){
            $jsonData = $response->json();
            $data = [
                "authorization_code"=>$jsonData["data"]["authorization"]["authorization_code"],
                "last4"=> $jsonData["data"]["authorization"]["last4"],
                "signature"=> $jsonData["data"]["authorization"]["signature"]
            ];
        \Log::info($jsonData);
        return [
            "status"=>true,
            "data"=>$data
        ];
        }
        return [
            "status"=>false
        ];



    }

    public function transfer_initiate($recipient, $amount)
    {
        $response = Http::withHeaders([
            'Authorization'=> 'Bearer '. env('PAYSTACK_SECRET')
        ])->post('https://api.paystack.co/transfer',[
            "source"=> "balance",
            "amount"=> intval($amount)*100,
            "recipient"=> $recipient,
            "reason"=> "Self initiated"
        ]);
        \Log::info($response);

        if($response->status() == 200){
            $jsonData = $response->json();

                $data = [
                    "transfer_code"=> $jsonData['data']['recipient_code'],
                    "reference"=> $jsonData['data']['details']['bank_name']
                ];


                return [
                    "status"=>true,
                    "data"=>$data
                ];
                }
                return [
                    "status"=>false
                ];

    }

    public function transfer_authorization($authorization_code, $email, $account_name)
    {
        $response = Http::withHeaders([
            'Authorization'=> 'Bearer '. env('PAYSTACK_SECRET')
        ])->post('https://api.paystack.co/transferrecipient',[
            "authorization_code"=>$authorization_code,
            "email" => $email,
            "name"=>$account_name,
            "type"=>"authorization"
        ]);
        \Log::info($response->status());
        if($response->status() == 201){
            $jsonData = $response->json();

                $data = [
                    "recipient_code"=> $jsonData['data']['recipient_code'],
                    "bank_name"=> $jsonData['data']['details']['bank_name'],
                    "bank_code"=> $jsonData['data']['details']['bank_code'],
                    "account_name"=>$jsonData['data']['details']['account_name'],
                    "account_number"=>$jsonData['data']['details']['account_number']
                ];

                return [
                    "status"=>true,
                    "data"=>$data
                ];
                }
                return [
                    "status"=>false
                ];

    }

    public function charge($amount,$authorization_code, $email)
    {
        $response = Http::withHeaders([
            'Authorization'=> 'Bearer '. env('PAYSTACK_SECRET')
        ])->post('https://api.paystack.co/transaction/charge_authorization',[
            "authorization_code"=>$authorization_code,
            "email" => $email,
            "amount"=>intval($amount)*100
        ]);
        \Log::info($response);
        if($response->status() == 200){
            $jsonData = $response->json();
            if($jsonData['data']['gateway_response'] == "Approved"){
                $data = [
                    "reference"=> $jsonData['data']['reference'],
                    "authorization_code"=>$jsonData["data"]["authorization"]["authorization_code"],
                    "signature"=> $jsonData["data"]["authorization"]["signature"]
                ];
            }

            return [
                "status"=>true,
                "data"=>$data
            ];

        }else{
            return [
                "status"=>false
            ];
        }
    }
}


