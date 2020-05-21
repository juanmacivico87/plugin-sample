<?php
$title    = get_field( 'sample_title' );
$subtitle = get_field( 'sample_subtitle' );
$button   = get_field( 'sample_button' ); ?>

<section class="sample-block">
    <h1><?php echo esc_attr( $title ) ?></h1>
    <p><?php echo esc_attr( $subtitle ) ?></p>
    <?php if ( $button ) : ?>
        <a href="<?php echo esc_url( $button['url'] ) ?>" target="<?php echo esc_attr( $button['target'] ) ?>" title="<?php echo esc_attr( $button['title'] ) ?>"><?php echo esc_attr( $button['title'] ) ?></a>
    <?php endif ?>
</section>
