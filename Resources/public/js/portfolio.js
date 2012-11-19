/*jshint devel:true */
$(document).ready(function() {
	$(".dropdown-docs").click(function() {
		$('.dropdown-docs-div').slideToggle();
		if($(this).find("i").hasClass("icon-circle-arrow-down")) {
			$(this).find("i").attr("class", "icon-circle-arrow-up");
		}
		else {
			$(this).find("i").attr("class", "icon-circle-arrow-down");
		}


		return false;
	});
});