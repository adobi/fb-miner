var App = App || {};

App.Dialog = function() {

    $('body').delegate('a[rel*=dialog]', 'click', function() {
        
        $('.dialog').remove();
        
        var self = $(this);
        
        
        var elem = $('<div />', {'class': 'dialog', id: 'dialog_'+(new Date()).getTime(), title: self.attr('title')}).html('<p style = "width: 300px;text-align:center"><img src = "'+App.URL+'img/pie.gif" /></p>');

        elem.dialog({
            modal: false,
            width: 'auto',
            minWidth: 500,
            position:[Math.floor((window.innerWidth / 2)-150),  70],
            open: function(event, ui) {
                
                $.get(self.attr('href'), function(response) {
                    elem.html(response);
                    //alert(window.innerHeight);
                    elem.dialog('option', 'position', [Math.floor(((window.innerWidth  - elem.width()) / 2)), window.pageYOffset]);
                    $('.ui-dialog').css('top',  window.pageYOffset + 70)
                    
                    if ($('form input[type=text]').length) {
                        
                        $.each($('form input[type=text]'), function(index, item) {
                            if ($(item).attr('size') === undefined) {
                                
                                $(item).attr('size', 45);
                            }
                        });
                    }

                    if ($('.datepicker').length) {
                        console.log('datepicker found');
                        App.Datepicker();
                    }
                    
                    if ($('#postal_code_id').length) {
                        
                        App.Autocomplete($('#postal_code_id'),  'postalcode/index/');
                    }
                    
                    if ($('#buyer_breeder_site_id').length) {
                        
                        App.Autocomplete($('#buyer_breeder_site_id'),  'breedersite/search_code_and_name');
                    }
                    
                    $('button').button();
                });
                
            }
        });
        
        return false;
    });
};

App.TriggerDialogOpen = function(dialogId) {
    $('[dialog_id='+dialogId+']').trigger('click');
};

App.Confirm = function() {
    $('body').delegate('.delete', 'click', function() {
        var self = $(this);
        var elem = $('<div />', {title: 'Figyelmztetés'}).html('Biztos törlöd?');
        
        elem.dialog({
            modal: true,
            buttons: {
                'Igen': function() {
                    window.location = self.attr('href');
                },
                'Nem': function() {
                    $(this).dialog('close');
                }
            }
        });
        
        return false;
    });  
};

App.Datepicker = function() {
    
    $('.datepicker').datepicker('destroy');
    
    $('.datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
        changeYear: true,
        changeMonth: true,
        showMonthAfterYear:true,
        yearRange: '1980:+5'
	});
  
};

App.Autocomplete = function (element, url) {
    
    element.autocomplete({
        source: App.URL + url,
        select: function(e, ui) {
            var id = ui.item.id;
            
            element.after($('<input />', {
                type: 'hidden',
                name: element.attr('id'),
                value: id    
            }));
            
            element.removeAttr('name');
        }
    });    
};


$(function() {
    App.Dialog();
    App.Confirm();
    
    $('button, input[type=submit], .button').button();
   
    $('#loading-global')
       .ajaxStart(function() {
           
    		$(this).show();
       })
       .ajaxStop(function() {
    		$(this).hide();
    });
    
     
    App.Datepicker();
    
});