(function( $ ) {
	'use strict';

	$( '.suggest', '.cmb-td' ).each( function() {
		var field = $( this ).attr('id');
		$( this ).suggest(ajaxurl + "?action=cmb-suggestions&field="+field, { delay: 500, minchars: 2 });

	});

})( jQuery );
