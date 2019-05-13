<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no,target-densityDpi=device-dpi">
    <title>Popsocial</title>

    <link rel="stylesheet" href="css/bootstrap.css"/>

    <link rel="stylesheet" href="css/managerMain.css"/>
    <link rel="stylesheet" href="css/managerMain_1024px.css"/>
    <link rel="stylesheet" href="css/managerMain_890px.css"/>
    <link rel="stylesheet" href="css/managerMain_715px.css"/>

    <link rel="stylesheet" href="../../public/css/managerMain.css"/>
    <link rel="stylesheet" href="../../public/css/managerMain_1024px.css"/>
    <link rel="stylesheet" href="../../public/css/managerMain_890px.css"/>
    <link rel="stylesheet" href="../../public/css/managerMain_715px.css"/>

    <script src="js/jquery-3.4.0.min.js"></script>
</head>
<body>

<div class="top">
    <div class="topContainer">
        <img class="logo" src="img/logo-w.png">
        <div class="topBarContainer">
            <div class="dropdown" id="accountDropdown">
                <img class="userPhoto" src="img/user.jpg">
                <div class="dropdownContent">
                    <div class="arrow"></div>
                    <div class="title">
                        @aplicativo_nota1000
                    </div>
                    <div class="items">
                        <div class="dropdownItem">
                            <i class="fa fa-user-circle"></i> Minha Conta
                        </div>
                        <div class="dropdownItem">
                            <i class="fa fa-sign-out-alt"></i> Sair
                        </div>
                    </div>
                </div>
            </div>

            <div class="dropdown" id="alertsDropdown">
                <i class="alerts fas fa-bell "></i>

                <div class="dropdownContent">
                    <div class="arrow"></div>
                    <div class="title">
                        Alertas
                    </div>
                    <div class="alerts">
                        <div class="alert">
                            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis...</span>
                            <div class="timestamp">
                                22/08/2019 às 15:54
                            </div>
                        </div>

                        <div class="alert">
                            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis...</span>
                            <div class="timestamp">
                                22/08/2019 às 15:54
                            </div>
                        </div>

                        <div class="alert">
                            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis...</span>
                            <div class="timestamp">
                                22/08/2019 às 15:54
                            </div>
                        </div>

                        <div class="alert">
                            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis...</span>
                            <div class="timestamp">
                                22/08/2019 às 15:54
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="statusBoxContainer">
            <div class="statusBox processingServices">
                <div>2</div>
                <div>PROCESSANDO</div>
            </div>
            <div class="statusBox totalServices">
                <div>320</div>
                <div>CONCLUIDOS</div>
            </div>
            <div class="statusBox balance">
                <div>R$150.22</div>
                <div>SALDO</div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <import var="contentImport"></import>
</div>

<div class="footer">
    &copy; 2019 · Popsocial. Todos os direitos reservados.
</div>

<div class="backdrop"></div>

<script>
    $(function () {
        $("#alertsDropdown").click(function () {
            $("#accountDropdown .dropdownContent").removeClass("down");
            $("#alertsDropdown .dropdownContent").addClass("alertsDown");
            $(".backdrop").fadeIn(150);
        });

        $("#accountDropdown").click(function () {
            $("#alertsDropdown .dropdownContent").removeClass("alertsDown");
            $("#accountDropdown .dropdownContent").addClass("down");
            $(".backdrop").fadeIn(150);
        });

        $(".backdrop").click(function () {
            $(this).fadeOut(150);
            let dropdown = $(".dropdownContent");
            dropdown.removeClass("down");
            dropdown.removeClass("alertsDown");
        });
    });
</script>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
      integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</body>
</html>
