(function( $ ) {

	/**
	 * once fully tested these can be consensed / simplified
	 */

	$('.cmb-add-group-row').on('cmb2_add_group_row_start', function(event,self){	
		var groupWrap = $(self).closest( '.cmb-repeatable-group' );
		groupWrap.find('.cmb-type-pw-select .select2').each(function(){
			$(this).select2("destroy").end();
		});
	});
	
	$('.cmb-repeatable-group').on('cmb2_add_row', function(event,newRow){
		
		var groupWrap = $(newRow).closest( '.cmb-repeatable-group' );
		groupWrap.find('.cmb-type-pw-select .select2').each(function(){
			$(this).select2();
		});
	});
	
	// prior to shift_rows destroy all select2()
	$('.cmb-repeatable-group').on('cmb2_shift_rows_start',function(event, self){
		var groupWrap = $(self).closest( '.cmb-repeatable-group' );
		groupWrap.find('.cmb-type-pw-select .select2').each(function(){
			$(this).select2("destroy").end();
		});
	});
	
	// shift_rows complete not reapply select2()
	$('.cmb-repeatable-group').on('cmb2_shift_rows_complete',function(event, self){
		//alert('sort complete -- ' + event + ' -- ' + self);
		var groupWrap = $(self).closest( '.cmb-repeatable-group' );
		groupWrap.find('.cmb-type-pw-select .select2').each(function(){
			//console.log('d2');
			$(this).select2();
		});
	});

	$( '.cmb-type-pw-select .select2' ).each(function() {
		$( this ).select2({
			allowClear: true
		});
	});

	$( '.cmb-type-pw-multiselect .select2' ).each(function() {
		var instance = $( this ),
			instance_data = window[ instance.attr( 'id' ) + '_data' ];

		$( instance ).select2({
			multiple: true,
			escapeMarkup: function ( m ) { return m; },
			data: instance_data,
			initSelection: function( element, callback ) {
				var data = [];

				$( element.val().split( ',' ) ).each(function() {
					var text = pw_select2_find_text( this, instance_data );

					if ( text != null ) {
						data.push({
							id: this,
							text: text
						});
					}
				});

				callback( data );
			}
		});

		$( instance ).select2( 'container' ).find( 'ul.select2-choices' ).sortable({
			containment: 'parent',
			start: function() { $( instance ).select2( 'onSortStart' ); },
			update: function() { $( instance ).select2( 'onSortEnd' ); }
		});
	});

	function pw_select2_find_text( id, instance_data ) {
		var i, l;

		for ( i = 0, l = instance_data.length; i < l; i++ ) {
			if ( id == instance_data[ i ].id ) {
				return instance_data[ i ].text;
			}
		}
	}

})(jQuery);