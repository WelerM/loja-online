<div style="min-height:100vh" class=" py-2 container   ">


    <h2 class="my-5">Produtos</h2>

    <div class="d-flex flex-wrap  gap-2 p-0">

        <?php foreach ($data as $item) : ?>

            <a href="?a=product_details_page/<?= $item['id']; ?>" class="text-dark">

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