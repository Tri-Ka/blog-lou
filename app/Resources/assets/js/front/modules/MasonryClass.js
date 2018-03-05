
var imagesLoaded = require('imagesloaded');
var Masonry = require('masonry-layout');

imagesLoaded.makeJQueryPlugin( $ );

class MasonryClass
{
    constructor(element)
    {
        this.grid = $('.grid');

        if (this.grid && 0 < this.grid.length) {
            this.bind();
        }
    }

    bind()
    {
        var that = this;

		that.grid.imagesLoaded( function(){
			new Masonry( '.grid', {
			  itemSelector: '.grid-item',
			  columnWidth: '.grid-item',
			});
		});
    }
}

export { MasonryClass };
