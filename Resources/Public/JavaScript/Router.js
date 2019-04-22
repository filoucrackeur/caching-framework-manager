/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * Module: TYPO3/CMS/Install/Router
 */
define([
   'jquery',
   'TYPO3/CMS/Install/InfoBox',
   'TYPO3/CMS/Install/Severity',
   'TYPO3/CMS/Install/ProgressBar',
   'TYPO3/CMS/Backend/Modal',
   'TYPO3/CMS/Backend/Icons'
], function($, InfoBox, Severity, ProgressBar, Modal, Icons) {
   'use strict';

   return {
      selectorBody: '.t3js-body',
      selectorMainContent: '.t3js-module-body',

      initialize: function() {

         $(document).on('click', '.card .btn', function(e) {
            e.preventDefault();

            var $me = $(e.currentTarget);
            var requireModule = $me.data('require');
            var inlineState = $me.data('inline');
            var isInline = typeof inlineState !== 'undefined' && parseInt(inlineState) === 1;
            if (isInline) {
               require([requireModule], function(aModule) {
                  if (typeof aModule.initialize !== 'undefined') {
                     aModule.initialize($me);
                  }
               });
            } else {
               var modalTitle = $me.closest('.card').find('.card-title').html();
               var modalSize = $me.data('modalSize') || Modal.sizes.large;

               Icons.getIcon('spinner-circle', Icons.sizes.default, null, null, Icons.markupIdentifiers.inline).done(function(icon) {
                  var configuration = {
                     type: Modal.types.default,
                     title: modalTitle,
                     size: modalSize,
                     content: $('<div class="modal-loading">').append(icon),
                     additionalCssClasses: ['install-tool-modal'],
                     callback: function (currentModal) {
                        require([requireModule], function (aModule) {
                           if (typeof aModule.initialize !== 'undefined') {
                              aModule.initialize(currentModal);
                           }
                        });
                     }
                  };
                  Modal.advanced(configuration);
               });
            }
         });
      },

      updateLoadingInfo: function(info) {
         var $outputContainer = $(this.selectorBody);
         $outputContainer.find('#t3js-ui-block-detail').text(info);
      }
   };
});
