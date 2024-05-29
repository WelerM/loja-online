<div class="container-fluid  p-0">

    <div style="height: 400px;" class="d-flex bg-success text-light py-5      w-100">
        <div class="container ">
            <h1 style="font-size: 40px; max-width: 450px">Seleção de produtos personalizada para você</h1>

            <img src="" alt="">
        </div>
    </div>



    <div class="container py-5">

        <div class="d-flex flex-wrap  gap-2 p-0">

            <?php foreach ($data as $item): ?>

                <a href="?a=product_details_page/<?= $item['id']; ?>" class="text-dark">

                    <div class="card" style="">

                    <img style="height:200px; width:200px" src="<?= $item['img_src']; ?>" class="card-img-top">
                        <div class="card-body p-3">

                            <h5 class="card-title"><?= $item['name']; ?> </h5>
                            <p class="card-title"><?= 'R$ ' . $item['price']; ?> </p>

                        </div>

                    </div>
                </a>

            <?php endforeach ?>

        </div>
    </div>

</div>