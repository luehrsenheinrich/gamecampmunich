<?php 
global $post;

if(have_comments() or comments_open()): ?>

<div class="row" id="comments">
	<div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12" id="comments-wrapper">
    	<h2 class="comments-headline"><?php _e("Comments", "gcmuc"); ?></h2>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 comment-form">
            <?php
            	get_template_part("comments-form");               
            ?>
            </div>
        </div>
        <div class="row">
        	<div class="col-md-12 col-sm-12 col-xs-12">
				<?php
                
                    $args = array(
                        'callback' 		=> "lh_comments",
                        'max_depth'		=> 2,
                        'avatar_size'	=> 64,
                        'style'			=> 'div',
                    );
                    
                    wp_list_comments($args);
                ?>
                <?php if(get_comment_pages_count()): ?>
                <div class="pagination">
                    <?php 
                    $args = array(
                    );
                    paginate_comments_links($args); 
                    
                    ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>