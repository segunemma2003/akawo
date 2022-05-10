<?php

namespace App\Http\Controllers;

use App\Http\Requests\CardRequest;
use App\Models\Card;
use App\Services\Paystack;

class CardController extends Controller
{


    public function index()
    {
        $cards = Card::where('user_id', auth()->user()->id)->latest()->get();

        return response(['data' => $cards ], 200);
    }

    public function store(CardRequest $request)
    {
        $data = $request->all();
        $data['user_id']= auth()->user()->id;
        $reference =$data['reference'];
        $res = $this->paystack->verification($reference);
        if($res['status'] == false){
            return response(['data' => "unable to validate"],408);
        }
        $data['authorization_code'] = $res['data']['authorization_code'];
        $data['last4'] = $res['data']['last4'];
        $data['signature'] = $res['data']['signature'];
        $trans_auth = $this->paystack->transfer_authorization($data['authorization_code'],auth()->user()->email,$data['name']);
        if($trans_auth['status'] == false){
            return response(['data' => "unable to validate"],418);
        }
        $data["recipient_code"]= $trans_auth['data']['recipient_code'];
        $data["bank"]= $trans_auth['data']['bank_name'];
        $data["bank_code"]= $trans_auth['data']['bank_code'];
        $data["account_name"]= $trans_auth['data']['account_name'];
        $data["account_number"]= $trans_auth['data']['account_number'];

        $card = Card::create($data);

        return response(['data' => $card ], 201);

    }

    public function show($id)
    {
        $card = Card::findOrFail($id);

        return response(['data', $card ], 200);
    }

    public function update(CardRequest $request, $id)
    {
        $card = Card::findOrFail($id);
        $card->update($request->all());

        return response(['data' => $card ], 200);
    }

    public function destroy($id)
    {
        Card::destroy($id);

        return response(['data' => null ], 204);
    }
}
