<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Closure;

class VerifyCsrfToken extends Middleware
{
    //protected $addHttpCookie = true;

//    public function handle($request, Closure $next)
//    {
//        $response=$next($request);
//
//        //$response->header('P3P', 'CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');
//        return $response;
//    }

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/payment',
        '/payment/*',
        '/payple/auth',
        '/payment/store',
        '/payment/store/rest',
        '/payment/store/rest/process',
        '/hotel/detail',
        'https://cpay.payple.kr',
        'https://cpay.payple.kr/*',
        'https://checkout.teledit.com',
        'https://checkout.teledit.com/*',
        'https://www.vpay.co.kr',
        'https://www.vpay.co.kr/*',
    ];
}
