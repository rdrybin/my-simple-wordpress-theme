<?php
/*
 * Template for displaying single pages. 
 */
?>
<?php get_header() ?>

<div class="main-area-single">
    <div class="content-single">
        <?php if( have_posts() ) : while( have_posts() ): the_post() ?>
            <div id="post-<?php the_ID() ?>" <?php post_class('inner-post-section') ?>>
                <div class="post-title">
                    <h1 class="page-title"><?php the_title() ?></h1>
                </div>
                <div class="post-content">
                    <?php the_content() ?>
                </div>
            </div><!-- inner-content-section ends -->
        </div>
</div><!-- Content-section ends here -->
<?php endwhile ?>
<?php endif ?>
<?php get_footer() ?>
