<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use App\User;
use App\WatchList;
use App\Comment;

class AdminController extends Controller
{
    public function getIndex(){
    	if (\Auth::user() && \Auth::user()->role == 1) {
	    	return view('admin.index');
	    }
	    abort(403, 'Access denied! You don’t have permission to access / on this server.');  	
    }

    public function getListUser(){
    	if (\Auth::user() && \Auth::user()->role == 1) {
    		$users = User::get();
    		return view('admin.user_list',compact('users'));
    	}
    	abort(403, 'Access denied! You don’t have permission to access / on this server.');
    }

    public function delUser($user_id){
    	Comment::where('user_id', $user_id)->delete();
    	WatchList::where('user_id', $user_id)->delete();
    	User::where('user_id', $user_id)->delete();
    	return redirect()->back()->with('alert', 'Xóa tài khoản thành công');
    }

    public function addUser(){
    	if (\Auth::user() && \Auth::user()->role == 1) {
    		return view('admin.user_add');
    	}
    	abort(403, 'Access denied! You don’t have permission to access / on this server.');
    }

    use RegistersUsers;
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['rdoLevel'],
        ]);
    }
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        return redirect('/admin/user_list')->with('alert', 'Thêm tài khoản thành công');
    }

    public function getListReview(){
        if (\Auth::user() && \Auth::user()->role == 1) {
            $reviews = Comment::get();
            return view('admin.review_list',compact('reviews'));
        }
        abort(403, 'Access denied! You don’t have permission to access / on this server.');
    }

    public function delReview($cmt_id){
        Comment::where('cmt_id', $cmt_id)->delete();
        return redirect()->back()->with('alert', 'Xóa review thành công');
    }

    public function editReview($cmt_id){
        $spoil = Comment::find($cmt_id)->spoil;       
        if ($spoil == 0) {
            Comment::where('cmt_id', $cmt_id)->update(['spoil' => 1]);
        }
        else {
            Comment::where('cmt_id', $cmt_id)->update(['spoil' => 0]);
        }
        return redirect()->back()->with('alert', 'Update review spoil thành công');
    }

    public function editSlide(){
        if (\Auth::user() && \Auth::user()->role == 1) {
            $slides = \DB::table('slide')->get();
            return view('admin.slide',compact('slides'));
        }
        abort(403, 'Access denied! You don’t have permission to access / on this server.');
    }

    public function updateSlide(Request $request){
        for ($i=1; $i < 5; $i++) {
            $path = '';
            if ($request->file('slide'.$i)) {
                $file = $request->file('slide'.$i);
                $fileName = $file->getClientOriginalName();
                $image = 'uploads/slide/'.$fileName;
                $path = 'uploads/slide';
                $file = $file->move($path, $fileName);
                \DB::table('slide')->where('slide_id', $i)->update(['url' => $image]);              
            }
        }
        return redirect()->back()->with('alert', 'Cập nhật slide thành công');
    }
}
