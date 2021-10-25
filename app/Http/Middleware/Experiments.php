<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Orchid\Experiment\Experiment;
use Psr\SimpleCache\InvalidArgumentException;

class Experiments
{

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     * @throws \Exception
     * @throws InvalidArgumentException
     */
    public function handle(Request $request, Closure $next)
    {
        $experiment = new Experiment('AB');

        $experiment->startAndSaveCookie([
            'A' => 1,
            'B' => 0,
        ]);

        return $next($request);
    }
}
