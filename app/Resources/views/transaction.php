<?php /** @var float $currentValue */ ?>
<?php /** @var string $error */ ?>
<div class="container">
    <form class="transaction-block" method="post">
        <div>
            <span>Current value: <?= $currentValue ?></span>
        </div>
        <div>
            <label for="value">Enter value</label>
            <input type="number" step="0.01" name="value" id="value" class="float-right ml-10">
        </div>
        <div class="errors">
            <?php if (isset($error)) {
                echo $error;
            } ?>
        </div>
        <div>
            <button type="submit" name="submit" class="float-right">Withdrawal</button>
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

    .transaction-block {
        max-width: 500px;
        height: 300px;
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
