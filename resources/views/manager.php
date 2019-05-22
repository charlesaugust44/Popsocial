<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no,target-densityDpi=device-dpi">
    <title>Popsocial</title>

    <link rel="stylesheet" href="<?php asset("css/bootstrap.css") ?>"/>

    <link rel="stylesheet" href="<?php asset("css/managerMain.css") ?>"/>
    <link rel="stylesheet" href="<?php asset("css/managerMain_1024px.css") ?>"/>
    <link rel="stylesheet" href="<?php asset("css/managerMain_890px.css") ?>"/>
    <link rel="stylesheet" href="<?php asset("css/managerMain_715px.css") ?>"/>

    <script src="<?php asset("js/jquery-3.4.0.min.js") ?>"></script>
    <?php API_URL(); ?>

    <style>
        .categoryTitle {
            color: #585858;
            margin: 1rem;
            padding-bottom: 1rem;
            font-size: 1.1rem;
            font-weight: bold;
            width: calc(100% - 2rem);
            border-bottom: solid 1px #e4e4e4;
        }

        .categoryTitle i {
            color: #6600ff;
            font-size: 1.1rem;
            margin-right: .6rem;
        }
    </style>

</head>
<body>

<div class="top">
    <div class="topContainer">
        <img class="logo" src="<?php asset("img/logo-w.png") ?>">
        <div class="topBarContainer">
            <div class="dropdown" id="accountDropdown">
                <img class="userPhoto" src="<?php asset("img/user.jpg") ?>">
                <div class="dropdownContent">
                    <div class="arrow"></div>
                    <div class="title">
                        <?php echo $manager['user']->name ?>
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
                <div>
                    <?php echo $manager['processingQuantity'] ?>
                </div>
                <div>PROCESSANDO</div>
            </div>
            <div class="statusBox totalServices">
                <div>
                    <?php echo $manager['doneQuantity'] ?>
                </div>
                <div>CONCLUIDOS</div>
            </div>
            <div class="statusBox balance">
                <div>
                    <?php money($manager['user']->credit) ?>
                </div>
                <div>SALDO</div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <?php require fragment($content); ?>
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
