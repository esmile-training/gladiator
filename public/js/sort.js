function onRadioButtonChange() {
      check1 = document.form1.Radio1.checked;
      check2 = document.form1.Radio2.checked;

      target = document.getElementById("output");

      if (check1 == true) {
        target.innerHTML = "要素1がチェックされています。<br/>";
      }
      else if (check2 == true) {
        target.innerHTML = "要素2がチェックされています。<br/>";
      }
    }