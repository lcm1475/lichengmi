// OMG I should be a JS Deveoper, JK I hardly know what the hell I'm doing

// Some notes taken from http://codepen.io/Fellini85/pen/oaDBh
$(function () {
    var imageWrap = $('.vfx-image-wrap'),
        topImage = $(this).find('.before-image'),
        divider = $(this).find('.divider-bar'),
        stayBounce = $('.toggle-function');

    imageWrap.on("mousemove", function (e) {
      // Gotta localize top image and divider so it only applies to this
        var offsets = $(this).offset(),
            fullWidth = $(this).width(),
            mouseX = e.pageX - offsets.left,
            topImage = $(this).find('.before-image'),
            divider = $(this).find('.divider-bar');

        if (mouseX < 0) {
            mouseX = 0;
        } else if (mouseX > fullWidth) {
            mouseX = fullWidth
        }
      $(this).addClass('special');
        divider.css({ left: mouseX, transition: 'none' });
        topImage.css({ width: mouseX, transition: 'none' });
    });
  stayBounce.click(function(){
    $(this).toggleClass('stay');
  });

  imageWrap.on("mouseleave", function () {
    if (!stayBounce.hasClass('stay')) {
      divider.css({  left: '50%', transition: 'all .3s' });
      topImage.css({  width: '50%', transition: 'all .3s' });
    }
  });
}); // JavaScript Document