<?php
use yii\helpers\Html;
?>

<div class="books_single">

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
            <td><?php echo $book->description; ?></td>
        </tr>
    </table>

</div>