<? get_header(); ?>

<div id="content" class="clearfix with_sidebar">
    <?php get_sidebar(); ?> 
    <article <?php post_class("content-wrapper "); ?>>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    		<div class="date-time"><?=get_the_date()?></div>
            <h1><?php the_title(); ?></h1>
            
            <div class="the-content">
            <?php the_content(); ?>
            </div>
        
        	
            	<?php comments_template(); ?>
        
        <?php endwhile; endif; ?>
    </article>    
 </div><!-- content -->
 
<? get_footer(); ?>