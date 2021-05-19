<?php

namespace App\Http\Controllers\Auth;

use App\Help\UserHelp;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
          $this->middleware(array('guest:super', 'guest:admin', 'guest:web'))->except('logout');
    }
            /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login', [
            'title'=>'pfs-index',
            'levels'=>UserHelp::getLevels(),
            'universities'=>USerHelp::getUniversities(),
            'programs'=>UserHelp::getPrograms(),
            'faculties'=>USerHelp::getFaculties(),
            'contents'=>UserHelp::getContents1(),
            'contents2'=>UserHelp::getContents2(),
            'contents3'=>UserHelp::getContents3(),
            'crashes'=>UserHelp::crash(),
        ]);
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();

        // $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }
        /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('web');
    }
}
