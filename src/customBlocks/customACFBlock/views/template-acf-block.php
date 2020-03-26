<?php
$title    = get_field( 'sample_title' );
$subtitle = get_field( 'sample_subtitle' );
$button   = get_field( 'sample_button' ); ?>

<section class="sample-block">
    <h1><?php echo $title ?></h1>
    <p><?php echo $subtitle ?></p>
    <?php if ( $button ) : ?>
        <a href="<?php echo $button['url'] ?>" target="<?php echo $button['target'] ?>" title="<?php echo $button['title'] ?>"><?php echo $button['title'] ?></a>
    <?php endif ?>
</section>
