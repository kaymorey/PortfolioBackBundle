/*jshint devel:true */$(document).ready(function(){$(".dropdown-docs").click(function(){$(".dropdown-docs-div").slideToggle();$(this).find("i").hasClass("icon-circle-arrow-down")?$(this).find("i").attr("class","icon-circle-arrow-up"):$(this).find("i").attr("class","icon-circle-arrow-down");return!1});$(document).ready(function(){$(".fancybox").fancybox();$(".fancy-remove").click(function(){var e=$(this).attr("data-id");$.fancybox.open({href:Routing.generate("portfolioback_categories_remove",{id:e}),type:"ajax",closeBtn:!1})})});return!1});