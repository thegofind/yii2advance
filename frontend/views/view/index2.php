
<!--<h1><?=$say_hi;?></h1>-->

<!-- 保留script标签，但使之无效 -->
<?php
use yii\helpers\Html;
?>
<h1><?=Html::encode($say_hi);?></h1>

<!-- 直接删除script标签 -->
<?php
use yii\helpers\HtmlPurifier;
?>
<h1><?=HtmlPurifier::process($say_hi);?></h1>