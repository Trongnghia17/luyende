<?php

namespace App\Http\Controllers;

use App\Models\AcountLadipageModel;
use App\Services\GoogleSheetsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MainController extends Controller
{
    public function UserRegisterHPN(Request $request)
    {
        $formData = $request->validate([
            'name' => 'required|string|max:255',
            'khoi' => 'required|string|max:10',
            'bode' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
        ]);
        
        // Lưu vào database
        $user = new AcountLadipageModel();
        $user->name = $formData['name'];
        $user->phone = $formData['phone'];
        $user->khoi = $formData['khoi'];
        $user->bode = $formData['bode'];
        $user->email = $formData['email'] ?? null;
        $user->save();
        
        // Lưu vào Google Sheets
        try {
            $googleSheets = new GoogleSheetsService();
            $stt = $googleSheets->getNextSTT();
            
            $googleSheets->appendData([
                'stt' => $stt,
                'name' => $formData['name'],
                'khoi' => $formData['khoi'],
                'bode' => $formData['bode'],
                'phone' => $formData['phone'],
                'email' => $formData['email'] ?? '',
                'tham_gia_chua' => '',
                'group_link' => 'https://zalo.me/g/wnvnikf40'
            ]);
        } catch (\Exception $e) {
            // Log lỗi nhưng vẫn trả về success vì đã lưu vào database
            Log::error('Google Sheets Error: ' . $e->getMessage());
        }
        
        return response()->json(['msg' => 'Bạn đã đăng ký học thử thành công']);
    }

    public function UserRegisterHPN2(Request $request)
    {
        $formData = $request->validate([
            'name' => 'required|string|max:255',
            'khoi' => 'required|string|max:10',
            'bode' => 'required|string|max:255',
            'phone1' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
        ]);
        
        // Lưu vào database
        $user = new AcountLadipageModel();
        $user->name = $formData['name'];
        $user->phone = $formData['phone1'];
        $user->khoi = $formData['khoi'];
        $user->bode = $formData['bode'];
        $user->email = $formData['email'] ?? null;
        $user->save();
        
        // Lưu vào Google Sheets
        try {
            $googleSheets = new GoogleSheetsService();
            $stt = $googleSheets->getNextSTT();
            
            $googleSheets->appendData([
                'stt' => $stt,
                'name' => $formData['name'],
                'khoi' => $formData['khoi'],
                'bode' => $formData['bode'],
                'phone' => $formData['phone1'],
                'email' => $formData['email'] ?? '',
                'tham_gia_chua' => '', // Có thể cập nhật sau
                'group_link' => 'https://zalo.me/g/wnvnikf40' // Link group mặc định
            ]);
        } catch (\Exception $e) {
            // Log lỗi nhưng vẫn trả về success vì đã lưu vào database
            Log::error('Google Sheets Error: ' . $e->getMessage());
        }
        
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
