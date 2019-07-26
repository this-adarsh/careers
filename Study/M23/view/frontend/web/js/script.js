
require(['jquery'], function($){
    $('.required-entry').each(function(key, element){
        $(element).attr('required','required');
    });        
});