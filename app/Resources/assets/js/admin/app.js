// css

require('../../sass/admin/style.scss');

// js

var $ = require('jquery');

require('popper.js');
require('bootstrap/dist/js/bootstrap.bundle.js');
require('jquery-easing');

require('chart.js');
require('datatables');
require('datatables.net-bs4');

require('startbootstrap-sb-admin/js/sb-admin.min.js');
require('startbootstrap-sb-admin/js/sb-admin-datatables.min.js');
require('startbootstrap-sb-admin/js/sb-admin-charts.min.js');

$(document).ready(function() {
   	$('[data-toggle="popover"]').popover();
    $('[data-toggle="tooltip"]').tooltip({container: 'body'});
});
