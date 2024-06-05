<div style="min-height:100vh" class="container ">

    <h1>Minhas mensagens</h1>




    <?php foreach ($data as $message): ?>

        <div style="" class="row border p-0 my-3 rounded shadow bg-body-tertiary">

            <p><?= $message['message'] ?></p>

        </div>

    <?php endforeach; ?>
</div>