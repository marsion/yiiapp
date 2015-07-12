<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>

<div class="authors_list" xmlns="http://www.w3.org/1999/html">

    <?php echo '<br><br>'; ?>

    <?php $sort = !empty( $_GET['sort'] ) ? $_GET['sort'] : 'lname'; ?>
    <?php $ord = !empty( $_GET['ord'] ) ? $_GET['ord'] : 'desc'; ?>
    <?php $country = !empty( $_GET['country'] ) ? $_GET['country'] : ''; ?>
    <?php $sec = !empty( $_GET['sec'] ) ? $_GET['sec'] : ''; ?>
    <?php $per = !empty( $_GET['per'] ) ? $_GET['per'] : '2'; ?>

    <div>
        <form action="authors" method="get">
            <span>
                <select name="sec" onchange="this.form.submit()">
                    <option value="" <?php echo $sec == '' ? 'selected' : ''; ?>>--- секція ---</option>
                    <option value="dyt" <?php echo $sec == 'dyt' ? 'selected' : ''; ?>>дитяча</option>
                    <option value="hud" <?php echo $sec == 'hud' ? 'selected' : ''; ?>>художня</option>
                    <option value="dov" <?php echo $sec == 'dov' ? 'selected' : ''; ?>>довідкова</option>
                    <option value="nav" <?php echo $sec == 'nav' ? 'selected' : ''; ?>>навчальна</option>
                    <option value="dil" <?php echo $sec == 'dil' ? 'selected' : ''; ?>>ділова</option>
                    <option value="insh" <?php echo $sec == 'insh' ? 'selected' : ''; ?>>інша</option>
                </select>
            </span>
            <span>
                <select name="country" onchange="this.form.submit()">
                    <option value="" <?php echo $country == '' ? 'selected' : ''; ?>>--- країна ---</option>
                    <option value="us" <?php echo $country == 'us' ? 'selected' : ''; ?>>США</option>
                    <option value="fr" <?php echo $country == 'fr' ? 'selected' : ''; ?>>Франція</option>
                    <option value="ua" <?php echo $country == 'ua' ? 'selected' : ''; ?>>Україна</option>
                    <option value="gb" <?php echo $country == 'gb' ? 'selected' : ''; ?>>Великобританія</option>
                    <option value="ru" <?php echo $country == 'ru' ? 'selected' : ''; ?>>Росія</option>
                </select>
            </span>

            <span>
                <span>за: </span>
                <select name="sort" onchange="this.form.submit()">
                    <option value="fname" <?php echo $sort == 'fname' ? 'selected' : ''; ?>>ім’ям</option>
                    <option value="lname" <?php echo $sort == 'lname' ? 'selected' : ''; ?>>прізвищем</option>
                    <option value="country" <?php echo $sort == 'country' ? 'selected' : ''; ?>>країною</option>
                </select>
            </span>
            <span>
                <select name="ord" onchange="this.form.submit()">
                    <option value="asc" <?php echo $ord == 'asc' ? 'selected' : ''; ?>>ASC</option>
                    <option value="desc" <?php echo $ord == 'desc' ? 'selected' : ''; ?>>DESC</option>
                </select>
            </span>
            <span>
                <span>по: </span>
                <select name="per" onchange="this.form.submit()">
                    <option value="2" <?php echo $per == '2' ? 'selected' : ''; ?>>2</option>
                    <option value="3" <?php echo $per == '3' ? 'selected' : ''; ?>>3</option>
                    <option value="4" <?php echo $per == '4' ? 'selected' : ''; ?>>4</option>
                </select>
            </span>
        </form>
    </div>

    <?php
    echo '<br><br>';
    echo LinkPager::widget([
        'pagination' => $pages,
    ]);

    ?>

    <?php
    foreach($authors as $author) { ?>
    <div class="post">
        <div class="thumbnails">
            <a href="<?php echo Yii::$app->homeUrl.'authors/'.$author->id; ?>" class="thumb">
                <img src="../css/img/sample-thumbnail.jpg" width="120" height="150" alt="" />
            </a>
        </div>
        <div class="post_title">
            <h3>
                <a href="<?php echo Yii::$app->homeUrl.'authors/'.$author->id; ?>">
                    <?php echo $author->firstName.' '.$author->lastName; ?>
                </a>
            </h3>
        </div>
        <div class="post_title">
            <h6>
                <?php echo '('.$author->birthYear.' - '.$author->deathYear.')'; ?>
            </h6>
        </div>
        <div class="post_title">
            <h6>
                <?php echo $author->countryName; ?>
            </h6>
        </div>
        <div class="post_body">
            <?php echo $author->bio; ?>
                <?= Html::a('[детальніше]', [Yii::$app->homeUrl.'authors/'.$author->id]) ?>
        </div>
    </div>
    <?php } ?>
    <?php

    echo LinkPager::widget([
        'pagination' => $pages,
    ]);

    ?>

</div>