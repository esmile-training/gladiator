@include('common/css', ['file' => 'purchase'])

<?php
	$number[$purchaseData['productData']['id']] = 0;
?>
<div class="purchase">
	{{-- 背景画像 --}}
	<img src="{{IMG_URL}}shop/popup_Bg.png" class="purchase_bg">

	<div id="purchase_name">
	{{$purchaseData['itemData']['name']}}
	</div>
	<div id="purchase_price">
		{{$purchaseData['productData']['price']}}　ゴールド
	</div>

	<div class="purchase_select_number">
		<table border="0">
			<tr>
				<td width="5%"></td>
				<td width="40%">
					個数選択
				</td>
				<td width="10%" align="left">
					<img src="{{IMG_URL}}popup/minus_Button.png" class="image_change purchase_select_number_minus_img" onclick="cntDown{{$purchaseData['productData']['id']}}()">
				</td>
				<td width="30%">
					<div id="number{{$purchaseData['productData']['id']}}">
						{{$number[$purchaseData['productData']['id']]}}
					</div>
				</td>
				<td width="10%">
					<img src="{{IMG_URL}}popup/plus_Button.png" class="image_change purchase_select_number_plus_img" onclick="cntUp{{$purchaseData['productData']['id']}}()">
				</td>
				<td width="5%"></td>
			</tr>
		</table>
	</div>
	<div>
		<table border="0">
			<tr>
				<td width="5%"></td>				
				<td width="40%">
					合計金額
				</td>
				<td width="5%"></td>
				<td width="45%">
					<div id="totalPrice">
						{{$purchaseData['productData']['price']}}
					</div>
				</td>
				<td width="5%"></td>
			</tr>
		</table>
	</div>
	
	<div class="purchase_button_ok clickfalse">
		<a href="{{APP_URL}}shop/updateBelongings?itemId={{$purchaseData['itemData']['id']}}">
			<img src="{{IMG_URL}}popup/purchase_Button.png" class="image_change purchase_button_ok_img">
		</a>
	</div>
</div>

<script type="text/javascript" src="{{APP_URL}}js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="{{APP_URL}}js/imgChange.js"></script>

<script type="text/javascript">
	
	var $cnt = 0;
	
	function cntUp{{$purchaseData['productData']['id']}}() {
		if(document.getElementById( "number{{$purchaseData['productData']['id']}}" ).innerHTML >= 10){
			return false;
		}
		document.getElementById( "number{{$purchaseData['productData']['id']}}" ).innerHTML = ++$cnt;
	}
	
	function cntDown{{$purchaseData['productData']['id']}}() {
		if(document.getElementById( "number{{$purchaseData['productData']['id']}}" ).innerHTML <= 0){
			return false;
		}
		document.getElementById( "number{{$purchaseData['productData']['id']}}" ).innerHTML = --$cnt;
	}
</script>