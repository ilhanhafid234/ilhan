jQuery(document).ready(function($){

	$('.site-navigation-toggle-holder').on('click', function(){
		$('.mobile-menu-modal').toggleClass('elementor-active');
	});

	trapFocus('#mobile_modal');

  $('.site-navigation').on('focus', '.sub-menu a', function() {
      $(this).parents('.menu-item-has-children').addClass('focus');
  }).on('blur', '.sub-menu a', function() {
      $(this).parents('.menu-item-has-children').removeClass('focus');
  });

  // Use for Keyboard accessiblity
  $('.site-navigation').on('focus', '.menu-item-has-children', function() {
      $(this).addClass('focus');
  }).on('blur', '.menu-item-has-children', function() {
      $(this).removeClass('focus');
  });

  $('.sub-menu-toggle').on('click', function(){
    $(this).toggleClass('active');
    $(this).parent('.menu-item-has-children').find('> ul').slideToggle();
  });

});


function trapFocus(element) {
  var focusableEls = document.querySelector(element).querySelectorAll('a[href]:not([disabled]), button:not([disabled]), textarea:not([disabled]), input[type="text"]:not([disabled]), input[type="radio"]:not([disabled]), input[type="checkbox"]:not([disabled]), select:not([disabled])');
  var firstFocusableEl = focusableEls[0];  
  var lastFocusableEl = focusableEls[focusableEls.length - 1];
  var KEYCODE_TAB = 9;

  document.querySelector(element).addEventListener('keydown', function(e) {
    var isTabPressed = (e.key === 'Tab' || e.keyCode === KEYCODE_TAB);

    if (!isTabPressed) { 
      return; 
    }

    if ( e.shiftKey ) /* shift + tab */ {
      if (document.activeElement === firstFocusableEl) {
        lastFocusableEl.focus();
          e.preventDefault();
        }
      } else /* tab */ {
      if (document.activeElement === lastFocusableEl) {
        firstFocusableEl.focus();
          e.preventDefault();
        }
      }
  });
}