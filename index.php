<?php 
include('includes/header.php'); 
include('lib/simple_html_dom.php');
?>

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron twitchtron"></div>

<div class="row">

	<h1 class="header">Top Games</h1>

	<?php

	// Fetch top 4 games on twitch.tv
	 
	$games = $twitch->games(4);
	
	foreach ( $games->top as $game ) {

	?>
	<div class="col-sm-6 col-md-3">

		<div class="well top_game__container">

			<div style="float:left;">

				<i class="fa fa-eye"></i>&nbsp;<h4 style="display:inline;">Viewers</h4>

				<h5 style="text-align:left;"><?php echo $game->viewers; ?></h5>

			</div>
			
			<div style="float:right;">

				<i class="fa fa-random"></i>&nbsp;<h4 style="display:inline;">Channels</h4>

				<h5 style="text-align:right;"><?php  echo $game->channels; ?></h5>

			</div>

			<div align="center" class="center-block text-center">

				<a href="<?php echo $twitch::TWITCH_BASE_URL . '/directory/game/' . $game->game->name; ?>" target="_blank"><img src="<?php echo $game->game->box->large; ?>" alt="<?php echo $game->game->name; ?>" class="top_game__image" /></a>

			</div>

			<h3 class="text-center"><?php echo $game->game->name; ?></h3>

		</div>

	</div>

	<?php } ?>

</div> <!-- end row fluid -->


<div class="row">

	<h1 class="header">Featured Streams</h1>

	<?php

	// Fetch 6 Featured streams on twitch.tv
	
	$featured = $twitch->featured(6);

	foreach ( $featured->featured as $feature ) {

		$featureText = str_get_html($feature->text)->find('p', 0)->plaintext;

	?>

    <div class="col-xs-6 col-lg-6">

    	<a href="streamer.php?name=<?php echo $feature->stream->channel->display_name; ?>"><h2 class="feature__display_name"><?php echo $feature->title; ?></h2></a>
	  
		<a href="<?php echo $twitch::TWITCH_BASE_URL . '/directory/game/' . $feature->stream->game; ?>" target="_blank"><img src="<?php echo $feature->stream->preview->large; ?>" class="img-responsive" /></a>

    	<p class="limitFeatureText"><?php echo $featureText; ?></p>

    	<p style="margin:5px 0;"><a class="btn btn-primary" href="<?php echo $feature->stream->channel->url; ?>" target="_blank" role="button">View Channel »</a></p>

    </div><!--/.col-xs-6.col-lg-4-->

	<?php } ?>

</div> <!-- end row fluid -->


<div class="row">

	<h1 class="header">Teams</h1>

	<div id="myCarousel" class="carousel slide" data-ride="carousel">

		<!-- Indicators -->
		<ol class="carousel-indicators">
	<?php 

	// Fetch random teams every refresh on twitch.tv
	
	$teams = $twitch->teams();

	foreach( $teams->teams as $index => $team ) {

	?>

	    	<li data-target="#myCarousel" data-slide-to="<?php echo $index; ?>" class="<?php echo ($index === 0) ? 'active' : ''; ?>"></li>
	<?php } ?>
	  	</ol>

	  <!-- Wrapper for slides -->
	  	<div class="carousel-inner" role="listbox">
	  		<?php 

	  		foreach( $teams->teams as $index => $team ) {

		  		$logo = ( $team->logo ) ? $team->logo : null;

				if ($logo !== null ) {
					$image = $logo;
				}  else {
					next($teams);
				}
	  		?>

	    	<div class="item <?php echo ($index === 0) ? 'active' : '' ; ?>">
	      		<a href="<?php echo $twitch::TWITCH_BASE_URL . '\\team\\' . $team->name; ?>" target="_blank"><img src="<?php echo $image; ?>" alt="">
	      		<div class="carousel-caption">
	        		<p><?php echo $team->display_name; ?></p>
	      		</div>
	      		</a>
	    	</div>

	    	<?php } ?>

	  	</div>

	  	<!-- Controls -->
	  	<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
	    	<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	    	<span class="sr-only">Previous</span>
	  	</a>
	  	<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
	    	<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	    	<span class="sr-only">Next</span>
	  	</a>

	</div>

</div> <!-- end row fluid -->

<?php include('includes/footer.php'); ?>