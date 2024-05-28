<div class="container-fluid  p-0">

    <div style="height: 400px;" class="d-flex bg-success text-light py-5      w-100">
        <div class="container ">
            <h1 style="font-size: 40px; max-width: 4-------------50px">Seleção de produtos personalizada para você</h1>

            <img src="" alt="">
        </div>
    </div>



    <div class="container py-5">

        <div class="d-flex flex-wrap  gap-2 p-0">

            <?php foreach ($data as $item) : ?>

                <a href="?a=show_product_page/<?= $item['id']; ?>" class="">

                    <div style="height:fit-content;" class="card" style="width: 18rem;">
                        <img style="max-width:200px" src="<?php echo $item['img_src']; ?>" class="card-img-top img-fluid" alt="...">

                        <div class="card-body ">
                            <h5 class="card-title"><?php echo $item['name']; ?> </h5>
                            <p class="card-title"><?= 'R$ ' .  $item['price']; ?> </p>
                            <p class="card-text"> <?php echo $item['description']; ?></p>
                            <a href="#" class=""><?php echo $item['link']; ?></a>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>

        </div>
    </div>

</div>