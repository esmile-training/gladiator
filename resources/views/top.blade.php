@include('common/css', ['file' => 'top'])


<div class="top_button">
    <input type="submit" value="ログイン" class="top_login"><a href="{{APP_URL}}top/login"></a>
</div>

<div>
    <a href="{{APP_URL}}mypage">
	管理画面
    </a>
</div>

<div>
    <a href="{{APP_URL}}battleStanby">
	バトルスタンバイ画面
    </a>
