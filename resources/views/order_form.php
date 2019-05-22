<head>
    <meta charset="UTF-8">
</head>
<body>
<link rel="stylesheet" href="<?php asset("css/order_form.css") ?>"/>

<div class="categoryTitle">
    <i class="fab fa-instagram"></i> Instagram

    <div style="float: right;margin-top: -1.2rem;width: 8rem">
        <h6>Total por <span id="lblQuantity">0</span>:</h6>
        <h3 id="lblTotal">R$ 0,00</h3>
    </div>
</div>

<div class="formContainer">
    <form>
        <div class="form-group">
            <label for="type">Tipo de serviço:</label>
            <select class="form-control" id="type">
                <?php foreach ($types as $k => $type): ?>
                    <option value="<?php echo $type->id ?>" <?php echo ($k == 0) ? "selected" : "" ?>>
                        <?php echo $type->name ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="service">Serviço:</label>
            <select class="form-control" id="service" required></select>
        </div>

        <div class="form-group">
            <label for="quantity">Quantidade:</label>
            <input class="form-control" id="qtd" min="10" max="100" type="number">
            <input type="range" min="1" max="100" value="50" class="slide form-control" id="quantity" required>
            <small class="text-muted">Pedido mínimo: <i id="lblMin">200</i> &emsp; Pedido máximo: <i id="lblMax">500</i>
            </small>
        </div>

        <div class="form-group">
            <label for="link">Link:</label>
            <input class="form-control" id="link" min="0" max="1" type="url" required>
            <small class="text-muted">Insira o link completo como mostra no navegador, Ex:
                https://www.youtube.com/watch?v=RCmZliDQ-7c
            </small>
        </div>
    </form>
    <div class="details">
        <div class="cardContainer">
            <h3>Instagram</h3>
            <h3><span id="lblService">Nada selecionado!</span>
                <small><i class="fa fa-tag"></i></small>
            </h3>
            <h5 id="lblType"></h5>

            <br>
            <span>Preço por 1000:</span>
            <h5 id="lblByThousand">R$ 0,00</h5>
        </div>
        <button class="btn btn-success btn-lg">Confirmar</button>
    </div>
</div>

<script>
    let services = <?php echo json_encode($services) ?>;
    let selected = 0;

    $txtService = $("#service");
    $txtType = $("#type");
    $txtQuantity = $("#quantity");
    $txtQtd = $("#qtd");

    $lblService = $("#lblService");
    $lblType = $("#lblType");
    $lblQuantity = $("#lblQuantity");
    $lblTotal = $("#lblTotal");
    $lblByThousand = $("#lblByThousand");
    $lblMin = $("#lblMin");
    $lblMax = $("#lblMax");

    function money(value) {
        return "R$ " + (value.toFixed(2)).replace(".", ",");
    }

    function loadServices() {
        let id = $txtType.val();

        $txtService.html("");

        services.forEach((s, k) => {
            if (s.typeId == id)
                $txtService.append($("<option />").val(k).text(s.name));
        });


        let type = $txtType.val();

        $lblType.html($("#type option[value=" + type + "]").html());

        selectService(true);
    }

    function selectService() {
        selected = $txtService.val();

        $lblService.html(services[selected].name);
        if (services[selected].promotionPrice !== 0)
            $lblByThousand.html(money(services[selected].promotionPrice));
        else
            $lblByThousand.html(money(services[selected].thousandPrice));

        $lblMin.html(services[selected].min);
        $lblMax.html(services[selected].max);

        $txtQuantity.attr('min', services[selected].min);
        $txtQuantity.attr('max', services[selected].max);
        $txtQuantity.val(services[selected].min);
        calcQuantity();
    }

    function calcQuantity() {
        let q = $txtQuantity.val();
        let total, promo = services[selected].promotionPrice !== 0;

        if (promo)
            total = services[selected].promotionPrice / 1000 * q;
        else
            total = services[selected].thousandPrice / 1000 * q;

        $txtQtd.val(q);

        $lblQuantity.html(q + ((promo) ? " <small>(Promoção)</small>" : ""));
        $lblTotal.html(money(total));
    }

    function updateSlider() {
        let q = $txtQtd.val();

        if (q < services[selected].min)
            q = services[selected].min;
        else if (q > services[selected].max)
            q = services[selected].max;

        $txtQtd.val(q);
        $txtQuantity.val(q);
        calcQuantity();
    }

    $txtType.change(loadServices);
    $txtQuantity.on('input', calcQuantity);
    $txtQtd.change(updateSlider);
    $txtService.change(selectService);

    $(function () {
        loadServices();
    });
</script>
</body>