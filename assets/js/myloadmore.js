jQuery(function($){

    $(document).on('click', '#show-more-button-holder .show-more', function(){

        const button = $(this);
        const button_text = $(this).find('.text');
        const loop = $('#other-posts-loop-layout');
        const data = {
			'action': 'loadmore',
			'query': loadmore_params.posts,
			'page' : loadmore_params.current_page,
		};

        $.ajax({
			url : loadmore_params.ajaxurl,
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				button_text.text('Loading...'); 
			},
			success : function( data ){
				if( data ) { 
					button_text.text( 'More posts' );

                    $(data).appendTo(loop);

					loadmore_params.current_page++;
					if ( loadmore_params.current_page == loadmore_params.max_page ) {
						button_text.text( 'No More Posts' );
                    }
				} else {
					button_text.text( 'No Data' );
				}
			}
		});

    });

});