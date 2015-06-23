<?php use yii\helpers\Url; ?>
<div class="books_index">
    <?php
    echo("This is Books' index page.".'<br>');
    echo Url::to(['/books/book', 'id' => 100]);
    echo '<br>';
    echo Url::to(['/books/book', 'id' => 5]);
    ?>
</div>