require('../../sass/front/style.scss');

var $ = require('jquery');

require('bootstrap/dist/js/bootstrap.bundle.js');
var imagesLoaded = require('imagesloaded');
var Masonry = require('masonry-layout');

imagesLoaded.makeJQueryPlugin( $ );

$(document).ready(function() {
   	$('[data-toggle="popover"]').popover();
    $('[data-toggle="tooltip"]').tooltip({container: 'body'});

    var $masonryContainer = $('.grid');

	$masonryContainer.imagesLoaded( function(){
		new Masonry( '.grid', {
		  itemSelector: '.grid-item',
		  columnWidth: '.grid-item',
		});
	});
});
