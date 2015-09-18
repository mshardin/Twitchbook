<?php 

// Retrieve search query and urlencode for api
$q = isset($_POST['search']) && !empty($_POST['search']) ? $_POST['search'] : '';

include('includes/header.php');
?>	

	<div id="main-error-message"></div>


	<div class="row">

		<h1>Channels</h1>
		<h4 id="channels-error-message"></h4>

		<div class="channels">

		</div>

	</div>
	
	<div class="row">

		<h1>Streams</h1>
		<h4 id="streams-error-message"></h4>

		<div class="streams">

		</div>

	</div>

<!-- 
	<div class="row">

		<h1>Games</h1>
		<div id="games-error-message"></div>

		<div class="games">

			<div class="col-md-4">
				<div id="url-0"></div>
				<div id="name-0"></div>
				<img id="logo-0" src="">
			</div>

		</div>

	</div> -->

	<script type="text/javascript">

	var q = "<?= $q ?>"; // pull $q from $_POST into js var q

	function makeChannelRow(key) {
		var dash = '-';
		var suffix;
		var row = '';

		// Don't suffix first row
		// Add dash to any subsequent rows and index
		if (key == 0) { suffix = ''; } else { suffix = dash + key }
		
		row += '<div class="col-md-4 channel-row">';
		row += '<div id="' + 'display-name' + suffix + '"></div>';
		row += '<a href="" id="' + 'link' + suffix + '"><img id="' + 'logo' + suffix + '" src=""></a>';
		row += '<div id="' + 'status' + suffix + '"></div>';
		row += '<span id="' + 'views' + suffix + '"></span>';
		row += '<span id="' + 'followers' + '"></span>';
		row += '</div>';

		return row;
	}

	function makeStreamRow(key) {
		var dash = '-';
		var suffix;
		var row = '';

		// Don't suffix first row
		// Add dash to any subsequent rows and index
		if (key == 0) { suffix = ''; } else { suffix = dash + key }
		
		row += '<div class="col-md-4 stream-row">';
		row += '<img src"" class="img-responsive" id="streamImage' + suffix + '" />';
		row += '<p><a class="btn btn-primary" href="" target="_blank" role="button" id="' + 'streamLink' + suffix + '">View Channel »</a></p>';
		row += '</div>';

		return row;
	}

	function getChannels() {
	    $.ajax({
	        type: "POST",
	        url: "functions/searchAll.php",
	        async: false,
	        data: { query: q }
	    }).success(function(data) {
	    	var datap = JSON.parse(data);

	    	console.log(datap.streams.streams.length);

	    	(datap.channels === undefined || datap.channels.channels.length == 0 ? $('#channels-error-message').html('No channels found for that query.') : console.log('we have channels'));
	    	(datap.streams === undefined || datap.streams.streams.length == 0 ? $('#streams-error-message').html('No streams found for that query.') : console.log('we have streams'));

	    	if (datap.status !== 400) {

	    		$('.channels').empty();
	    		$('.streams').empty();

		    	$.each(datap.channels.channels, function(key, value) {

		    		$('.channels').append(makeChannelRow(key));

		    		// console.log(makeChannelRow(key));
		    		
		    		// for the ones with no logo 'http://placehold.it/300x300'
		    		 
		    		if (key == 0) {
		    			$('.channels #display-name').html(value.display_name);
		    			$('.channels #link').attr('href', value.url);
		    			$('.channels #logo').attr('src', (value.logo !== null ? value.logo : 'http://placehold.it/300x300'));
		    			$('.channels #status').html(value.status);
		    			$('.channels #views').html(value.views);
		    			$('.channels #followers').html(value.followers);
		    		} else {
			    		$('.channels #display-name-'+key).html(value.display_name);
		    			$('.channels #link-'+key).attr('href', value.url);
		    			$('.channels #logo-'+key).attr('src', (value.logo !== null ? value.logo : 'http://placehold.it/300x300'));
		    			$('.channels #status-'+key).html(value.status);
		    			$('.channels #views-'+key).html(value.views);
		    			$('.channels #followers-'+key).html(value.followers);
		    		}
		    	});

		    	$.each(datap.streams.streams, function(key, value) {
					
					$('.streams').append(makeStreamRow(key));

		    		// sconsole.log(makeStreamRow(key));

		    		if (key == 0) {
		    			$('.streams #streamImage').attr('src', value.preview.large);
		    			$('.streams #streamLink').attr('href', value.channel.url);
		    		} else {
		    			$('.streams #streamImage-'+key).attr('src', value.preview.large);
		    			$('.streams #streamLink-'+key).attr('href', value.channel.url);
		    		}
		    	});

		    	// $.each(datap.games, function(key, value) { 
		    	// 	$('.channels #url-'+key).html(datap.channels[key].url);
		    	// 	$('.channels #name-'+key).html(datap.channels[key].name);
		    	// 	$('.channels #logo-'+key).attr('src', datap.channels[key].logo);
		    	// });
		    } else {
		    	$('#main-error-message').html('No search to query, please choose a channel, stream or game to search.');
		    }

	        setTimeout(function(){getChannels();}, 15000);
	    }).error(function(jqXHR, textStatus, errorThrown) {
	    	$('#main-error-message').html(errorThrown);
	    	console.log(errorThrown);
	    });
	}

	$(document).ready(getChannels);
	</script>

<?php 
include('includes/footer.php');
?>