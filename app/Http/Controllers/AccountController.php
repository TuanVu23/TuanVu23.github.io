<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\User;

class AccountController extends BaseController
{
    public function getAccount(){
    	$user_id = \Auth::user()->user_id;
        $user = User::find($user_id);
    	return view('pages.account', compact('user'));
    }

    public function updateInfo(){
    	$user_id = \Auth::user()->user_id;
        if (isset($_POST['update-info'])) {
            $name = $_POST['name'];
            User::where('user_id', $user_id)->update(['name' => $name]);
            return redirect()->back()->with('alert', 'Cập nhật thông tin tài khoản thành công'); 
        }
    }

    public function changePass(Request $request){
        $user_id = \Auth::user()->user_id;
        $user = User::find($user_id);

        $old_pass = $request->old_pass;
        $new_pass = $request->new_pass;
        if (\Hash::check($old_pass, $user->password)){
            if($old_pass == $new_pass){
                return redirect()->back()->with('alert','Mật khẩu mới trùng lặp, vui lòng thử lại');
            }
            User::find($user_id)->update(['password'=>bcrypt($new_pass)]);
            return redirect()->back()->with('alert', 'Thay đổi mật khẩu thành công');
        }
        else{
            return redirect()->back()->with('alert', 'Mật khẩu hiện tại không đúng, vui lòng thử lại');
        }
    }

    public function updateAvatar(Request $request){
        $user_id = \Auth::user()->user_id;
        $path = '';
        if ($request->file('avatar')) {
            $file = $request->file('avatar');
            $fileName = $file->getClientOriginalName();
            $image = 'uploads/avatar/'.$fileName;
            $path = 'uploads/avatar';
            $file = $file->move($path, $fileName);
            User::where('user_id', $user_id)->update(['avatar' => $image]);
            return redirect()->back()->with('alert', 'Cập nhật ảnh đại diện thành công'); 
        }
        abort ('404');
    }
}
