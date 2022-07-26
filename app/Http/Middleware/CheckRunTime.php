<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\PersonalAccessToken;
use App\Models\Invoice;
use Carbon\Carbon;

class CheckRunTime
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        $userToken = PersonalAccessToken::where('tokenable_id', auth()->user()->id)->first();//NEED TO DETECT THE TOKEN PERFECTLY
        $userToken->created_at = Carbon::now()->toDateTimeString();
        $userToken->save();

        // return Carbon::now() - $userToken->created_at;



        // $current_time = Carbon::now();
        // $start_time = Carbon::parse($userToken->created_at);
        // $diff = $current_time->diffInMinutes($start_time);
        // $userToken->created_at = Carbon::now()->toDateTimeString();
        // $userToken->save();

        
        // $diffsec = $current_time->diffInSeconds($start_time);

        // echo "text from middleware. auth = ".$request->user();
        // $invoice = Invoice::find(552338743);
        // $invoice->payment_method = $diff;
        // $invoice->save();

        // if($diff < 5){
                
        //     $userToken->created_at = Carbon::now()->toDateTimeString();
        //     $userToken->save();
        // }


        
        return $next($request);
    }
}
