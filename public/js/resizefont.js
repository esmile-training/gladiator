$(function (){
   var windowWidth = screen.width;
   var nameWidth = windowWidth / 4;
   
   var name = $("p.user_name");
   
   var userName = name.text();
   var beforeNameWidth = name.text(userName).get(0).offsetWidth;
   //width = $("p.user_name").empty();
   console.log(nameWidth);
   console.log(beforeNameWidth);
   if(beforeNameWidth < nameWidth)
   {
       beforeNameWidth = nameWidth / beforeNameWidth;
   }
   console.log(beforeNameWidth);
   
   var afterNameWidth = beforeNameWidth * 100 + '%';
   console.log(afterNameWidth);
   
   name.css('font-size', afterNameWidth);
   name.css('left', '0');
   name.css('right', '0');
   name.css('text-align', 'center');
   
});
