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
						'<option value="1 hour">1 Hour</option>'+
						'<option value="2 hours">2 Hours</option>'+
						'<option value="1 day">1 Day</option>'+
						'<option value="2 days">2 Days</option>'+
						'<option value="3 days">3 Days</option>'+
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

    	for(var j=7; j<=15; j++)
    	{
			age += '<option value="'+j+'">'+j+' Years</option>';
		}

    	for(var i=0; i < valueSelected; i++)
    	{
    		children_form += '<input placeholder="Name..." type="text" name="child[participant]['+i+'][name]">'+
    						'<select name="child[participant]['+i+'][age]">'+age+'</select>'+
							'<select name="child[participant]['+i+'][skill]">'+
								'<option value="beginner">Beginner</option>'+
								'<option value="intermediate">Intermediate</option>'+
							'</select>';
    	}
    	$('.children-container').empty();
    	$('.children-container').append(children_form);
	});


	jQuery('.datepicker').datepicker({
        dateFormat : 'dd-mm-yy'
    });
});


