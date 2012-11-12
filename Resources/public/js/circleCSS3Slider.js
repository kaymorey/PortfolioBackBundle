/* Katia Moreira - Circle CSS3 Slider - Portfolio */

jQuery.fn.extend({
	circleCSS3Slider : function(options)
	{
		var settings = $.extend({
				auto: false,
				animationSpeed : 500,
				animationInterval : 2000,
				sliderClass : ".slider",
				sliderElementClass : "img",
				paginatorElement : ".paginator",
				animationElement: ".circle"
		}, options);
		var currentIndex = 0;
		var slider = $(settings.sliderClass);
		var classElement = settings.sliderElementClass;
		var nbSlide = slider.find(classElement).length;
		var animationElement = slider.find($(settings.animationElement));
		
		var paginator = $(settings.paginatorElement);
		if(paginator.length == 0)
			var  noPaginator = true;
		else  {
			var noPaginator = false;
			paginator.find("a:first").addClass("active");
		}

		var roll = settings.auto;
		if(roll) {
			goAuto = function() {
				if(currentIndex == nbSlide-1)
					currentIndex = -1;
				
				goToNext();
			};
		}
		var startAuto = function() {
			auto = setInterval("goAuto();",settings.animationInterval);
			roll = true;
		};
		var stopAuto = function() {
			clearInterval(auto);
			roll = false;
		};
		var goToNext = function() {
			if(currentIndex < nbSlide-1)
				currentIndex++;
			else
				currentIndex = 0;

			if(!noPaginator)
				paginator.find("a").eq(currentIndex).click();
			else 
				goToIndex(currentIndex);
		};
		var goToPrevious = function() {
			if(currentIndex > 0)
			{
				currentIndex--;
				if(!noPaginator)
					paginator.find("a").eq(currentIndex).click();
				else 
					goToIndex(currentIndex);
			}
		};
		
		var goTo = function(e) {
			e.preventDefault();
			clearInterval(auto);
			var index = paginator.find("a").index($(this));
			if (currentIndex != index)
				var prevIndex = currentIndex;
			else
				var prevIndex = currentIndex-1;
				
			currentIndex = index;
			paginator.find("a").removeClass("active");
			$(this).addClass("active");

			close = setInterval("animationClose();", 4000);
			slider.find("img").hide();
			slider.find("img").eq(index).show();
			open = setInterval("animationOpen();", 1000);

			if(roll)
				startAuto();
		};
		var goToIndex = function(index) {
			clearInterval(auto);
			currentIndex = index;
			$(this).addClass("active");
			close = setInterval("animationClose();", 5500);
			slider.find("img").hide();
			slider.find("img").eq(index).show();
			open = setInterval("animationOpen();", 300);

			if(roll)
				startAuto();
				
		};
		animationOpen = function() {
			$(animationElement).css("background-position", "-330px -330px, 330px -330px, -330px 330px, 330px 330px");
			clearInterval(open);
		}
		animationClose = function() {
			$(animationElement).css("background-position", "-50px -50px, 50px -50px, -50px 50px, 50px 50px");
			clearInterval(close);
		}
		
		if(!noPaginator) {
			paginator.find("a").click(goTo);
			paginator.find(".prev").click(goToPrevious);
			paginator.find(".next").click(goToNext);
		}
		
		if(roll)
			startAuto();

		animationOpen();

	}
});
