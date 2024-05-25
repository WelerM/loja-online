<?php

use core\classes\Functions;

?>

<nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom">

    <div class="container-fluid  ">

        <a class="navbar-brand text-success fw-bold" href="?a=home"><?= APP_NAME ?></a>


        <button class="navbar-toggler  " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon  bg-light"></span>
        </button>

        <div class="collapse navbar-collapse " id="navbarSupportedContent" style="flex-grow: 0;">


            <ul class="navbar-nav  mb-2 mb-lg-0 border-0  me-3">


                <?php if (Functions::user_logged()) : ?>

                    <?php if ($_SESSION['user_type'] === 'admin') : ?>

                        <li class="nav-item">
                            <a class="nav-link text-center " href="?a=create_product_page">Criar produto</a>
                        </li>

                        <li class="nav-item me-5">
                            <a class="nav-link text-center " href="?a=answer_questions_page">Responder</a>
                        </li>


                    <?php endif; ?>

                <?php endif; ?>






                <li class="nav-item">
                    <a class="nav-link text-center mb-2 " href="?a=product_page">Produtos</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-center mb-2 " href="?a=account_page">Sobre Nós</a>
                </li>




                <?php if (Functions::user_logged()) : ?>

                    <li class="nav-item">
                        <a class="nav-link text-center mb-2 " href="?a=account_page">Minha conta</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link text-center " href="?a=signout">Sair</a>
                    </li>
                <?php endif; ?>




                <?php if (!Functions::user_logged()) : ?>

                    <li class="nav-item text-center mb-2">
                        <a class="nav-link " href="?a=signin_page">Entrar</a>
                    </li>

                    <li class="nav-item text-center">
                        <a class="nav-link  " href="?a=signup_page">Registrar</a>
                    </li>

                <?php endif; ?>

            </ul>




        </div>

    </div>
</nav>