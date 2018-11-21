function Inicio(){

	$('.sidebar-menu').tree();

	$(".treeview-menu a").click(function(e){
		e.preventDefault();
        url = $(this).attr("href");
		console.log(url);
        $.post( url, {url:url},function(data) {
        		if(url!="#")
        			$(".content-header" ).html(data);
        });
     });

}