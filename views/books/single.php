<?php
use app\helpers\MyBreadcrumbs;


$this->title = $book->title;
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => [Yii::$app->homeUrl . '/books']];
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
        <div class="books_single">
            <div class="product-card">
                <div class="product-card-box">
                    <div class="product-card-img">
                        <a class="img">
                            <img src="<?php echo $book->img; ?>" alt="<?php echo $book->title; ?>" width="168"
                                 height="248"/>
                        </a>

                        <div class="product-card-rating">
                            - <?php echo $book->rating; ?> +
                        </div>
                    </div>
                </div>
                <div class="product-card-box">
                    <div class="product-card-title">
                        <?php echo '"' . $book->title . '"'; ?>
                    </div>
                    <div class="product-card-title">
                        <?php for ($i = 0; $i < count($book->authors); $i++) { ?>
                            <a href="<?php echo Yii::$app->homeUrl . 'authors/' . $book->authors[$i]->id; ?>">
                                <?php echo $book->authors[$i]->fullName; ?>
                            </a>
                            <?php if ((count($book->authors) > 1) && ($i < count($book->authors) - 1)) echo ', ';
                        } ?>
                    </div>

                    <div class="product-card-details">
                        <table class="data_table">

                            <tr>
                                <td class="product-card-info">
                                    <div class="product-card-info-column">Кількість сторінок:</div>
                                </td>
                                <td class="product-card-value">
                                    <?php if ($book->pages > 0) { ?>
                                        <?php echo $book->pages; ?>
                                    <?php } else { ?>
                                        <?php echo "-"; ?>
                                    <?php } ?>
                                </td>
                            </tr>


                            <tr>
                                <td class="product-card-info">
                                    <div class="product-card-info-column">Мова:</div>
                                </td>
                                <td class="product-card-value">
                                    <?php if (!empty($book->lang)) { ?>
                                        <a href="<?php echo Yii::$app->homeUrl . 'books?l=' . $book->lang->id; ?>">
                                            <?php echo $book->lang->name; ?></a>
                                    <?php } else { ?>
                                        <?php echo "-"; ?>
                                    <?php } ?>
                                </td>
                            </tr>


                            <tr>
                                <td class="product-card-info">
                                    <div class="product-card-info-column">Мова оригіналу:</div>
                                </td>
                                <td class="product-card-value">
                                    <?php if (!empty($book->origLang)) { ?>
                                        <a href="<?php echo Yii::$app->homeUrl . 'books?lo=' . $book->origLang->id; ?>">
                                            <?php echo $book->origLang->name; ?></a>
                                    <?php } else { ?>
                                        <?php echo "-"; ?>
                                    <?php } ?>
                                </td>
                            </tr>


                            <tr>
                                <td class="product-card-info">
                                    <div class="product-card-info-column">Видавництва:</div>
                                </td>
                                <td class="product-card-value">
                                    <?php  if (!empty($book->publishingHouse)) { ?>
                                        <a href="<?php echo Yii::$app->homeUrl . 'books?ph=' . $book->publishingHouse->id; ?>">
                                            <?php echo $book->publishingHouse->name; ?></a>
                                    <?php } else { ?>
                                        <?php echo "-"; ?>
                                    <?php } ?>
                                </td>
                            </tr>


                            <tr>
                                <td class="product-card-info">
                                    <div class="product-card-info-column">Рік видання:</div>
                                </td>
                                <td class="product-card-value">
                                    <?php if (!empty($book->year)) { ?>
                                        <?php echo $book->year; ?>
                                    <?php } else { ?>
                                        <?php echo "-"; ?>
                                    <?php } ?>
                                </td>
                            </tr>


                            <tr>
                                <td class="product-card-info">
                                    <div class="product-card-info-column">Серія:</div>
                                </td>
                                <td class="product-card-value">
                                    <?php if (count($book->series) > 0) { ?>
                                        <?php echo $book->series->name; ?>
                                    <?php } else { ?>
                                        <?php echo "-"; ?>
                                    <?php } ?>
                                </td>
                            </tr>


                            <tr>
                                <td class="product-card-info">
                                    <div class="product-card-info-column">Перекладач:</div>
                                </td>
                                <td class="product-card-value">
                                    <?php if (count($book->translator) > 0) { ?>
                                        <?php echo $book->translator->name; ?>
                                    <?php } else { ?>
                                        <?php echo "-"; ?>
                                    <?php } ?>
                                </td>
                            </tr>


                            <tr>
                                <td class="product-card-info">
                                    <div class="product-card-info-column">ISBN:</div>
                                </td>
                                <td class="product-card-value">
                                    <?php if (!empty($book->isbn)) { ?>
                                        <?php echo $book->isbn; ?>
                                    <?php } else { ?>
                                        <?php echo "-"; ?>
                                    <?php } ?>
                                </td>
                            </tr>

                            <tr>
                                <td class="product-card-info">
                                    <div class="product-card-info-column">Категорії:</div>
                                </td>
                                <td class="product-card-value">
                                    <?php if (count($book->genres) > 0) { ?>
                                        <?php for ($i = 0; $i < count($book->genres); $i++) { ?>
                                            <a href="<?php echo Yii::$app->homeUrl . 'books?g=' . $book->genres[$i]->id; ?>">
                                                <?php echo $book->genres[$i]->name; ?>
                                            </a>
                                            <?php if ((count($book->genres) > 1) && ($i < count($book->genres) - 1)) echo ', ';
                                        } ?>
                                    <?php } else { ?>
                                        <?php echo "-"; ?>
                                    <?php } ?>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
                <div class="author-bio">
                    <?php echo $book->description; ?>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="right" id="sidebar">

    <div id="sidebar_content">

        <!--<div class="box">

            <div class="box_title">Категорії</div>
            <?php /*if (count($genres) > 1) { */ ?>
                <div class="box_content">
                    <ul>
                        <?php /*foreach ($genres as $genre) { */ ?>
                            <li><a href="#"><?php /*echo $genre['text']; */ ?></a></li>
                        <?php /*} */ ?>
                    </ul>
                </div>
            <?php /*} */ ?>
        </div>-->

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