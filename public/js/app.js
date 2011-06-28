
App.MineMenuHover = function() {
    
    $('.mine-menu-item').hover(
        function() {
            $(this).css('opacity', 1);
        },
        function() {
            $(this).css('opacity', '0.7');
        }
    );
};

$(function() {
    
});