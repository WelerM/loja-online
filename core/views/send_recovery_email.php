<div class="vh-100">

    <form action="?a=send_recovery_email" method="POST" class="mx-auto" style="max-width: 400px; margin-top:100px;">

        <p class="text-center text-success  fs-2 mb-4">Enter your email to redefine your password</p>

        <?php require(APP_DOCUMENT_ROOT . '/core/views/components/alert.php'); ?>



        <div class="mb-2">

            <label for="email" class="form-label">Your email</label>
            <input id="email" class="form-control" type="email" name="email">
        </div>


        <button type="submit" class="btn btn-success">Send email</button>

    </form>

</div>