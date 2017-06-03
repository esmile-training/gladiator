num = 2; // 入れ替える画像の枚数(最初の画像も含める)
nme = "http://esmile-sys.sakura.ne.jp/gladiator/img/status/arrow" // 画像のディレクトリとファイル名の数字と拡張子より前の部分
exp = "png" // 拡張子
cnt = 0;
function changeImage() {
  cnt++;
  cnt %= num;
  document.img.src = nme + cnt + "." + exp;
}

