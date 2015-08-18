<?php
use app\helpers\MyBreadcrumbs;

$this->title = $author->fullName;
$this->params['breadcrumbs'][] = ['label' => 'Автори', 'url' => ['/authors']];
$this->params['breadcrumbs'][] = $this->title;
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
        <div class="authors_single">
            <div class="product-card">
                <div class="product-card-box">
                    <div class="product-card-img">
                        <a class="img">
                            <img src="<?php echo $author->img; ?>" alt=""/>
                        </a>
                    </div>
                    <div class="product-card-other-books">
                        <a href="<?php echo Yii::$app->homeUrl . 'authors/' . $author->id . '/books'; ?>">
                            [ всі книги автора ]
                        </a>
                    </div>
                </div>
                <div class="product-card-box">
                    <div class="product-card-title">
                        <?php echo $author->fullName; ?>
                    </div>

                    <div class="product-card-details">
                        <table class="data_table">
                            <tr>
                                <td>
                                    <div class="product-card-info-column">Роки життя:</div>
                                </td>
                                <td><?php echo $author->birthYear . ' - ' . $author->deathYear; ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="product-card-info-column">Країна:</div>
                                </td>
                                <td><?php echo $author->countryName; ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="product-card-info-column">Рейтинг:</div>
                                </td>
                                <td><?php echo $author->rating; ?></td>
                            </tr>

                        </table>
                    </div>
                </div>
                <div class="author-bio">
                    <?php echo $author->bio; ?>
                </div>

            </div>
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