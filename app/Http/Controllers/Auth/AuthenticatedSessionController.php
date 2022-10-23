<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller,Session;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthenticatedSessionController extends Controller
{
    /**
     * ログイン画面表示
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * ログイン処理
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();
        ///セッションにidとrole入れとく
        $user = Auth::user();
        Session::put(['user_id' => $user->id,'role' => $user->role]);

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * ログアウト処理
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * ログイン画面表示
     *
     * @return \Illuminate\View\View
     */
    public function adminCreate()
    {
        return view('auth.adminLogin');
    }

    /**
     * 管理者ログイン認証
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function adminStore(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();
        ///セッションにidとrole入れとく
        $user = Auth::user();
        Session::put(['user_id' => $user->id,'role' => $user->role]);

        return redirect()->intended('adminTop');
    }
}
