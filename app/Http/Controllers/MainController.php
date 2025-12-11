<?php

namespace App\Http\Controllers;

use App\Models\AcountLadipageModel;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function UserRegisterHPN(Request $request)
    {
        $formData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);
        $user = new AcountLadipageModel();
        $user->name = $formData['name'];
        $user->type_ladipage = 1;
        $user->phone = $formData['phone'];
        $user->math = $request->has('math') ? 1 : 0;
        $user->english = $request->has('english') ? 1 : 0;
        $user->literature = $request->has('literature') ? 1 : 0;
        $user->save();
        return response()->json(['msg' => 'Bạn đã đăng ký học thử thành công']);
    }

    public function UserRegisterHPN2(Request $request)
    {
        $formData = $request->validate([
            'name' => 'required|string|max:255',
            'phone1' => 'required|string|max:15',
        ]);
        $user = new AcountLadipageModel();
        $user->name = $formData['name'];
        $user->type_ladipage = 1;
        $user->phone = $formData['phone1'];
        $user->math = $request->has('math') ? 1 : 0;
        $user->english = $request->has('english') ? 1 : 0;
        $user->literature = $request->has('literature') ? 1 : 0;
        $user->save();
        return response()->json(['msg' => 'Bạn đã đăng ký học thử thành công']);
    }

    public function admin(){
        if (!session()->has('user')) {
            return redirect()->route('admin_login')->with('error', 'Bạn cần đăng nhập để truy cập trang này.');
        }
    
        $user = AcountLadipageModel::orderBy('create_at', 'desc')->get();
        return view('dashboard',compact('user'));
    }

    public function admin_login(){
        return view('login');
    }

    public function check_login(Request $request){
        $data = $request->all();
        $defaultAccounts = [
            ['username' => 'admin', 'password' => '123456'],
            ['username' => 'dung', 'password' => '123456'],
            ['username' => 'linh', 'password' => '123456'],
        ];
        $isValid = false;
        $loggedInUser = null;
        foreach ($defaultAccounts as $account) {
            if ($account['username'] == $data['username'] && $account['password'] == $data['password']) {
                $isValid = true;
                $loggedInUser = $account;
                break;
            }
        }
        
        if ($isValid) {
            session(['user' => $loggedInUser]);
            return redirect()->route('admin');
        } else {
            return redirect()->back()->with('error', 'Tài khoản và mật khẩu không đúng');
        }
    }
    
}
