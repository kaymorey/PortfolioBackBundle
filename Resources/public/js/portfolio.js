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

	$(document).ready(function() {
		$(".fancybox").fancybox();

		$(".fancy-remove").click(function() {
			var id = $(this).attr("data-id");
			var route = $(this).attr("href");
			$.fancybox.open({
				href : route,
				type : "ajax",
				closeBtn : false,
				afterShow : function() {
					$('.remove .btn-danger').click(function() {
						$.fancybox.close();
						return false;
					});
				}
			});
			return false;
		});
	});
});