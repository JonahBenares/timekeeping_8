
<style type="text/css">
    @import url('https://fonts.googleapis.com/css?family=Nunito:300');
 body {
     margin: 0;
     padding-bottom: 20px;
     font-family: 'Nunito', sans-serif;
     color: white;
     background: #85bdd0;
}
 .section {
     padding: 1rem;
}
 .header {
     position: relative;
     text-align: center;
}
 .header__text {
     position: relative;
     padding: 3rem 0 3rem;
}
 .header__text > h1 {
     margin: 0;
     font-size: 2.5rem;
}
 .header > .trapezoid {
     position: absolute;
     top: 0;
     left: 0;
     width: 100%;
     height: 100%;
     background-position: top center;
     background-attachment: fixed;
}
 form {
     margin: 0 auto;
     max-width: 16rem;
     overflow: auto;
}
 form > * + * {
     margin-top: 1rem;
}
 form > input {
     border: 0;
     border-bottom: 1px solid white;
     border-radius: 0;
     width: 100%;
     height: 2rem;
     padding: 0 0 0.25rem 0;
     font-size: 1rem;
     color: white;
     background: #85bdd0;
}
 form > input:focus {
     outline: none;
}
 form > input::placeholder {
     color: white;
}
.submit {
     margin-top: 2rem;
     border: 0;
     border-radius: 200px;
     width: 100%;
     padding: 0.85rem;
     font-size: 1rem;
     color: #85bdd0;
     background: white;
}
 .submit:focus {
     outline: none;
}
 form > p {
     margin: 1rem 0 0;
     text-align: center;
     color: white;
}
 .sign-up {
     display: none;
}
 .opposite-btn1, .opposite-btn2 {
     cursor: pointer;
}
</style>
<div class="wrapper">
  
  <!--  Header  -->
  <header class="section header">
    <div class="trapezoid"></div>
    
    <div class="header__text">
      <h2 style="margin:0px;letter-spacing: 3px;font-weight: 900">CENPRI</h2>
      <h1 style="margin:0px;letter-spacing: 3px">TIMEKEEPING SYSTEM</h1>
    <!--   <p>Sign in or create a new account.</p> -->
    </div>
  </header>

    <!--  Sign Up  -->
    <section class="section sign-up">
      <div class="trapezoid"></div>
      <form action="">
        <input type="text" name="name" placeholder="Name">
        <input type="text" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="confirm" placeholder="Confirm Password">
        <button>Create Account</button>
        <p class="opposite-btn2">Already have an account?</p>
      </form>
    </section>
    
    <!--  Sign In  -->
    <section class="section sign-in">
      <form method="POST" action="login.php">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input class="submit" type ="submit" name="login_time" value="Sign In">
        <p class="">Don't have an account? Contact IT Department.</p>
      </form>
    </section>
</div>