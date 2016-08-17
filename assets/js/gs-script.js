jQuery( function ( $ ) {

	$("#surf-board-rental").click(function() {
	    if($(this).is(":checked"))
	    {
	    	var boards = '';
	    	for(var i = 1; i <= 10; i++) {
				boards += '<option value="'+i+'">'+i+'</option>';
			}
			
	        $(".board-rental-wrapper").append(''+
	        	'<div>Surf Board Rental</div>'+
				'<div>'+
					'<label>Reservation Date</label>'+
					'<input placeholder="Date..." type="text" class="datepicker" name="board_rental[date]">'+
					'<input placeholder="HH:MM"type="text" name="board_rental[time]">'+
				'</div>'+
				
				'<div>'+
					'<label>Duration</label>'+
					'<select name="board_rental[duration]">'+
						'<option value="1-hour">1 Hour</option>'+
						'<option value="2-hours">2 Hours</option>'+
						'<option value="1-day">1 Day</option>'+
						'<option value="2-days">2 Days</option>'+
						'<option value="3-days">3 Days</option>'+
					'</select>'+
				'</div>'+

				'<div>'+
					'<label>Number of Board</label>'+
					'<select name="board_rental[number]">'+boards+'</select>'+
				'</div>	'+
	        '');
	        jQuery('.datepicker').datepicker({
		        dateFormat : 'dd-mm-yy'
		    });
	    }else
	    {
	    	$(".board-rental-wrapper").empty();
	    }
	});

	$('.lesson-duration').on('change', function(e){
		var optionSelected = $("option:selected", this);
    	var valueSelected = this.value;
    	var duration_form = '';
    	for(var i=1; i <= valueSelected; i++)
    	{
    		duration_form += '<label>Reservation Day '+i+'</label> :'+
					'<input type="text" name="reservation_date[]" class="datepicker" value="" required="">';
    	}
    	$('.duration-container').empty();
    	$('.duration-container').append(duration_form);	
    	
    	jQuery('.datepicker').datepicker({
	        dateFormat : 'dd-mm-yy'
	    });
	});

	$('#adult-participant').on('change', function(e){
		var optionSelected = $("option:selected", this);
    	var valueSelected = this.value;
    	var adults_form = '';
    	for(var i=0; i < valueSelected; i++)
    	{
    		adults_form += '<input placeholder="Name..." type="text" name="adult[participant]['+i+'][name]">'+
							'<select name="adult[participant]['+i+'][skill]">'+
								'<option value="beginner">Beginner</option>'+
								'<option value="intermediate">Intermediate</option>'+
							'</select>';
    	}
    	$('.adults-container').empty();
    	$('.adults-container').append(adults_form);
	});

	$('#child-participant').on('change', function(e){
		var optionSelected = $("option:selected", this);
    	var valueSelected = this.value;
    	var children_form = '';
    	var age = '';


		console.log('test children')

    	for(var j=7; j<=15; j++)
    	{
			age += '<option value="'+j+'">'+j+' Years</option>';
		}

    	for(var i=0; i < valueSelected; i++)
    	{
    		children_form += '<div class="gs-row-float set-flex"><input placeholder="Name..." type="text" name="child[participant]['+i+'][name]">'+
    						'<select name="child[participant]['+i+'][age]">'+age+'</select>'+
							'<select name="child[participant]['+i+'][skill]">'+
								'<option value="beginner">Beginner</option>'+
								'<option value="intermediate">Intermediate</option>'+
							'</select></div>';
    	}
    	$('.children-container').empty();
    	$('.children-container').append(children_form);
	});

	$("#currency-option").on('change', function(e){
		var currency = $(this).val().split("_");

		$('#currency').val(currency[0]);
		$('#convertion-value').val(currency[1]);

		//convert the package tarif
		var prices = [];
		$(".package-price").each(function(index) {
			prices[index] = {
				'value': ($(this).data("price") * currency[1]).toFixed(2),
				'attr' : $(this).attr("id")
			}
			$(this).empty();
			$(this).append(prices[index].value+" "+currency[0]);

			name_attr = $("#chosen-package"+(index+1)).attr("name");
			surf_package = name_attr.split("_");
			name_attr = name_attr.replace(surf_package[surf_package.length-1], prices[index].value)+"]";
			$("#chosen-package"+(index+1)).attr("name", name_attr);
			//console.log(name_attr+" "+name_attr.replace(surf_package[surf_package.length-1], prices[index].value)+"]");
		});

		//convert the board rental tarif
		var board_prices
		$(".surfboard-price").each(function(i) {
			prices[i] = {
				'value': ($(this).data("price") * currency[1]).toFixed(2),
				'attr' : $(this).attr("id")
			}
			$(this).empty();
			$(this).append(prices[i].value+" "+currency[0]);

			sb = $(this).parent().find('[id=chosen-board]').val();
			sbvalue = sb.split("_");
			$(this).parent().find('[id=chosen-board]').val(sb.replace(sbvalue[0], prices[i].value));

		});

	});

	$("#price-type").on('change', function(e){
		console.log("hahahahha");

	});

	$('#add-board-price').click(function(){
		var bd = $('.board-dyn-price').length;
		console.log(bd);
		$('#bd-price-wrapper').append('<div class="dyn-form">'+
			'<select name="board_price['+bd+'][type]" id="price-type" class="board-dyn-price">'+
				'<option value="1-hour">1 Hour</option>'+
				'<option value="2-hours">2 Hours</option>'+
				'<option value="1-day">1 Day</option>'+
				'<option value="2-days">2 Days</option>'+
				'<option value="3-days">3 Days</option>'+
			'</select>'+
			'<input type="text" placeholder="Price in USD" name="board_price['+bd+'][value]" id="board-price">'+
			'<input type="button" class="board-remove" value="x"/>'+
		'</div>');
		
		$(".board-remove").click(function(){
			$(this).parents('.dyn-form').remove(); bd--;
		});
	});

	$(".board-remove").click(function(){
		$(this).parents('.dyn-form').remove();
	});

	jQuery('.datepicker').datepicker({
        dateFormat : 'dd-mm-yy'
    });
});


