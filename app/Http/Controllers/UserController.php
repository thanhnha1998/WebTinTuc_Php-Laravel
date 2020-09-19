<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Comment;


class UserController extends Controller
{
    public function getDanhSach(){
        $user=User::all();
    	return view('admin.user.danhsach',['user'=>$user]);
    }
    public function getThem(){
        return view('admin.user.them');        
    }
    public function postThem(Request $request){
    	$this->validate($request,[
            'name'=>'required|min:3',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:3|max:35',
            'passwordAgain'=>'required|same:password'
        ],[
            'name.required'=>'Bạn chưa nhập tên người dùng',
            'name.min'=>'Tên người dùng quá ngắn',
            'email.required'=>'Bạn chưa nhập email',
            'email.email'=>'Chưa nhập đúng định dạng email',
            'email.unique'=>'Email đã tồn tại',
            'password.required'=>'Bạn chưa nhập mật khẩu',
            'password.min'=>'Mật khẩu quá ngắn',
            'password.max'=>'Mật khẩu quá dài',
            'passwordAgain.required'=>'Bạn chưa nhập lại mật khẩu',
            'passwordAgain.same'=>'Mật khẩu nhập lại không đúng'

        ]);
        $user=new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=$request->password;
        $user->quyen=$request->quyen;
        $user->save();
        return redirect('admin/user/them')->with('thongbao','Thêm thành công');
    }


    public function getSua($id){
       $user= User::find($id);
       return view('admin.user.sua',['user'=>$user]);
    }
    public function postSua(Request $request,$id){
    	$this->validate($request,[
            'name'=>'required|min:3',
            
        ],[
            'name.required'=>'Bạn chưa nhập tên người dùng',
            'name.min'=>'Tên người dùng quá ngắn'

        ]);
        $user=User::find($id);
        $user->name=$request->name;
        $user->quyen=$request->quyen;

        if($request->changePassword=="on"){
            $this->validate($request,[
            'password'=>'required|min:3|max:35',
            'passwordAgain'=>'required|same:password'
        ],[
            'password.required'=>'Bạn chưa nhập mật khẩu',
            'password.min'=>'Mật khẩu quá ngắn',
            'password.max'=>'Mật khẩu quá dài',
            'passwordAgain.required'=>'Bạn chưa nhập lại mật khẩu',
            'passwordAgain.same'=>'Mật khẩu nhập lại không đúng'

        ]);
            $user->password=bcrypt($request->password);
        }
        $user->save();
        return redirect('admin/user/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getXoa($id){
    	$user=User::find($id);
        $comment = Comment::where('idUser',$id);
        $comment->delete();
        $user->delete();
        
        return redirect('admin/user/danhsach')->with('thongbao','Xóa người dùng thành công');
    }  

    public function getDangNhapAdmin(){
        return view('admin.login');
    } 
    public function postDangNhapAdmin(Request $request){
        $this->validate($request,[
            'email'=>'required',
            'password'=>'required',
            
        ],[
            'email.required'=>'Bạn chưa nhập Email',
            'password.required'=>'Bạn chưa nhập Password',
        ]);
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect('admin/theloai/danhsach');
        }
        else{
            return redirect('admin/dangnhap')->with('thongbao','Email hoặc mật khẩu không đúng, vui lòng đăng nhập lại');
        }
    }
    public function getDangXuatAdmin(){
        Auth::logout();
         return redirect('admin/dangnhap');
    }
}
