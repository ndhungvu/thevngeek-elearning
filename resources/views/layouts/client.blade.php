
<!DOCTYPE html>
<!--[if IE 8]><html class="ie ie8"> <![endif]-->
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!--> 
<html> <!--<![endif]-->
    <head>
    <!-- Basic -->
        <meta charset="utf-8">
        <title>Thevngeek Elearning</title>
        <meta name="Description" content=""/>
        <meta name="Keywords" content=""/>
        <style>
            .send18bg { background:#d6d6d6; width: 100%; margin:0 auto; padding: 20px 0 30px 0;}
            .send18bg h2 {color:#424242!important; text-align:center;}
            .send18bg p{color:#424242!important;padding:10px 0px 15px 0px!important; margin:0 auto; text-align:center!important;}
            @media(min-width:320px){.bgimage{background:none!important;} }
            @media(min-width:568px){.bgimage{background:none!important;} }
            @media(min-width:768px){.bgimage{background:none!important;} }
            .tutor-connect{background:#fff url(/assets/client/theme/images/fabric-of-squares.png) repeat center center!important; padding:10px 0px; border-top:2px solid #024622; border-bottom:2px solid #B7B5B5;}
            .fa-briefcase:before {content:"\f0b1"; font-family:'FontAwesome'; font-style:normal; font-weight:normal; font-size:100%;}
            .fa-icons{font-size:120%; color:#4F4F42; position:relative; top:3px; padding:0px 10px 0px 0px;}
        </style>
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=yes">
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="website" />
        <meta property="fb:app_id" content="471319149685276" />
        <meta property="og:site_name" content="www.tutorialspoint.com" />
        <meta name="robots" content="index, follow"/>
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="author" content="tutorialspoint.com">
      
        <link rel="stylesheet" href="{{ asset('assets/client/theme/css/style-min.css?v=2') }}">
        <!-- Head Libs -->
        <!--[if IE 8]>
        <link rel="stylesheet" href="{{ asset('assets/client/theme/css/ie8.css') }}">

        <![endif]-->
        <link rel="stylesheet" href="{{ asset('assets/client/theme/css/flags.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/client/theme/css/common.css') }}">

        <script src="{{ asset('assets/client/theme/js/script-min-v4.js') }}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <script src="{{ asset('assets/client/theme/js/bootstrap.min.js') }}"></script>

        <style>
            
        </style>
        <script>
          $(document).ready(function() {
              $('input[name="q"]').keydown(function(event){
                  if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                  }
              });
          });
        </script>
    </head>
    <body>
        <!-- HEADER -->             
        @include('layouts.partials.client.header')
        <!-- END HEADER -->

        <div style="clear:both;"></div> 
        <!-- Content -->
        <div class="wp-content">
             @yield('content')
        </div>
        <!-- End Content -->                
        <!--Login-->
        <div id="modal-login" class="modal">
            <div class="modal-content w-700">
                <div class="modal-header">
                    <span class="close jsClose">&times;</span>
                    <h2 class="center title">Login</h2>
                </div>
                <div class="container w-100-percent main-login">
                    <div class="col-md-12">
                        <div class="F-left">
                            <form>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" id="" placeholder="Password">
                                </div>
                                <div class="checkbox">
                                    <input id="c-login03" type="checkbox" name="remember" value="0">
                                    <label for="c-login03">Remember Me</label>
                                </div>
                                <button type="submit" id="submit">Login</button> </form>
                                <a href="#">Forgot password?</a>
                        </div>
                        <div class="line-center">
                            <div class="line">
                                <span>OR</span>
                            </div>
                        </div>
                        <div class="F-right">
                            <a href="#" class="button" id="login-facebook">
                                <img src="/assets/client/theme/images/facebook.png">
                                <span class="text-center">Login by Facebook</span>
                            </a>
                            <a href="#" class="button" id="login-google">
                                <img src="/assets/client/theme/images/google-plus.png">
                                <span class="text-center">Login by Google+</span>
                            </a>
                            <a href="#" class="button" id="login-twitter">
                                <img src="/assets/client/theme/images/twitter.png">
                                <span class="text-center">Login by Twitter</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Login-->

        <!--Sign Up-->
        <div id="modal-singup" class="modal">
            <div class="modal-content w-700">
                <div class="modal-header">
                    <span class="close jsClose">&times;</span>
                    <h2 class="center title">Sign Up</h2>
                </div>
                <div class="container w-100-percent main-login">
                    <div class="col-md-12">
                        <div class="F-left">
                            <form>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" id="" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Confirm Password</label>
                                    <input type="password" class="form-control" id="" placeholder="Password">
                                </div>
                                <button type="submit" id="submit">Sign up</button> </form>
                        </div>
                        <div class="line-center">
                            <div class="line">
                                <span>OR</span>
                            </div>
                        </div>
                        <div class="F-right">
                            <a href="#" class="button" id="login-facebook">
                                <img src="/assets/client/theme/images/facebook.png">
                                <span class="text-center">Login by Facebook</span>
                            </a>
                            <a href="#" class="button" id="login-google">
                                <img src="/assets/client/theme/images/google-plus.png">
                                <span class="text-center">Login by Google+</span>
                            </a>
                            <a href="#" class="button" id="login-twitter">
                                <img src="/assets/client/theme/images/twitter.png">
                                <span class="text-center">Login by Twitter</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Sing up-->
        
        <!-- FOOTER -->             
        @include('layouts.partials.client.footer')
        <!-- END FOOTER -->
        <script src="{{ asset('assets/client/theme/js/custom-min.js') }}"></script>
        <script src="{{ asset('assets/client/theme/js/jquery.flagstrap.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#language').flagStrap({
                    countries: {
                        "VN": "VietNam",
                        "GB": "English",
                    },
                    
                    placeholder: false
                });
                modalPopup(document.getElementById('modalLogin'), document.getElementById('modal-login'));
                modalPopup(document.getElementById('modalSignUp'), document.getElementById('modal-singup'));
            })
        </script>
    </body>
</html>

