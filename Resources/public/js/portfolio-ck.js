/*jshint devel:true */$(document).ready(function(){$(".dropdown-docs").click(function(){$(".dropdown-docs-div").slideToggle();$(this).find("i").hasClass("icon-circle-arrow-down")?$(this).find("i").attr("class","icon-circle-arrow-up"):$(this).find("i").attr("class","icon-circle-arrow-down");return!1})});