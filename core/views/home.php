<!-- Home presentation -->
<div style="height: 400px;" class="container d-flex text-light py-5 w-100  bg-gray">
    <h1 style="font-size: 40px; max-width: 450px" class="text-dark">Seleção de produtos personalizada para você</h1>
</div>


<!-- Product list -->
<div class="container py-5 d-flex flex-wrap  gap-2">


    <?php foreach ($data as $item) : ?>

        <a href="?a=detalhes-do-produto/<?= $item['id']; ?>" class="text-dark p-0  border rounded shadow-sm">

            <div class="product-card p-0 ">

                <img style="width:200px; height:220px" src="<?= $item['img_src']; ?>" class="img-fluid">

                <div class="card-body px-2  py-1 ">

                    <p class="card-title  m-0"><?= $item['name']; ?> </p>
                    <p class="card-title m-0"><?= 'R$ ' . number_format($item['price'], 2, ',', '.'); ?> </p>

                </div>

            </div>
        </a>

    <?php endforeach ?>


</div>