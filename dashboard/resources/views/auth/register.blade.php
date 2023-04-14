<!DOCTYPE html>
<html lang="en">
<head>
  <title>Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  @include('layouts.header')
</head>
<body>
  <div class="login-page">
    <div class="login-left">
        <div class="login-logo">
            <img src="assets/images/logo.svg">
        </div>
        <div class="login-sktc wow fadeInLeft animate " style="animation-duration: 1s;">
          <img src="assets/images/login-left.png">
        </div>
    </div>
    <div class="login-right">
      <div class="login-right-inner wow pulse animate" style="animation-duration: 1s;">
      <h3>REGISTER</h3>
      <div class="other-logins">
        <a href="#"> <img src="assets/images/fb.svg">Login with Facebook</a>
        <a href="#"> <img src="assets/images/google.svg">Login with Google</a>
        <a href="#"> <img src="assets/images/apple.svg">Login with Apple</a>
      </div>
      <span class="or-brd">OR</span>
      <div class="login-from">
        <form method="post" action="{{url('/register')}}">
            @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Name </label>
                <input type="text" name="name" placeholder="">
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label>EMAIL </label>
                <input type="email" name="email" placeholder="">
              </div>
            </div>
            
            <div class="col-md-12">
              <div class="form-group">
                <label>PASSWORD</label>
                <input type="password" name="password" placeholder="">
                <img src="assets/images/eye.svg">
              </div>
            </div>
            <div class="col-md-12 forget-pass">
              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                  <label class="form-check-label" for="flexCheckDefault">
                   Remember Me
                  </label>
                </div>
                <a href="#">Forgot Password?</a>
              </div>
            </div>
              <div class="col-md-12">
              <div class="form-group">
                <button class="cm-btn"><span>Login</span></button>
              </div>
            </div>
        </div>
        <a class="al-linked" href="#">Signup</a>
        </form>
      </div>
      </div>
    </div>
  </div>

@include('layouts.footer')
<script>
new WOW().init();
</script>
</body>
</html>
