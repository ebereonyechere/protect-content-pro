jQuery(document).ready(($) => {
    let is_blocked = false;
    let is_blocked_by_devtools = false;

    if ( protect_content_pro.block_right_click ) {
        window.addEventListener('contextmenu', function (e) {
            e.preventDefault();
            protect_content_pro_block_inspector_panel();
        }, false);

    }

    let body_template = `<div id="protect-content-pro-rclick-modal" class="protect-content-pro-rclick-modal-window">
                                <div>
                                    <a href="javascript:;" title="Close" class="protect-content-pro-rclick-modal-close" id="protect-content-pro-rclick-modal-close-btn">Close</a>
<!--                                    <h1>Voilà!</h1>-->
                                    <div>${protect_content_pro.displayed_notice}</div>
                                    <br>
                                </div>
                            </div>`;


    let body_original = $('body').html();

    $('#protect-content-pro-rclick-modal-close-btn').on('click', function () {
        $('#protect-content-pro-rclick-modal')
            .css('visibility', 'hidden')
            .css('opacity', '0')
            .css('pointer-events', 'none');
        is_blocked = false;
    });

    document.onkeydown = function (e) {
        // if(event.keyCode == 123) {
        // 	return false;
        // }
        /* <fs_premium_only> */
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
            if ( protect_content_pro.block_ctrl_shift_i ) {
                protect_content_pro_block_inspector_panel();
                return false;
            }
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
            if ( protect_content_pro.block_ctrl_shift_c ) {
                protect_content_pro_block_inspector_panel();
                return false;
            }
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
            if ( protect_content_pro.block_ctrl_shift_j ) {
                protect_content_pro_block_inspector_panel();
                return false;
            }
        }
        /* </fs_premium_only> */

        if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
            if ( protect_content_pro.block_ctrl_u ) {
                protect_content_pro_block_inspector_panel();
                return false;
            }
        }
        if (e.ctrlKey && e.keyCode == 'S'.charCodeAt(0)) {
            if ( protect_content_pro.block_ctrl_s ) {
                protect_content_pro_block_inspector_panel();
                return false;
            }
        }
        if (e.ctrlKey && e.keyCode == 'P'.charCodeAt(0)) {
            if ( protect_content_pro.block_ctrl_p ) {
                protect_content_pro_block_inspector_panel();
                return false;
            }
        }
        if (e.ctrlKey && e.keyCode == 'C'.charCodeAt(0)) {
            if ( protect_content_pro.block_ctrl_c ) {
                protect_content_pro_block_inspector_panel();
                return false;
            }
        }
    }

    /* <fs_premium_only> */
    if ( protect_content_pro.block_devtools_opening ) {
        setInterval(() => {
            if (devtools.isOpen) {

                $('body').html(body_template);

                protect_content_pro_block_inspector_panel();
                is_blocked_by_devtools = true;

            } else {
                if (is_blocked && is_blocked_by_devtools) {

                    $('body').html(body_original);
                    $('#protect-content-pro-rclick-modal')
                        .css('visibility', 'hidden')
                        .css('opacity', '0')
                        .css('pointer-events', 'none')
                }
            }
        }, 5);
    }


    function protect_content_pro_block_inspector_panel() {
        $('#protect-content-pro-rclick-modal')
            .css('visibility', 'visible')
            .css('opacity', '1')
            .css('pointer-events', 'auto');
        is_blocked = true;
    }
    /* </fs_premium_only> */
});
