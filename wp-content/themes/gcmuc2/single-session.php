<? 
add_action("wp_head", array($lh_session, "session_og_head"));

get_header(); ?>

<div class="container content-page">

	<div class="row">
	
		<div class="col-md-12 col-sm-12 col-xs-12">


			<div id="content" class="clearfix with_sidebar session_object">
			    <?php get_sidebar(); ?> 
			    <article <?php post_class("content-wrapper"); ?>>
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			    		<div class="date-time"><?=date("d.m.Y - H:i", get_post_meta($post->ID, "_session_start", true))?> Uhr<br />
			            <?
							$terms = get_the_terms($post->ID, "location");
							if($terms && ! is_wp_error( $terms )){
								$terms_arr = array();
								
								foreach($terms as $t){
									$term_arr[] = $t->name;	
								}
								
								echo implode(", ", $term_arr);
							}
						?>
			            </div>
			            <h1><?php the_title(); ?></h1>
			            <div class="session_wrapper clearfix">
			            
			                <div class="speaker">
			                    <div class="avatar">
			                        <?=get_avatar( get_the_author_meta('ID'), 100 )?>
			                    </div>
			                    
			                    <div class="name">
			                        <?=get_the_author_meta("display_name", get_the_author_meta('ID'))?>
			                    </div>
			                    
			                    <div class="buttons">
			                    	<? if(get_the_author_meta("facebook", get_the_author_meta('ID'))): ?>
			                        	<a href="https://www.facebook.com/<?=get_the_author_meta("facebook", get_the_author_meta('ID'))?>" target="_blank" class="zocial facebook"> Facebook </a>
			                        <? endif; ?>
			                        <? if(get_the_author_meta("twitter", get_the_author_meta('ID'))): ?>
			                        	<a href="https://www.twitter.com/<?=get_the_author_meta("twitter", get_the_author_meta('ID'))?>" target="_blank" class="zocial twitter"> @<?=get_the_author_meta("twitter", get_the_author_meta('ID'))?> </a>
			                        <? endif; ?>
									<? if(get_the_author_meta("googleplus", get_the_author_meta('ID'))): ?>
			                            <a href="https://plus.google.com/<?=get_the_author_meta("googleplus", get_the_author_meta('ID'))?>" target="_blank" class="zocial googleplus"> Google+ </a>
			                        <? endif; ?>
			                    </div>
			                </div>
			                
			                <div class="the-content">
			                <?php the_content(); ?>
			                </div>
			            
			            </div>
			            
			            <div class="social_bar">
			                	<div class="fb-like" data-send="false" data-href="<?=get_permalink()?>" data-layout="button_count" data-width="130" data-show-faces="false" data-font="arial"></div>
			                    <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?=get_permalink()?>" data-text="<?=get_the_title()?>" data-lang="de" data-hashtags="gcmuc">Twittern</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
								<a href="#" class="zocial facebook" id="attend_action" onclick="trigger_attendence('<?=get_permalink()?>', '<?=date("c", get_post_meta($post->ID, "_session_start", true))?>', '<?=date("c", get_post_meta($post->ID, "_session_end", true))?>')">Ich bin dabei!</a>
			            </div>
			                	
			           	<?php comments_template(); ?>
			        
			        <?php endwhile; endif; ?>
			    </article>    
			 </div><!-- content -->
			 
		</div>
		
	</div>
	
</div>
 
<? get_footer(); ?>