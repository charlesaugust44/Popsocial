<head>
    <meta charset="UTF-8">
</head>
<body>

<link rel="stylesheet" href="<?php asset("css/managerContent.css") ?>"/>
<link rel="stylesheet" href="<?php asset("css/managerContent_412px.css") ?>"/>

<div class="categoryTitle"><i class="fa fa-globe-americas"></i> Redes Sociais / Sites</div>
<div class="networksContainer">
    <div class="menuItem facebook" data-id="0">
        <div class="itemImage"></div>
        <span class="itemName">Facebook</span>
    </div>
    <div class="menuItem instagram" data-id="1">
        <div class="itemImage"></div>
        <span class="itemName">Instagram</span>
    </div>

    <div class="menuItem youtube" data-id="2">
        <div class="itemImage"></div>
        <span class="itemName">Youtube</span>
    </div>
    <div class="menuItem twitter" data-id="3">
        <div class="itemImage"></div>
        <span class="itemName">Twitter</span>
    </div>
    <div class="menuItem googlePlus" data-id="4">
        <div class="itemImage"></div>
        <span class="itemName">Google Plus</span>
    </div>
    <div class="menuItem soundcloud" data-id="5">
        <div class="itemImage"></div>
        <span class="itemName">Soundcloud</span>
    </div>
    <div class="menuItem traffic" data-id="6">
        <div class="itemImage"></div>
        <span class="itemName">Website</span>
    </div>
</div>

<div class="categoryTitle"><i class="fa fa-outdent"></i> Opções</div>
<div class="optionsContainer">
    <div class="menuItem addCredit">
        <div class="itemImage"></div>
        <span class="itemName">Add Saldo</span>
    </div>
    <div class="menuItem history">
        <div class="itemImage"></div>
        <span class="itemName">Histórico</span>
    </div>
    <div class="menuItem training">
        <div class="itemImage"></div>
        <span class="itemName">Treinamentos</span>
    </div>
    <div class="menuItem account">
        <div class="itemImage"></div>
        <span class="itemName">Conta</span>
    </div>
</div>

<script>
    $(function () {
        $(".networksContainer .menuItem").click(function (e) {
            let id = $(this).attr('data-id');
            window.location = "/client/network/" + id;
        });
    })
</script>
</body>