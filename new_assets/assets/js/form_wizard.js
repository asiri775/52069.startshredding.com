/* ============================================================
 * Form Wizard
 * Multistep form wizard using Bootstrap Wizard Plugin
 * For DEMO purposes only. Extract what you need.
 * ============================================================ */
(function ($) {

  'use strict';

  $(document).ready(function () {

    // Function to check if the checkbox is checked
    function isCheckboxChecked() {
      return $('#checkbox-agree').is(':checked');
    }

    // Initially disable the 'Next' button if the checkbox is not checked
    function toggleNextButton() {
      if (isCheckboxChecked()) {
        $('#rootwizard').find('.pager .next button').prop('disabled', false);
        $('#rootwizard').find('.pager .finish button').prop('disabled', false);
      } else {
        $('#rootwizard').find('.pager .next button').prop('disabled', true);
        $('#rootwizard').find('.pager .finish button').prop('disabled', true);
      }
    }

    // Initially check the checkbox status
    toggleNextButton();

    // Add event listener to checkbox to enable/disable the 'Next' button
    $('#checkbox-agree').change(function () {
      toggleNextButton();
    });

    $('#rootwizard').bootstrapWizard({
      onTabShow: function (tab, navigation, index) {
        var $total = navigation.find('li').length;
        var $current = index + 1;

        // console.log('Tab ', index)

        // If it's the last tab then hide the last button and show the finish instead
        if ($current >= $total) {
          $('#rootwizard').find('.pager .next').hide();
          $('#rootwizard').find('.pager .finish').show().removeClass('disabled hidden');
        } else {
          $('#rootwizard').find('.pager .next').show();
          $('#rootwizard').find('.pager .finish').hide();
        }

        // var li = navigation.find('li a.active').parent();

        // var btnNext = $('#rootwizard').find('.pager .next').find('button');
        // var btnPrev = $('#rootwizard').find('.pager .previous').find('button');

        // // remove fontAwesome icon classes
        // function removeIcons(btn) {
        //   btn.removeClass(function (index, css) {
        //     return (css.match(/(^|\s)fa-\S+/g) || []).join(' ');
        //   });
        // }

        // if ($current > 1 && $current < $total) {

        //   var nextIcon = li.next().find('.fa');
        //   // var nextIconClass = nextIcon.attr('class').match(/fa-[\w-]*/).join();

        //   if (nextIcon.length) { // Check if nextIcon is found
        //     var nextIconClass = nextIcon.attr('class');
        //     if (nextIconClass) { // Check if nextIcon has a class attribute
        //       var matchedClass = nextIconClass.match(/fa-[\w-]*/);
        //       if (matchedClass) {
        //         var nextIconClass = matchedClass.join();
        //         // Do something with nextIconClass
        //       }
        //     }
        //   }

        //   removeIcons(btnNext);
        //   btnNext.addClass(nextIconClass + ' btn-animated from-left fa');

        //   var prevIcon = li.prev().find('.fa');
        //   // var prevIconClass = prevIcon.attr('class').match(/fa-[\w-]*/).join();

        //   if (prevIcon.length) { // Check if nextIcon is found
        //     var prevIconClass = prevIcon.attr('class');
        //     if (prevIconClass) { // Check if nextIcon has a class attribute
        //       var matchedClass = prevIconClass.match(/fa-[\w-]*/);
        //       if (matchedClass) {
        //         var prevIconClass = matchedClass.join();
        //         // Do something with nextIconClass
        //       }
        //     }
        //   }

        //   removeIcons(btnPrev);
        //   btnPrev.addClass(prevIconClass + ' btn-animated from-left fa');
        // } else if ($current == 1) {
        //   // remove classes needed for button animations from previous button
        //   btnPrev.removeClass('btn-animated from-left fa');
        //   removeIcons(btnPrev);
        // } else {
        //   // remove classes needed for button animations from next button
        //   btnNext.removeClass('btn-animated from-left fa');
        //   removeIcons(btnNext);
        // }

        // Check if it's the second tab and adjust 'Next' button state
        if ($current == 2) {
          toggleNextButton();
        } else {
          $('#rootwizard').find('.pager .next button').prop('disabled', false);
          if (isCheckboxChecked()) {
            $('#rootwizard').find('.pager .finish button').prop('disabled', false);
          } else {
            $('#rootwizard').find('.pager .finish button').prop('disabled', true);
          }
        }
      },
      onNext: function (tab, navigation, index) {
        console.log("Showing next tab");
        var $current = index + 1;

        // if(index == 1){
        //     console.log("1");
        //     var client_info = $('.client_info');
        //     var val_flag = 1;
        //     for(var i = 0; i < client_info.length; i++){
        //         if(client_info[i].value == ""){
        //             val_flag = 0;
        //             break;
        //         }
        //     }
        //     if(val_flag == 0){
        //         alert("Please complete the form");
        //         return false;
        //     }
        //     else {

        //     }
        //     $('#checkbox-agree-valid').html('');
        // }
        if (index == 2 && $('#checkbox-agree').is(':checked') == false) {
          $('#checkbox-agree-valid').html('<span class="text-danger">Required</span>');
          return false;
        }
        // else{
        //     $('#checkbox-agree-valid').html('');
        // }
        if ($('#checkbox-agree').is(':checked') == true) {
          $('#form_terms_accepted').val("1");
        }

        if ($current == 2) {
          toggleNextButton();
        }
      },
      onPrevious: function (tab, navigation, index) {
        console.log("Showing previous tab");
        var $current = index + 1;

        if ($current == 2) {
          toggleNextButton();
        }
      },
      onInit: function () {
        $('#rootwizard ul').removeClass('nav-pills');
      }

    });

    $('.remove-item').click(function () {
      $(this).parents('tr').fadeOut(function () {
        $(this).remove();
      });
    });

  });

})(window.jQuery);