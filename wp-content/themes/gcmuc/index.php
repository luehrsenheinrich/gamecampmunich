<? get_header(); ?>

<div id="content" class="clearfix category">
    <?php get_sidebar(); ?> 
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article <?php post_class("content-wrapper"); ?>>
    		<div class="date-time">
					<?=get_the_date()?><br />
            		<a href="<?php comments_link(); ?>"><?=comments_number( "Keine Kommenare", "Ein Kommentar", "% Kommentare" );?></a>
            </div>

            <h2 class="article-headline"><a href="<? the_permalink() ?>"><?php the_title(); ?></a></h2>
            
            <div class="the-content">
           		<?=strip_tags(get_the_content(""))?>
                <p class="more-link"><a href="<?=get_permalink()?>"><?=__("... read more", "gcmuc")?></a></p>
            </div>
        
        
    </article>    
    <div class="trenner"></div>
    <?php endwhile; endif; ?>
	<?php wp_pagenavi(); ?>
 </div><!-- content -->
 
<? get_footer(); ?>