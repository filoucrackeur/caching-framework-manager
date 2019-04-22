define([
   'jquery',
   'TYPO3/CMS/StorageFrameworkManager/Router',
   'TYPO3/CMS/Backend/Notification',
], function($, Router, Notification) {
   'use strict';

   return {
      selectorModalBody: '.t3js-modal-body',
      currentModal: {},

      initialize: function(currentModal) {
         this.currentModal = currentModal;
         this.getData();
      },

      getData: function() {
         var modalContent = this.currentModal.find(this.selectorModalBody);
         $.ajax({
            url: TYPO3.settings.ajaxUrls.session_backends,
            cache: false,
            success: function(data) {
               if (data.success === true) {
                  modalContent.empty().append(data.html);
               } else {
                  Notification.error('Ajax loading failed');
               }
            },
            error: function(xhr) {
               Router.handleAjaxError(xhr, modalContent);
            }
         });
      }
   };
});
