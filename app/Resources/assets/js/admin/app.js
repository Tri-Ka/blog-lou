var $ = require('jquery');

require('popper.js');

require('bootstrap/dist/js/bootstrap.js');
require('jquery-easing');

require('chart.js');
require('datatables');
require('datatables.net-bs4');

require('startbootstrap-sb-admin/js/sb-admin.min.js');
require('startbootstrap-sb-admin/js/sb-admin-datatables.min.js');

import fontawesome from '@fortawesome/fontawesome';

import faNewspaper from '@fortawesome/fontawesome-free-regular/faNewspaper';
import faImages from '@fortawesome/fontawesome-free-regular/faImages';

import faTachometerAlt from '@fortawesome/fontawesome-free-solid/faTachometerAlt';
import faTags from '@fortawesome/fontawesome-free-solid/faTags';
import faWrench from '@fortawesome/fontawesome-free-solid/faWrench';

fontawesome.library.add(
    faTachometerAlt,
    faNewspaper,
    faTags,
    faImages,
    faWrench
);

if (0 < $('[data-chart]').length) {
	require('startbootstrap-sb-admin/js/sb-admin-charts.min.js');
}

$(document).ready(function() {
   	$('[data-toggle="popover"]').popover();
    $('[data-toggle="tooltip"]').tooltip({container: 'body'});

    if ('undefined' !== typeof tinymce) {
        var langs = {
            'fr': 'fr_FR'
        };

        var lang = undefined !== langs[$('html').attr('lang')] ? langs[$('html').attr('lang')] : langs['en'];

        tinymce.init({
            selector: '[data-tinymce]',
            language: lang,
            plugins: [
                "code",
                "advlist autolink link lists charmap print preview hr anchor pagebreak",
                "searchreplace visualblocks visualchars nonbreaking",
                "table contextmenu directionality paste textcolor autoresize jbimages"
            ],
            relative_urls : false,
            remove_script_host : false,
            convert_urls : true,
            toolbar1: "bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link unlink anchor | forecolor backcolor | jbimages | preview code |",
            image_advtab: true ,
            external_plugins: { "jbimages" : "/jbimages/plugin.min.js"}
        });
    }

    $('select[data-select2="true"').each(function(){
        $(this).select2({
            // tags: true
        })
    });
});
