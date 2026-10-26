<?php
/** MyRehat Test child theme — functions.php. Contains 3 planted PHP bugs (Part 2). */

add_action( 'wp_enqueue_scripts', 'myrehat_test_assets' );
function myrehat_test_assets() {
    wp_enqueue_style( 'myrehat-test-style', get_stylesheet_uri(), array(), '1.0.2' );
    wp_enqueue_script(
        'myrehat-test-trails',
        get_stylesheet_directory_uri() . '/trails.js',
        array(),
        '1.0.2',
        true
    );
}

// B1 FIXED: Added 'myrehat-test' text-domain.
function myrehat_test_booking_title() {
    return __( 'Book a guided hike', 'myrehat-test' );
}

// B2 FIXED: Verified nonce and sanitized all $_POST inputs.
add_action( 'template_redirect', 'myrehat_test_booking_handler' );
function myrehat_test_booking_handler() {
    if ( ! isset( $_POST['trails_booking'] ) ) {
        return;
    }

    $nonce = isset( $_POST['trails_booking_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['trails_booking_nonce'] ) ) : '';
    if ( ! wp_verify_nonce( $nonce, 'trails_booking_action' ) ) {
        return;
    }

    $date          = isset( $_POST['date'] ) ? sanitize_text_field( wp_unslash( $_POST['date'] ) ) : '';
    $name          = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
    $digital_nomad = isset( $_POST['digital_nomad'] ) ? sanitize_text_field( wp_unslash( $_POST['digital_nomad'] ) ) : '';
    $pricing_plan  = isset( $_POST['pricing_plan'] ) ? sanitize_text_field( wp_unslash( $_POST['pricing_plan'] ) ) : '';

    set_transient( 'trails_last_booking', $date, HOUR_IN_SECONDS );

    set_transient( 'trails_booking_meta', array(
        'name'          => $name,
        'digital_nomad' => $digital_nomad,
        'pricing_plan'  => $pricing_plan,
    ), HOUR_IN_SECONDS );
}

// B3 FIXED: Changed accepted_args from 1 to 2 so $trail_id and $count are properly passed.
add_action( 'myrehat_trail_viewed', 'myrehat_test_count_view', 10, 2 );
function myrehat_test_count_view( $trail_id, $count = 1 ) {
    if ( null === $trail_id || '' === $trail_id ) {
        return;
    }
    $key   = 'trail_views_' . sanitize_key( (string) $trail_id );
    $total = (int) get_option( $key, 0 );
    update_option( $key, $total + (int) $count );
}

