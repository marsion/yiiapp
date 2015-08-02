<?php
$this->title = $book->title;
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => [Yii::$app->homeUrl.'/books']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="books_single">
    <div class="post">
        <div class="thumbnails">
            <a class="thumb">
                <img src="<?php echo Yii::$app->request->baseUrl; ?>/css/images/books/<?php echo $book->img; ?>" alt="" />
            </a>
        </div>
        <div class="post_title">
            <h3>
                <?php echo '"'.$book->title.'"'; ?>
            </h3>
        </div>
        <div class="post_title">
            <h5>
                <?php for($i = 0; $i < count($book->authors); $i++) { ?>
                    <a href="<?php echo Yii::$app->homeUrl.'authors/'.$book->authors[$i]->id; ?>">
                        <?php echo $book->authors[$i]->firstName." ".$book->authors[$i]->lastName; ?>
                    </a>
                <?php if((count($book->authors) > 1) && ($i < count($book->authors) - 1)) echo ', '; } ?>
            </h5>
        </div>
        <div class="post_body">
            <?php echo $book->description; ?>
        </div>
    </div>

</div>