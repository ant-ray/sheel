<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller,Session;
use App\Models\User;
use App\Models\Institution;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * 登録画面
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $institutions = Institution::orderBy('created_at')->paginate();
        return view('auth.register', compact('institutions'));
    }

    /**
     * 登録処理とバリデーション
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'kana' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'tel' => ['required', 'numeric', 'digits_between:8,11',],
            'institution_id' => ['required', 'string', 'max:10'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'kana' => $request->kana,
            'email' => $request->email,
            'tel' => $request->tel,
            'institution_id' => $request->institution_id,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);
        $user = Auth::user();
        Session::put(['user_id' => $user->id,'role' => $user->role]);

        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * 管理者登録画面
     *
     * @return \Illuminate\View\View
     */
    public function adminCreate()
    {
        return view('auth.adminRegister');
    }

    /**
     * 管理者登録処理とバリデーション
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function adminStore(Request $request)
    {
        //
        if ($request->role == 734289) {
            $request->role = 1;
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'kana' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'tel' => ['required', 'numeric', 'digits_between:8,11',],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            $user = User::create([
                'name' => $request->name,
                'kana' => $request->kana,
                'email' => $request->email,
                'tel' => $request->tel,
                'institution_id' => $request->institution_id,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);
        } else {
            $request['role'] = null;
            $request->validate([
                'role' => ['boolean'],
            ]);
        }

        event(new Registered($user));

        Auth::login($user);
        $user = Auth::user();
        Session::put(['user_id' => $user->id,'role' => $user->role]);

        return redirect(RouteServiceProvider::ADMIN_HOME);
    }
}
