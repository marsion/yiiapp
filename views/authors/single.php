<?php
use app\helpers\MyBreadcrumbs;

$this->title = $author->fullName;
$this->params['breadcrumbs'][] = ['label' => 'Автори', 'url' => ['/authors']];
$this->params['breadcrumbs'][] = $this->title;
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

        <div class="authors_single">
            <div class="product-card">
                <div class="product-card-box">
                    <div class="product-card-img">


                        <a class="img">
                            <img src="<?php echo $author->img; ?>" alt="" width="168" height="248"/>
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
                            <a href="<?php echo Yii::$app->homeUrl . 'books?a[]=' . $author->id; ?>">
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
                                    <a href="<?php echo Yii::$app->homeUrl . 'authors?byeq=e&byear=' . $author->birthYear; ?>">
                                        <?php echo $author->birthYear; ?></a>
                                    <?php echo " - "; ?>
                                    <a href="<?php echo Yii::$app->homeUrl . 'authors?dyeq=e&dyear=' . $author->deathYear; ?>">
                                        <?php echo $author->deathYear; ?></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="product-card-info">
                                    <div class="product-card-info-column">Країна:</div>
                                </td>
                                <td class="product-card-value">
                                    <a href="<?php echo Yii::$app->homeUrl . 'authors?c[]=' . $author->countryId; ?>">
                                        <?php echo $author->countryName; ?>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="product-card-info">
                                    <div class="product-card-info-column">Перша книга:</div>
                                </td>
                                <td class="product-card-value">
                                    <?php if (!empty($author->yearFirstBook)) { ?>
                                        <a href="<?php echo Yii::$app->homeUrl . 'books?yeq=e&year=' . $author->yearFirstBook; ?>">
                                            <?php echo $author->yearFirstBook; ?></a>
                                    <?php } else { ?>
                                        <?php echo "-"; ?>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="product-card-info">
                                    <div class="product-card-info-column">Остання книга:</div>
                                </td>
                                <td class="product-card-value">
                                    <?php if (!empty($author->yearLastBook)) { ?>
                                        <a href="<?php echo Yii::$app->homeUrl . 'books?yeq=e&year=' . $author->yearLastBook; ?>">
                                            <?php echo $author->yearLastBook; ?></a>
                                    <?php } else { ?>
                                        <?php echo "-"; ?>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="product-card-info">
                                    <div class="product-card-info-column">Всього книг:</div>
                                </td>
                                <td class="product-card-value">
                                    <a href="<?php echo Yii::$app->homeUrl . 'books?a[]=' . $author->id; ?>">
                                        <?php echo $author->bookAmount; ?>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="product-card-info">
                                    <div class="product-card-info-column">Видавництва:</div>
                                </td>
                                <td class="product-card-value">
                                    <?php if (count($author->publishingHouses) > 0) { ?>
                                        <?php for ($i = 0; $i < count($author->publishingHouses); $i++) { ?>
                                            <a href="<?php echo Yii::$app->homeUrl . 'books?ph[]=' . $author->publishingHouses[$i]->id; ?>">
                                                <?php echo $author->publishingHouses[$i]->name; ?></a>
                                            <?php if ((count($author->publishingHouses) > 1) && ($i < count($author->publishingHouses) - 1)) echo '; '; ?>
                                        <?php } ?>
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
                                    <?php if (count($author->genres) > 0) { ?>
                                        <?php for ($i = 0; $i < count($author->genres); $i++) { ?>
                                            <a href="<?php echo Yii::$app->homeUrl . 'books?g[]=' . $author->genres[$i]->id; ?>">
                                                <?php echo $author->genres[$i]->name; ?></a>
                                            <?php if ((count($author->genres) > 1) && ($i < count($author->genres) - 1)) echo '; ';
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
                    <?php echo $author->bio; ?>
                </div>


                <?php if (count($popularBooks) > 0) { ?>
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

                <?php if (count($usersChoiceBooks) > 0) { ?>

                    <div class="content_separator"></div>

                    <div class="additional_books_title">Читачі <?php echo '&ldquo;' . $author->fullName . '&rdquo;'; ?>
                        також обирають:
                    </div>
                    <div class="additional_books">
                        <?php foreach ($usersChoiceBooks as $book) { ?>
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

<div id="sidebar-right" class="main-column">

    <div id="sidebar-right-content">

        <div class="box">

            <div class="box_title">Топ-5 книг автора</div>

            <div class="box_content_center">
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
        </div>


    </div>

</div>