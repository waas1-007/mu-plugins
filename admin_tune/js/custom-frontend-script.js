jQuery(document).ajaxComplete(function(event, xhr, settings) {
	if (settings.url === '/?wc-ajax=update_order_review') {
		jQuery('body.woocommerce-checkout #neve-checkout-coupon .woocommerce-info .berocket_minmax').parent().hide();
		jQuery('body.woocommerce-checkout #neve-checkout-coupon .woocommerce-info .have_coupon_span').parent().show();
	}
});
