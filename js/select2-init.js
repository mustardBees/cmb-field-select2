jQuery(document).ready(function ($) {
	
	$('.select2').each(function() {
		var instance = $(this).attr('id');
		
		var instance_data = window[instance + '_data']
		
		$(this).select2({
			multiple : true,
			data: instance_data,
			initSelection: function(element, callback) {
				var data = [];
				
				$(element.val().split(",")).each(function() {
					text = select2_find_text(this, instance_data);
					
					if('undefined' != typeof text) {
						data.push({
							id: this,
							text: text
						});
					}
				});
				
				callback(data);
			}
		});
		
		$(this).select2("container").find("ul.select2-choices").sortable({
			containment: 'parent',
			start: function() { $(".select2").select2("onSortStart"); },
			update: function() { $(".select2").select2("onSortEnd"); }
		});
	});
	
	function select2_find_text(id, instance_data) {
		for(var i = 0; i < instance_data.length; i++) {
			if(id == instance_data[i].id) {
				return instance_data[i].text;
			}
		}
	}
	
});
