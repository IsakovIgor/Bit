<?php /** @var string $error */ ?>
<div class="container">
    <form class="auth-block" method="post">
        <div>
            <label for="email">E-Mail</label>
            <input type="email" name="email" id="email" class="float-right ml-10">
        </div>
        <div class="mt-20">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="float-right ml-10">
        </div>
        <div class="errors">
            <?php if (isset($error)) {
                echo $error;
            } ?>
        </div>
        <div>
            <button type="submit" name="submit" class="float-right">Sign in</button>
        </div>
    </form>
</div>

<style>
    .container {
        display: flex;
        height: 100vh;
        align-items: center;
        justify-content: center;
    }

    .auth-block {
        max-width: 500px;
        height: 300px;
    }

    .mt-20 {
        margin-top: 20px;
    }

    .ml-10 {
        margin-left: 10px;
    }

    .float-right {
        float: right;
    }

    .errors {
        color: #ff0000;
        height: 20px;
    }
</style>
