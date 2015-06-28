<?php
use yii\helpers\Html;
?>

<div class="books_list">

    <?php foreach($books as $book) { ?>
    <table>
        <tr>
            <td width="120">Назва: </td>
            <td><?= Html::a($book->title, [Yii::$app->homeUrl.'books/'.$book->id]) ?></td>
        </tr>
        <tr>
            <td>Автор: </td>
            <td><?= Html::a($book->authorFirstName.' '.$book->authorLastName,
                    [Yii::$app->homeUrl.'authors/'.$book->authorId]) ?></td>
        </tr>
        <tr>
            <td>Опис: </td>
            <td>
                <?php echo $book->description; ?>
                <?= Html::a('[детальніше]', [Yii::$app->homeUrl.'books/'.$book->id]) ?>
            </td>
        </tr>
    </table>
        <?php echo '<br><br>'; ?>
    <?php } ?>
</div>