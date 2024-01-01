<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tenuser = $request->input('ten_user');
        $vaitro = $request->input('vai_tro');
        $user = User::orderBy('id','DESC')->search($tenuser, $vaitro)->get();
        return view('admin.nguoidung.user')->with(compact('user','tenuser','vaitro'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'sdt' => 'required',
            'password' => 'required',
            'diachi' => 'required',
            'vaitro' => 'required',
            // 'role'=> 'required',
        ],
        [
            'name.required' => 'Tên người dùng không được bỏ trống.',
            'email.required' => 'Email không được bỏ trống.',
            'email.unique' => 'Email đã tồn tại trong hệ thống.',
            'password.required' => 'Mật khẩu không được bỏ trống.',
            'vaitro.required' => 'Vai trò không được bỏ trống.',
            'sdt.required' => 'Số điện thoại không được bỏ trống.',
            'diachi.required' => 'Địa chỉ không được bỏ trống.',
        ]
    );    
       $data = $request->all();
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->sdt = $data['sdt'];
        $user->password = $data['password'];
        $user->diachi = $data['diachi'];
        $user->vaitro = $data['vaitro'];
        // $user->role = $data['role'];
        $user->save();
        $notification = array(
            'message' => 'Thêm người dùng thành công.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
       // return redirect()->back()->with('status','Thêm nguoi dung thành công');//trả về trang mà bn đã gửi dữ liệu cho database
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('admin.nguoidung.sua')->with(compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'sdt' => 'required',
            'diachi' => 'required',
            'vaitro' => 'required',
        ],
        [
            'name.required' => 'Tên người dùng không được bỏ trống.',
            'vaitro.required' => 'Vai trò không được bỏ trống.',
            'sdt.required' => 'Số điện thoại không được bỏ trống.',
            'diachi.required' => 'Địa chỉ không được bỏ trống.',
        ]
    );    
       $data = $request->all();
        $user =  User::find($id);
        $user->name = $data['name'];
       // $user->email = $data['email'];
        $user->sdt = $data['sdt'];
      //  $user->password = $data['password'];
        $user->diachi = $data['diachi'];
        $user->vaitro = $data['vaitro'];
        // $user->role = $data['role'];
        $user->save();
        $notification = array(
            'message' => 'Cập nhật thông tin người dùng thành công.',
            'alert-type' => 'success'
        );
        return redirect('admin/user')->with($notification); //trả về trang mà bn đã gửi dữ liệu cho database
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
        $notification = array(
            'message' => 'Xóa người dùng thành công.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
