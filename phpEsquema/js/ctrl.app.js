(function ($) {
    $.ctrl = {
        _evaluate: function (data) {
            var retorno = false;

            send_data({
                data: { code: data },
                dataType: 'text',
                url: 'http://localhost/phpEsquema/inc/ctrl.app.php',
                callback: function (data) {
                    retorno = data;
                }
            })

            return retorno;
        },
    }

    ctrl = function (data) {
        return $.ctrl._evaluate(data);
    }

})(jQuery);