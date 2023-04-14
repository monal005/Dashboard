
<!DOCTYPE html>
<html lang="en">
<head>
  {{-- <title>{{$title}}</title> --}}
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
   <!--fontawesome-->
   @yield('head-css')

@include('layouts.header')
</head>
<body>
  <header class="page-header">
    <div class="custom-container">
      <div class="row">
          <div class="col-md-6">
              <div class="header-left">
                  <div class="logo">
                    <img src="{{asset('assets/images/logo.svg')}}">
                  </div>
                  <div class="side-nav">
                     <img src="{{asset('assets/images/side-nav.svg')}}">
                  </div>
                  <div class="header-home">
                     <a href="#"><span><img src="{{asset('assets/images/home-ic.svg')}}"></span></a>
                  </div>
              </div>
          </div>
          <div class="col-md-6">
              <div class="header-right">
                <div class="form-group">
                  <input type="text" name="" placeholder="Search…">
                  <img src="{{asset('assets/images/search-btn.svg')}}">
                </div>
                <div class="notebook">
                  <a href="{{url('/logout')}}"><span><img src="{{asset('assets/images/book.svg')}}"></span></a>
                </div>
                  <div class="notification">
                   <a href="#"><span><img src="{{asset('assets/images/bell.svg')}}"></span><label></label></a>
                </div>
              </div>
          </div>
      </div>
    </div>
  </header>

  <div class="dashboad-page">
    <div class="custom-container">
        <div class="dashboad-page-wrapper">
              {{-- start left side bar --}}
            <div class="left-bar">
                <div class="nav-bar">
                    <ul>
                        <li class=""><a href="{{url('/dashboard')}}"><img src="{{asset('assets/images/home-ic.svg')}}">Home</a></li>
                        <li class="active"><a href="{{route('view.show')}}"><img src="{{asset('assets/images/about.svg')}}">Posts</a></li>
                        <li><a href="{{url('/blogs')}}"><img src="{{asset('assets/images/session.svg')}}">Blogs</a></li>
                        <li><a href="#"><img src="{{asset('assets/images/artist.svg')}}">Articles</a></li>
                        <li><a href="#"><img src="{{asset('assets/images/wallet.svg')}}">Wallet</a></li>
                        <li><a href="#"><img src="{{asset('assets/images/payment.svg')}}">Saved Payment</a></li>
                        <li><a href="#"><img src="{{asset('assets/images/gift.svg')}}">Refer a friend</a></li>
                        <li><a href="#"><img src="{{asset('assets/images/notification.svg')}}">Notifications</a></li>
                        <li><a href="#"><img src="{{asset('assets/images/fund.svg')}}">Request Refund</a></li>
                        <li><a href="#"><img src="{{asset('assets/images/faq.svg')}}">FAQ</a></li>
                        <li><a href="#"><img src="{{asset('assets/images/service.svg')}}">Terms Of Services</a></li>
                        <li><a href="#"><img src="{{asset('assets/images/privacy.svg')}}">Privacy Policy</a></li>
                        <li><a href="#"><img src="{{asset('assets/images/about.svg')}}">About Us</a></li>
                        <li><a href="#"><img src="{{asset('assets/images/set.svg')}}">Account Settings</a></li>
                    </ul>
                </div>
                <div class="user-account">
                    <img src="{{asset('assets/images/account.png')}}">
                    <div class="user-account-left">
                        <h6>Welcome</h6>
                        <h3>Marry Castle</h3>
                    </div>
                </div>
            </div>
            {{-- end left side bar --}}
            {{-- Data table starts --}}

            @yield('content')

        </div>

    </div>
</div>




@include('layouts.footer')

<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".side-nav").click(function(){
            $(".dashboad-page").toggleClass("open");
        });
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    });
    function sweetAlert(title = 'sadf', text = 'ads', icon = 'success') {
        swal({
            title: title,
            text: text,
            icon: icon,
        });
    }
    </script>
@yield('sectipe')

</body>
</html>
