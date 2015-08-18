<?php
use yii\helpers\Html;
use app\helpers\CatalogLinkPager;
use app\helpers\MyBreadcrumbs;

$this->title = $authorName . ' - всі книги ';
$this->params['breadcrumbs'][] = ['label' => 'Автори', 'url' => ['/authors']];
$this->params['breadcrumbs'][] = ['label' => $authorName,
    'url' => ['/authors/' . $authorId]];
$this->params['breadcrumbs'][] = 'Всі книги';

$sort = !empty($_GET['sort']) ? $_GET['sort'] : 'name';
$ord = !empty($_GET['ord']) ? $_GET['ord'] : 'asc';
$per = !empty($_GET['per']) ? $_GET['per'] : '60';

?>
<div class="left" id="main">
    <div id="main_content">
        <div>
            <?= MyBreadcrumbs::widget([
                'homeLink' => [
                    'label' => Yii::t('yii', 'Home'),
                    'url' => Yii::$app->homeUrl,
                ],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>

        </div>
        <div class="books_list">
            <?php if (count($books) > 0) { ?>
                <div class="filt-sort-pan">
                    <form action="books" method="get">


                        <div class="orderby-pan">
                            <div class="orderby-item">
                                <div class="textHelper">сортувати за:</div>
                                <select name="sort" onchange="this.form.submit()">
                                    <option value="title" <?php echo $sort == 'title' ? 'selected' : ''; ?>>назвою
                                    </option>
                                </select>
                            </div>
                            <div class="orderby-item">
                                <div class="textHelper">впорядкувати за:</div>
                                <select name="ord" onchange="this.form.submit()">
                                    <option value="asc" <?php echo $ord == 'asc' ? 'selected' : ''; ?>>зростанням
                                    </option>
                                    <option value="desc" <?php echo $ord == 'desc' ? 'selected' : ''; ?>>спаданням
                                    </option>
                                </select>
                            </div>
                            <div class="orderby-item">
                                <div class="textHelper">показати:</div>
                                <select name="per" onchange="this.form.submit()">
                                    <option value="60" <?php echo $per == '60' ? 'selected' : ''; ?>>60</option>
                                    <option value="120" <?php echo $per == '120' ? 'selected' : ''; ?>>120</option>
                                    <option value="240" <?php echo $per == '240' ? 'selected' : ''; ?>>240</option>
                                </select>
                            </div>
                        </div>

                        <div class="filter-pan">

                        </div>

                    </form>
                </div>


                <div class="catalog">
                    <?php foreach ($books as $book) { ?>
                        <div class="item">
                            <div class="itemImg">
                                <a href="<?php echo Yii::$app->homeUrl . 'books/' . $book->id; ?>" class="img">
                                    <img src="<?php echo $book->img; ?>" alt="" width="130" height="195"/>
                                </a>
                            </div>
                            <div class="bookTitle">
                                <a href="<?php echo Yii::$app->homeUrl . 'books/' . $book->id; ?>">
                                    <?php echo '&ldquo;' . $book->title . '&rdquo;'; ?>
                                </a>
                            </div>
                            <div class="bookAuthor">
                                <?php for ($i = 0; $i < count($book->authors); $i++) { ?>
                                    <a href="<?php echo Yii::$app->homeUrl . 'authors/' . $book->authors[$i]->id; ?>">
                                        <?php echo $book->authors[$i]->fullName; ?>
                                    </a>
                                    <?php if ((count($book->authors) > 1) && ($i < count($book->authors) - 1)) echo ', ';
                                } ?>
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
            <?php } else { ?>
                <div class="empty-search-results">
                    На жаль, жодної книги даного автора не знайдено.
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<div class="right" id="sidebar">

    <div id="sidebar_content">

        <div class="box">

            <div class="box_title">Категорії</div>
            <?php if (count($genres) > 1) { ?>
                <div class="box_content">
                    <ul>
                        <?php foreach ($genres as $genre) { ?>
                            <li><a href="#"><?php echo $genre['text']; ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
        </div>

        <div class="box">

            <div class="box_title">Categories</div>

            <div class="box_content">
                <ul>
                    <li><a href="http://templates.arcsin.se/category/website-templates/">Website Templates</a></li>
                    <li><a href="http://templates.arcsin.se/category/wordpress-themes/">Wordpress Themes</a></li>
                    <li><a href="http://templates.arcsin.se/professional-templates/">Professional Templates</a></li>
                    <li><a href="http://templates.arcsin.se/category/blogger-templates/">Blogger Templates</a></li>
                    <li><a href="http://templates.arcsin.se/category/joomla-templates/">Joomla Templates</a></li>
                </ul>
            </div>

        </div>

        <div class="box">

            <div class="box_title">Resources</div>

            <div class="box_content">
                <ul>
                    <li><a href="http://templates.arcsin.se/">Arcsin Web Templates</a></li>
                    <li><a href="http://www.google.com/" rel="nofollow">Google</a> - Web Search</li>
                    <li><a href="http://www.w3schools.com/" rel="nofollow">W3Schools</a> - Online Web Tutorials</li>
                    <li><a href="http://www.wordpress.org/" rel="nofollow">WordPress</a> - Blog Platform</li>
                    <li><a href="http://cakephp.org/" rel="nofollow">CakePHP</a> - PHP Framework</li>
                </ul>
            </div>

        </div>

        <div class="box">

            <div class="box_title">Gallery</div>

            <div class="box_content">

                <div class="thumbnails">

                    <a href="#" class="thumb"><img
                            src="<?php echo Yii::$app->request->baseUrl; ?>/css/img/sample-thumbnail.jpg" width="75"
                            height="75" alt=""/></a>
                    <a href="#" class="thumb"><img
                            src="<?php echo Yii::$app->request->baseUrl; ?>/css/img/sample-thumbnail.jpg" width="75"
                            height="75" alt=""/></a>
                    <a href="#" class="thumb"><img
                            src="<?php echo Yii::$app->request->baseUrl; ?>/css/img/sample-thumbnail.jpg" width="75"
                            height="75" alt=""/></a>
                    <a href="#" class="thumb"><img
                            src="<?php echo Yii::$app->request->baseUrl; ?>/css/img/sample-thumbnail.jpg" width="75"
                            height="75" alt=""/></a>
                    <a href="#" class="thumb"><img
                            src="<?php echo Yii::$app->request->baseUrl; ?>/css/img/sample-thumbnail.jpg" width="75"
                            height="75" alt=""/></a>
                    <a href="#" class="thumb"><img
                            src="<?php echo Yii::$app->request->baseUrl; ?>/css/img/sample-thumbnail.jpg" width="75"
                            height="75" alt=""/></a>

                    <div class="clearer">&nbsp;</div>

                </div>

            </div>

        </div>

    </div>

</div>
