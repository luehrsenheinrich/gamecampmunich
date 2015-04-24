<? 
/*
	Template Name: Home
*/

get_header(); ?>

<div id="content">

	<div class="sponsoren">
    	<p>Das GameCamp Munich 2013 wird unterstützt von</p>
    	<p>
    		<a href="http://www.microsoft.de" target="_blank"><img src="<?=WP_THEME_URL?>/img/sponsoren/microsoft.jpg" alt="Microsoft"></a>
    		<a href="http://www.traviangames.de" target="_blank"><img src="<?=WP_THEME_URL?>/img/sponsoren/travian.jpg" alt="Travian Games"></a>
    		<a href="http://www.cipsoft.de" target="_blank"><img src="<?=WP_THEME_URL?>/img/sponsoren/cipsoft.png" alt="Cipsoft"></a>
    		<a href="http://muenchen.sae.edu/de/home/" target="_blank"><img src="<?=WP_THEME_URL?>/img/sponsoren/sae.png" alt="SAE Institute"></a>
    		<a href="http://www.mediadesign.de" target="_blank"><img src="<?=WP_THEME_URL?>/img/sponsoren/mdh.png" alt="Mediadesign Hochschule"></a>
      		<a href="http://www.ravensburger-games.com" target="_blank"><img src="<?=WP_THEME_URL?>/img/sponsoren/ravensburger.jpg" alt="Ravensburger Digital"></a>

    	</p>
        <p>
        	<a href="/sponsoring">Jetzt Sponsor werden</a>
        </p>
    </div>
    
     <?php while( have_posts() ) : the_post(); ?>
          
              
                  <div class="single-entry">
                      <div class="media-body">
                          <div class="the-content">
                              <?php echo the_content() ?>
                          </div>
                      </div>
                  </div>
                  
                  <div class="centerdiv">
                  	<a class="editor_buttons" href="http://eepurl.com/A39Fv">Jetzt zum GameCamp Newsletter eintragen</a>
                  </div>
                         
              
             
      
      <?php endwhile; ?>
   
    <div id="circles">
	<div class="content_block block_1">
    	<div class="circlepic">
        	<a href="<?=get_post_meta($post->ID, "box1_url", true)?>">
        	<div class="circle_teaser">
            	<p>Sessions</p>
            </div>
            </a>
    	</div>
    	<div class="teasertext">
        	<h2><a href="<?=get_post_meta($post->ID, "box1_url", true)?>"><?=get_post_meta($post->ID, "box1_headline", true)?></a></h2>
        	<p><?=get_post_meta($post->ID, "box1_body", true)?></p>
    	</div>
	</div>
	<div class="content_block block_2">
        <div class="circlepic">
        	<a href="<?=get_post_meta($post->ID, "box2_url", true)?>">
        	<div class="circle_teaser">
            	<p>Berichte</p>
            </div>
            </a>
    	</div>
    	<div class="teasertext">
            <h2><a href="<?=get_post_meta($post->ID, "box2_url", true)?>"><?=get_post_meta($post->ID, "box2_headline", true)?></a></h2>
        	<p><?=get_post_meta($post->ID, "box2_body", true)?></p>
        </div>
	</div>
	<div class="content_block block_3">
        <div class="circlepic">
        	<a href="<?=get_post_meta($post->ID, "box3_url", true)?>">
        <div class="circle_teaser">
            	<p>Event</p>
            </div>
           </a>
    	</div>
    	<div class="teasertext">
            <h2><a href="<?=get_post_meta($post->ID, "box3_url", true)?>"><?=get_post_meta($post->ID, "box3_headline", true)?></a></h2>
        	<p><?=get_post_meta($post->ID, "box3_body", true)?></p>
        </div>
	</div>
    </div><!-- circles -->
    
    <div class="flickr-gallery">
    
    <?php echo do_shortcode('[slickr-flickr items="11" type="gallery"]'); ?>

    <div class="breaker"></div>
    
    <div class="trenner"></div>
    
    <div class="content_block2 blog">
    	<div class="teasertext">
              <div class="centerdiv"><h2 class="blogh2"><a href="/news/">News</a></h2></div>
              <?
			  	$args = array( "posts_per_page" => 5 );
				query_posts( $args );
				
				while ( have_posts() ) : the_post();
					?>
                    <h4><a href="<?=get_permalink()?>"><?=get_the_title()?></a></h4>
              		<p class="date"><?=strftime("%d.%m.%Y - %A", get_the_date("U"))?></p>
                    <?
				endwhile;
	
				wp_reset_query();
			  
			  ?>
    	</div>
	</div>
	<div class="content_block2 twitter">
        	<div class="teasertext">
                <div class="centerdiv"><h2 class="twitterh2"><a href="https://twitter.com/#!/search/%23gcmuc">Twitter</a></h2></div>
                <script>
                new TWTR.Widget({
                  version: 2,
                  type: 'search',
                  search: '#gcmuc',
                  interval: 1000,
                  title: '',
                  subject: '',
                  width: null,
                  height: null,
                  theme: {
                    shell: {
                      background: '#ffffff',
                      color: '#ffffff'
                    },
                    tweets: {
                      background: '#ffffff',
                      color: '#656565',
                      links: '#f7951d'
                    }
                  },
                  features: {
                    scrollbar: true,
                    loop: false,
                    live: true,
                    behavior: 'all'
                  },
				  ready: function(){
					jQuery(".twtr-widget .twtr-tweets").addClass("content");
					jQuery(".twtr-timeline").addClass("nano")
					setInterval(function(){jQuery(".nano").nanoScroller(); }, 1000);
					jQuery(".pane").attr("style", null);
				  },
                }).render().start();
                </script>	
        </div>
	</div>
	<div class="content_block2 facebook">
    
    <?php
	
		$page_feed = get_fb_page_contents();
		if(is_array($page_feed['data'])){
			
			foreach($page_feed['data'] as $p ){
				if(isset($p['message'])){
					$page_story_raw = $p;
					break;
				}
			}
						
			$page_story['message'] = auto_link_text($page_story_raw['message']);
			
			$page_story['date'] = strftime("%d.%m.%Y - %A", strtotime($page_story_raw['created_time']));
			$page_story['url'] = "http://facebook.com/".$page_story_raw['from']['id'];
		}
	?>
    
    	<div class="teasertext">
              <div class="centerdiv"><h2 class="facebookh2"><a href="<?=$page_story['url']?>" target="_blank">Facebook</a></h2></div>
              <p class="facebookname"><a href="<?=$page_story['url']?>" target="_blank">GameCamp Munich</a></p>
              <p class="date"><?=$page_story['date']?></p>
              <div class="facebookmsg">
              <?=nl2br($page_story['message'])?>
              </div>
              <p class="facebookname"><a href="<?=$page_story['url']?>" target="_blank">mehr auf Facebook</a></p>
        </div>
	</div>
    <div class="breaker"></div>
        
</div><!-- content -->
 
<? get_footer(); ?>