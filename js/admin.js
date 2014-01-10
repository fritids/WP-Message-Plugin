(function ( $ ) {
	"use strict";
	$(function () {
		// Place your administration-specific JavaScript here
		$( "#tabs" ).tabs();
		$("#to").select2({
			 placeholder: "Type names of one or more user"
		});
	});
}(jQuery));