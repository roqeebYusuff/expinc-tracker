(function($) {

    successToast = function(tit, mes) {
        'use strict';
        iziToast.success({
            title: tit,
            message: mes,
            position: 'topRight',
            timeout: 6000,
        })
    }

    errorToast = function(tit, mes) {
      'use strict';
        iziToast.error({
            title: tit,
            message: mes,
            position: 'topRight',
            timeout: 6000,
        })
    }

    warningToast = function(tit, mes) {
        'use strict';
        iziToast.warning({
            title: tit,
            message: mes,
            position: 'topRight',
            timeout: 6000,
        })
    }
  
})(jQuery);