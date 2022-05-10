<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Services\Paystack;
use App\Models\Activity;
use App\Models\Transaction;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $paystack;

    public function __construct(Paystack $paystack)
    {
        $this->paystack = $paystack;
    }

    public function add_activity($details){
        $data = [
            "user_id"=>auth()->user()->id,
            "details"=> $details
        ];
        $data = Activity::create($data);
        return true;
    }
    public function add_transaction($details,$code,$saving_id, $status,$amount){
        $data = [
            "user_id"=>auth()->user()->id,
            "transaction_code"=>$code,
            "saving_id"=>$saving_id ?? 0,
            "details"=> $details,
            "status"=> $status,
            'amount'=>$amount
        ];
        $data = Transaction::create($data);
        return true;
    }
}
