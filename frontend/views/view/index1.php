<h1><?=$view_name;?></h1>
<h1><?=$view_phone[0];?></h1>

<?php $this->beginBlock('blockOfIndex1');?>
<h1>hi,i am a common user</h1>
<?php $this->endBlock();?>

<?php $this->beginBlock('vipBlockOfIndex1');?>
<h1>hi,i am a vip user</h1>
<?php $this->endBlock();?>


