<div id="misc-publishing-actions">
	<div class="misc-pub-section curtime misc-pub-curtime">
    	<span id="timestamp">
		    <?php printf( esc_html__( 'Created on: %1$s', 'formidable-payments' ), '<b>' . $created_at . '</b>' ); ?>
		</span>
	</div>
	
	<?php if ( $payment->status == 'complete' && ! empty( $payment->receipt_id ) ) { ?>
		<div class="misc-pub-section">
			<span class="dashicons dashicons-cart wp-media-buttons-icon"></span>
			<?php esc_html_e( 'Payment:', 'formidable-payments' ) ?>
			<?php FrmTransPaymentsController::show_refund_link( $payment ); ?>
		</div>
	<?php } ?>

	<?php do_action( 'frm_pay_' . $payment->paysys . '_sidebar', $payment ); ?>
</div>

