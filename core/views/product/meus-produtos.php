<div style="min-height: 100vh;" class="container mx-auto px-1 py-2 row">

    <div class="col-md-6 col-sm-12 p-0 mx-auto">
        <?php require(APP_DOCUMENT_ROOT . '/core/views/components/alert.php'); ?>



        <h5>Meus produtos</h5>

        <div class="d-flex gap-2 my-3">
            <a href="?a=meus-produtos" class="btn btn-success btn-sm">ativos</a>
            <a href="?a=meus-produtos/deletados" class="btn btn-danger btn-sm">deletados</a>

        </div>

        <?php if (!empty($data)) : ?>

            <!-- Products loop -->
            <?php foreach ($data as $product) : ?>

                <div class="d-flex justify-content-between border w-100 my-3 p-2 rounded shadow ">

                    <div style="height: 100px;" class=" d-flex flex-row gap-3 border-0">

                        <img style="width:100px" src="<?= $product['img_src']; ?>" class=" img-fluid m-0 p-0" alt="...">

                        <div class="  p-0 ps-2">
                            <h5 class="card-title p-0 m-0"><?= $product['name']; ?> </h5>

                            <p class="card-title p-0 m-0"><?= 'R$ ' . number_format($product['price'], 2, ',', '.'); ?> </p>
                     

                            <p class="card-text text-truncate  p-0 m-0" style="max-width:200px"> <?= $product['description']; ?></p>
                            <a href="#" class="p-0 m-0"><?= $product['link']; ?></a>
                        </div>

                    </div>

                    <?php if ($product['deleted_at'] === NULL) : ?>

                        <!-- Crud BTN container  -->
                        <div class="d-flex flex-column justify-content-between py-2">
                            <a class="btn btn-warning btn-sm " href="?a=editar-produto/<?= $product['id']; ?>">Editar</a>
                            <a class="btn-delete-product btn btn-danger btn-sm " href="?a=delete_product/<?= $product['id'] ?>">Excluir</a>
                        </div>

                    <?php endif ?>

                </div>

            <?php endforeach; ?>

        <?php else : ?>

            <p>Ainda não há produtos</p>

        <?php endif ?>

    </div>

</div>