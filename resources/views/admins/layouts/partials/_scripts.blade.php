<script>
var toggle = true;

$(".sidebar-icon").click(function() {
  if (toggle)
  {
    $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
    $("#menu span").css({"position":"absolute"});
  }
  else
  {
    $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
    setTimeout(function() {
      $("#menu span").css({"position":"relative"});
    }, 400);
  }
                toggle = !toggle;
            });
</script>

<!--scrolling js-->
<script src="{{ URL::asset('/admin/js/jquery.nicescroll.js') }}"></script>
<script src="{{ URL::asset('/admin/js/scripts.js') }}"></script>
		<!--//scrolling js-->
<script src="{{ URL::asset('/admin/js/bootstrap.js') }}"> </script>

<script src="{{ URL::asset('/admin/js/jquery.filer.js') }}"> </script>
<!-- mother grid end here-->
    <script>
$(document).ready(function(){
    $("#user").hover(function(){
          $(this).css("color", "#1C7203");
        }, function(){
        $(this).css("color", "#FFFFFF");
    });
});
</script>