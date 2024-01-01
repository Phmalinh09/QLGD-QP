<p>Gửi {{$admin->name}}</p>
<br>
<p>Mật khẩu của bạn trên hệ thống đã được thay đổi thành công.
    Dưới đây là thông tin đăng nhập mới của bạn:
    <br>
    <b>Thông tin đăng nhập: </b> {{ $admin->name}} - {{$admin->email}}
    <br>
    <b>Mật khẩu: </b>{{ $new_password}}
</p>