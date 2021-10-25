<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

define('LARAVEL_START', microtime(true));
if(!function_exists('session_start_samesite')) {
    function session_start_modify_cookie()
    {
        $headers = headers_list();
        krsort($headers);
        foreach ($headers as $header) {
            if (!preg_match('~^Set-Cookie: PHPSESSID=~', $header)) continue;
            $header = preg_replace('~; secure(; HttpOnly)?$~', '', $header) . '; secure; SameSite=None';
            header($header, false);
            break;
        }
    }

    function session_start_samesite($options = [])
    {
        $currentCookieParams = session_get_cookie_params();
        $cookie_domain= 'www.livinginhotel.com';
        if (PHP_VERSION_ID >= 70300) {
            session_set_cookie_params([
                'lifetime' =>  120,
                'path' => '/',
                'domain' => $cookie_domain,
                'secure' => "1",
                'httponly' => "1",
                'samesite' => 'None',
            ]);
        } else {
            session_set_cookie_params(
                120,
                '/; samesite=None',
                $cookie_domain,
                "1",
                "1"
            );
        }
        $res = session_start($options);
        if (isset($_SERVER['HTTPS'])) session_start_modify_cookie();
        return $res;
    }

    function session_regenerate_id_samesite($delete_old_session = false)
    {
        $res = session_regenerate_id($delete_old_session);
        session_start_modify_cookie();
        return $res;
    }
}

@session_start_samesite();
/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels great to relax.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let us turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight our users.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);
if(DB::connection()->getDatabaseName())
{
    //echo "Connected to database ".DB::connection()->getDatabaseName();
}
$response->send();

$kernel->terminate($request, $response);
