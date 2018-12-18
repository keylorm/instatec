var myApp = angular.module('myApp', ['chart.js', 'angular.chosen']);
//var myApp = angular.module('myApp', []);

(function($){
	$(document).ready(function(){
		menuResponsivo();
		formFieldsWidgets();
		formAddRemoveCustom();
		formValidation();
		selectWithSearch();
		inputMaskMoney();
		inputNumberMask();
	});

	$(document).ajaxStop(function () {
		menuResponsivo();
		formFieldsWidgets();
		formAddRemoveCustom();
		formValidation();
		selectWithSearch();
		inputMaskMoney();
		inputNumberMask();
	});

	function formFieldsWidgets(){
		$( ".datepicker" ).datepicker({
	      format: 'dd/mm/yyyy',
	      language: 'es',
	    });

	    $('.input-daterange').datepicker({
	      format: 'dd/mm/yyyy',
	      language: 'es',
	    });
	}

	function inputNumberMask(){
		setTimeout(function(){
			$(".input-number").on('keydown',function (e) {
				// Allow: backspace, delete, tab, escape, enter and .
				if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
					// Allow: Ctrl+A, Command+A
					(e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
					// Allow: home, end, left, right, down, up
					(e.keyCode >= 35 && e.keyCode <= 40)) {
					// let it happen, don't do anything
					return;
				}
				// Ensure that it is a number and stop the keypress
				if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
					e.preventDefault();
				}
			});
			$('.input-number').spinner();
		}, 1500);
	}

	function selectWithSearch(){
		$(".chosen-select").chosen({no_results_text: "Sin resultados."}); 
	}

	function inputMaskMoney(){
		$(".input-money-mask").maskMoney({prefix:'$ ', allowNegative: true, thousands:' ', decimal:'.', affixesStay: false});
		$(".input-money-mask-colones").maskMoney({prefix:'₡ ', allowNegative: true, thousands:' ', decimal:'.', affixesStay: false});
	}

	function menuResponsivo(){
		var ancho_pantalla = $( window ).width();
		if(ancho_pantalla > 991){
			if(!$('nav#menu.collapse').hasClass('show')){
				$('nav#menu.collapse').addClass('show');
			}
		}

		$(window).resize(function(){
			var ancho_pantalla = $( window ).width();
			if(ancho_pantalla > 991){
				if(!$('nav#menu.collapse').hasClass('show')){
					$('nav#menu.collapse').addClass('show');
				}
			}else{
				if($('nav#menu.collapse').hasClass('show')){
					$('nav#menu.collapse').removeClass('show');
				}
			}
		})
	}

	function formValidation(){
		$('form.form-validation .form-submit').click(function(e){
			e.preventDefault();
			if(formValidationCustom($(this).parents('form.form-validation'))){
				$('form.form-validation').submit();
			}else{
				$('html, body').animate({scrollTop : 0},800);
			}
			
		});
	}

	function formValidationCustom(form){
		$('.alert-form-validation').remove();
		$('input, textarea').css('border', '1px solid #ced4da');
		var msj_error = '';
		$(form).find('.input-required').each(function(){	
			$(this).css('border', '1px solid #ced4da');		
			if($(this).val()==''){
				if (!$(this).hasClass('skip-validation')){
					$(this).css('border', '1px solid #ff0000');
					msj_error = 'Los campos enmarcados en rojo son obligatorios';
				}
			}
		});
		$(form).find('.select-required').each(function(){		
			$(this).css('border', '1px solid #ced4da');
			if($(this).val()=='' || $(this).val()=='none' || $(this).val()=='? undefined:undefined ?'){
				if (!$(this).hasClass('skip-validation')){
					$(this).css('border', '1px solid #ff0000');
					msj_error = 'Los campos enmarcados en rojo son obligatorios';
				}
			}
		});

		$(form).find('.select-required.chosen-select').each(function(){					
			var nameFieldChosen = '#'+$(this).attr('name')+'_chosen .chosen-single';
			$(nameFieldChosen).css('border', '1px solid #ced4da');				
			if($(this).val()=='' || $(this).val()=='none' || $(this).val()=='? undefined:undefined ?'){		
				if (!$(this).hasClass('skip-validation')){		
					$(nameFieldChosen).css('border', '1px solid #ff0000');				
					msj_error = 'Los campos enmarcados en rojo son obligatorios';
				}
			}
		});
		if(msj_error!=''){
			$(form).before('<div class="alert-form-validation alert alert-danger">'+msj_error+'</div>');
			
			return false;
		}else{
			return true;
		}
	}

	function formAddRemoveCustom(){
		// The maximum number of options
    	//var MAX_OPTIONS = 5;
		$('form')
		// Add button click handler
        .on('click', '.addButton', function() {
            var $template = $('#'+$(this).data('template')),
                $clone    = $template
                                .clone()
                                .removeClass('d-none')
                                .removeAttr('id')
                                .insertBefore($template),
                $option   = $clone.find('[name="'+$(this).data('campo')+'[]"]');

            
        })

        // Remove button click handler
        .on('click', '.removeButton', function() {
            var $row    = $(this).parents('.form-group'),
                $option = $row.find('[name="'+$(this).data('campo')+'[]"]');

            // Remove element containing the option
            $row.remove();
            
        })

        // Called after adding new field
        /*.on('added.field.fv', function(e, data) {
            // data.field   --> The field name
            // data.element --> The new field element
            // data.options --> The new field options

            if (data.field === 'option[]') {
                if ($('#surveyForm').find(':visible[name="option[]"]').length >= MAX_OPTIONS) {
                    $('#surveyForm').find('.addButton').attr('disabled', 'disabled');
                }
            }
        })

        // Called after removing the field
        .on('removed.field.fv', function(e, data) {
           if (data.field === 'option[]') {
                if ($('#surveyForm').find(':visible[name="option[]"]').length < MAX_OPTIONS) {
                    $('#surveyForm').find('.addButton').removeAttr('disabled');
                }
            }
        });*/
	}
})(jQuery);