<?php
use yii\helpers\Html;
?>

<div class="books_single">
    <div class="post">
        <div class="thumbnails">
            <a class="thumb">
                <img src="../css/img/sample-thumbnail.jpg" width="220" height="300" alt="" />
            </a>
        </div>
        <div class="post_title">
            <h3>
                <?php echo '"'.$book->title.'"'; ?>
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
        </div>
    </div>

</div>