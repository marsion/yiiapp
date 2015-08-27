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
                        <div class="product-card-rating">
                            - <?php echo $author->rating; ?> +
                        </div>
                    </div>

                </div>
                <div class="product-card-box">
                    <div class="product-card-title">
                        <?php echo $author->fullName; ?>
                        <span class="product-card-other-books">
                            <a href="<?php echo Yii::$app->homeUrl . 'authors/' . $author->id . '/books'; ?>">
                                [ всі книги автора ]
                            </a>
                        </span>
                    </div>

                    <div class="product-card-details">
                        <table class="data_table">
                            <tr>
                                <td class="product-card-info">
                                    <div class="product-card-info-column">Роки життя:</div>
                                </td>
                                <td class="product-card-value">
                                    <?php echo $author->birthYear . ' - ' . $author->deathYear; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="product-card-info-column">Країна:</div>
                                </td>
                                <td>
                                    <a href="<?php echo Yii::$app->homeUrl . 'authors?c=' . $author->countryISO; ?>">
                                        <?php echo $author->countryName; ?>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="product-card-info-column">Перша книга:</div>
                                </td>
                                <td><?php echo $author->yearFirstBook; ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="product-card-info-column">Остання книга:</div>
                                </td>
                                <td><?php echo $author->yearLastBook; ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="product-card-info-column">Кількість книг:</div>
                                </td>
                                <td><?php echo $author->bookAmount; ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="product-card-info-column">Видавництва:</div>
                                </td>
                                <td>
                                    <?php for ($i = 0; $i < count($author->publishingHouses); $i++) { ?>
                                        <a href="<?php echo Yii::$app->homeUrl . 'authors?c=' . $author->publishingHouses[$i]->id; ?>">
                                            <?php echo $author->publishingHouses[$i]->name; ?>
                                        </a>
                                        <?php if ((count($author->publishingHouses) > 1) && ($i < count($author->publishingHouses) - 1)) echo '; '; ?>
                                    <?php } ?>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
                <div class="author-bio">
                    <?php echo $author->bio; ?>
                </div>


                <?php if(count($popularBooks) > 0) { ?>
                    <div class="content_separator"></div>

                    <div class="additional_books_title">Найпопулярніші книги автора:</div>
                    <div class="additional_books">
                        <?php foreach ($popularBooks as $book) { ?>
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
                                        <?php if ((count($book->authors) > 1) && ($i < count($book->authors) - 1)) echo ', '; ?>
                                   <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                <?php } ?>

                <?php if(count($popularBooks) > 0) { ?>

                    <div class="content_separator"></div>

                    <div class="additional_books_title">Читачі також обирають:</div>
                    <div class="additional_books">
                        <?php foreach ($popularBooks as $book) { ?>
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

                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="right" id="sidebar">

    <div id="sidebar_content">

        <!--<div class="box">

            <div class="box_title">Категорії</div>
            <?php /*if (count($genres) > 1) { */?>
                <div class="box_content">
                    <ul>
                        <?php /*foreach ($genres as $genre) { */?>
                            <li><a href="#"><?php /*echo $genre['text']; */?></a></li>
                        <?php /*} */?>
                    </ul>
                </div>
            <?php /*} */?>
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