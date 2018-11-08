
<div class="postbox frm_with_icons">
<div class="handlediv"><br/></div>
<h3 class="hndle"><span><?php _e( 'Payments', 'formidable-payments' ) ?></span></h3>
<div class="inside">

	<?php foreach ( $payments as $payment ) {
		if ( empty( $payment->status ) && isset( $payment->completed ) && $payment->completed ) {
			$payment->status = 'complete'; // PayPal fallback
		}

		if ( $payment->status == 'complete' ) {
			$entry_total += $payment->amount;
			$total_payment = $payment;
		}
	?>
		<div class="misc-pub-section">
			<span class="dashicons dashicons-calendar-alt wp-media-buttons-icon"></span>
			<span>
				<?php _e( 'Created:', 'formidable-payments' ) ?>
			</span>
			<span>
				<b><a href="?page=formidable-payments&amp;action=show&amp;id=<?php echo absint( $payment->id ) ?>" title="<?php esc_attr_e( 'Show Payment', 'formidable-payments' ) ?>">
					<?php echo esc_html( FrmAppHelper::get_localized_date( $date_format, $payment->created_at ) ) ?>
				</a></b>
			</span>
		</div>
		<div class="misc-pub-section">
			<span class="dashicons dashicons-money wp-media-buttons-icon"></span>
			<span>
				<?php _e( 'Amount:', 'formidable-payments' ) ?>
			</span>
			<span>
				<b><?php echo FrmTransAppHelper::formatted_amount( $payment ) ?></b>
			</span>
			<?php do_action( 'frm_pay_' . $payment->paysys . '_refund_link', $payment ); ?>
		</div>
		<div class="misc-pub-section">
			<span class="dashicons-<?php echo esc_attr( $payment->status == 'complete' ? 'yes' : 'no-alt' ); ?> dashicons wp-media-buttons-icon"></span>
			<span>
				<?php esc_html_e( 'Status:', 'formidable-payments' ) ?>
			</span>
			<span>
				<b><?php echo esc_html( FrmTransAppHelper::show_status( $payment->status ) ); ?></b>
			</span>
		</div>
		<br/>
	<?php } ?>

	<?php foreach ( $subscriptions as $sub ) { ?>
	    <div class="misc-pub-section">
	        <span class="dashicons dashicons-update wp-media-buttons-icon"></span>
			<a href="?page=formidable-payments&amp;action=show&amp;type=subscriptions&amp;id=<?php echo absint( $sub->id ) ?>">
				<?php echo esc_html( FrmTransAppHelper::format_billing_cycle( $sub ) ); ?>
			</a>
			<?php
			if ( $sub->status == 'active' ) {
				FrmTransSubscriptionsController::show_cancel_link( $sub );
			}
			?>
		</div>
	<?php } ?>

	<?php if ( $entry_total ) {
		$total_payment->amount = $entry_total; ?>
		<div class="misc-pub-section">
			<span class="dashicons-cart dashicons wp-media-buttons-icon"></span>
			<span>
				<?php esc_html_e( 'Total Paid:', 'formidable-payments' ) ?>
			</span>
			<span>
				<b><?php echo esc_html( FrmTransAppHelper::formatted_amount( $total_payment ) ); ?></b>
			</span>
		</div>
	<?php } ?>
</div>
</div>