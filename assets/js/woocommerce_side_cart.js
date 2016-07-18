jQuery( document ).ready(function( $ ) {
		
	$.blockUI.defaults.overlayCSS.cursor = 'default';
	
<<<<<<< HEAD
	var delay = (function(){
      var timer = 0;
      return function(callback, ms){
        clearTimeout (timer);
        timer = setTimeout(callback, ms);
      };
    })();
	
	$(this).on('change', '.js-side-cart-change-qty', function(e, button) {
    	
    	$input = $(this);
    	
    	delay( function() {
=======
	$(document).on("change", ".js-side-cart-change-qty", function(e, button) {
		
		// wc_add_to_cart_params is required to continue, ensure the object exists
		if ( typeof wc_add_to_cart_params === 'undefined' )
			return false;	
			
		doTransition();
		
		$input = $(this);
		
		var item = $input.parents('.item').block({
			message: null,
			overlayCSS: {
				background: '#fff',
				opacity: 0.6
			}
		});

	    var data = {
			action: 'change_cart_item_quantity',
		};

		$.each( $(this).data(), function( key, value ) {
			data[key] = value;
		});
		
		data.quantity = $input.val();
	    
	    // Trigger event
	    $( 'body' ).trigger( 'adding_to_cart', [ data, $input ] );
	    
		$( 'body' ).trigger( 'changing_cart_item_qty', [ data, $input ] );

		// Ajax action
		$.post( wc_add_to_cart_params.ajax_url, data, function( response ) {
>>>>>>> master

    		// wc_add_to_cart_params is required to continue, ensure the object exists
    		if ( typeof wc_add_to_cart_params === 'undefined' )
    			return false;	
    		
    		var item = $input.parents('.item').block({
    			message: null,
    			overlayCSS: {
    				background: '#fff',
    				opacity: 0.6
    			}
    		});
    
    	    var data = {
    			action: 'change_cart_item_quantity',
    		};
    
    		$.each( $input.data(), function( key, value ) {
    			data[key] = value;
    		});
    		
    		data.quantity = $input.val();
    	    
    	    // Trigger event
    	    $( 'body' ).trigger( 'adding_to_cart', [ data, $input ] );
    	    
    		$( 'body' ).trigger( 'changing_cart_item_qty', [ data, $input ] );
    
    		// Ajax action
    		$.post( wc_add_to_cart_params.ajax_url, data, function( response ) {
    
    			if ( ! response )
    				return;
    	
    			var this_page = window.location.toString();
    	
    			this_page = this_page.replace( 'add-to-cart', 'added-to-cart' );
    	
    			if ( response.error && response.product_url ) {
    				window.location = response.product_url;
    				return;
    			}
    	
    			// Redirect to cart option
    			if ( wc_add_to_cart_params.cart_redirect_after_add === 'yes' ) {
    	
    				window.location = wc_add_to_cart_params.cart_url;
    				return;
    	
    			} else {
    	
    				fragments = response.fragments;
    				cart_hash = response.cart_hash;
    	
    				// Block fragments class
    				if ( fragments ) {
    					$.each( fragments, function( key, value ) {
    						$( key ).addClass( 'updating' );
    					});
    				}
    	
    				// Block widgets and fragments
    				$( '.shop_table.cart, .updating, .cart_totals' ).fadeTo( '400', '0.6' ).block({
    					message: null,
    					overlayCSS: {
    						opacity: 0.6
    					}
    				});
    	
    				// Replace fragments
    				if ( fragments ) {
    					$.each( fragments, function( key, value ) {
    						$( key ).replaceWith( value );
    					});
    				}
    	
    				// Unblock
    				$( '.widget_shopping_cart, .updating' ).stop( true ).css( 'opacity', '1' ).unblock();
    	
    				// Cart page elements
    				$( '.shop_table.cart' ).load( this_page + ' .shop_table.cart:eq(0) > *', function() {
    	
    					$( '.shop_table.cart' ).stop( true ).css( 'opacity', '1' ).unblock();
    	
    					$( 'body' ).trigger( 'cart_page_refreshed' );
    				});
    	
    				$( '.cart_totals' ).load( this_page + ' .cart_totals:eq(0) > *', function() {
    					$( '.cart_totals' ).stop( true ).css( 'opacity', '1' ).unblock();
    				});
    	
    				// Trigger event so themes can refresh other areas
    				$( 'body' ).trigger( 'added_to_cart', [ fragments, cart_hash, $input ] );
    				
    				$( 'body' ).trigger( 'changing_cart_item_qty', [ fragments, cart_hash, $input ] );
    				
    			}
    			
            });
			
        }, 1000 );
	   
	});
	
	$(this).on('click', '.js-remove-basket-item', function(e) {
    	
    	e.stopPropagation();
		
		e.preventDefault();
		
		var item = $(this).parents('.item');
          
        item.block({
			message: null,
			overlayCSS: {
				background: '#fff',
				opacity: 0.6
			}
		});
		
		item.find('.js-side-cart-item-controls').find('input.qty').val(0).trigger('change', [$(this)]);

	});
	
	$(this).on('click', '.js-side-cart-close, .js-side-cart-open', function(e) {
    	
    	e.stopPropagation();
    	
    	e.preventDefault();
    	
    	if( $('.side-cart-icon').hasClass('close') ) {
			
			$('body').trigger('side_cart_close');
			
		} else {
			
			$('body').trigger('side_cart_open');
			
		}	
		
	});	
	
	$( 'body' ).bind( 'side_cart_open', function() {
    	
    	$('body').addClass('side-cart-open');
			
		$('.side-cart-icon').addClass('close');
		
		$('.side-cart').addClass('opened');	
    	
	});
	
	$( 'body' ).bind( 'side_cart_close', function() {
    	
    	$('body').removeClass('side-cart-open');
			
		$('.side-cart-icon').removeClass('close');
		
		$('.side-cart').removeClass('opened');
		
		$('.side-cart .item h5, .side-cart .item li').removeClass('transition');
    	
	});
	
	$( 'body' ).bind( 'added_to_cart', function(e, fragments, cart_hash, button) {
		
		$('.side-cart-icon').addClass('jump');
		
		setTimeout(function() {
			
			$('.side-cart-icon').removeClass('jump');
			
		}, 2000);
			
		setTimeout(function() {
		
			button.removeClass('added');
			
		}, 5000);
		
	});

});