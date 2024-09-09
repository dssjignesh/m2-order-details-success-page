define(['jquery'], function ($) {
    'use strict';

    return function (config) {
        // Extract configuration values
        var thanksz = config.thanksz;
        var thankcl = config.thankcl;
        var textbeforesz = config.textbeforesz;
        var textbeforecl = config.textbeforecl;
        var textaftersz = config.textaftersz;
        var textaftercl = config.textaftercl;

        $(document).ready(function() {
            // Define the CSS rules
            var style = `
                .tmess {
                    font-size: ${thanksz}px;
                    color: ${thankcl};
                }
                .bmess {
                    font-size: ${textbeforesz}px;
                    color: ${textbeforecl};
                }
                .fmess {
                    font-size: ${textaftersz}px;
                    color: ${textaftercl};
                }
            `;

            $('<style>')
                .prop('type', 'text/css')
                .html(style)
                .appendTo('head');
        });
    };
});
