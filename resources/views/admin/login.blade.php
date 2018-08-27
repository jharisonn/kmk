<form action="{{route('admin_login')}}" method="post">
  {{csrf_field()}}
Username : <input name="username" type="text" />
password : <input name="password" type="password"  />
<input type="checkbox" name="remember" />Remember me
<button type="submit">Login</button>
</form>
