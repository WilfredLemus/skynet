
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');

    require('jquery-slimscroll');

    require('fastclick');

    require('icheck');

    // bootstrap-datepicker
    require('bootstrap-datepicker');

    // Select2
    require('select2');
    // AdminLTE
    require('admin-lte');

    // Datatables & export tables
    require('datatables.net');
    require('datatables.net-bs');
    require('datatables.net-buttons-bs');
    require('datatables.net-buttons/js/buttons.html5.js');
    require('datatables.net-buttons/js/buttons.print.js');
    require('datatables.net-fixedheader-bs');
    window.moment = require('moment');
    require('moment');
    require('moment/locale/es.js');
    require('bootstrap-daterangepicker');

    require('datetime-moment');
    // require('jszip/dist/jszip.min.js');


    var pdfMake = require('pdfmake/build/pdfmake.js');
    var pdfFonts = require('pdfmake/build/vfs_fonts.js');
    pdfMake.vfs = pdfFonts.pdfMake.vfs;

    require('multiselect-two-sides');
    require('sweetalert');
    window.Swal = require('sweetalert2');

    // Bootstrap File Input
    window.fileinput = require('bootstrap-fileinput');
    require('bootstrap-fileinput/js/locales/es.js');

    // Viewerjs
    window.Viewer = require('viewerjs/dist/viewer.min.js');

} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });

$(document).ready(function() {
    $('.i-checks').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue'
    });

    $('.js-datepicker').datepicker({
      autoclose: true,
      todayHighlight: true
    });

    $(".select2").select2({width: '100%'});

    $('.multiselect').multiselect({
        search: {
            left: '<input type="text" name="q" class="form-control" placeholder="Buscar..." />',
            right: '<input type="text" name="q" class="form-control" placeholder="Buscar..." />',
        }
    });

    $('[data-toggle="tooltip"]').tooltip();
    // "fixedHeader": true,
    $.extend( true, $.fn.dataTable.defaults, {
        dom: 'lBftrip',
        "iDisplayLength": 10,
        buttons: [
            { extend: 'excel',
            customizeData: function ( data ) {
                // for (var i=0; i<data.body.length; i++){
                //     for (var j=0; j<data.body[i].length; j++ ){
                //         data.body[i][j] = '\u200C' + data.body[i][j];
                //     }
                // }
                for (var i=0; i<data.body.length; i++){
                    data.body[i][0] = '\u200C' + data.body[i][0];
                }
            },
            // customize: function( xlsx, row ) {
            //     var sheet = xlsx.xl.worksheets['sheet1.xml'];
            //      $('row c[r^="D"], row c[r^="E"]', sheet).attr( 's', 64);
            // },
            text: 'EXCEL', 
            footer: true},
            { extend: 'pdf', text: 'PDF', footer: true},
            { extend: 'print', text: 'IMPRIMIR', footer: true},
        ],
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });

    // $.extend( true, $.fn.fileinput.defaults, {
    //     language: "es",
    //     dropZoneEnabled: false,
    //     maxFileCount: 3,
    //     maxFileSize: 50,
    //     allowedFileExtensions: ["jpg", "jpeg", "png", "tif"],
    //     showUpload: false,
    // });

    // $(".files-input").fileinput();
    $(".commentFiles").fileinput({
        language: "es",
        dropZoneEnabled: false,
        maxFileCount: 3,
        maxFileSize: 200,
        allowedFileExtensions: ["jpg", "jpeg", "png", "tif"],
        showUpload: false,
    });

    $.extend( true, $.fn.datepicker.dates['es'] = {
        days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
        daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
        daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
        today: "Hoy",
        monthsTitle: "Meses",
        clear: "Borrar",
        weekStart: 1,
        format: "dd/mm/yyyy"
    });
    $('.fecha').datepicker({language: 'es', autoclose: true});

    $.extend( true, $.fn.daterangepicker.defaults, {
        "format": "DD/MM/YYYY",
        "separator": " - ",
        "locale": {
            "applyLabel": "Aplicar",
            "cancelLabel": "Cancelar",
        },
        "fromLabel": "Del",
        "toLabel": "Al",
        "customRangeLabel": "Personalizado",
        "daysOfWeek": [
            "Do",
            "Lu",
            "Ma",
            "Mi",
            "Ju",
            "Vi",
            "Sa"
        ],
        "monthNames": [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ],
        "firstDay": 1,
    });
    $('.rangofechas').daterangepicker({
        "autoApply": false,
        locale: { cancelLabel: 'Cancelar', applyLabel: 'Aplicar'},
        "maxSpan": {
            "days": 31
        },
    });
    $('.rangoSuspension').daterangepicker({
        "autoApply": false,
        locale: { cancelLabel: 'Cancelar', applyLabel: 'Aplicar'},
    });
    $('.rangoTotal').daterangepicker({
        "autoApply": false,
        locale: { cancelLabel: 'Cancelar', applyLabel: 'Aplicar'},
    });
});
