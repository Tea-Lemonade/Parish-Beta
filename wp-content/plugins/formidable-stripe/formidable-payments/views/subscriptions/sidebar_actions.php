<div id="misc-publishing-actions">
	<div class="misc-pub-section curtime misc-pub-curtime">
    	<span id="timestamp">
		    <?php printf( esc_html__( 'Created on: %1$s', 'formidable-payments' ), '<b>' . FrmAppHelper::get_localized_date( $date_format, $subscription->created_at ) . '</b>' ); ?>
		</span>
	</div>

	<?php if ( $subscription->status == 'active' ) { ?>
		<div class="misc-pub-section">
			<span class="dashicons dashicons-update wp-media-buttons-icon"></span>
			<?php esc_html_e( 'Subscription:', 'formidable-payments' ) ?>
			<?php FrmTransSubscriptionsController::show_cancel_link( $subscription ); ?>
		</div>
	<?php } ?>

	<?php foreach ( $payments as $payment ) { ?>
	    <div class="misc-pub-section">
	        <span class="dashicons dashicons-<?php echo esc_attr( $payment->status == 'complete' ? 'yes' : 'no-alt' ); ?> wp-media-buttons-icon"></span>
			<?php echo FrmTransAppHelper::formatted_amount( $payment ) ?>
			<a href="?page=formidable-payments&amp;action=show&amp;id=<?php echo absint( $payment->id ) ?>">
				<?php echo esc_html( FrmAppHelper::get_localized_date( $date_format, $payment->created_at ) ) ?>
			</a>
		</div>
	<?php } ?>

</div>

