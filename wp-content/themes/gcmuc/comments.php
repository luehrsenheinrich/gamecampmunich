<?php

if(comments_open($post->ID) || have_comments()){

	?> 
       <div class="trenner"></div>
       <h2 class="comment-headline">Kommentare</h2>
    <?
	
}

if(comments_open($post->ID)): ?>

<div id="comments-form">

	<?
	
	$fields =  array(
	'author' => '<p class="comment-form-author left">' . '<label for="author">' . __( 'Name', 'gcmuc' ) . ( $req ? ' *' : '' ) . '</label>'  .
	            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
	'email'  => '<p class="comment-form-email left"><label for="email">' . __( 'Email', 'gcmuc' ) . ( $req ? ' *' : '' ) . '</label>' .
	            '<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" /></p>',
	'url'    => '<p class="comment-form-url left"><label for="url">' . __( 'Website', 'gcmuc' ) . '</label>' .
	            '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p> ',
				);
	
	
	$args['fields'] = $fields;
	$args['comment_notes_after'] = NULL;
	$args['comment_notes_before'] = NULL;
	
	?>


	<? comment_form($args); ?>

</div>

<div class="trenner grey"></div>

<? endif; ?>



<? if(have_comments()): ?>

<div class="the-comments" id="comments">
	
    <div class="commentlist"><?php wp_list_comments(array(
															'style' 		=> 'div',
															'callback'		=> 'gcmuc_comments_walker',
															'end-callback'	=> 'gcmuc_comment_walker_end',
									)); ?>
    </div>
    
</div>

<? endif; ?>