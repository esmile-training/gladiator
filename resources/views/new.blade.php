@include('common/css', ['file' => 'new'])

    <div class="new_content">
	<div class="new_content_wrrap">
	    <form action="{{APP_URL}}adduser" method="get">
			<p>チーム名を入力してください</p>
			<input type="text" name="teamname" size="32">
	    </form><?php//ユーザー名入力欄 ?>
	    
	    <form class="new_button">
			<input type="submit" value="登録する" class="registration_button"><a href="{{APP_URL}}top/login?uid=123456"></a>
			<input type="submit" value="トップに戻る"  class="return_top_button"><a href="{{APP_URL}}top/login?uid=123456"></a>
	    </form>
	</div>
    </div>


