@extends('layouts.nothing')
@section('content')

<style>
html,
body {
  height: 100%;
}

body {
  display: -ms-flexbox;
  display: -webkit-box;
  display: flex;
  -ms-flex-align: center;
  -ms-flex-pack: center;
  -webkit-box-align: center;
  align-items: center;
  -webkit-box-pack: center;
  justify-content: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signup {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signup .checkbox {
  font-weight: 400;
}
.form-signup .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signup .form-control:focus {
  z-index: 2;
}
</style>


<body class="text-center">
<form class="form-signup">
    <h1 class="h3 mb-3 font-weight-normal">Sign Up</h1>

    <label for="inputName" class="sr-only">Name</label>
    <input type="text" id="inputName" class="form-control" placeHolder="Name" required autofocus>

    <label for="inputSurname" class="sr-only">Surbname</label>
    <input type="text" id="inputSurname" class="form-control" placeHolder="Surname" required autofocus>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="Password" required autofocus>
    <label for="inputPassword2" class="sr-only">Repeat Password</label>
    <input type="password" id="inputPassword2" class="form-control" placeholder="Repeat Password" required>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

    <script>
      var password = document.getElementById("inputPassword")
      , confirm_password = document.getElementById("inputPassword2");

      function validatePassword(){
        if(password.value != confirm_password.value) {
          confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
          confirm_password.setCustomValidity('');
        }
      }

      password.onchange = validatePassword;
      confirm_password.onkeyup = validatePassword;
    </script>
</form>
</body>
@endsection