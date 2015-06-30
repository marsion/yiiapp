<?php
use yii\helpers\Html;
?>

<div class="books_list">

    <?php foreach($books as $book) { ?>
    <div class="post">
        <div class="thumbnails">
            <a href="<?php echo Yii::$app->homeUrl.'books/'.$book->id; ?>" class="thumb">
                <img src="../css/img/sample-thumbnail.jpg" width="120" height="150" alt="" />
            </a>
        </div>
        <div class="post_title">
            <h3>
                <a href="<?php echo Yii::$app->homeUrl.'books/'.$book->id; ?>">
                    <?php echo '"'.$book->title.'"'; ?>
                </a>
            </h3>
        </div>
        <div class="post_title">
            <h5>
                <a href="<?php echo Yii::$app->homeUrl.'authors/'.$book->authorId; ?>">
                    <?php echo $book->authorFirstName.' '.$book->authorLastName; ?>
                </a>
            </h5>
        </div>
        <div class="post_body">
            <?php echo $book->description; ?>
            <?= Html::a('[детальніше]', [Yii::$app->homeUrl.'books/'.$book->id]) ?>
        </div>
    </div>
    <?php } ?>
</div>