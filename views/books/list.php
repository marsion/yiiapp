<?php
use yii\helpers\Html;
use app\helpers\CatalogLinkPager;
use app\helpers\MyBreadcrumbs;

$this->title = 'Книги';
$this->params['breadcrumbs'][] = $this->title;

$sort = isset($_GET['sort']) ? $_GET['sort'] : 'year';
$ord = isset($_GET['ord']) ? $_GET['ord'] : 'desc';
$per = isset($_GET['per']) ? $_GET['per'] : '30';
$c = isset($_GET['c']) ? $_GET['c'] : array();
$lang = isset($_GET['lang']) ? $_GET['lang'] : array();
$langor = isset($_GET['langor']) ? $_GET['langor'] : array();
$g = isset($_GET['g']) ? $_GET['g'] : array();
$ph = isset($_GET['ph']) ? $_GET['ph'] : array();
$year = isset($_GET['year']) ? $_GET['year'] : '';
$yeq = isset($_GET['yeq']) ? $_GET['yeq'] : 'e';

?>
<div id="sidebar-left" class="main-column">
    <div id="sidebar-left-content">
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

<div id="main" class="main-column">
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
            <div class="filt-sort-pan">
                Знайдено книг:
            </div>

            <div class="content_separator"></div>

            <?php if (count($books) > 0) { ?>
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
                    На жаль, жодної книги за заданими критеріями не знайдено.
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<div id="sidebar-right" class="main-column">

    <div id="sidebar-right-content">
        <form action="books" method="get">
<!--            <input type="hidden" name="g[]" value="NULL">-->
<!--            <input type="hidden" name="ph[]" value="NULL">-->

            <div class="box">
                <div class="box_title">Фільтрувати</div>
                <div class="box_content">
                    <div class="textHelper">відсортувати за:</div>
                    <select class="sort" name="sort" onchange="this.form.submit()">
                        <option value="title" <?php echo $sort == 'title' ? 'selected' : ''; ?>>назвою</option>
                        <option value="rating" <?php echo $sort == 'rating' ? 'selected' : ''; ?>>популярністю</option>
                        <option value="year" <?php echo $sort == 'year' ? 'selected' : ''; ?>>роком видання
                        <option value="pages" <?php echo $sort == 'pages' ? 'selected' : ''; ?>>кількістю сторінок
                        <option value="circ" <?php echo $sort == 'circ' ? 'selected' : ''; ?>>тиражем
                        </option>
                    </select>

                    <div class="col-container ord_container">
                        <div class="textHelper">впорядкувати:</div>
                        <select class="ord" name="ord" onchange="this.form.submit()">
                            <option value="asc" <?php echo $ord == 'asc' ? 'selected' : ''; ?>>зростанням</option>
                            <option value="desc" <?php echo $ord == 'desc' ? 'selected' : ''; ?>>спаданням</option>
                        </select>
                    </div>
                    <div class="col-container per_container">
                        <div class="textHelper">показати:</div>
                        <select class="per" name="per" onchange="this.form.submit()">
                            <option value="30" <?php echo $per == '30' ? 'selected' : ''; ?>>30</option>
                            <option value="60" <?php echo $per == '60' ? 'selected' : ''; ?>>60</option>
                            <option value="120" <?php echo $per == '120' ? 'selected' : ''; ?>>120</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="box">
                <?php if (count($countryOptions) > 0) { ?>
                    <div class="box_title">Країна</div>

                    <div class="box_content">
                        <?php foreach ($countryOptions as $countryOption) { ?>
                            <div>
                                <input type="checkbox" name="c[]" value="<?php echo $countryOption->id; ?>"
                                    <?php echo in_array($countryOption->id, $c) ? 'checked' : ''; ?>
                                       onchange="this.form.submit()"/>&nbsp;<?php echo $countryOption->name; ?>
                            </div>
                        <?php } ?>

                        <div class="filter-helper">
                            <a href="#">[ список всіх країн ]</a>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="box">

                <div class="box_title">Рік видання</div>
                <div class="box_content">
                    <label>
                        <input type="radio" name="yeq" value="b" <?php echo $yeq == 'b' ? 'checked' : ''; ?>
                               onchange="this.form.submit()">до
                    </label>
                    <label>
                        <input type="radio" name="yeq" value="e" <?php echo $yeq == 'e' ? 'checked' : ''; ?>
                               onchange="this.form.submit()">рівно
                    </label>
                    <label><input type="radio" name="yeq" value="a" <?php echo $yeq == 'a' ? 'checked' : ''; ?>
                                  onchange="this.form.submit()">після
                    </label>

                    <input type="text" name="year" value="<?php echo $year; ?>" onkeyup="this.form.submit()">
                </div>
            </div>

            <div class="box">

                <?php if (count($langOptions) > 0) { ?>
                    <div class="box_title">Мова</div>
                    <div class="box_content">
                        <?php foreach ($langOptions as $langOption) { ?>
                            <div>
                                <label>
                                    <input type="checkbox" name="lang[]" value="<?php echo $langOption->id; ?>"
                                        <?php echo in_array($langOption->id, $lang) ? 'checked' : ''; ?>
                                           onchange="this.form.submit()" />&nbsp;<?php echo $langOption->name; ?>
                                </label>
                            </div>
                        <?php } ?>

                        <div class="filter-helper">
                            <a href="#">[ список всіх мов ]</a>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="box">
                <?php if (count($langOptions) > 0) { ?>
                    <div class="box_title">Мова оригіналу</div>

                    <div class="box_content">
                        <?php foreach ($langOptions as $langOption) { ?>
                            <div>
                                <input type="checkbox" name="langor[]" value="<?php echo $langOption->id; ?>"
                                    <?php echo in_array($langOption->id, $langor) ? 'checked' : ''; ?>
                                       onchange="this.form.submit()"/>&nbsp;<?php echo $langOption->name; ?>
                            </div>
                        <?php } ?>

                        <div class="filter-helper">
                            <a href="#">[ список всіх мов ]</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </form>

    </div>

</div>

