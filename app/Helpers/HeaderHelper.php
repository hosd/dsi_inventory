<?php


namespace App\Helpers;
use App\Models\Paymentplanmodal;
use App\Models\DealerType;

class HeaderHelper
{
    public static function getPaymentPlan($recId)
    {
    	$plan = Paymentplanmodal::join('bank', 'payment_plan.ibankID', '=', 'bank.id')
                ->select('payment_plan.name','bank.name as bank')
                ->find($recId);

        return $plan->bank.' '.$plan->name;
    }

    public static function get_dealer_type_name($recId)
    {
    	$dealer = DealerType::find($recId);
        
        return $dealer->name;
    }

}
