jQuery( document ).ready( ( $ ) => {
    /* <fs_premium_only> */
    let protect_content_pro_watermark_uploader;

    $('#protect-content-pro-watermark-upload-btn').click( () => {

        //If the uploader object has already been created, reopen the dialog
        if ( protect_content_pro_watermark_uploader ) {
            protect_content_pro_watermark_uploader.open();
            return;
        }

        //Extend the wp.media object
        protect_content_pro_watermark_uploader = wp.media.frames.file_frame = wp.media( {
            title: 'Choose Watermark Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        } );

        //When a file is selected, grab the URL and set it as the text field's value
        protect_content_pro_watermark_uploader.on( 'select', function () {
            // console.log(protect_content_pro_watermark_uploader.state().get('selection').toJSON());
            let attachment = protect_content_pro_watermark_uploader.state().get( 'selection' ).first().toJSON();
            $( `#${protect_content_pro.prefix}watermark_image` ).val(attachment.url);
            $( `#${protect_content_pro.prefix}watermark_image_preview` ).prop('src', attachment.url)
                .css( 'display', 'block' );
        } );

        //Open the uploader dialog
        protect_content_pro_watermark_uploader.open();
    });

    $( '#protect-content-pro-watermark-remove-img' ).on( 'click', function() {
        $( `#${protect_content_pro.prefix}watermark_image` ).val( '' );
        $( `#${protect_content_pro.prefix}watermark_image_preview` ).prop( 'src', '' );
    } )
    /* </fs_premium_only> */
})