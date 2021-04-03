<!DOCTYPE html>
<html>

<head>
    <title>NTG Hub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css" media="all" />

</head>

<body>


  <section class="w3l-workinghny-form">

    <div class="workinghny-form-grid">
      <div class="wrapper">
        <div class="logo">
          <h1><a class="brand-logo" href="index.html"><span>NTG Hub<br/></span> Customer Relationship Management</a></h1>

        </div>
        <div class="workinghny-block-grid">
          <div class="workinghny-left-img align-end">
            <img src="images/2.png" class="img-responsive" alt="img" />
          </div>
          <div class="form-right-inf">

            <div class="login-form-content">
              <form action="{{ route('login') }}" class="signin-form" method="post">
                @csrf
                <div class="one-frm">

                 <label>Name</label>
                 <input type="text" name="username"  placeholder="" required="">
               </div>
               <div class="one-frm">
                 <label>Password</label>
                 <input type="password" name="password"  placeholder="" required="">
               </div>
               <button class="btn btn-style mt-3">Sign In </button>
             </form>
           </div>
         </div>
       </div>
     </div>
   </div>

   <div class="copyright text-center">
    <div class="wrapper">
      <p class="copy-footer-29">© <?php echo date("Y"); ?> NTG International Sdh Bhd. All rights reserved | Design by NTG Hub</p>
    </div>
  </div>
</section>

</body>

</html>
