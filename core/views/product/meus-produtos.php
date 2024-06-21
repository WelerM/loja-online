<div style="min-height: 100vh;" class="container mx-auto px-1 py-5 row">

    <div class="col-md-6 col-sm-12 p-0 mx-auto">

        <?php if (isset($_SESSION['error'])) : ?>

            <div class="alert alert-danger d-flex gap-3 align-items-center justify-content-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                </svg>
                <div>
                    <?= $_SESSION['error'] ?>
                    <?php unset($_SESSION['error']); ?>
                </div>
            </div>

        <?php endif; ?>

        <?php if (isset($_SESSION['success'])) : ?>

            <div class="alert alert-success d-flex gap-3 align-items-center justify-content-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </svg>
                <div>
                    <?= $_SESSION['success'] ?>
                    <?php unset($_SESSION['success']); ?>
                </div>
            </div>

        <?php endif; ?>


        <h5>Meus produtos</h5>


        <?php if (!empty($data)) : ?>

            <!-- Products loop -->
            <?php foreach ($data as $product) : ?>

                <div class="d-flex justify-content-between border w-100 my-3 p-2 rounded shadow ">

                    <div style="height: 100px;" class=" d-flex flex-row gap-3 border-0">

                        <img style="width:100px" src="<?= $product['img_src']; ?>" class=" img-fluid m-0 p-0" alt="...">

                        <div class="  p-0 ps-2">
                            <h5 class="card-title p-0 m-0"><?= $product['name']; ?> </h5>
                            <p class="card-title p-0 m-0"><?= 'R$ ' . $product['price']; ?> </p>
                            <p class="card-text p-0 m-0"> <?= $product['description']; ?></p>
                            <a href="#" class="p-0 m-0"><?= $product['link']; ?></a>
                        </div>

                    </div>

                    <!-- Crud BTN container  -->
                    <div class="d-flex flex-column justify-content-between py-2">
                        <a class="btn btn-warning btn-sm " href="?a=editar-produto/<?= $product['id']; ?>">Editar</a>
                        <a id="btn-delete-product" class="btn btn-danger btn-sm " href="?a=delete_product/<?= $product['id'] ?>">Excluir</a>
                    </div>

                </div>

            <?php endforeach; ?>

        <?php else : ?>

            <p>Ainda não há produtos</p>

        <?php endif ?>

    </div>

</div>