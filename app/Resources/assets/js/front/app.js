require('../../sass/front/style.scss');

var $ = require('jquery');

var Tether = require('tether/dist/js/tether.js');
require('bootstrap/dist/js/bootstrap.js');

var imagesLoaded = require('imagesloaded');
var Masonry = require('masonry-layout');

imagesLoaded.makeJQueryPlugin( $ );

import fontawesome from '@fortawesome/fontawesome';
import faComments from '@fortawesome/fontawesome-free-regular/faComments';
import faEnvelope from '@fortawesome/fontawesome-free-regular/faEnvelope';
import faSearch from '@fortawesome/fontawesome-free-solid/faSearch';

import faFacebookF from '@fortawesome/fontawesome-free-brands/faFacebookF';
import faTwitter from '@fortawesome/fontawesome-free-brands/faTwitter';
import faGooglePlusG from '@fortawesome/fontawesome-free-brands/faGooglePlusG';

fontawesome.library.add(
    faComments,
    faEnvelope,
    faSearch,
    faFacebookF,
    faTwitter,
    faGooglePlusG
);

$(document).ready(function() {
   	$('[data-toggle="popover"]').popover();
    $('[data-toggle="tooltip"]').tooltip({container: 'body'});

    if ($('.grid').length > 0) {
    	var $masonryContainer = $('.grid');

		$masonryContainer.imagesLoaded( function(){
			new Masonry( '.grid', {
			  itemSelector: '.grid-item',
			  columnWidth: '.grid-item',
			});
		});
    }

    $('[data-load-later').each(function(index, element){
        $(element).attr("src", $(element).attr("data-src"));
    });
});
