<?php

$this->title = $author->firstName.' '.$author->lastName;
$this->params['breadcrumbs'][] = ['label' => 'Автори', 'url' => ['/authors']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="authors_single">
    <div class="product-card">
        <div class="product-card-box">
            <div class="product-card-img">
                <a class="img">
                    <img src="<?php echo Yii::$app->request->baseUrl; ?>/css/images/authors/<?php echo $author->img; ?>" alt="" />
                </a>
            </div>
            <div class="product-card-other-books">
                <a href="<?php echo Yii::$app->homeUrl.'authors/'.$author->id.'/books'; ?>">
                    [ всі книги автора ]
                </a>
            </div>
        </div>
        <div class="product-card-box">
            <div class="product-card-title">
                    <?php echo $author->firstName.' '.$author->lastName; ?>
                    <?php echo $author->countryId != 1
                        ? ' ('.$author->originalFirstName.' '.$author->originalLastName.')'
                        : ''; ?>
            </div>

            <div class="product-card-details">
                <table class="data_table">
                    <tr>
                        <td><div class="product-card-info-column">Роки життя:</div></td>
                        <td><?php echo '('.$author->birthYear.' - '.$author->deathYear.')'; ?></td>
                    </tr>
                    <tr>
                        <td><div class="product-card-info-column">Країна:</div></td>
                        <td><?php echo $author->countryName; ?></td>
                    </tr>
                    <tr>
                        <td><div class="product-card-info-column">Рейтинг:</div></td>
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