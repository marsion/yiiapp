<?php
use yii\helpers\Html;
use app\helpers\CatalogLinkPager;

$this->title = 'Книги';
$this->params['breadcrumbs'][] = $this->title;

$sort = !empty( $_GET['sort'] ) ? $_GET['sort'] : 'fname';
$ord = !empty( $_GET['ord'] ) ? $_GET['ord'] : 'asc';
$c = !empty( $_GET['c'] ) ? $_GET['c'] : '';
$sec = !empty( $_GET['sec'] ) ? $_GET['sec'] : '';
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
                        <option value="author" <?php echo $sort == 'author' ? 'selected' : ''; ?>>автором</option>
                        <option value="country" <?php echo $sort == 'country' ? 'selected' : ''; ?>>країною</option>
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
                <div class="orderby-item">
                    <div class="textHelper">секція: </div>
                    <select name="sec" onchange="this.form.submit()">
                        <option value="" <?php echo $sec == '' ? 'selected' : ''; ?>>--- секція ---</option>
                        <option value="dyt" <?php echo $sec == 'dyt' ? 'selected' : ''; ?>>дитяча</option>
                        <option value="hud" <?php echo $sec == 'hud' ? 'selected' : ''; ?>>художня</option>
                        <option value="dov" <?php echo $sec == 'dov' ? 'selected' : ''; ?>>довідкова</option>
                        <option value="nav" <?php echo $sec == 'nav' ? 'selected' : ''; ?>>навчальна</option>
                        <option value="dil" <?php echo $sec == 'dil' ? 'selected' : ''; ?>>ділова</option>
                        <option value="insh" <?php echo $sec == 'insh' ? 'selected' : ''; ?>>інша</option>
                    </select>
                </div>
                <div class="orderby-item">
                    <div class="textHelper">країна: </div>
                    <select name="c" onchange="this.form.submit()">
                        <option value="" <?php echo $c == '' ? 'selected' : ''; ?>>--- країна ---</option>
                        <?php foreach($countryOptions as $countryOpt) { ?>
                            <option value="<?php echo $countryOpt['value']; ?>"
                                <?php echo $c == $countryOpt['value'] ? 'selected' : ''; ?> >
                                <?php echo $countryOpt['text']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

        </form>
    </div>


    <div class="pagination-pan">
        <?php

        echo CatalogLinkPager::widget([
            'pagination' => $pages,
        ]);

        ?>
    </div>


    <div class="catalog">
    <?php foreach($books as $book) { ?>
    <div class="item">
        <div class="itemImg">
            <a href="<?php echo Yii::$app->homeUrl.'books/'.$book->id; ?>" class="img" >
                <img src="../css/images/books/<?php echo $book->img; ?>" alt="" />
            </a>
        </div>
        <div class="bookTitle">
            <a href="<?php echo Yii::$app->homeUrl.'books/'.$book->id; ?>">
                <?php echo '&ldquo;'.$book->title.'&rdquo;'; ?>
            </a>
        </div>
        <div class="bookAuthor">
            <?php for($i = 0; $i < count($book->authors); $i++) { ?>
                <a href="<?php echo Yii::$app->homeUrl.'authors/'.$book->authors[$i]['author_id']; ?>">
                    <?php echo $book->authors[$i]['first_name']." ".$book->authors[$i]['last_name']; ?>
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