<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no,target-densityDpi=device-dpi">
    <title>Popsocial</title>

    <link rel="stylesheet" href="css/bootstrap.css"/>

    <link rel="stylesheet" href="css/managerMain.css"/>
    <link rel="stylesheet" href="css/managerMain_890px.css"/>
    <link rel="stylesheet" href="css/managerMain_715px.css"/>

    <link rel="stylesheet" href="css/loginMain.css"/>

    <script src="js/jquery-3.4.0.min.js"></script>
    <?php API_URL() ?>
</head>
<body>

<div class="top"></div>

<div class="content">
    <img src="img/logo.png" class="login-logo">
    <h5>Seja Bem-vindo(a)!</h5>
    <div class="slide">
        <h3 id="login" class="title selected">Login</h3>
        <h3 id="signup" class="title">Cadastrar-se</h3>
    </div>
    <div class="formContainer">
        <div class="loginContainer">
            <h3 class="title">Login</h3>

            <form>
                <div class="form-group">
                    <label for="txtUser">Usuário:</label>
                    <input type="text" class="form-control form-control-sm" id="txtUser" placeholder="Usuário">
                </div>
                <div class="form-group">
                    <label for="txtPassword">Senha:</label>
                    <input type="password" class="form-control form-control-sm" id="txtPassword" placeholder="Senha">
                    <div class="invalid-feedback">
                        Usuário ou senha incorretos, por favor tente novamente.
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" id="btnLogin">Entrar</button>
            </form>
        </div>
        <div class="signupContainer">
            <h3 class="title">Cadastrar</h3>

            <form>
                <div class="form-group">
                    <label for="txtEmail">Email:</label>
                    <input type="email" class="form-control form-control-sm" id="txtEmail"
                           placeholder="exemplo@exemplo.com">
                </div>
                <div class="form-group">
                    <label for="txtUserCad">Usuário:</label>
                    <input type="text" class="form-control form-control-sm" id="txtUserCad" placeholder="Usuário">
                </div>
                <div class="form-group">
                    <label for="txtPasswordCad">Senha:</label>
                    <input type="password" class="form-control form-control-sm" id="txtPasswordCad" placeholder="Senha">
                </div>
                <div class="form-group">
                    <label for="txtPasswordRepeat">Repita a senha:</label>
                    <input type="password" class="form-control form-control-sm" id="txtPasswordRepeat"
                           placeholder="Repita a senha">
                </div>
                <button type="submit" class="btn btn-primary" id="btnSingup">Cadastrar</button>
            </form>
        </div>
    </div>


</div>
<div class="footer">
    &copy; 2019 · Popsocial. Todos os direitos reservados.
</div>

<script>
    $(function () {
        let loginContainer = $(".loginContainer"),
            signupContainer = $(".signupContainer"),
            login = $("#login"),
            signup = $("#signup");


        login.click(function () {
            login.addClass("selected");
            signup.removeClass("selected");

            loginContainer.css({"left": "2.5vw", "opacity": 1});
            signupContainer.css({"left": "100%", "opacity": 0});
        });

        signup.click(function () {
            signup.addClass("selected");
            login.removeClass("selected");

            loginContainer.css({"left": "-100%", "opacity": 0});
            signupContainer.css({"left": "2.5vw", "opacity": 1});
        });
    });
</script>
<script src="js/helper.js"></script>
<script src="js/loginDataControl.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
      integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</body>
</html>
