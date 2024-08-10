/**
* Digit Software Solutions..
*
* NOTICE OF LICENSE
*
* This source file is subject to the EULA
* that is bundled with this package in the file LICENSE.txt.
*
* @category   Dss
* @package    Dss_OrderDetails
* @author     Extension Team
* @copyright Copyright (c) 2024 Digit Software Solutions. ( https://digitsoftsol.com )
*/
define([
        "jquery",
    ], function ($) {
        $(document).ready(function ($) {
            $(".actions-toolbar").addClass('button-continue');
            $(".button-continue").removeClass('actions-toolbar');
        });
    });