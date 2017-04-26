
<div>
     <a href="{{APP_URL}}top/login">
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