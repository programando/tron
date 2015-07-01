// Producto => vista ampliada => tooltips = Ver otras referencias
  function simple_tooltip(target_items, name){
    $(target_items).each(function(i){
      $("body").append("<div class='"+name+"' id='"+name+i+"'><p>"+$(this).attr('title')+"</p></div>");
      var my_tooltip = $("#"+name+i);

      $(this).removeAttr("title").mouseover(function(){
          my_tooltip.css({opacity:0.9, display:"none"}).fadeIn(400);
      }).mousemove(function(kmouse){
          my_tooltip.css({left:kmouse.pageX-160, top:kmouse.pageY+20});
      }).mouseout(function(){
          my_tooltip.fadeOut(400);
      });
    });
  }


simple_tooltip("a.nuvv","tooltip");
