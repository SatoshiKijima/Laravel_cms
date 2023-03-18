<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SupportUser;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Validator; 

class SupportRegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.supregister');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
            //バリデーション
        $validator = Validator::make($request->all(), [
             'name' => 'required|min:3|max:255',
             'email' => 'required',
             'pref'   => 'required',
             'city'   => 'required',
             'birthday'   => 'required',
             'gender'   => 'required',
        ]);
    
        //バリデーション:エラー 
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        
        $users = new supportuser;
        $users -> name = $request->name;
        $users -> email = $request->email;
        $users -> password = Hash::make($request->password);
        $users -> pref  =  $request->pref; // 都道府県情報
        $users -> city = $request->city; // 市区町村情報
        $users -> birthday = $request->birthday; // 誕生日情報
        $users -> gender = $request->gender; // 性別情報
        $users -> save();
        return redirect('/');
        
    }
}
