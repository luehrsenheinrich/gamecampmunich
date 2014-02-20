<?php get_header(); ?>

	<div class="container loop-wrapper">
		
		
		<?php 
	
			$i = 0; while( have_posts() ) : the_post(); 
			
		    if(has_post_thumbnail()){
		        $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), "loop_square");
		        $style = 'style="background-image: url('.$image[0].');")';
		    } else {
		        $style = 'style="background-image: url('.WP_THEME_URL.'/img/gcmuc_loop_placeholder.png);")';
		    }
		    
		?>
	        
		    <?php if($i == 0): ?>
		        <div class="row margin-bottom">
		    <?php endif; ?>
		    
		        <div class="col-md-6">
		            <div class="loop-item">
		            	<a href="<?php the_permalink(); ?>" title="<?php echo strip_tags(get_the_title()); ?>">
		                <div class="item-pic" <?=$style?>>
		                    
		                    <div class="item-meta pull-left">
                    			<span><?php the_time(get_option('date_format')); ?></span>
		                    </div>
		                </div>
		                <div class="item-body">
		                	<div class="item-headline">
		                        <h3>
		                        	<a href="<?php the_permalink(); ?>" title="<?php echo strip_tags(get_the_title()); ?>"><?php the_title(); ?></a>
		                        </h3>
		                  	</div>
		                    <div class="item-excerpt">
		                    	<?php echo shorten_text(trim( strip_tags( get_the_content())), 70); ?>
		                    </div>
		                </div>
		            	</a>
		            </div>
		        </div>            
		        
		<?php
			$close_row = false;
			if($i == 1){
				$close_row = true;
				$i = 0;
			} else {
		    	$i++;
			}
			
			
			if($close_row): ?>
		
	    	</div>
	    
	    <?php endif; ?>
		
		<?php endwhile; ?>
		
		<?php if($i == 1): ?>
		        </div> <!--close row-->
		<?php endif; ?>
		
		<div class="row margin-bottom">
			<div class="col-md-12">
				<div class="pagination loop-next pull-left"><?php previous_posts_link( '<i class="icon-chevron-left"></i> Neuere Beiträge' ); ?></div>
				<div class="pagination loop-previous pull-right"><?php next_posts_link( 'Weitere Beiträge <i class="icon-chevron-right"></i>' ); ?></div>
			</div>
		</div>

		
		
	</div>

<?php get_footer(); ?>