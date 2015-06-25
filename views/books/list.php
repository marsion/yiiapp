<?php use yii\helpers\Url; ?>
<div class="books_list">
    <?php
    echo("This is Books' index page.".'<br>');

    foreach($data as $row) {
        foreach($row as $value) {
            echo $value.'<br>';
        }
        echo '<br><br>';
    }
    ?>
</div>