<?php setcookie('username',"aaa"); ?>

<div>
     <a href="{{APP_URL}}top/login?uid=123456">
	ログイン
    </a>
    <form action="sample" method="get">
	<input type="text" name="username" value="">
	<br>
	<input type="submit" value="ログイン">
    </form>
</div>

<div>
    <a href="{{APP_URL}}admin">
	管理画面
    </a>
</div>

<div>
    <a href="{{APP_URL}}edit">
	エディット画面
    </a>
</div>

<div>
    <a href="{{APP_URL}}calc">
	計算機跡地
    </a>
</div>

<div>
    <a href="{{APP_URL}}test">
	テストページ
    </a>
</div>

<div>
    <a href="{{APP_URL}}test2">
	テストページ2
    </a>
</div>

<div>
<?php if(isset($_COOKIE["username"])) print "OK"; ?>
</div>