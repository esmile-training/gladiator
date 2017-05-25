$(function (){
   var windowHeight = screen.height;
   var nameHeight = windowHeight / 22;
   
   var name = $("p.user_name");
   
   var userName = name.text();
   var beforeNameHeight = name.text(userName).get(0).offsetHeight;

   console.log(beforeNameHeight);

   beforeNameHeight = nameHeight / beforeNameHeight;
   
   var afterNameHeight = beforeNameHeight * 100 + '%';
   console.log(afterNameHeight);
   
   name.css('font-size', afterNameHeight);
   name.css('left', '0');
   name.css('right', '0');
   name.css('text-align', 'center');
   name.css('font-family', 'serif');
});
