<?php
namespace app\helpers;

use yii\widgets\Breadcrumbs;
use yii\helpers\Html;

class MyBreadcrumbs extends Breadcrumbs
{
    public $options = ['class' => 'breadcrumbs'];

    public $itemTemplate = "<li>{link}</li> / \n";

    public function run()
    {
        if (empty($this->links)) {
            return;
        }
        $links = [];
        if ($this->homeLink === null) {
            $links[] = $this->renderItem([
                'label' => Yii::t('yii', 'Home'),
                'url' => Yii::$app->homeUrl,
            ], $this->itemTemplate);
        } elseif ($this->homeLink !== false) {
            $links[] = $this->renderItem($this->homeLink, $this->itemTemplate);
        }
        foreach ($this->links as $link) {
            if (!is_array($link)) {
                $link = ['label' => $link];
            }
            $links[] = $this->renderItem($link, isset($link['url']) ? $this->itemTemplate : $this->activeItemTemplate);
        }
        echo '<div class="breadcrumbs-bar">'.Html::tag($this->tag, implode('', $links), $this->options).'</div>';
    }
}