<?php
//$this->registerJs('alert("Hello world!")', $this::POS_LOAD, 'main-index');
$this->registerJsFile('@web/js/sidebarmenu.js', ['position' => $this::POS_BEGIN], 'sidebarmenu');

use yii\helpers\Html;
use app\helpers\CatalogLinkPager;
use app\helpers\MyBreadcrumbs;

$this->title = 'Автори';
$this->params['breadcrumbs'][] = $this->title;

$sort = !empty($_GET['sort']) ? $_GET['sort'] : 'name';
$ord = !empty($_GET['ord']) ? $_GET['ord'] : 'asc';
$c = !empty($_GET['c']) ? $_GET['c'] : '';
$sec = !empty($_GET['sec']) ? $_GET['sec'] : '';
$per = !empty($_GET['per']) ? $_GET['per'] : '30';

?>
<script type="text/javascript">

    </script>
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
        <div class="authors_list">

            <div class="filt-sort-pan">
                <form action="authors" method="get">


                    <div class="orderby-pan">
                        <div class="orderby-item">
                            <div class="textHelper">сортувати за:</div>
                            <select name="sort" class="sort" onchange="this.form.submit()" >
                                <option class="option" value="name" <?php echo $sort == 'name' ? 'selected' : ''; ?>>ім’ям</option>
                                <option value="rating" <?php echo $sort == 'rating' ? 'selected' : ''; ?>>популярністю</option>
                                <option value="byear" <?php echo $sort == 'byear' ? 'selected' : ''; ?>>роком народження</option>
                            </select>
                        </div>
                        <div class="orderby-item">
                            <div class="textHelper">впорядкувати за:</div>
                            <select name="ord" class="ord" onchange="this.form.submit()">
                                <option value="asc" <?php echo $ord == 'asc' ? 'selected' : ''; ?>>зростанням</option>
                                <option value="desc" <?php echo $ord == 'desc' ? 'selected' : ''; ?>>спаданням</option>
                            </select>
                        </div>
                        <div class="orderby-item">
                            <div class="textHelper">показати:</div>
                            <select name="per" class="per" onchange="this.form.submit()">
                                <option value="30" <?php echo $per == '30' ? 'selected' : ''; ?>>30</option>
                                <option value="60" <?php echo $per == '60' ? 'selected' : ''; ?>>60</option>
                                <option value="120" <?php echo $per == '120' ? 'selected' : ''; ?>>120</option>
                            </select>
                        </div>
                    </div>

                    <div class="filter-pan">
                        <div class="orderby-item">
                            <div class="textHelper">країна:</div>
                            <select name="c" class="c" onchange="this.form.submit()">
                                <option value="" <?php echo $c == '' ? 'selected' : ''; ?>>--- виберіть країну ---</option>
                                <?php if (count($countryOptions) > 0) { ?>
                                    <?php foreach ($countryOptions as $countryOpt) { ?>
                                        <option value="<?php echo $countryOpt['iso']; ?>"
                                            <?php echo $c == $countryOpt['iso'] ? 'selected' : ''; ?> >
                                            <?php echo $countryOpt['name']; ?>
                                        </option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>


                </form>
            </div>

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

<div class="right" id="sidebar">

    <div id="sidebar_content">

        <div class="box">
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
