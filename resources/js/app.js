
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app'
// });

$(document).ready(function() {
    // Tooltip
    $('body').tooltip({selector: '[data-toggle="tooltip"]'}).tooltip('show');
    $('[data-toggle="tooltip-forever"]').tooltip({trigger: 'manual'}).tooltip('show');

    // Password show/hide
    $("#current_password span.glyphicon-eye-open").mousedown(function(){
        $("#current_password input").attr('type','text');
    }).mouseup(function(){
        $("#current_password input").attr('type','password');
    }).mouseout(function(){
        $("#current_password input").attr('type','password');
    });
    $("#password span.glyphicon-eye-open").mousedown(function(){
        $("#password input").attr('type','text');
    }).mouseup(function(){
        $("#password input").attr('type','password');
    }).mouseout(function(){
        $("#password input").attr('type','password');
    });
    $("#password_confirmation span.glyphicon-eye-open").mousedown(function(){
        $("#password_confirmation input").attr('type','text');
    }).mouseup(function(){
        $("#password_confirmation input").attr('type','password');
    }).mouseout(function(){
        $("#password_confirmation input").attr('type','password');
    });

    // CARGA DE DATOS AJAX A DATATABLES
    $('.tableData').DataTable();

    // CARGA TABLA USUARIOS
    // $('#tableUsuarios').DataTable({
    //     "scrollX": true,
    //     "processing" : true,
    //     'serverSide': true,
    //     "ajax": {
    //         url: "/api/users/list",
    //         dataType: 'JSON',
    //         error: function (erro) {
    //             console.error(erro);
    //         }
    //     },
    //     "columns" : [
    //         {data: 'cif', name: 'cif'},
    //         {data: 'codigo_ejecutivo', name: 'codigo_ejecutivo'},
    //         {data: 'codigo_bankworks', name: 'codigo_bankworks'},
    //         {data: 'usuario_dominio', name: 'usuario_dominio'},
    //         {data: 'nombre', name: 'nombre'},
    //         {data: 'apellido', name: 'apellido'},
    //         {data: 'Unidad', name: 'Unidad.nombre'},
    //         {data: 'Puesto', name: 'Puesto.nombre'},
    //         {data: 'Roles', "searchable": false},
    //         {data: 'Estado', "searchable": false},
    //         {data: 'updated_at', "searchable": false},
    //         {data: 'Opciones', "searchable": false, "width": "50%"},
    //     ],
    //     "fnDrawCallback": function(oSettings) {
    //         $(".restablecer").on("click", function(e){
    //             e.preventDefault();
    //             var id = $(this).data('id');
    //             swal({
    //                 title: "Esta seguro de restablecer la contraseña del usuario?",
    //                 icon: "warning",
    //                 buttons: ['Cancelar', 'Restablecer'],
    //             }).then((conf) => {
    //                 if (conf) $("#restablecer-form"+id).submit();
    //             });
    //         });
    //     }
    // });

});

// Modal Restablecer password
$(".restablecer").on("click", function(e){
    e.preventDefault();
    var id = $(this).data('id');
    swal({
        title: "Esta seguro de restablecer la contraseña del usuario?",
        icon: "warning",
        buttons: ['Cancelar', 'Restablecer'],
    }).then((conf) => {
        if (conf) $("#restablecer-form"+id).submit();
    });
});

// Modal Eliminar
$(".delete").on("click", function(e){
    e.preventDefault();
    var id = $(this).data('id');
    swal({
        title: "Esta seguro de eliminarlo?",
        icon: "warning",
        buttons: ['Cancelar', 'Eliminar'],
        dangerMode: true,
    }).then((conf) => {
        if (conf) $("#delete-form"+id).submit();
    });
});
