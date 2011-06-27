var Admin = Admin || {};

Admin.Dialog = function() {

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
                    $('.ui-dialog').css('top',  window.pageYOffset + 70);
                    
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
                    
                    Admin.IphoneCheckbox();
                });
                
            }
        });
        
        return false;
    });
};

Admin.TriggerDialogOpen = function(dialogId) {
    $('[dialog_id='+dialogId+']').trigger('click');
};

Admin.Confirm = function() {
    $('body').delegate('.delete', 'click', function() {
        var self = $(this);
        var elem = $('<div />', {title: 'Confirmation'}).html('Are you sure?');
        
        elem.dialog({
            modal: true,
            buttons: {
                'Yes': function() {
                    window.location = self.attr('href');
                },
                'No': function() {
                    $(this).dialog('close');
                }
            }
        });
        
        return false;
    });  
};

Admin.Datepicker = function() {
    
    $('.datepicker').datepicker('destroy');
    
    $('.datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
        changeYear: true,
        changeMonth: true,
        showMonthAfterYear:true,
        yearRange: '1980:+5'
	});
  
};

Admin.Autocomplete = function (element, url) {
    
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

Admin.UpdateShopItem = function () {
    $('body').delegate('.update-item', 'click', function() {
        
        var self = $(this),
            form = self.parents('form:first');
            
        $.post(form.attr('action'), form.serialize(), function() {
            
        });
        
        return false;         
    });
};

Admin.IphoneCheckbox = function() {
    
    $(':checkbox').iphoneStyle({
        checkedLabel: 'YES',
        uncheckedLabel: 'NO'        
    });
        
};

$(function() {
    Admin.Dialog();
    Admin.Confirm();
    
    $('button, input[type=submit], .button').button();
    
    Admin.IphoneCheckbox();
    
    $('#loading-global')
       .ajaxStart(function() {
           
    		$(this).show();
       })
       .ajaxStop(function() {
    		$(this).hide();
    });
    
     
    Admin.Datepicker();
    
    Admin.UpdateShopItem();
    
});