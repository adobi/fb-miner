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
            
            if (/mine/.test(url)) {
                
                url = App.URL+'game/mine/'+$('#selected-mine').attr('data-id');
            }
            
            $('#reload').attr('href', url);
        });
        
        return false;
    });
};

Game.StartMining = function() {
    
    $('.game-canvas').delegate('.start-mining', 'click', function() {
        
        var self = $(this),
            item = $('.selected-mine-item'),
            tool = $('.selected-tool'),
            url = App.URL+'game/startmining/'+item.attr('data-id')+'/tool/'+tool.attr('data-id');
        
        // ha volt kivalasztva banya item es eszkoz    
        if (item.length == 1 && tool.length == 1) {
            
            $.post(url, {}, function(response) {
                
                var response = $.parseJSON(response);
                
                // mindent rendbe beallitottunk
                if (response.code == 1) {
                        
                    item.find('span').html('Working...');
                    item.prevAll('img:first').show();
                    
                    tool.find('span').html('Working...');
                    tool.prevAll('img:first').show();
                    
                    $('#next-mining-time').html(response.next_mining_time);
                    
                    $('#next-mining-notification').show();
                } 
                
                // adatbazis hiba volt
                if (response.code == 0) {
                    
                    $('.game-canvas').find('.mine-map').css('opacity', 0.7);
                }
                
                $('#reload').attr('href', App.URL+'game/mine/'+$('#selected-mine').attr('data-id'));
                
                $.colorbox({html:response.message});
            });
        } else {
            $.colorbox({html: '<p>Please select a mine item and  a tool</p>'});
        }
            
        return false; 
    });
};

Game.SelectItem = function() {
    
    // a banyaszhato itemek kivalasztasat kezeli
    $('.game-canvas').delegate('.select-mine-item', 'click', function() {
        
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
    
    // a felhasznalhato eszkozok kivalasztasat kezeli
    $('.game-canvas').delegate('.select-tool', 'click', function() {
        
        var self = $(this),
            canvas = $('.game-canvas');
        
        if (canvas.find('.pending-item').length) {
            $.colorbox({html: '<p>You already hava a pending operation, please first wait that</p>'});
        } else {
            
            canvas.find('.selected-tool').removeClass('selected-tool');
            
            canvas.find('.tool').css('opacity', 0.7);
            
            self.addClass('selected-tool');
            
            self.parents('.tool').css('opacity', 1);
        }
        
        return false; 
    });    
};

Game.Check = function () {
    var url = App.URL + 'game/check',
        scriptStreamer = $('#script-streamer');
        
    if (scriptStreamer.length) {
        scriptStreamer.remove();
    }
    
    scriptStreamer = $('<script />', {'type': 'text/javascript', 'src': url, 'id': 'script-streamer'});
    
    $('head').append(scriptStreamer);
};

Game.OnCheckFinished = function(result) {
    
    // ha lejart egy banyaszas
    if (result.code === 1) {
        
        // frissitjuk a penzt
        $('#player-cash').html(result.cash);
        
        // frissitjuk az oldalt
        $('#reload').trigger('click');
        
        // uzenet
        $.colorbox({html: result.message});
        
        // kovetkezo banyaszas idejet eltuntetjuk
        $('#next-mining-notification').hide();
        
        //console.log('minig finished ' + (new Date).toString());
    } 
    
    // meg folyik a banyaszas
    if (result.code === 0) {
        
        //console.log('still mining...' + (new Date).toString());

    }
    
    // nincs banyaszas folyamatban
    if (result.code === -1) {
        //console.log('there is no mining ' + (new Date).toString());
        
        // ha nem volt frissitve az oldal regota, akkor frissiteni kell kovetkezo banyaszas datumat
        if(result.hasOwnProperty('next_mining_time')) {
            
            $('#next-mining-time').html(result.next_mining_time);
            
            if ($('#next-mining-notification').is(':hidden')) {
                
                $('#next-mining-notification').show();
            }
        }        

    }
    
    setTimeout(function() {Game.Check();}, 10000);
};

$(function() {
    Game.Check();
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