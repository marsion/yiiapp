<?php
use yii\helpers\Html;
use app\helpers\CatalogLinkPager;

$this->title = 'Всі книги '.$authorFullName;
$this->params['breadcrumbs'][] = ['label' => 'Автори', 'url' => ['/authors']];
$this->params['breadcrumbs'][] = ['label' => $authorFullName,
    'url' => ['/authors/'.$books[0]->authors[0]->id]];
$this->params['breadcrumbs'][] = 'Всі книги';

$sort = !empty( $_GET['sort'] ) ? $_GET['sort'] : 'fname';
$ord = !empty( $_GET['ord'] ) ? $_GET['ord'] : 'asc';
$per = !empty( $_GET['per'] ) ? $_GET['per'] : '10';

?>

<div class="books_list">
    <div class="filt-sort-pan">
        <form action="books" method="get">


            <div class="orderby-pan">
                <div class="orderby-item">
                    <div class="textHelper">сортувати за: </div>
                    <select name="sort" onchange="this.form.submit()">
                        <option value="title" <?php echo $sort == 'title' ? 'selected' : ''; ?>>назвою</option>
                    </select>
                </div>
                <div class="orderby-item">
                    <div class="textHelper">впорядкувати за: </div>
                    <select name="ord" onchange="this.form.submit()">
                        <option value="asc" <?php echo $ord == 'asc' ? 'selected' : ''; ?>>зростанням</option>
                        <option value="desc" <?php echo $ord == 'desc' ? 'selected' : ''; ?>>спаданням</option>
                    </select>
                </div>
                <div class="orderby-item">
                    <div class="textHelper">показати: </div>
                    <select name="per" onchange="this.form.submit()">
                        <option value="10" <?php echo $per == '10' ? 'selected' : ''; ?>>10</option>
                        <option value="20" <?php echo $per == '20' ? 'selected' : ''; ?>>20</option>
                        <option value="30" <?php echo $per == '30' ? 'selected' : ''; ?>>30</option>
                    </select>
                </div>
            </div>

            <div class="filter-pan">

            </div>

        </form>
    </div>


    <div class="catalog">
        <?php foreach($books as $book) { ?>
            <div class="item">
                <div class="itemImg">
                    <a href="<?php echo Yii::$app->homeUrl.'books/'.$book->id; ?>" class="img" >
                        <img src="<?php echo Yii::$app->request->baseUrl; ?>/css/images/books/<?php echo $book->img; ?>" alt="" width="130" height="195"/>
                    </a>
                </div>
                <div class="bookTitle">
                    <a href="<?php echo Yii::$app->homeUrl.'books/'.$book->id; ?>">
                        <?php echo '&ldquo;'.$book->title.'&rdquo;'; ?>
                    </a>
                </div>
                <div class="bookAuthor">
                    <?php for($i = 0; $i < count($book->authors); $i++) { ?>
                        <a href="<?php echo Yii::$app->homeUrl.'authors/'.$book->authors[$i]->id; ?>">
                            <?php echo $book->authors[$i]->firstName." ".$book->authors[$i]->lastName; ?>
                        </a>
                        <?php if((count($book->authors) > 1) && ($i < count($book->authors) - 1)) echo ', '; } ?>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="pagination-pan">
        <?php

        echo CatalogLinkPager::widget([
            'pagination' => $pages,
        ]);

        ?>
    </div>
</div>