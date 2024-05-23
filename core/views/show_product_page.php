<div style="min-height: 100vh;" class="container  py-5">

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div style="height:fit-content; width:fit-content" class="card  ">
                <img style=" max-width:200px" src="<?= $data[0][0]['img_src']; ?>" class="card-img-top img-fluid" alt="...">

                <div class="card-body">
                    <h5 class="card-title"><?= $data[0][0]['name']; ?> </h5>
                    <p class="card-title"><?= 'R$ ' .  $data[0][0]['price']; ?> </p>
                    <p class="card-text"> <?= $data[0][0]['description']; ?></p>
                    <a href="#" class=""><?= $data[0][0]['link']; ?></a>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6">
            <h2>perguntas</h2>

            <div class="mt-3 ">

                <form class="flex-column px-0 mb-5 py-1  " action="?a=make_question&product_id=<?= $data[0][0]['id']; ?> " enctype="multipart/form-data" method="POST">


                    <!-- Product description-->
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="question-text" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                        <label for="floatingTextarea2">Fazer pergunta</label>
                    </div>


                    <button id="btn-form-submit" type="submit" name="submit" class="btn btn-success mx-0 d-flex align-items-center justify-content-center" style="width: fit-content;">

                        Enviar</button>


                </form>

            </div>
            <?php

            //  print_r($data[1]);
            ?>
            <?php foreach ($data[1] as $questions) : ?>

                <div class="border my-2 p-2">
                    <p class="fw-bold"><?= $questions['name']; ?></p>
                    <p><?= $questions['question']; ?></p>
                    <p><?= $questions['created_at']; ?></p>

                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>