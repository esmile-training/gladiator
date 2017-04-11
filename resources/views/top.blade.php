 <?php //css  ?>
<link href="css/top.css" rel="stylesheet" type="text/css">

<div>
    おめでとう！！<br>
    top画面が表示されたよ♪
</div>

<?php //画像  ?>
<div>
    <img class="topTitles" src="<?= IMG_URL ?>title.png">
</div>

<?php //foreachでメンバーリスト表示する  ?>
<div>
    <?php foreach( $viewData['memberList'] as $type => $memberList ): ?>
        <div>
            【<?= $type ?>】
        </div>
        <?php foreach( $memberList as $name ): ?>
            <div>
                <?= $name ?>
            </div>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>

<?php //ハイパーリンク  ?>
<div>
    <a href="<?= APP_URL ?>mypage">
            MYPAGEへ
    </a>
</div>

 <?php //viewParts  ?>

<?php //popup  ?>
