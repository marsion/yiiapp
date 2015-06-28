<?php
use yii\helpers\Html;
?>

<div class="authors_list">

    <?php foreach($authors as $author) { ?>

        <table>
            <tr>
                <td width="120">Ім’я: </td>
                <td><?= Html::a($author->firstName.' '.$author->lastName,
                        [Yii::$app->homeUrl.'authors/'.$author->id]) ?></td>
        </tr>
        <tr>
            <td>Роки життя: </td>
            <td><?php echo '('.$author->birthYear.' - '.$author->deathYear.')'; ?></td>
        </tr>
        <tr>
            <td>Країна: </td>
            <td><?php echo $author->countryName; ?></td>
        </tr>
        <tr>
            <td>Біографія: </td>
            <td>
                <?php echo $author->bio; ?>
                <?= Html::a('[детальніше]', [Yii::$app->homeUrl.'authors/'.$author->id]) ?>
            </td>
        </tr>
        </table>

        <?php echo '<br><br>'; ?>
    <?php } ?>


</div>