<?php

namespace App\Http\Controllers\Auth;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin');
    }
   public function showLoginForm(Request $request){

       return view('auth.admin-login');
   }
   public function login(Request $request){
        
      //attempt to log the user in       
            if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password],false)){
                            
            //if true go to dashboard        
            return redirect()->intended(route('admin.dashboard'));
        }
        else{           
            return redirect()->back()->withInput($request->only('email'));
        }
        
        

   }
}
