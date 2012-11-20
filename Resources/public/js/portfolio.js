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
			$.fancybox.open({
				href : Routing.generate("portfolioback_categories_remove", {"id" : id}),
				type : "ajax",
				closeBtn : false
			});
		});
	});
	/*$.fancybox.open({
		href : Routing.generate("ficep_newsletter"),
		type : "ajax",
		helpers: {
			overlay : {
				opacity : 0.4
			}
		},
		closeBtn : false,
		afterShow : function() {
			$('.registerNews .send').click(registerNewsletter);
		}
	});*/
	return false;
});