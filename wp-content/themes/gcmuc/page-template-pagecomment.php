<? 
/*
	Template Name: Page-Comment
*/

get_header(); ?>

<div id="content" class="clearfix page">
    <?php get_sidebar(); ?> 
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article <?php post_class("content-wrapper"); ?>>
            <h1 class="article-headline"><?php the_title(); ?></h1>
            
            <div class="the-content">
            <?php the_content(); ?>
            </div>
        
        <?php comments_template(); ?>
        
    </article>    
    <?php endwhile; endif; ?>

 </div><!-- content -->
 
<? get_footer(); ?>