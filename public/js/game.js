var Game = Game || {};

(function($) { 
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
    
    // azt a linket aminek a rel-je colorbox, behuzza colorbox-ba
    Game.InColorbox = function() {
        
        $('body').delegate('a[rel=colorbox]', 'click', function() {
            
            $.colorbox({href: $(this).attr('href'), onComplete: function() { $('#quantity').focus(); }});
            
            return false;
        });
    };
    
    // validalja a mennyiseg inputjat
    Game.ValidateShopping = function() {
        $('body').delegate('#quantity', 'keyup', function() {
            var self = $(this),
                val = self.val(),
                max = parseInt($('#shop-max-quality').html(), 10); 

            if (max < val) {
                self.val(max);
                //self.removeClass('error').addClass('error')
            } else {
                self.val(val.replace(/[^0-9]/g,''));
            }
            
            $('.error-message').remove();
        });
    };
    
    Game.PerformShopping = function () {
        $('body').delegate('#perfom-shopping', 'click', function() {
            
            var self = $(this),
                quantity = $('#quantity').val(),
                token = self.parents('form:first').find('input[name=ci_csrf_token]').val();
            
                
            if (!quantity.length) {
                
                self.parent().prevAll('.error-message').remove();
                self.parent().before('<p class = "error-message">The field is required</p>');
                
                $.colorbox.resize();
                return false;
            }
            
            $.post(self.parents('form:first').attr('action'), {quantity: quantity, ci_csrf_token: token}, function(response) {
                
                var response = $.parseJSON(response);
                
                if (response.code === 0) {
                    
                    // hiba volt, uzenet kiirasa
                    
                    $.colorbox({html: response.message});
                }
                
                if (response.code === 1) {
                    
                    // minden ok, frissiteni a $-t
                
                // frissitjuk a penzet
                    if (response.hasOwnProperty('cash')) {
                        
                        $('#player-cash').html(response.cash);
                    }                    
                    $.colorbox({html: response.message});
                    
                }
                //$.colorbox.resize();

            });

            return false;
        });  
    };
    
    $(function() {
        Game.PerformShopping();
        Game.ValidateShopping();
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
        
        Game.InColorbox();
    });
}) (jQuery);