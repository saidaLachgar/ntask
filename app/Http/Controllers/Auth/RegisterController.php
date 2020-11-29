<?php

namespace App\Http\Controllers\Auth;

use DateTime;
use DateTimeZone;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct(){
        $this->middleware("guest");
    }
    public function index(){
        return view("Auth.register");
    }
    public function store(request $request){

        //validation
        $this->validate($request, [
            'username' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);
        //store
        User::create([
            'name' => $request->username,
            'email' => $request->email,
            'timezone' => $request->timezone,
            'password' => Hash::make($request->password),
        ]);
       
        //sign in
        auth()->attempt($request->only('email', 'password'));

        $date = new DateTime("now", new DateTimeZone(auth()->user()->timezone) );
        DB::table('tasks')->insert(
            ['description' => 'Create Your First Task 👇', 'user_id' => auth()->user()->id, 'createdOn' => $date]
        );
        //redirect
        return redirect()->route('Tasks');
    }
}
