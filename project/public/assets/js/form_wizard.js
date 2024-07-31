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
		if (!isCheckboxChecked()) {
			$('#rootwizard').find('.pager .next button').prop('disabled', true);
		}

		// Add event listener to checkbox to enable/disable the 'Next' button
		$('#checkbox-agree').change(function () {
			if (isCheckboxChecked()) {
				$('#rootwizard').find('.pager .next button').prop('disabled', false);
			} else {
				$('#rootwizard').find('.pager .next button').prop('disabled', true);
			}
		});

		$('#rootwizard').bootstrapWizard({
			onTabShow: function (tab, navigation, index) {
				var $total = navigation.find('li').length;
				var $current = index + 1;

				// If it's the last tab then hide the last button and show the finish instead
				if ($current >= $total) {
					$('#rootwizard').find('.pager .next').hide();
					$('#rootwizard').find('.pager .finish').show().removeClass('disabled hidden');
				} else {
					$('#rootwizard').find('.pager .next').show();
					$('#rootwizard').find('.pager .finish').hide();
				}

				var li = navigation.find('li a.active').parent();

				var btnNext = $('#rootwizard').find('.pager .next').find('button');
				var btnPrev = $('#rootwizard').find('.pager .previous').find('button');

				if ($current < $total) {

					var nextIcon = li.next().find('.material-icons');
					var nextIconClass = nextIcon.text();

					btnNext.find('.material-icons').html(nextIconClass)

					var prevIcon = li.prev().find('.material-icons');
					var prevIconClass = prevIcon.html()
					btnPrev.addClass('');
					btnPrev.find('.hidden-block').show();
					btnPrev.find('.material-icons').html(prevIconClass);

				}
				if ($current == 1) {
					btnPrev.find('.hidden-block').hide();
					btnPrev.removeClass('');
				}

				// Check if it's the second tab and adjust 'Next' button state
				if ($current == 2) {
					btnNext.prop('disabled', !isCheckboxChecked());
				}
			},
			onNext: function (tab, navigation, index) {
				console.log("Showing next tab");
			},
			onPrevious: function (tab, navigation, index) {
				console.log("Showing previous tab");
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