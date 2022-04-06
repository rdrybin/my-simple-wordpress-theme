<?php
/*
 * Template for displaying footer.
 */
?>
<div class="footer">
    <?php if ( !dynamic_sidebar( 'footerbox_sidebar' ) ): ?>
    <?php endif ?>
    <?php wp_footer(); ?>
</div>

</div> <!-- end container -->
</body>
</html>