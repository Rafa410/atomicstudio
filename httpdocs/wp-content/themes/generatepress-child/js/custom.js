(function($) {

    /* When the user scrolls down, add the class 'fixed' to the header */
    function stickyMenu() {
        const header = document.getElementById('site-navigation');

        window.onscroll = function () {
            if (window.pageYOffset > 20) {
                header.classList.add('fixed');
            }
            else {
                header.classList.remove('fixed');
            }
        }
    }


    /************** DOCUMENT READY **************/

    $(document).ready(function() {

        stickyMenu();
        

    })

})(jQuery);
