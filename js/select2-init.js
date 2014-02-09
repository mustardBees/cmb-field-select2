(function( $ ) {

	$( '.cmb-type-pw_select .select2' ).each(function() {
		$( this ).select2({
			allowClear: true
		});
	});

	$( '.cmb-type-pw_multiselect .select2' ).each(function() {
		var instance = $( this ).attr( 'id' ),
			instance_data = window[ instance + '_data' ];

		$( this ).select2({
			multiple: true,
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

		$( this ).select2( 'container' ).find( 'ul.select2-choices' ).sortable({
			containment: 'parent',
			start: function() { $( '.select2' ).select2( 'onSortStart' ); },
			update: function() { $( '.select2' ).select2( 'onSortEnd' ); }
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