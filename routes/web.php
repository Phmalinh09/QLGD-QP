<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChuyenvienController;
use App\Http\Controllers\KhoaController;
use App\Http\Controllers\KhoahocController;
use App\Http\Controllers\NganhController;
use App\Http\Controllers\LopController;
use App\Http\Controllers\GiangvienController;
use App\Http\Controllers\SinhvienController;
use App\Http\Controllers\DothocController;
use App\Http\Controllers\PhanphongController;
use App\Http\Controllers\PhanxeController;
use App\Http\Controllers\PhandotController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PhangiangvienController;
use App\Http\Controllers\ChuyenvienPhongController;
use App\Http\Controllers\PhongController;
use App\Http\Controllers\ChuyenvienPhanphongController;
use App\Models\Phangiangvien;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('admin.user.login');
});
//Route::post('admin/auth',[AdminController::class,'auth'])->name('admin.auth');

Route::group(['prefix' => 'chuyenvien'], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/login', [ChuyenvienController::class, 'index'])->name('chuyenvien.login');
        Route::post('/authenticate', [ChuyenvienController::class, 'authenticate'])->name('chuyenvien.authenticate');
        Route::get('/forgot-password', [ChuyenvienController::class, 'forgotpassword'])->name('chuyenvien.forgot-password');
        Route::post('/forgot-passwords', [ChuyenvienController::class, 'forgotpasswords'])->name('chuyenvien.forgot-passwords');
        Route::get('/password/reset/{token}', [ChuyenvienController::class, 'reserPassword'])->name('chuyenvien.reset-password');
        Route::post('/reset-password-handler', [ChuyenvienController::class, 'resetPasswordHandler'])->name('chuyenvien.reset-password-handler');
    });
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/tongquan', [ChuyenvienController::class, 'tongquan1'])->name('chuyenvien.tongquan');
        Route::get('/profile', [ChuyenvienController::class, 'profile'])->name('chuyenvien.profile');
        Route::get('edit/profile', [ChuyenvienController::class, 'editprofile'])->name('chuyenvien.edit.profile');
        Route::post('/update-password', [ChuyenvienController::class, 'updatepassword'])->name('chuyenvien.update-password');
        Route::get('/logout', [ChuyenvienController::class, 'logout'])->name('chuyenvien.logout');
        Route::post('/store/profile', [ChuyenvienController::class, 'storeprofile'])->name('chuyenvien.store.profile');

        Route::resource('/cvphanphong', ChuyenvienPhanphongController::class);
        Route::resource('/cvphong', ChuyenvienPhongController::class);
        Route::delete('/cvxoa-phong-o', [ChuyenvienPhongController::class, 'cvxoaPhongo'])->name('cvxoa-phong-o');
        Route::delete('/cvxoa-phan-phong-o', [ChuyenvienPhanphongController::class, 'cvxoaPhanphong'])->name('cvxoa-phan-phong-o');
        Route::get('/cvxem-dothoc/{id}', [SinhvienController::class, 'cvxem_dothoc'])->name('chuyenvien.xem-dothoc');

        Route::post('/get-Dothoc', [PhandotController::class, 'getDothoc'])->name('get-Dothoc');
        Route::post('/get-Gioitinh', [PhanphongController::class, 'getGioitinh'])->name('get-Gioitinh');
    });
});


Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('/login', [AdminController::class, 'index'])->name('admin.login');
        Route::post('/authenticate', [AdminController::class, 'authenticate'])->name('admin.authenticate');
        Route::get('/forgot-password', [AdminController::class, 'forgotpassword'])->name('admin.forgot-password');
        Route::post('/forgot-passwords', [AdminController::class, 'forgotpasswords'])->name('admin.forgot-passwords');
        Route::get('/password/reset/{token}', [AdminController::class, 'reserPassword'])->name('admin.reset-password');
        Route::post('/reset-password-handler', [AdminController::class, 'resetPasswordHandler'])->name('admin.reset-password-handler');
    });
    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('/tongquan', [AdminController::class, 'tongquan'])->name('admin.tongquan');
        //  Route::get('/chuyen-vien', [AdminController::class, 'tongquan1'])->name('admin.chuyen-vien');
        // Route::get('admin/tongquan', [AdminController::class, 'tongquan']);
        Route::resource('/user', UserController::class);
        Route::resource('/khoa', KhoaController::class);
        Route::resource('/khoahoc', KhoahocController::class);
        Route::resource('/nganh', NganhController::class);
        Route::resource('/lop', LopController::class);
        Route::resource('/giangvien', GiangvienController::class);
        Route::resource('/sinhvien', SinhvienController::class);
        Route::resource('/dothoc', DothocController::class);
        Route::resource('/phandot', PhandotController::class);
        Route::resource('/phanphong', PhanphongController::class);
        Route::resource('/phanxe', PhanxeController::class);
        Route::resource('/phangiangvien', PhangiangvienController::class);
        Route::resource('/phong', PhongController::class);
        // Route::resource('admin/khoa', KhoaController::class);
        // Route::resource('admin/khoahoc', KhoahocController::class);
        // Route::resource('admin/nganh', NganhController::class);
        // Route::resource('admin/nienkhoa', NienkhoaController::class);
        // Route::resource('admin/lop', LopController::class);
        // Route::resource('admin/hoidong', HoiDongController::class);
        // Route::resource('admin/giangvien', GiangvienController::class);
        // Route::resource('admin/sinhvien', SinhvienController::class);
        // Route::resource('admin/dothoc', DothocController::class);
        // Route::resource('admin/phandot', PhandotController::class);
        // Route::resource('admin/phanphong', PhanphongController::class);
        // Route::resource('admin/phanxe', PhanxeController::class);

       // Route::get('/getDothoc/{id}', [PhandotController::class, 'getDotHoc']);

        // Route::get('getLopkhoa', function ( $request) {
        //     $khoaId = $request->input('khoa_id');
        //     $lops = App\Models\LopModel::where('khoa_id',$khoaId)->get();
        //     return response()->json($lops);
        // });

        // Route::get('/get-lops', function (Request $request) {
        //     $khoaIds = $request->input('khoas', []);
        //     $lopss = App\Models\LopModel::whereIn('khoa_id', $khoaIds)->get();


        //     return response()->json($lopss);
        // });
        Route::delete('/xoa-phan-giang-vien', [PhangiangvienController::class, 'xoaPhangiangvien'])->name('xoa-phan-giang-vien');
        Route::post('/phan-dot-tong-sinh-vien', 'PhandotController@getTongSinhVien');
        Route::post('/get-Lopkhoa', [PhandotController::class, 'getLopkhoa'])->name('get-Lopkhoa');
        Route::post('/get-Dothoc', [PhandotController::class, 'getDothoc'])->name('get-Dothoc');
        
        Route::post('/get-Dothoctk', [PhandotController::class, 'getDothoctk'])->name('get-Dothoctk');
        Route::post('/get-Gioitinh', [PhanphongController::class, 'getGioitinh'])->name('get-Gioitinh');
        Route::post('/get-Giaovien', [PhangiangvienController::class, 'getGiaovien'])->name('get-Giaovien');
        Route::post('/get-Soxe', [PhangiangvienController::class, 'getSoxe'])->name('get-Soxe');

        Route::post('/get-Nganh', [LopController::class, 'getNganh'])->name('get-Nganh');
        Route::post('/get-Lop', [LopController::class, 'getLop'])->name('get-Lop');


        Route::delete('/xoa-phan-xe', [PhandotController::class, 'xoaPhandothoc'])->name('xoa-phan-dot-hoc');
        Route::delete('/xoa-lop', [LopController::class, 'xoaLop'])->name('xoa-lop');
        Route::post('/lop/delete-select', [LopController::class, 'delete_select']);
        Route::delete('/xoa-dot-hoc', [DothocController::class, 'xoaDothoc'])->name('xoa-dot-hoc');
        Route::delete('/xoa-phan-dot-hoc', [PhanxeController::class, 'xoaPhanxe'])->name('xoa-phan-xe');
        Route::delete('/xoa-phong-o', [PhongController::class, 'xoaPhongo'])->name('xoa-phong-o');
        Route::delete('/xoa-phan-phong-o', [PhanphongController::class, 'xoaPhanphong'])->name('xoa-phan-phong-o');
        // Route::get('/them-sinhvien/{id}', [SinhvienController::class, 'them_sinhvien'])->name('them-sinhvien');
        Route::delete('/xoa-sinhvien', [SinhvienController::class, 'xoaSinhvien'])->name('xoa-sinhvien');
        Route::get('/xem-dothoc/{id}', [SinhvienController::class, 'xem_dothoc'])->name('admin.xem-dothoc');
        Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
        Route::get('edit/profile', [AdminController::class, 'editprofile'])->name('admin.edit.profile');
        Route::post('/update-password', [AdminController::class, 'updatepassword'])->name('admin.update-password');
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');



    });
});
Route::post('store/profile', [AdminController::class, 'storeprofile'])->name('store.profile');
//Route::post('/update.password', [AdminController::class, 'updatepassword'])->name('update.password');
Route::post('/lay-ket-qua', 'PhandotController@layKetQua');
Route::post('import-lop', [LopController::class, 'import'])->name('lop.import');
Route::post('export-lop', [LopController::class, 'export'])->name('lop.export');
Route::post('export-maulop', [LopController::class, 'MauLopExport'])->name('maulop.export');
Route::post('export', [SinhvienController::class, 'export'])->name('sinhvien.export');
Route::post('import', [SinhvienController::class, 'import'])->name('sinhvien.import');
Route::post('export-mausinhvien', [SinhvienController::class, 'MauSinhvienExport'])->name('mausinhvien.export');
Route::post('/export-chitiet/{id}', [SinhvienController::class, 'export_chitiet'])->name('export-chitiet');
Route::post('/export-phanxe', [PhanxeController::class, 'export_phanxe'])->name('export-phanxe');
Route::get('/them-sinhvien/{id}', [SinhvienController::class, 'them_sinhvien'])->name('them-sinhvien');
// Route::get('/xem-dothoc/{id}', [SinhvienController::class, 'xem_dothoc'])->name('xem-dothoc');
Route::post('/trang-thai', [SinhvienController::class, 'trangthais']);

