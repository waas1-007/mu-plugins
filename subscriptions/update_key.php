<?php

function update_shah_consumer()
{
    $response = wp_remote_retrieve_body(wp_remote_post(
        'https://myshahbandr.com/wp-json/auth/user',
        array(
            'method'      => 'POST',
            'body'        => array(
                'email' => WAAS1_CLIENT_EMAIL,
                'site_id' => THIS_SITE_ID,
            ),
        )
    ));
    if ($response) {
        $response= json_decode( $response);
        update_option('shah_consumer_key', $response->consumer_key);
        update_option('shah_consumer_secret', $response->consumer_secret);
        update_option('shah_unique_order_id', $response->unique_order_id);
        header("location: " . $_SERVER['REQUEST_URI']);
    }
}
if (!shah_consumer_key) {
    update_shah_consumer();
};
