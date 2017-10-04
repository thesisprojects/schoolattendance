window.Vue = require('vue');

window.routes = {
    'roleedit' : $('#route').text()
}
$('#route').remove();

let route = window.routes.roleedit;

const editroleapp = new Vue({
    el: '#editroleapp',
    data: {
        role : $('#role').val()
    },
    methods: {
        togglePermission: function (permission) {
            $('#loader').show();
            axios.post(route, {
                permission: permission,
                role: this.role
            }).then(function (response) {
                $('#loader').hide();
                Materialize.toast(response.data.message, 3000, 'green');
            }).catch(function(error)
            {
                $('#loader').hide();
                Materialize.toast(error.data.message, 3000, 'red');
            });
        }
    }
});

require('./bootstrap');