<?php
use yii\helpers\Html;
?>

<div class="authors_list">

    <?php foreach($authors as $author) { ?>
    <div class="post">
        <div class="thumbnails">
            <a href="<?php echo Yii::$app->homeUrl.'authors/'.$author->id; ?>" class="thumb">
                <img src="../css/img/sample-thumbnail.jpg" width="120" height="150" alt="" />
            </a>
        </div>
        <div class="post_title">
            <h3>
                <a href="<?php echo Yii::$app->homeUrl.'authors/'.$author->id; ?>">
                    <?php echo $author->firstName.' '.$author->lastName; ?>
                </a>
            </h3>
        </div>
        <div class="post_title">
            <h6>
                <?php echo '('.$author->birthYear.' - '.$author->deathYear.')'; ?></td>
            </h6>
        </div>
        <div class="post_title">
            <h6>
                <?php echo $author->countryName; ?></td>
            </h6>
        </div>
        <div class="post_body">
            <?php echo $author->bio; ?>
                <?= Html::a('[детальніше]', [Yii::$app->homeUrl.'authors/'.$author->id]) ?>
        </div>
    </div>
    <?php } ?>


</div>