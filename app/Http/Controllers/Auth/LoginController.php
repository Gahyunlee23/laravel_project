<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;
use \Illuminate\Http\Request;
use Illuminate\Http\{RedirectResponse, Response};
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as SocialUser;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected function redirectTo()
    {
        if(session()->has('redirect') && session()->get('redirect') !== null && session('redirect')!=='https://www.livinginhotel.com/login'){
            return session()->pull('redirect','/');
        }
        if (Auth::user()->hasRole('super-admin|admin')) {
            return '/admin/dash-board';
        }
        return '/';
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function username()
    {
        return 'email';
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }
    }


    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
//        if(is_numeric($request->get('tel'))){
//            return ['tel'=>$request->get('tel'),'password'=>$request->get('password')];
//        }
        if (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
            return ['email' => $request->get('email'), 'password'=>$request->get('password')];
        }
    }

    /**
     * 사용자를 주어진 공급자의 OAuth 서비스로 리디렉션합니다.
     *
     * @param Request $request
     * @return Response|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider(Request $request)
    {
        if(!is_null($request->redirect)){
            session(['redirect'=>$request->redirect]);
        }
        if(!is_null($request->route)){
            session(['route'=>$request->route]);
        }
        //ddd($request->session()->pull('character_type'));
        return Socialite::driver($request->type)->with(['access_type'=>'offline'])->redirect();
    }

    /**
     * 소셜에서 인증을 받은 후 응답입니다.
     *
     * @param Request $request
     * @return Response|mixed
     * @throws Exception
     */
    public function handleProviderCallback(Request $request)
    {
        $socialUser = Socialite::driver($request->type)->user();
        if ($user = User::where('email', $socialUser->getEmail())->first()) {
            switch ($request->type) {
                case 'kakao':
                    if($user->kakao_social_id === null){
                        $user->kakao_social_id = $socialUser->id ?? null;
                    }
                    if( $user->name !== $socialUser->nickname &&  $user->name_check !== $socialUser->nickname){
                        $user->name_check = $socialUser->nickname ?? null;
                    }
                    if( $user->email !== $socialUser->email && $user->email_check !== $socialUser->email){
                        $user->email_check = $socialUser->email ?? null;
                    }
                    if( $user->nick_name === null){
                        $user->nick_name = $socialUser->nickname ?? null;
                    }
                    if($user->profile_image === null){
                        $user->profile_image = $socialUser->avatar ?? null;
                    }
                    if($user->email_verified_at === null){
                        $user->email_verified_at = Date::now();
                    }
                    if($user->remember_token === null){
                        $user->remember_token = Str::random(60);
                    }
                    if($user->phone !== null
                        && $user->phone !== $socialUser->user['kakao_account']['phone_number']
                        && $user->phone_check !== $socialUser->user['kakao_account']['phone_number'] ){
                        $user->phone_check = $socialUser->user['kakao_account']['phone_number'] ?? null;
                    }
                    if($user->phone === null){
                        $user->phone = $socialUser->user['kakao_account']['phone_number'] ?? null;
                    }
                    if(isset($socialUser->user['kakao_account']['age_range'])){
                        if($user->age_range === null || $user->age_range !== $socialUser->user['kakao_account']['age_range']){
                            $user->age_range = $socialUser->user['kakao_account']['age_range'] ?? null;
                        }
                    }
                    if($socialUser->user['kakao_account']['has_birthyear']){
                        if($user->birthyear === null || $user->birthyear !== $socialUser->user['kakao_account']['birthyear']){
                            $user->birthyear = $socialUser->user['kakao_account']['birthyear'] ?? null;
                        }
                    }
                    if(isset($socialUser->user['kakao_account']['birthday'])){
                        if($user->birthday === null || $user->birthday !== $socialUser->user['kakao_account']['birthday']){
                            $user->birthday = $socialUser->user['kakao_account']['birthday'] ?? null;
                        }
                    }
                    if(isset($socialUser->user['kakao_account']['gender'])){
                        if($user->gender === null || $user->gender !== $socialUser->user['kakao_account']['gender']){
                            $user->gender = $socialUser->user['kakao_account']['gender'] ?? null;
                        }
                    }
                    if($user->tel !== null){
                        $user->tel=null;
                        //$user->tel = Str::of($socialUser->user['kakao_account']['phone_number'])->replace(' ', '')->replace('-', '')->replace('+82', '0');
                    }
                    $user->save();
                    break;
            }
            $this->guard()->login($user, true);
            usleep(10);
            if($request->session()->has('redirect')){
                if($request->session()->get('redirect')==='api'){
                    return response()->json([
                        'message' => 'User successfully logging',
                        'user' => $user
                    ]);
                }

                if($request->session()->get('redirect')==='close'){
                    return view('close', [
                            'api_token' => $user->api_token,
                        ]
                    );
                }
                if (!is_null($request->redirect) && $request->redirect !== '/login') {
                    return redirect($request->session()->pull('redirect','/'));
                }
                if(session('redirect')!=='https://www.livinginhotel.com/login'){
                    return redirect($request->session()->pull('redirect','/'));
                }

                return redirect('/');
            }
            return $this->sendLoginResponse($request);
        }
        return $this->register($request, $socialUser);
        /*$user = Socialite::driver($request->type)->userFromToken($token);*/
    }

    /**
     * 주어진 소셜 회원을 응용 프로그램에 등록합니다.
     *
     * @param Request $request
     * @param SocialUser $socialUser
     * @return mixed
     */
    protected function register(Request $request, SocialUser $socialUser)
    {
        //ddd($request,$socialUser,$socialUser->user,$socialUser->user['kakao_account']['birthday']);
        if($socialUser){
            switch ($request->type) {
                case 'kakao':
                if(User::whereKakaoSocialId($socialUser->id)->count() >= 1){
                    $user = User::whereKakaoSocialId($socialUser->id)->first();
                    $user->email_check = $socialUser->email;
                    $user->name_check = $socialUser->name;
                }else{
                    $user = User::updateOrCreate([
                        'email'=>$socialUser->email,
                        'name'=>$socialUser->name,
                    ],[
                        'email'=>$socialUser->email,
                        'name'=>$socialUser->name,
                    ]);
                }
                break;
            }

            switch ($request->server('REDIRECT_URL')) {
                case '/login/social/callback/kakao':
                    $user->kakao_social_id = $socialUser->id;
                    $user->phone = phone($socialUser->user['kakao_account']['phone_number'],'KR')->formatE164();
                    //$user->tel = Str::of($socialUser->user['kakao_account']['phone_number'])->replace(' ', '')->replace('-', '')->replace('+82', '0');
                    break;
            }

            $user->email_verified_at = Date::now();
            $user->remember_token = Str::random(60);
            $user->nick_name = $socialUser->nickname;
            $user->profile_image = $socialUser->avatar;
            $user->save();

            $this->guard()->login($user, true);
        }
        if($request->session()->has('route')){
            return redirect()->route($request->session()->pull('route','/'));
        }
        if($request->session()->has('redirect')){
            return redirect($request->session()->pull('redirect','/'));
        }
        return $this->sendLoginResponse($request);
    }
    /**
     * 사용자 인증을 받았습니다.
     *
     * @param Request $request
     * @param User $user
     */
    protected function authenticated(Request $request, User $user)
    {
         //ddd($request,$this->redirectTo);
        //flash()->success(__('auth.welcome', ['name' => $user->name]));
        /*
         $role = Auth::user()->role->role_name;
        switch($role) {
            case 'admin':
                return redirect('/admin');
                break;
            case 'user':
                return redirect('/dashboard');
                break;
            default:
                return redirect('/login');
                break;
        }
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }
        */
    }

    /**
     * 지원하지 않는 소셜 공급자에 대한 응답입니다.
     *
     * @param string $provider
     * @return RedirectResponse
     */
    protected function sendNotSupportedResponse(string $provider): RedirectResponse
    {
        //flash()->error(trans('auth.social.not_supported', ['provider' => $provider]));

        return back();
    }

    /**
     * 로그아웃 후 > 전 페이지로 > 리다이렉트 기능
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    protected function redirectToLogout(Request $request)
    {
        Auth::logout();

        if (!is_null($request->redirect) && $request->redirect !== '/login') {
            return redirect($request->redirect);
        }
        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $this->guard()->logout();

        $request->session()->invalidate();

        if (!is_null($request->redirect) && $request->redirect !== '/login') {
            return redirect($request->redirect);
        }
        return redirect('/');
    }

    public function userPasswordNeedChange(){
        ddd('develop');
        //return view('close');
    }

    public function passworSdearch()
    {
        return view('auth.password-search');
    }

    public function userRegister()
    {
        return view('auth.user-register');
    }

}
