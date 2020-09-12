(function($) {

    /* 
     * When the user scrolls down, toggle the classes from header and cookie notice 
     * and detect the current menu section
     */
    function stickyElements() {
        const header = document.getElementById('site-navigation');
        const cookieNotice = document.getElementById('cookie-notice');
        cookieNotice.classList.add('cookie-notice-custom-hidden');

        let prevID;
        const topMenu = $( '#site-navigation' );
        const topMenuHeight = topMenu.outerHeight();

        let menuItems = topMenu.find("ul a");

        let scrollItems = menuItems.map(function() {
            let link = $(this).attr('href');
            let item = $( link.substring(link.indexOf('#')) );
            if (item.length) { 
                return item; 
            }
        });

        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 20) {
                header.classList.add('fixed');
                cookieNotice.classList.remove('cookie-notice-custom-hidden');
            }
            else {
                header.classList.remove('fixed');
                cookieNotice.classList.add('cookie-notice-custom-hidden');
            }

            // Get the current scroll position
            let currPos = $(this).scrollTop() + topMenuHeight;
            
            // Get id of current section
            let currSection = scrollItems.map(function(){
                if ($(this).offset().top < currPos) {
                    return this;
                }
            });

            // Get the id of the current element
            currSection = currSection[currSection.length - 1];
            let id = currSection && currSection.length ? currSection[0].id : '';

            if (id) {
                if (prevID !== id) {
                    prevID = id;
                    menuItems
                        .parent().removeClass('sfHover')
                        .end().filter("[href*='#"+id+"']").parent().addClass('sfHover');
                }
            }
            else {
                if (prevID) {
                    prevID = null;
                    menuItems.parent().removeClass('sfHover');
                }
            }
        })
    }


    /************** DOCUMENT READY **************/

    $(document).ready(function() {

        stickyElements();
        
    })

})(jQuery);
