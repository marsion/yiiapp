<?php
$this->title = $book->title;
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => [Yii::$app->homeUrl.'/books']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="books_single">
    <div class="post">
        <div class="thumbnails">
            <a class="thumb">
                <img src="../css/images/books/<?php echo $book->img; ?>" alt="" />
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
                    <a href="<?php echo Yii::$app->homeUrl.'authors/'.$book->authors[$i]['author_id']; ?>">
                        <?php echo $book->authors[$i]['first_name']." ".$book->authors[$i]['last_name']; ?>
                    </a>
                <?php if((count($book->authors) > 1) && ($i < count($book->authors) - 1)) echo ', '; } ?>
            </h5>
        </div>
        <div class="post_body">
            <?php echo $book->description; ?>
        </div>
    </div>

</div>