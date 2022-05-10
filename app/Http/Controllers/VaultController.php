<?php

namespace App\Http\Controllers;

use App\Http\Requests\VaultRequest;
use App\Models\Card;
use App\Models\Vault;
use Illuminate\Http\Request;
use App\Models\User;

class VaultController extends Controller
{
    public function index()
    {
        $vaults = Vault::with('user')->latest()->get();
        if(auth()->user()->user_type == "user"){
            $vaults = Vault::with('user')->where('user_id', auth()->user()->id)->latest()->get();
        }
        return response(['data' => $vaults ], 200);
    }


    public function withdrawal(Request $request){
        $data = $request->all();
        $user = User::whereId(auth()->user()->id)->first();
        $card = Card::whereId($data['card_no'])->first();
        if($user->pocket_mooney < $data['amount']){
            return response()->json(["error"=>"you don't have enough money for this transaction"], 422);
        }
        $res = $this->paystack->transfer_initiate($card->recipient_code,$data['amount']);
        if($res['status'] == false){
            return response()->json(['data' => "failed to transfer funds"],408);

        }
        $user->pocket_mooney = floatval($user->pocket_mooney) - floatval($data['amount']);
        $user->save();
        $details =" withdrawal of ". $data['amount'] . " is made";
        $this->add_activity($details);
        $this->add_transaction($details,$res['data']['reference'],0, "true", $data['amount']);

        return response()->json(['data'=>$user], 200);
    }

    public function topup(Request $request){
        $data = $request->all();
        $user = User::whereId(auth()->user()->id)->first();
        $card = Card::whereId($data['card_no'])->first();
        $res = $this->paystack->charge($data['amount'],$card->authorization_code, $user->email);
        \Log::info($card->authorization_code);
        if($res['status'] == false){
            return response()->json(['data' => "top up fails"],408);

        }
        $user->pocket_mooney += $data['amount'];
        $user->save();
        $details =" Account topped up with". $data['amount'];
        $this->add_activity($details);
        $this->add_transaction($details,$res['data']['reference'],0, "true", $data['amount']);

        return response()->json(['data'=>$user], 200);



    }


    public function store(VaultRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $vault = Vault::create($data);

        return response(['data' => $vault ], 201);

    }

    public function show($id)
    {
        $vault = Vault::findOrFail($id);

        return response(['data', $vault ], 200);
    }

    public function update(VaultRequest $request, $id)
    {
        $vault = Vault::findOrFail($id);
        $vault->update($request->all());

        return response(['data' => $vault ], 200);
    }

    public function destroy($id)
    {
        Vault::destroy($id);

        return response(['data' => null ], 204);
    }
}
