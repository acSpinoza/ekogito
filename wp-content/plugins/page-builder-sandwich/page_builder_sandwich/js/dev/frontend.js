window.pbsIsRTL = function() {
	var html = document.querySelector('html');
	return html.getAttribute( 'dir' ) === 'rtl';
};

window._pbsFixRowWidth = function( element ) {

	var dataWidth = element.getAttribute('data-width');

	// Nested rows cannot be full width
	if ( element.parentNode.classList.contains('pbs-col') ) {
		window._pbsRowReset( element );
	} else if ( typeof dataWidth === 'undefined' || ! dataWidth ) {
		window._pbsRowReset( element );
	} else if ( dataWidth === 'full-width' ) {
		window._pbsFullWidthRow( element );
	} else {
		window._pbsFullWidthRow( element, true );
	}

	clearTimeout( window._pbsFixRowWidthsResizeTrigger );
	window._pbsFixRowWidthsResizeTrigger = setTimeout( function() {
		window._pbsFixRowWidthsResizeNoReTrigger = true;
		window.dispatchEvent( new Event( 'resize' ) );
	}, 1 );
};


window._pbsRowReset = function( element ) {
	element.style.width = '';
	element.style.position = '';
	element.style.maxWidth = '';
	if ( ! window.pbsIsRTL() ) {
		element.style.left = '';
	} else {
		element.style.right = '';
	}
	element.style.webkitTransform = '';
	element.style.mozTransform = '';
	element.style.msTransform = '';
	element.style.transform = '';
	// element.style.marginLeft = '';
	// element.style.marginRight = '';
	// element.style.paddingLeft = '';
	// element.style.paddingRight = '';
};

window._pbsFullWidthRow = function( element, fitToContentWidth ) {

	var origWebkitTransform = element.style.webkitTransform;
	var origMozTransform = element.style.mozTransform;
	var origMSTransform = element.style.msTransform;
	var origTransform = element.style.transform;

    // Reset changed parameters for contentWidth so that width recalculation on resize will work
	element.style.width = 'auto';
	element.style.position = 'relative';
	element.style.maxWidth = 'none';
	element.style.webkitTransform = '';
	element.style.mozTransform = '';
	element.style.msTransform = '';
	element.style.transform = '';
	element.style.marginLeft = '0px';
	element.style.marginRight = '0px';

	if ( typeof fitToContentWidth !== 'undefined' && fitToContentWidth ) {
		element.style.paddingLeft = '';
		element.style.paddingRight = '';
	}

	// Make sure our parent won't hide our content
	element.parentNode.style.overflowX = 'visible';

	// Reset the left parameter
	if ( ! window.pbsIsRTL() ) {
		element.style.left = '0px';
	} else {
		element.style.right = '0px';
	}

	// Assign the new full-width styles
	var bodyWidth = document.body.clientWidth;
	var rect = element.getBoundingClientRect();
	var bodyRect = document.body.getBoundingClientRect();

	element.style.width = bodyWidth + 'px';
	element.style.position = 'relative';
	// element.style.maxWidth = document.documentElement.clientWidth + 'px';
	element.style.maxWidth = bodyWidth + 'px';
	if ( ! window.pbsIsRTL() ) {
		element.style.left = ( -rect.left + bodyRect.left ) + 'px';
	} else {
		element.style.right = ( rect.right - bodyRect.right ) + 'px';
	}
	element.style.webkitTransform = origWebkitTransform;
	element.style.mozTransform = origMozTransform;
	element.style.msTransform = origMSTransform;
	element.style.transform = origTransform;

	if ( typeof fitToContentWidth === 'undefined' ) {
		return;
	}
	if ( ! fitToContentWidth ) {
		return;
	}

	// Calculate the required left/right padding to ensure that the content width is being followed
	var actualWidth = rect.width, paddingLeft, paddingRight;

	if ( ! window.pbsIsRTL() ) {
		paddingLeft = rect.left - bodyRect.left;
		paddingRight = bodyWidth - actualWidth - rect.left + bodyRect.left;
	} else {
		paddingLeft = bodyWidth - actualWidth + rect.right - bodyRect.right;
		paddingRight = - rect.right + bodyRect.right;
	}

	// If the width is too large, don't pad
	if ( actualWidth > bodyWidth ) {
		paddingLeft = 0;
		paddingRight = 0;
	}

	element.style.paddingLeft = paddingLeft + 'px';
	element.style.paddingRight = paddingRight + 'px';
};

window.pbsFixRowWidths = function() {
	var fullRows = document.querySelectorAll('.pbs-row[data-width]');
	Array.prototype.forEach.call(fullRows, function(el){
		window._pbsFixRowWidth( el );
	});
};

window.addEventListener('resize', function() {
	if ( window._pbsFixRowWidthsResizeNoReTrigger ) {
		delete window._pbsFixRowWidthsResizeNoReTrigger;
		return;
	}
	window.pbsFixRowWidths();
});
window.pbsFixRowWidths();


window.addEventListener( 'DOMContentLoaded', function() {

	setTimeout(function() {
		window.pbsFixRowWidths();
	}, 1 );

});

