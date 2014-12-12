/*
 * jQuery File Upload Plugin JS Example 8.9.1
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/* global $, window */

$(function () {
    'use strict';
    var inputField = $('input[name^=GalleryImages][type=hidden]');
    var mod='manage';
    var saveUrl = window.location.search.match(/^\?r/) ? '?r=backend/gallery/gallery-images/save-images' : '/backend/gallery/gallery-images/save-images';
    if(inputField.length > 0) {
        mod='create';
    }
    var filesToSave = [];

    $('.lunch-demo').on('click',function(){
        blueimp.Gallery($('#blueimp-gallery-carousel .slides > a'),{
            container: '#blueimp-gallery-carousel',
            carousel: true
        });


    });
    $('.show-hide-demo').on('click',function(){
        $('#blueimp-gallery-carousel').toggle();
    });


    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: '/vendors/jquery-fileupload/server/php/',
        success: function(file) {


            for(var i= 0, numberOfFiles = file.files.length; i< numberOfFiles; i++) {
                filesToSave.push(file.files[i].name);
            }
            if(mod === 'create') {
                inputField.val(filesToSave);
            }
            if(mod === 'manage') {
                $.post(saveUrl,{image:file.files[0].name},function(data){

                });
            }
        }
    });

    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
        )
    );

    if (window.location.hostname === 'blueimp.github.io') {
        // Demo settings:
        $('#fileupload').fileupload('option', {
            url: '//jquery-file-upload.appspot.com/',
            // Enable image resizing, except for Android and Opera,
            // which actually support image resizing, but fail to
            // send Blob objects via XHR requests:
            disableImageResize: /Android(?!.*Chrome)|Opera/
                .test(window.navigator.userAgent),
            maxFileSize: 5000000,
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
        });
        // Upload server status check for browsers with CORS support:
        if ($.support.cors) {
            $.ajax({
                url: '//jquery-file-upload.appspot.com/',
                type: 'HEAD'
            }).fail(function () {
                $('<div class="alert alert-danger"/>')
                    .text('Upload server currently unavailable - ' +
                            new Date())
                    .appendTo('#fileupload');
            });
        }
    } else {
        // Load existing files:
        $('#fileupload').addClass('fileupload-processing');
        $.ajax({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: $('#fileupload').fileupload('option', 'url'),
            dataType: 'json',
            context: $('#fileupload')[0]
        }).always(function () {
            $(this).removeClass('fileupload-processing');
        }).done(function (result) {
            console.log('here');
            $(this).fileupload('option', 'done')
                .call(this, $.Event('done'), {result: result});
        });
    }

});
