define([
    'Magento_Ui/js/grid/columns/column',
    'jquery',
    'mage/template',
    'text!Study_M23/templates/grid/cells/message.html',
    'Magento_Ui/js/modal/modal'
], function (Column, $, mageTemplate, messageTemplate) {
    'use strict';

    return Column.extend({
        defaults: {
            bodyTmpl: 'ui/grid/cells/html',
            fieldClass: {
                'data-grid-html-cell': true
            }
        },
        gethtml: function (row) {
            return row[this.index + '_html'];
        },
        getLabel: function (row) {
            return row[this.index + '_html']
        },
        getTitle: function (row) {
            return row[this.index + '_title']
        },        
        getMessage: function (row) {
            return row[this.index + '_message']
        },                
        preview: function (row) {
            var modalHtml = mageTemplate(
                messageTemplate,
                {
                    html: this.gethtml(row),
                    message : this.getMessage(row), 
                }
            );
            var previewPopup = $('<div/>').html(modalHtml);
            previewPopup.modal({
                title: this.getTitle(row),
                innerScroll: true,
                modalClass: '_image-box',
                buttons: []}).trigger('openModal');
        },
        getFieldHandler: function (row) {
            return this.preview.bind(this, row);
        }
    });
});