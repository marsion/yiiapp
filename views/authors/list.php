<?php
//$this->registerJs('alert("Hello world!")', $this::POS_LOAD, 'main-index');
$this->registerJsFile('@web/js/sidebarmenu.js', ['position' => $this::POS_BEGIN], 'sidebarmenu');
$this->registerJsFile('@web/js/filterpopup.js', ['position' => $this::POS_BEGIN], 'filterpopup');

use yii\helpers\Html;
use app\helpers\CatalogLinkPager;
use app\helpers\MyBreadcrumbs;

$this->title = 'Автори';
$this->params['breadcrumbs'][] = $this->title;

$sort = isset($_GET['sort']) ? $_GET['sort'] : 'rating';
$ord = isset($_GET['ord']) ? $_GET['ord'] : 'desc';
$per = isset($_GET['per']) ? $_GET['per'] : '30';
$c = isset($_GET['c']) ? $_GET['c'] : array();
$byear = isset($_GET['byear']) ? $_GET['byear'] : '';
$byeq = isset($_GET['byeq']) ? $_GET['byeq'] : 'e';
$dyear = isset($_GET['dyear']) ? $_GET['dyear'] : '';
$dyeq = isset($_GET['dyeq']) ? $_GET['dyeq'] : 'e';

?>
<div id="sidebar-left" class="main-column">
    <div id="sidebar-left-content">
        <div class="box">
            <div class="box_title">Категорії</div>
            <div class="box_content">
                <div id="celebs">
                    <ul id="accordion">
                        <li class="active">
                            Художня література
                            <ul>
                                <li><a href="#">Computadors</a></li>
                                <li><a href="#">Johny Stardust</a></li>
                                <li><a href="#">Beau Dandy</a></li>
                            </ul>
                        </li>
                        <li>
                            Навчальна література
                            <ul>
                                <li><a href="#">Sinusoidal Tendancies</a></li>
                                <li><a href="#">Steve Extreme</a></li>
                            </ul>
                        </li>
                        <li>
                            Дитяча література
                            <ul>
                                <li><a href="#">Duran Duran Duran</a></li>
                                <li><a href="#">Mike's Mechanic</a></li>
                            </ul>
                        </li>
                        <li>
                            Бізнес і економіка
                            <ul>
                                <li><a href="#">Lardy Dah</a></li>
                                <li><a href="#">Rove Live</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
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
        <div class="authors_list">

<!--            <div class="filt-sort-pan">-->
<!--                Знайдено авторів:-->
<!--            </div>-->
<!---->
<!--            <div class="content_separator"></div>-->

            <?php if (count($authors) > 0) { ?>

                <div class="catalog">
                    <?php
                    foreach ($authors as $author) { ?>
                        <div class="item">
                            <div class="itemImg">
                                <a href="<?php echo Yii::$app->homeUrl . 'authors/' . $author->id; ?>" class="img">
                                    <img src="<?php echo $author->img; ?>" alt="" width="130" height="195"/>
                                </a>

                            </div>
                            <div class="authorName">
                                <a href="<?php echo Yii::$app->homeUrl . 'authors/' . $author->id; ?>">
                                    <?php echo $author->fullName; ?>
                                </a>
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
                    На жаль, жодного автора за заданими критеріями не знайдено.
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<div id="sidebar-right" class="main-column">

    <div id="sidebar-right-content">
        <form action="authors" method="get">

            <div class="box">
                <div class="box_title">Фільтрувати</div>
                <div class="box_content">
                    <div class="textHelper">відсортувати авторів за:</div>
                    <select class="sort" name="sort" onchange="this.form.submit()">
                        <option value="name" <?php echo $sort == 'name' ? 'selected' : ''; ?>>ім’ям</option>
                        <option value="rating" <?php echo $sort == 'rating' ? 'selected' : ''; ?>>популярністю
                        <option value="byear" <?php echo $sort == 'byear' ? 'selected' : ''; ?>>роком народження
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
                        <?php for ($i = 0; $i < 10; $i++) { ?>
                            <div>
                                <input type="checkbox" name="c[]" value="<?php echo $countryOptions[$i]->id; ?>"
                                    <?php echo in_array($countryOptions[$i]->id, $c) ? 'checked' : ''; ?>
                                       onchange="this.form.submit()"/>&nbsp;<?php echo $countryOptions[$i]->name; ?>
                            </div>
                        <?php } ?>

                        <div class="filter-helper">
                            <div class="filterPopupContainer" >
                                <div class="filterPopupButton" >[ список всіх країн ]</div>
                                <div class="filterPopup" >
                                    <div class="filterPopupTitlePane" >
                                        <div class="filterPopupCloseIcon" ></div>
                                        всі країни
                                    </div>
                                    <div class="filterPopupScroller" >
                                    <?php for ($i = 10; $i < count($countryOptions); $i++) {  ?>
                                        <div>
                                            <input type="checkbox" name="c[]" value="<?php echo $countryOptions[$i]->id; ?>"
                                                <?php echo in_array($countryOptions[$i]->id, $c) ? 'checked' : ''; ?>
                                                   onchange="this.form.submit()"/>&nbsp;<?php echo $countryOptions[$i]->name; ?>
                                        </div>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="box">

                <div class="box_title">Рік народження</div>
                <div class="box_content">
                    <label>
                        <input type="radio" name="byeq" value="b" <?php echo $byeq == 'b' ? 'checked' : ''; ?>
                               onchange="this.form.submit()">до
                    </label>
                    <label>
                        <input type="radio" name="byeq" value="e" <?php echo $byeq == 'e' ? 'checked' : ''; ?>
                               onchange="this.form.submit()">рівно
                    </label>
                    <label><input type="radio" name="byeq" value="a" <?php echo $byeq == 'a' ? 'checked' : ''; ?>
                                  onchange="this.form.submit()">після
                    </label>

                    <input type="text" name="byear" value="<?php echo $byear; ?>" onkeyup="this.form.submit()">
                </div>
            </div>

            <div class="box">

                <div class="box_title">Рік смерті</div>
                <div class="box_content">
                    <label>
                        <input type="radio" name="dyeq" value="b" <?php echo $dyeq == 'b' ? 'checked' : ''; ?>
                               onchange="this.form.submit()">до
                    </label>
                    <label>
                        <input type="radio" name="dyeq" value="e" <?php echo $dyeq == 'e' ? 'checked' : ''; ?>
                               onchange="this.form.submit()">рівно
                    </label>
                    <label><input type="radio" name="dyeq" value="a" <?php echo $dyeq == 'a' ? 'checked' : ''; ?>
                                  onchange="this.form.submit()">після
                    </label>

                    <input type="text" name="dyear" value="<?php echo $dyear; ?>" onkeyup="this.form.submit()">
                </div>
            </div>
        </form>
    </div>

</div>
