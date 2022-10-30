<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institution;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Condition;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;

class SheelController extends Controller
{
    /**
     * 一般ユーザー
     * トップ画面表示
     * @return view
     */
    public function showTop(Request $request)
    {
        $login = $request->session()->get('user_id');
        if (isset($login)) {
            $tenants = Tenant::orderBy('created_at')->paginate();
            //施設プルダウン表示用変数
            $institutions = Institution::orderBy('created_at')->paginate();

            return view('sheel.top', compact('tenants', 'institutions'));
        }
        return view('auth.login')->with('flash_message', '不正なアクセスです。');
    }

    /**
     * 一般ユーザー
     * トップ画面検索表示
     * @return view
     */
    public function showTopSearch(Request $request)
    {
        $login = $request->session()->get('user_id');
        if (isset($login)) {
            $s_name = $request->input('s_name');
            $s_institution = $request->input('s_institution');
            $query = Tenant::query();
            //もし名前が入力されていたら
            if (isset($s_name)) {
                $spaceConversion = mb_convert_kana($s_name, 's');
                $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
                foreach ($wordArraySearched as $value) {
                    $query->where('name', 'like', '%' . $value . '%');
                }
            }
            //もし施設が選択されていたら
            if (isset($s_institution)) {
                $query->where('institution_id', '=', $s_institution);
            }
            //検索結果
            $tenants = $query->paginate();
            //施設プルダウン表示用変数
            $institutions = Institution::orderBy('created_at')->paginate();
            $s_institution = DB::table('institutions')->find($s_institution);
            //dd($s_institution);
            return view('sheel.top', compact('tenants', 'institutions', 's_name','s_institution'));
        }
        return view('auth.login')->with('flash_message', '不正なアクセスです。');
    }

    /**
     * 一般ユーザー
     * 施設一覧画面表示
     * @return view
     */
    public function showInstitutionList(Request $request)
    {
        $login = $request->session()->get('user_id');
        if (isset($login)) {
            //ページネーション呼び出し
            $s_institutions = Institution::orderBy('created_at')->paginate();
            $institutions = Institution::orderBy('created_at')->paginate();
            return view('sheel.institutionList', compact('institutions', 's_institutions'));
        }
        return view('auth.login')->with('flash_message', '不正なアクセスです。');
    }

    /**
     * 一般ユーザー
     * 施設画面検索表示
     * @return view
     */
    public function showInstitutionSearch(Request $request)
    {
        $login = $request->session()->get('user_id');
        if (isset($login)) {
            $s_institution = $request->input('s_institution');
            $query = Institution::query();
            //もし施設が選択されていたら
            if (isset($s_institution)) {
                $query->where('id', '=', $s_institution);
            }
            //ページネーション呼び出し
            $institutions = $query->paginate();
            $s_institutions = Institution::orderBy('created_at')->paginate();
            return view('sheel.institutionList', compact('institutions', 's_institutions'));
        }
        return view('auth.login')->with('flash_message', '不正なアクセスです。');
    }

    /**
     * 一般ユーザー
     * 施設詳細画面表示
     * @return view
     */
    public function showInstitution(Request $request)
    {
        $login = $request->session()->get('user_id');
        if (isset($login)) {
            $id = $request['id'];
            $institution = DB::table('institutions')->find($id);
            return view('sheel.Institution', compact('institution'));
        }
        return view('auth.login')->with('flash_message', '不正なアクセスです。');
    }

    /**
     * 一般ユーザー
     * 利用者登録画面
     * @return view
     */
    public function showTenantRegister(Request $request)
    {
        $login = $request->session()->get('user_id');
        if (isset($login)) {
            //施設プルダウン表示用変数
            $institutions = Institution::orderBy('created_at')->paginate();

            return view('sheel.tenantRegister', compact('institutions'));
        }
        return view('auth.login')->with('flash_message', '不正なアクセスです。');
    }

