var $ = require('jquery');

require('bootstrap/dist/js/bootstrap.js');
require('select2');
require('tablesorter');

import FontAwesome from './modules/FontAwesome';

$(document).ready(function() {
   	$('[data-toggle="popover"]').popover();
    $('[data-toggle="tooltip"]').tooltip({container: 'body'});

    $('[data-select2]').each(function(){
    	$(this).select2();
    });

    $('[data-select2-tags]').each(function(){
        $(this).select2({
            tags: true
        });
    });

    var $tableSorted = $('[data-tablesorted]');

    $tableSorted.tablesorter();

    tinymce.init({
        selector: '[data-tinymce]',
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
});
