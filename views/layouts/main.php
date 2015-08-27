<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\helpers\MyBreadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= isset($this->title) ? Html::encode($this->title).' - ' : Html::encode($this->title);
        echo  Yii::t('app', 'My Company') . ' - '
        . Yii::t('app', 'online library')?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div id="header">
    <div class="center_wrapper">

        <div id="toplinks">
            <div id="toplinks_inner">
                <?php
                    echo Yii::$app->user->isGuest ?
                        '<a href="/login">Вхід</a> |' :
                        '<a href="/logout">Вихід ('.Yii::$app->user->identity->getId().')</a> |';
                ?>
                <a href="#">FAQ</a></a>
            </div>
        </div>
        <div class="clearer">&nbsp;</div>

        <div id="site_title">
            <h1><a href="<?php echo Yii::$app->homeUrl; ?>"><span>ЧАС </span>ЧИТАТИ</a></h1>
            <p>... коли людина припиняє читати, вона перестає мислити ...</p>
        </div>

    </div>
</div>

<div id="navigation">
    <div class="center_wrapper">

        <ul>
            <li class="current_page_item">
                <a href="<?php echo Yii::$app->homeUrl; ?>"><?php echo Yii::t('app', 'Home') ?></a>
            </li>
            <li><a href="#"><?php echo 'Top-100' ?></a></li>
            <li><a href="/books"><?php echo Yii::t('app', 'Books') ?></a></li>
            <li><a href="/authors"><?php echo Yii::t('app', 'Authors') ?></a></li>
            <li><a href="#"><?php echo 'Видавництва'; ?></a></li>
            <li><a href="#"><?php echo 'Жанри'; ?></a></li>
            <li><a href="/about"><?php echo Yii::t('app', 'About') ?></a></li>
            <li><a href="/contact"><?php echo Yii::t('app', 'Contact us') ?></a></li>
        </ul>

        <div class="clearer">&nbsp;</div>

    </div>
</div>

<div id="main_wrapper_outer">
    <div id="main_wrapper_inner">
        <div class="center_wrapper">
            <!-- ---------------------------- -->

            <!-- ------------------------ -->
            <?= $content ?>
            <!-- ------------------------ -->

            <div class="clearer">&nbsp;</div>
        </div>
    </div>
</div>

<div id="dashboard">
    <div id="dashboard_content">
        <div class="center_wrapper">

            <div class="col3 left">
                <div class="col3_content">

                    <h4>Tincidunt</h4>
                    <ul>
                        <li><a href="#">Consequat molestie</a></li>
                        <li><a href="#">Sem justo</a></li>
                        <li><a href="#">Semper eros</a></li>
                        <li><a href="#">Magna sed purus</a></li>
                        <li><a href="#">Tincidunt morbi</a></li>
                    </ul>

                </div>
            </div>

            <div class="col3mid left">
                <div class="col3_content">

                    <h4>Fermentum</h4>
                    <ul>
                        <li><a href="#">Semper fermentum</a></li>
                        <li><a href="#">Sem justo</a></li>
                        <li><a href="#">Magna sed purus</a></li>
                        <li><a href="#">Tincidunt nisl</a></li>
                        <li><a href="#">Consequat molestie</a></li>
                    </ul>

                </div>
            </div>

            <div class="col3 right">
                <div class="col3_content">

                    <h4>Praesent</h4>
                    <ul>
                        <li><a href="#">Semper lobortis</a></li>
                        <li><a href="#">Consequat molestie</a></li>
                        <li><a href="#">Magna sed purus</a></li>
                        <li><a href="#">Sem morbi</a></li>
                        <li><a href="#">Tincidunt sed</a></li>
                    </ul>

                </div>
            </div>

            <div class="clearer">&nbsp;</div>

        </div>
    </div>
</div>
<footer class="footer">
    <div id="footer">
        <div class="center_wrapper">

            <div class="left">
                &copy; <?= Yii::t('app', 'My Company').'! '; ?><?= date('Y') ?>
            </div>
            <div class="right">made by <span id="author">kshukost</span></div>

            <div class="clearer">&nbsp;</div>

        </div>
    </div>
</footer>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