    /**
     * 一般ユーザー
     * 利用者登録
     * @return view
     */
    public function exeTenantRagister(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'kana' => ['required', 'string', 'max:255'],
            'age' => ['required'],
            'sex' => ['required'],
            'emergency_contact' => ['required', 'numeric', 'digits_between:8,11'],
            'contact_name' => ['required', 'string', 'max:255'],
            'institution_id' => ['required']
        ]);

        $tenant = Tenant::create([
            'name' => $request->name,
            'kana' => $request->kana,
            'age' => $request->age,
            'sex' => $request->sex,
            'emergency_contact' => $request->emergency_contact,
            'contact_name' => $request->contact_name,
            'institution_id' => $request->institution_id,
        ]);

        event(new Registered($tenant));

        return redirect('top')->with('flash_message', '登録が完了しました');
    }

    /**
     * 一般ユーザー
     * 利用者体調登録画面
     * @return view
     */
    public function showConditionRegister(Request $request)
    {
        $login = $request->session()->get('user_id');
        if (isset($login)) {
            $id = $request['id'];
            $tenant  = DB::table('tenants')->find($id);

            return view('sheel.conditionRegister', compact('tenant'));
        }
        return view('auth.login')->with('flash_message', '不正なアクセスです。');
    }

    /**
     * 一般ユーザー
     * 利用者体調登録
     * @return view
     */
    public function exeConditionRegister(Request $request)
    {
        $request->validate([
            'condition' => ['required'],
            'body' => ['required', 'string', 'max:255'],
        ]);

        $tenantCondition = Condition::create([
            'condition' => $request->condition,
            'body' => $request->body,
            'user_id' => $request->session()->get('user_id'),
            'tenant_id' => $request->tenant_id
        ]);

        $check = Tenant::where('id', '=', $request->tenant_id)->update([
            'check' => 1
        ]);

        event(new Registered($tenantCondition, $check));

        return redirect('top')->with('flash_message', '登録が完了しました');
    }


    /**
     * 一般ユーザー
     * 利用者詳細画面
     * @return view
     */
    public function showTenant(Request $request)
    {
        $login = $request->session()->get('user_id');
        if (isset($login)) {
            $id = $request['id'];
            $tenant = DB::table('tenants')->find($id);
            //最新の体調取得
            $lastConditions = DB::table('conditions')
                ->orderBy('created_at')
                ->where('tenant_id', '=', $id)->first();
            $institution_id = $tenant->institution_id; //ここで施設id取得
            $institutionName = DB::table('institutions')->find($institution_id);
            //体調取得しジョインで記録者も取得
            $conditions = DB::table('conditions')
                ->join('users', 'conditions.user_id', '=', 'users.id')
                ->select('conditions.*', 'users.name')
                ->orderBy('conditions.created_at', 'desc')
                ->where('tenant_id', '=', $id)->paginate();

            return view('sheel.tenant', compact('tenant', 'institutionName', 'conditions', 'lastConditions'));
        }
        return view('auth.login')->with('flash_message', '不正なアクセスです。');
    }



    /**
     * 一般ユーザー
     * 利用者詳細画面検索表示
     * @return view
     */
    public function showConditionSearch(Request $request)
    {
        $login = $request->session()->get('user_id');
        if (isset($login)) {
            //変数定義
            $s_Sdate = $request->input('s_Sdate');
            $s_Edate = $request->input('s_Edate');
            $s_condition = $request->input('s_condition');
            $id = $request['id'];

            //最新の体調取得
            $lastConditions = DB::table('conditions')
                ->orderBy('created_at')
                ->where('tenant_id', '=', $id)->first();
            if (empty($lastConditions)) {
                $lastConditions = '未登録';
            }

            //施設名出力
            $tenant = DB::table('tenants')->find($id);
            $institution_id = $tenant->institution_id; //ここで施設id取得
            $institutionName = DB::table('institutions')->find($institution_id);

            //検索
            $query = Condition::query()
                ->join('users', 'conditions.user_id', '=', 'users.id')
                ->select('conditions.*', 'users.name')
                ->orderBy('conditions.created_at', 'desc')
                ->where('tenant_id', '=', $id);
            //もし日付入力されていたら
            if (isset($s_Sdate, $s_Edate)) {
                $query->whereBetween('conditions.created_at', [$s_Sdate, $s_Edate]);
            } elseif (isset($s_Sdate)) {
                $query->whereDate('conditions.created_at', '>=', $s_Sdate);
            } elseif (isset($s_Edate)) {
                $query->whereDate('conditions.created_at', '<=', $s_Edate);
            }
            //もし体調が入力されていたら
            if (isset($s_condition)) {
                $query->where('condition', '=', $s_condition);
            }
            $conditions = $query->paginate();

            return view('sheel.tenant', compact('tenant', 'institutionName', 'conditions', 'lastConditions'));
        }
        return view('auth.login')->with('flash_message', '不正なアクセスです。');
    }


    /**
     * 一般ユーザー
     * ajax受け取り
     * @return view
     */
    public function ajaxConditionRegister(Request $request)
    {
        $tenantCondition = Condition::create([
            'condition' => $request->condition,
            'body' => $request->body,
            'user_id' => $request->session()->get('user_id'),
            'tenant_id' => $request->tenant_id
        ]);
        $check = Tenant::where('id', '=', $request->tenant_id)->update([
            'check' => 1
        ]);

        event(new Registered($tenantCondition, $check));
    }


    /**
     * 一般ユーザー
     * 発表会用リセットボタン
     * @return view
     */
    public function resetCondition()
    {
        $tenants = Tenant::orderBy('created_at')->paginate();
        //施設プルダウン表示用変数
        $institutions = Institution::orderBy('created_at')->paginate();

        $check = Tenant::where('check', 1)
            ->update(['check' => 0]);
        event(new Registered($check));
        return view('sheel.top', compact('tenants', 'institutions'));
    }


    /****************************管理者********************************/


    /**
     * 管理者
     * 管理者トップ画面表示
     * @return view
     */
    public function showAdminTop(Request $request)
    {
        $login = $request->session()->get('role');
        if ($login == 1) {
            //施設プルダウン表示用変数
            $institutions = Institution::orderBy('created_at')->paginate();
            $tenants = Tenant::orderBy('created_at')->paginate();

            return view('sheelAdmin.adminTop', compact('tenants', 'institutions'));
        }
        return view('auth.login')->with('flash_message', '不正なアクセスです。');
    }

    /**
     * 管理者
     * トップ画面検索表示
     * @return view
     */
    public function showAdminTopSearch(Request $request)
    {
        $login = $request->session()->get('role');
        if ($login == 1) {
            $s_name = $request->input('s_name');
            $s_institution = $request->input('s_institution');
            $query = Tenant::query();
            //もし名前が入力されていたら
            if (isset($s_name)) {
                $spaceConversion = mb_convert_kana($s_name, 's');
                $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
                foreach ($wordArraySearched as $value) {
                    $query->where('name', 'like', '%' . $value . '%');
                }
            }
            //もし施設が選択されていたら
            if (isset($s_institution)) {
                $query->where('institution_id', '=', $s_institution);
            }
            //検索結果
            $tenants = $query->paginate();
            //施設プルダウン表示用変数
            $institutions = Institution::orderBy('created_at')->paginate();

            return view('sheelAdmin.AdminTop', compact('tenants', 'institutions', 's_name'));
        }
        return view('auth.login')->with('flash_message', '不正なアクセスです。');
    }

    /**
     * 管理者施設一覧画面表示
     * @return view
     */
    public function showAdminInstitutionList(Request $request)
    {
        $login = $request->session()->get('role');
        if ($login == 1) {
            //ページネーション呼び出し
            $institutions = Institution::orderBy('created_at')->paginate();
            $s_institutions = Institution::orderBy('created_at')->paginate();
            return view('sheelAdmin.adminInstitutionList', compact('institutions', 's_institutions'));
        }
        return view('auth.login')->with('flash_message', '不正なアクセスです。');
    }

    /**
     * 管理ユーザー
     * 施設画面検索表示
     * @return view
     */
    public function showAdminInstitutionListSearch(Request $request)
    {
        $login = $request->session()->get('role');
        if ($login == 1) {
            $s_institution = $request->input('s_institution');
            $query = Institution::query();
            //もし施設が選択されていたら
            if (isset($s_institution)) {
                $query->where('id', '=', $s_institution);
            }
            //ページネーション呼び出し
            $institutions = $query->paginate();
            $s_institutions = Institution::orderBy('created_at')->paginate();
            return view('sheelAdmin.adminInstitutionList', compact('institutions', 's_institutions'));
        }
        return view('auth.login')->with('flash_message', '不正なアクセスです。');
    }

    /**
     * 管理者
     * 施設詳細画面表示
     * @return view
     */
    public function showAdminInstitution(Request $request)
    {
        $login = $request->session()->get('role');
        if ($login == 1) {
            $id = $request['id'];
            $institution = DB::table('institutions')->find($id);
            return view('sheelAdmin.adminInstitution', compact('institution'));
        }
        return view('auth.login')->with('flash_message', '不正なアクセスです。');
    }


    /**
     * 管理者
     * 施設登録画面表示
     * @return view
     */
    public function showInstitutionRagister(Request $request)
    {
        $login = $request->session()->get('role');
        if ($login == 1) {
            return view('sheelAdmin.institutionRegister');
        }
        return view('auth.login')->with('flash_message', '不正なアクセスです。');
    }

    /**
     * 管理者
     * 施設登録処理
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return view
     */
    public function exeInstitutionRagister(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'tel' => ['required', 'numeric', 'digits_between:8,11',],
        ]);

        $institution = Institution::create([
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'tel' => $request->tel,
        ]);

        event(new Registered($institution));

        return redirect('adminInstitutionList')->with('flash_message', '登録が完了しました');
    }

    /**
     * 管理者
     * 施設削除
     * @return view
     */
    public function exeInstitutionDelete(Request $request)
    {
        $id = $request['id'];
        Institution::find($id)->delete();
        return redirect('adminInstitutionList')->with('flash_message', '削除しました');
    }

    /**
     * 管理者
     * 利用者登録画面
     * @return view
     */
    public function showAdminTenantRegister()
    {
        //施設プルダウン表示用変数
        $institutions = Institution::orderBy('created_at')->paginate();

        return view('sheelAdmin.adminTenantRegister', compact('institutions'));
    }

    /**
     * 管理者
     * 利用者登録
     * @return view
     */
    public function exeAdminTenantRagister(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'kana' => ['required', 'string', 'max:255'],
            'age' => ['required'],
            'sex' => ['required'],
            'emergency_contact' => ['required', 'numeric', 'digits_between:8,11'],
            'contact_name' => ['required', 'string', 'max:255'],
            'institution_id' => ['required']
        ]);

        $tenant = Tenant::create([
            'name' => $request->name,
            'kana' => $request->kana,
            'age' => $request->age,
            'sex' => $request->sex,
            'emergency_contact' => $request->emergency_contact,
            'contact_name' => $request->contact_name,
            'institution_id' => $request->institution_id,
        ]);

        event(new Registered($tenant));
        return redirect('adminTop')->with('flash_message', '登録が完了しました');
    }

    /**
     * 管理者
     * 管理者利用者詳細画面
     * @return view
     */
    public function showAdminTenant(Request $request)
    {
        $login = $request->session()->get('role');
        if ($login == 1) {
            $id = $request['id'];
            $tenant = DB::table('tenants')->find($id);
            //最新の体調取得
            $lastConditions = DB::table('conditions')
                ->orderBy('created_at')
                ->where('tenant_id', '=', $id)->first();
            $institution_id = $tenant->institution_id; //ここで施設id取得
            $institutionName = DB::table('institutions')->find($institution_id);
            //体調取得しジョインで記録者も取得
            $conditions = DB::table('conditions')
                ->join('users', 'conditions.user_id', '=', 'users.id')
                ->select('conditions.*', 'users.name')
                ->orderBy('conditions.created_at', 'desc')
                ->where('tenant_id', '=', $id)->paginate();

            return view('sheelAdmin.adminTenant',  compact('tenant', 'institutionName', 'conditions', 'lastConditions'));
        }
        return view('auth.login')->with('flash_message', '不正なアクセスです。');
    }

    /**
     * 一般ユーザー
     * 利用者詳細画面検索表示
     * @return view
     */
    public function showAdminConditionSearch(Request $request)
    {
        $login = $request->session()->get('role');
        if ($login == 1) {
            //変数定義
            $s_Sdate = $request->input('s_Sdate');
            $s_Edate = $request->input('s_Edate');
            $s_condition = $request->input('s_condition');
            $id = $request['id'];

            //施設名出力
            $tenant = DB::table('tenants')->find($id);
            $institution_id = $tenant->institution_id; //ここで施設id取得
            $institutionName = DB::table('institutions')->find($institution_id);

            //検索
            $query = Condition::query()
                ->join('users', 'conditions.user_id', '=', 'users.id')
                ->select('conditions.*', 'users.name')
                ->orderBy('conditions.created_at', 'desc')
                ->where('tenant_id', '=', $id);
            //もし日付入力されていたら
            if (isset($s_Sdate, $s_Edate)) {
                $query->whereBetween('conditions.created_at', [$s_Sdate, $s_Edate]);
            } elseif (isset($s_Sdate)) {
                $query->whereDate('conditions.created_at', '>=', $s_Sdate);
            } elseif (isset($s_Edate)) {
                $query->whereDate('conditions.created_at', '<=', $s_Edate);
            }
            //もし体調が入力されていたら
            if (isset($s_condition)) {
                $query->where('condition', '=', $s_condition);
            }
            $conditions = $query->paginate();

            return view('sheelAdmin.adminTenant', compact('tenant', 'institutionName', 'conditions'));
        }
        return view('auth.login')->with('flash_message', '不正なアクセスです。');
    }


    /**
     * 管理者
     * 利用者情報編集画面
     * @return view
     */
    public function showTenantUpdate(Request $request)
    {
        $login = $request->session()->get('role');
        if ($login == 1) {
            $id = $request['id'];
            $tenant = DB::table('tenants')->find($id);
            //入居施設名取得
            $institutionName = DB::table('institutions')->find($tenant->institution_id);
            //施設プルダウン表示用変数
            $institutions = Institution::orderBy('created_at')->paginate();

            return view('sheelAdmin.tenantUpdate', compact('institutions', 'tenant', 'institutionName'));
        }
        return view('auth.login')->with('flash_message', '不正なアクセスです。');
    }

    /**
     * 管理者
     * 利用者編集
     * @return view
     */
    public function exeTenantUpdate(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'kana' => ['required', 'string', 'max:255'],
            'age' => ['required'],
            'sex' => ['required'],
            'emergency_contact' => ['required', 'numeric', 'digits_between:8,11'],
            'contact_name' => ['required', 'string', 'max:255'],
            'institution_id' => ['required']
        ]);

        $tenant = Tenant::where('id', '=', $request->id)->update([
            'name' => $request->name,
            'kana' => $request->kana,
            'age' => $request->age,
            'sex' => $request->sex,
            'emergency_contact' => $request->emergency_contact,
            'contact_name' => $request->contact_name,
            'institution_id' => $request->institution_id,
        ]);

        event(new Registered($tenant));
        return redirect('adminTop')->with('flash_message', '更新が完了しました');
    }


    /**
     * 管理者
     * 利用者削除
     * @return view
     */
    public function exeTenantDelete(Request $request)
    {
        $id = $request['id'];
        Tenant::find($id)->delete();
        return redirect('adminTop')->with('flash_message', '削除しました');
    }

    /**
     * 管理者
     * 従業員一覧画面表示
     * @return view
     */
    public function showUserList(Request $request)
    {
        $login = $request->session()->get('role');
        if ($login == 1) {
            //ページネーション呼び出し
            $users = User::orderBy('created_at')->paginate();
            return view('sheelAdmin.userList', compact('users'));
        }
        return view('auth.login')->with('flash_message', '不正なアクセスです。');
    }

    /**
     * 管理者
     * 従業員画面検索表示
     * @return view
     */
    public function showUserListSearch(Request $request)
    {
        $login = $request->session()->get('role');
        if ($login == 1) {
            $search = $request->input('search');
            $query = User::query();
            $spaceConversion = mb_convert_kana($search, 's');
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
            foreach ($wordArraySearched as $value) {
                $query->where('name', 'like', '%' . $value . '%');
            }

            $users = $query->paginate();

            return view('sheelAdmin.userList', compact('users', 'search'));
        }
        return view('auth.login')->with('flash_message', '不正なアクセスです。');
    }

    /**
     * 管理者
     * 従業員詳細画面
     * @return view
     */
    public function showUser(Request $request)
    {
        $login = $request->session()->get('role');
        if ($login == 1) {
            $id = $request['id'];
            $user = DB::table('users')->find($id);
            //施設名出力
            $institution_id = $user->institution_id; //ここで施設id取得
            $institutionName = DB::table('institutions')->find($institution_id);
            return view('sheelAdmin.user', compact('user', 'institutionName'));
        }
        return view('auth.login')->with('flash_message', '不正なアクセスです。');
    }

    /**
     * 管理者
     * 従業員情報編集画面
     * @return view
     */
    public function showUserUpdate(Request $request)
    {
        $login = $request->session()->get('role');
        if ($login == 1) {
            $id = $request['id'];
            $user = DB::table('users')->find($id);
            //入居施設名取得
            $institutionName = DB::table('institutions')->find($user->institution_id);
            //施設プルダウン表示用変数
            $institutions = Institution::orderBy('created_at')->paginate();

            return view('sheelAdmin.userUpdate', compact('institutions', 'user', 'institutionName'));
        }
        return view('auth.login')->with('flash_message', '不正なアクセスです。');
    }

    /**
     * 管理者
     * 従業員編集
     * @return view
     */
    public function exeUserUpdate(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'kana' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',],
            'tel' => ['required', 'numeric', 'digits_between:8,11',],
            'institution_id' => ['required', 'string', 'max:10'],
        ]);

        $user = User::where('id', '=', $request->id)->update([
            'name' => $request->name,
            'kana' => $request->kana,
            'email' => $request->email,
            'tel' => $request->tel,
            'institution_id' => $request->institution_id,
        ]);

        event(new Registered($user));
        return redirect('userList')->with('flash_message', '更新が完了しました');
    }

    /**
     * 管理者
     * 従業員削除
     * @return view
     */
    public function exeUserDelete(Request $request)
    {
        $id = $request['id'];
        User::find($id)->delete();
        return redirect('userList')->with('flash_message', '削除しました');
    }
}
