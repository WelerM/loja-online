<div style="min-height: 100vh;" class="">

    <div class="container py-5">

        <h2>Perguntas não respondidas</h2>

        <?php foreach ($data as $item) : ?>

       

            <div style="width: fit-content;" class="border d-flex flex-column gap-3 p-3 my-3 rounded-1 shadow">

                <div class="d-flex gap-1">
                    <a href="?a=show_product/<?= $item['product_id'] ?>">
                        <img src="<?= $item['img_src'] ?>" class="img-fluid" style="max-width: 60px; height: 60px" alt="">
                    </a>

                    <p><?= $item['question'] ?></p>
                </div>


                <div class="d-flex gap-2">
                    <div style="height: fit-content;" class="d-flex gap-1">

                        <button name="<?=$item['product_id']?>" class="btn-ver-chat btn btn-success" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                        Responder
                        </button>
                        
                        <button class="btn btn-danger btn-sm">Exclur</button>
                    </div>

                    <div class="">
                        <p><?= $item['created_at'] ?></p>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>
    </div>




    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">

            <div class="questions-header-display d-flex gap-1">
                <img style="30px" class="user-img-icon" src="" alt="">
                <span class="user-name fw-bold"></span>
            </div>

            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">
            <div style="" class="d-flex flex-column gap-2">

                <ul class="ul-questions p-0">

                </ul>


                <div class="d-flex flex-column gap-1">

                    <form action="?a=answer_question" method="POST">
                        <textarea class="form-control" name="answer" id=""></textarea>
                        <button type="submit" class="btn btn-success btn-sm">Responder</button>

                        <input class="product-id d-none" name="product_id" value="<?=$item['product_id']?>" type="text" >
                        <input class="client-id d-none" name="client_id" value="<?=$item['client_id']?>" type="text" >
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>