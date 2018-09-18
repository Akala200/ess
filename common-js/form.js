$(document).ready(function () {

    $('#form').validate({ // initialize the plugin
        rules: {
            field1: {
                required: true,
                email: true
            }
        }
    });

});