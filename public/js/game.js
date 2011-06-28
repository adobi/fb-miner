var Game = Game || {};

Game.ChangeScreen = function()
{
    $('.game-canvas').delegate('.change-screen', 'click', function() {
        var url = $(this).attr('href');
        
        $('.game-canvas-main').load(url, function() {
            if (/main/.test(url)) {
                App.MineMenuHover(); 
                $('#back-to-main').hide();
            } else {
                $('#back-to-main').show();
            }
            
            if (/map/.test(url)) {
            }
            
            $('#relaod').attr('href', url);
        });
        
        return false;
    });
};

Game.StartMining = function() {
    
    $('.game-canvas').delegate('.start-mining', 'click', function() {
        
        var self = $(this),
            item = $('.selected-mine-item'),
            url = App.URL+'game/startmining/'+item.attr('data-id');
        if (item.length==1) {
            
            $.post(url, {}, function(response) {
                
                var response = $.parseJSON(response);
                
                if (response.code == 1) {
                        
                    item.find('span').html('Started...');
                    
                    item.prevAll('img:first').show();
                } 
                
                if (response.code == 0) {
                    
                    $('.game-canvas').find('.mine-map').css('opacity', 0.7);
                }
                
                $.colorbox({html:response.message});
            });
        } else {
            $.colorbox({html: '<p>There is nothing selected</p>'});
        }
            
        return false; 
    });
};

Game.SelectItem = function() {
    
    $('.game-canvas').delegate('.select-item', 'click', function() {
        
        var self = $(this),
            canvas = $('.game-canvas');
        
        if (canvas.find('.pending-item').length) {
            $.colorbox({html: '<p>You already hava a pending operation, please first wait that</p>'});
        } else {
            
            canvas.find('.selected-mine-item').removeClass('selected-mine-item');
            
            canvas.find('.mine-map').css('opacity', 0.7);
            
            self.addClass('selected-mine-item');
            
            self.parents('.mine-map').css('opacity', 1);
        }
        
        return false; 
    });
};

$(function() {
    Game.SelectItem();
    Game.StartMining();
    Game.ChangeScreen(); 
    $('#loading-global')
       .ajaxStart(function() {
           
    		$(this).show();
       })
       .ajaxStop(function() {
    		$(this).hide();
    });
    
    $('#back-to-main').trigger('click');
});