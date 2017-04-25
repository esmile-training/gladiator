<!-- 永続的Cookeiの仮置き -->
<?php //setcookie('userId',"",time() + 60*60*24*365*20, '/'); ?>

<div>
     <a href="{{APP_URL}}top/login?uid=123456">
	ログイン
    </a>
</div>

<div>
    <a href="{{APP_URL}}admin">
	管理画面
    </a>
</div>

<div>
    <a href="{{APP_URL}}edit/index?">
	エディット画面
    </a>
</div>

<div>
    <!-- Cookieの内容を確認 -->
    <?php if(isset($_COOKIE["userId"])) print $_COOKIE['userId']; ?>
</div>