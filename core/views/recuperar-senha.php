<div style="min-height: 100vh;" class="py-2">

    <form action="?a=send_recovery_email" method="POST" class="mx-auto" style="max-width: 400px; ">

        <h5 class="text-center text-success mb-4">Informe um email para receber um link de verificação</h5>

        <?php require(APP_DOCUMENT_ROOT . '/core/views/components/alert.php'); ?>



        <div class="mb-2">

            <label for="email" class="form-label">Your email</label>
            <input id="email" class="input-email form-control" type="email" name="email">
        </div>


        <button type="submit" class="btn btn-success">Send email</button>

    </form>

</div>