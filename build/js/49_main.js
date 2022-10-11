(function( $ ){
  $(document).ready(function () {

  /**
   * Play Promo
   */
  $(document).on('click', '.content-block-promo-inner-content-play', function(){
    let $this = $(this);
    let oembed = $this.siblings('.content-block-promo-inner-content-oembed');

    $(oembed).find('iframe')[0].src += "?autoplay=1";

    console.log($(oembed).find('iframe')[0].src);

    $('body').addClass('promo-playing');
  });

  $(document).on('click', '.content-block-promo-inner-content-oembed-close-button', function(){
    let $this = $(this);
    let oembed = $this.closest('.content-block-promo-inner-content-oembed');

    $(oembed).find('iframe')[0].src += "?autoplay=1";

    $('body').removeClass('promo-playing');

  });

  });
})(jQuery)
