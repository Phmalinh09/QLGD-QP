<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use constDefaults;
use constGuards;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\Dothoc;
use App\Models\Giangvien;
use App\Models\Khoa;
use App\Models\Khoahoc;
use App\Models\LopModel;
use App\Models\Nhieugiangvien;
use App\Models\Nhieukhoa;
use App\Models\Nhieulop;
use App\Models\Phandot;
use App\Models\Phong;
use App\Models\Sinhvien;


class ChuyenvienController extends Controller
{
    public $current_password, $new_password, $new_password_confi;
    public function index(Request $request)
    {
        return view('chuyenvien.user.login');
    }
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->passes()) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
                $admin = Auth::user();
                if($admin->vaitro == 'Chuyên viên'){
                   return redirect()->route('chuyenvien.tongquan'); 
                } 
                else{
                    Auth::logout();
                    $notification = array(
                        'message' => 'Bạn không được cấp phép vào trang này.',
                        'alert-type' => 'error'
                    );
                    return redirect()->route('chuyenvien.login')->with($notification);
                }
                return redirect()->route('chuyenvien.tongquan');
            } else {
                $notification = array(
                    'message' => 'Thông tin đăng nhập không đúng.',
                    'alert-type' => 'error'
                );
                return redirect()->route('chuyenvien.login')->with($notification);
            }
        } else {
            return redirect()->route('chuyenvien.login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
            
        }
    }

    public function tongquan1(Request $request)
    {
        $dothoc = $request->input('dothocstk');
        $khoahoc = $request->input('khoahocstk');

        $phandot = Phandot::orderBy('id', 'DESC')->search($dothoc, $khoahoc)->get();
        $giangviens = Giangvien::orderBy('id', 'DESC')->where(['trangthai' => 0])->get();
        $lops = LopModel::orderBy('id', 'DESC')->get();
        $khoas = Khoa::orderBy('id', 'DESC')->get();
        //  $khoas = Khoa::pluck('tenkhoa', 'id');
        $khoahocs = Khoahoc::orderBy('id', 'DESC')->get();
        $dothocs = Dothoc::orderBy('id', 'DESC')->get();
        $lops = collect($lops); // Chuyển đổi kết quả truy vấn thành Laravel Collection
        $columns = $lops->chunk(15); // Chia nhỏ danh sách thành các phân đoạn có 6 item

        $soThuTu1 = 1;
        foreach ($phandot as $phandots) {
            $phandots->soThuTu1 = $soThuTu1;
            $soThuTu1++;
        }
        $sinhvienss = Sinhvien::all()->count();
        $lopss = LopModel::all()->count();
        $phongss = Phong::all()->count();
        $phandotss = Phandot::all()->count();

        return view('chuyenvien.tongquan1')->with(compact('dothoc','sinhvienss','lopss','phongss','phandotss','khoahoc','giangviens', 'dothocs', 'khoahocs', 'khoas', 'lops', 'phandot', 'columns'));
    }
    public function logout()
    {
        Auth::logout();
        $notification = array(
            'message' => 'Đăng xuất thành công.',
            'alert-type' => 'success'
        );
        return redirect()->route('chuyenvien.login')->with($notification);
    }
    public function profile()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('chuyenvien.user.profile', compact('adminData'));
    }
    public function editprofile()
    {
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('chuyenvien.user.editprofile', compact('editData'));
    }

    public function storeprofile(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;

        $data->ngaysinh = $request->ngaysinh;
        $data->sdt = $request->sdt;
        $data->diachi = $request->diachi;
        if ($request->file('hinhanh')) {
            $file = $request->file('hinhanh');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('upload/admin_image'), $filename);
            $data['hinhanh'] = $filename;
        }
        $data->save();
        $notification = array(
            'message' => 'Thay đổi mật khẩu thành công',
            'alert-type' =>'success'
        );
      //  session()->flash('success', 'Cap nhat thong tin thanh cong');
        return redirect()->route('chuyenvien.profile')->with($notification);
    }
    public function updatepassword(Request $request)
    {
        $validateData = $request->validate([
            'current_password' => [
                'required', function ($attibute, $value, $fail) {
                    if (!Hash::check($value, User::find(Auth::user()->id)->password)) {
                        return $fail(__('Mật khẩu hiện tại không chính xác'));
                    }
                }
            ],
            'new_password' => 'required|min:5',
            'new_password_confi' => 'required|same:new_password'
        ],[
            'current_password.required' =>'Mật khẩu cũ không được bỏ trống',
            'new_password.required' =>'Mật khẩu mới không được bỏ trống',
            'new_password.min' =>'Mật khẩu mới phải có chiều dài tối thiểu 5',
            'new_password_confi.required' =>'Xác nhận mật khẩu không được bỏ trống',
            'new_password_confi.same' =>'Xác nhận mật khẩu không khớp với mật khẩu mới',
        ]);

        //$hashedPassword = Auth::user()->password;
        $query = User::findOrFail(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        if (Hash::check($request->current_password, $query)) {
          //  $users = User::find(Auth::id());
            $query->password = bcrypt($request->new_password);
            $query->save();
            // session()->flash('status', 'Mật khẩu cập nhật thành công');
           $notification = array(
                'message' => 'Đã xảy ra lỗi',
                'alert-type' =>'error'
            );
            return redirect()->back()->with($notification);
        } else {
             $notification = array(
                'message' => 'Thay đổi mật khẩu thành công',
                'alert-type' =>'success'
            );
            
            return redirect()->back()->with($notification);
        }
    }
    public function forgotpassword()
    {
        return view('chuyenvien.user.forgot_password');
    }
    public function forgotpasswords(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.required' => 'Email không được bỏ trống.',
            'email.email' => 'Email không hợp lệ.',
            'email.exists' => 'Email không tồn tại trong hệ thống.'
        ]);
        $admin = User::where('email', $request->email)->first();
        $token = base64_encode(Str::random(64));
        $oldToken = DB::table('password_reset_tokens')
            ->where(['email' => $request->email, 'guard' => constGuards::ADMIN])->first();
        if ($oldToken) {
            //update token
            DB::table('password_reset_tokens')
                ->where(['email' => $request->email, 'guard' => constGuards::ADMIN])
                ->update([
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]);
        } else {
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'guard' => constGuards::ADMIN,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
        }
        $actionLink = route('chuyenvien.reset-password', ['token' => $token, 'email' => $request->email]);
        $data = array(
            'actionLink' => $actionLink,
            'admin' => $admin
        );
        $mail_body = view('chuyenvien.user.admin-forgot-email', $data)->render();
        $mailConfig = array(
            'mail_from_email' => env('MAIL_FROM_ADDRESS'),
            'mail_from_name' => env('MAIL_FROM_NAME'),
            'mail_recipient_email' => $admin->email,
            'mail_recipient_name' => $admin->name,
            'mail_subject' => 'Đặt lại mật khẩu',
            'mail_body' => $mail_body
        );
        if (sendEmail($mailConfig)) {
            session()->flash('success', 'Đã gửi liên kết đặt lại mật khẩu của bạn qua email.');
            return redirect()->route('chuyenvien.forgot-password');
        } else {
            session()->flash('fail', 'Đã xảy ra lỗi!');
        }
    }
    public function reserPassword(Request $request, $token = null)
    {
        $check_token = DB::table('password_reset_tokens')
            ->where(['token' => $token, 'guard' => constGuards::ADMIN])->first();
        if ($check_token) {
            $diffMins = Carbon::createFromFormat('Y-m-d H:i:s', $check_token->created_at)->diffInMinutes(Carbon::now());
            if ($diffMins > constDefaults::tokenExpiredMinutes) {
                session()->flash('fail', 'Mã thông báo đã hết hạn, yêu cầu liên kết khác.');
                return redirect()->route('chuyenvien.forgot-password', ['token' => $token]);
            } else {
                return view('chuyenvien.user.reset-password')->with(['token' => $token]);
            }
        } else {
            session()->flash('fail', 'Mã thông báo không hợp lệ, yêu cầu gửi lại liên kết khác  ');
            return redirect()->route('chuyenvien.forgot-password', ['token' => $token]);
        }
    }
    public function resetPasswordHandler(Request $request)
    {
        $request->validate([
            'new_password' => 'required|min:5|max:45|required_with:new_password_confi|same:new_password_confi',
            'new_password_confi' => 'required'
        ]);
        $token = DB::table('password_reset_tokens')->where(['token' => $request->token, 'guard' => constGuards::ADMIN])->first();
        $admin = User::where('email', $token->email)->first();

        User::where('email', $admin->email)->update([
            'password' => Hash::make($request->new_password)
        ]);
        DB::table('password_reset_tokens')->where([
            'email' => $admin->email,
            'token' => $request->token,
            'guard' => constGuards::ADMIN
        ])->delete();
        //gui email thong bao cho admin
        $data = array(
            'admin' => $admin,
            'new_password' => $request->new_password
        );
        $mail_body = view('chuyenvien.user.admin-reset-email', $data)->render();
        $mailConfig = array(
            'mail_from_email' => env('MAIL_FROM_ADDRESS'),
            'mail_from_name' => env('MAIL_FROM_NAME'),
            'mail_recipient_email' => $admin->email,
            'mail_recipient_name' => $admin->name,
            'mail_subject' => 'Mật khẩu đã thay đổi',
            'mail_body' => $mail_body
        );
        sendEmail($mailConfig);
        return redirect()->route('chuyenvien.login')->with('success', 'Xong! Mật khẩu của bạn đã được thay đổi.');
    }

    //     public function updatepassword(Request $request)
    //     {
    //     $request->validate([
    //         'current_password'=>[
    //             'required', function($attibute,$value,$fail){
    //                 if(!Hash::check($value,User::find(auth('admin')->id())->password)){
    //                     return $fail(__('Mat khau hien tai khong chinh xac'));
    //                 }
    //             }
    //         ],
    //         'new_password'=>'required|min:5|max:45|confirmed'
    //     ]);
    //     $query = User::findOrFail(auth('admin')->id())->update([
    //         'password'=>Hash::make($request->new_password)
    //     ]);
    //     if($query){
    //         $query->current_password = $query->new_password = $query->new_password_confi = null;
    //         session()->flash('success','Thay doi mat khau thanh cong');
    //     }else{
    //         session()->flash('error','Da xay ra loi');
    //     }
    // }
}
