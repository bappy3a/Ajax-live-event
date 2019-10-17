<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    // *
    //  * Create a new controller instance.
    //  *
    //  * @return void
     
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::latest()->paginate(5);
        return view('home',compact('users'));
    }


    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $users = DB::table('users')->where('name', 'LIKE', '%' . $request->search . '%')->paginate(5);
            if ($users) {
                foreach ($users as $key => $user) {
                    $output .= '<tr>
                    <td>' . $user->id . '</td>
                    <td>' . $user->name . '</td>
                    <td>' . $user->email . '</td>
                    <td>' . $user->qty . '</td>
                    <td><button class="btn btn-success btn-sm">+</button></td>
                    </tr>';
                }
            }
            
            return Response($output);
        }
    }


}
