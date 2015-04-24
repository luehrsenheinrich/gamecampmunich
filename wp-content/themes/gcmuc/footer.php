</div> <!-- role main -->
</div> <!-- wrapper -->
<footer>
	<div class="footer_wrapper">
    	<?php get_template_part('veranstalter'); ?>
    	<div class="footer_border"></div>
    	<div class="footer_links">
        <p><a href="/impressum">Impressum</a> - <a href="/kontakt">Kontakt</a> - made in munich - powered by <a href="http://www.luehrsen-heinrich.de">Luehrsen // Heinrich</a></p></div>
    
    </div>
</footer>

<? wp_footer(''); ?>
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '364461830288428', // App ID
      channelUrl : '<?=WP_THEME_URL?>/channel.php', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    });

    // Additional initialization code here
  };

  // Load the SDK Asynchronously
  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/de_DE/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));

	// Google Analytics
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-33288217-1']);
  _gaq.push(['_gat._anonymizeIp']);
  _gaq.push(['_setDomainName', 'gamecampmunich.de']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>