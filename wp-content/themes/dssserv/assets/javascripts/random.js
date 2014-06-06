//Full Screen Menu dropdowns
$("#list-link").hover(function() {
	$("#list").toggle();
	$(".submenu").toggle();
});
$("#services-link").hover(function() {
	$("#services").toggle();
	$(".submenu").toggle();
});
$("#resources-link").hover(function() {
	$("#resources").toggle();
	$(".submenu").toggle();
});

//Property's Page collapse
$('.collapse.single-prop').on('show.bs.collapse', function() {
	var $openTarget = "#" + $(this).attr('id');
	$("button, .individual").removeClass("selected");
	$('.collapse.single-prop.in').collapse('hide');

	if($("[data-target='" + $openTarget + "']")){
		$("button[data-target='" + $openTarget + "']").addClass("selected");
	}
	$(".selected").parent().parent().addClass("selected");
});
//Property's Page Collapse Close button
$("button").click(function() {
	$(this).removeClass("selected");
	$(".individual").removeClass("selected");
});

//Removed close button when entire div i sslected
$(".individual").click(function(){
	$(this).removeClass("selected");
	console.log($(this).children().last());
	$(this).children().last().children().toggleClass("selected");
});

//Single Property hover
$(".lightbox-gallery").hover(function(){
	$(this).toggleClass("hover");
});

//Set links to be active