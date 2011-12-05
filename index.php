<!DOCTYPE html>
<header>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
<script type="text/javascript" src="jquery.sparkline.js"></script>
<script type="text/javascript" src="jQueryRotate.js"></script>
<script>
	jQuery(document).ready(function($) {

		var color_list = [];
		var index = 0;
		while (index < 14){
			color_list.push(get_random_color());
			index += 1;
		}
		index = 0;
		$('#choices div').each(function(){
			$(this).css('color', color_list[index]);
			$(this).data('color', color_list[index]);
			index += 1;
		})
		
		$('#pie').sparkline(
			[1,1,1,1,1,1,1,1,1,1,1,1,1,1],{
				type	: 'pie',
				width	: 500,
				height	: 500,
				sliceColors	: color_list
			}
		);
		
		$('.selector span').click(function(){
			var metadata = $(this).data("type") == 'restaurant' ? "data-name" : "data-" + $(this).data("type");
			$('div[' + metadata + '="' + $(this).html() + '"]').hide();
			$(this).css("text-decoration", "line-through");
			var colors = refresh_pie();
			var size = colors.length;
			var distribution = [1,1,1,1,1,1,1,1,1,1,1,1,1,1].slice(0,size);
			$('#pie').sparkline(
				distribution,{
					type	: 'pie',
					width	: 500,
					height	: 500,
					sliceColors	: colors
				}
			);
		})
		
		$('#arrow').click(function(){
			var addition = Math.random()*360;
			var pool_size = $('#choices div:visible').size();
			var winner_index = Math.ceil(Math.floor(360-addition)/(360/pool_size));
			
			$('#pie').rotate({
				angle	:	0,
				animateTo: 3600 + addition,
				duration: 20000,
				easing: $.easing.easeInOutElastic,
				callback: function(){display(winner_index);}
			});	
		})
	
		function refresh_pie(){
			var remain_color = [];
			$('#choices div:visible').each(function(){				
				remain_color.push($(this).data('color'));
			})
			return remain_color;
		}
		
		function display(winner_index){
			var i = 1;
			$("#choices div:visible").each(function(){
				if (i == winner_index){
					$(this).css("font-size", "400%");					
				}
				i += 1;
			})
		}
		
		function get_random_color() {
		  var letters = '0123456789ABCDEF'.split('');
		  var color = '#';
		  for (var i = 0; i < 6; i++ ) {
		      color += letters[Math.round(Math.random() * 15)];
		  }
		  return color;
		}

	})
</script>
<style>
	body {
		margin:0;
		padding: 0;
		border: 0;
		text-align: center;
		width: 960px;
	}
	
	img, div{
		margin:0;
		padding: 0;
		border: 0;
	}
	
	#choices {
		width: 900px;
		margin: 50px 30px;
		height: 100px;
	}
	
	#choices div{
		display: inline;
		margin-right: 10px;
		text-align: left;
	}
	
	#main {
		width: 900px;
		margin: 0px 30px;
	}
	
	#selection {
		width: 200px;
		text-align: left;
		display: block;
		float: left;
	}
	
	#spinner{
		width: 500px;
		display: block;
		float: left;
		padding-left: 50px;
	}
/*
	
	#pie{
		display: inline
	}
*/
	
	#arrow img{
		display: inline;
		padding-top: 230px;
	}
	
	.sub_title{
		font-family: Author, cursive;
		font-size: 18px;
		padding-bottom: 5px;
	}
	
	.selector span{
		font-size: 12px;
		padding-right: 10px;
	}
</style>
</header>
<body>
	<div id="choices">
		<div data-location="North Point" data-style="Chinese" data-expense="0-50" data-distance="Medium" data-name="Food Court">Food Court</div>
		<div data-location="North Point" data-style="Japanese" data-expense="50-100" data-distance="Near" data-name="Genki Sushi">Genki Sushi</div>
		<div data-location="North Point" data-style="Taiwanese" data-expense="0-50" data-distance="Far" data-name="Don't recall">Don't recall</div>
		<div data-location="North Point" data-style="Japanese" data-expense="50-100" data-distance="Medium" data-name="Sakura Sushi">Sakura Sushi</div>
		<div data-location="North Point" data-style="Chinese" data-expense="0-50" data-distance="Far" data-name="Beef Noodle">Beef Noodle</div>
		<div data-location="North Point" data-style="Chinese" data-expense="0-50" data-distance="Far" data-name="Wing's Catering">Wing's Catering</div>
		<div data-location="North Point" data-style="Japanese" data-expense="50-100" data-distance="Near" data-name="Ajisen Ramen">Ajisen Ramen</div>
		<div data-location="North Point" data-style="Chinese" data-expense="0-50" data-distance="Far" data-name="A One">A One</div>
		<div data-location="North Point" data-style="Cafe" data-expense="0-50" data-distance="Near" data-name="Pacific Coffe">Pacific Coffee</div>
		<div data-location="North Point" data-style="Dim Sum" data-expense="50-100" data-distance="Near" data-name="Yi Yuen">Yi Yuen</div>
		<div data-location="Quarry Bay" data-style="Thai" data-expense="0-50" data-distance="Medium" data-name="Thai Cuisine">Thai Cuisine</div>
		<div data-location="Quarry Bay" data-style="Vegetarian" data-expense="0-50" data-distance="Medium" data-name="Cook Light Caf">Cook Light Cafe</div>
		<div data-location="Quarry Bay" data-style="Cafe" data-expense="0-50" data-distance="Near" data-name="Java Mama">Java Mama</div>
		<div data-location="Quarry Bay" data-style="Cafe" data-expense="0-50" data-distance="Near" data-name="Cafe 21">Cafe 21</div>
	</div>
	<div id="main">
	<div id="selection">
		<div class="sub_selection">
			<div class="sub_title">Directions:</div>
			<div class="selecting_pool">
				<div class="selector">
					<span data-type="location">North Point</span>
					<span data-type="location">Quarry Bay</span>
				</div>
			</div>
		</div>
		<hr/>
		<div class="sub_selection">
			<div class="sub_title">Styles:</div>
			<div class="selecting_pool">
				<div class="selector">
					<span data-type="style">Cafe</span>
					<span data-type="style">Chinese</span>
					<span data-type="style">Taiwanese</span>
					<span data-type="style">Thai</span>
					<span data-type="style">Japanese</span>
					<span data-type="style">Vegetarian</span>
					<span data-type="style">Dim Sum</span>
				</div>
			</div>
		</div>
		<hr/>
		<div class="sub_selection">
			<div class="sub_title">Expense:</div>
			<div class="selecting_pool">
				<div class="selector">
					<span data-type="expense">0-50</span>
					<span data-type="expense">50-100</span>
				</div>
			</div>
		</div>
		<hr/>
		<div class="sub_selection">
			<div class="sub_title">Distance:</div>
			<div class="selecting_pool">
				<div class="selector">
					<span data-type="distance">Near</span>
					<span data-type="distance">Medium</span>
					<span data-type="distance">Far</span>
				</div>
			</div>
		</div>
		<hr/>
		<div class="sub_selection">
			<div class="sub_title">Restaurants:</div>
			<div class="selecting_pool">
				<div class="selector">
					<span data-type="restaurant">Food Court</span>
					<span data-type="restaurant">Genki Sushi</span>
					<span data-type="restaurant">Don't recall</span>
					<span data-type="restaurant">Sakura Sushi</span>
					<span data-type="restaurant">Beef Noodle</span>
					<span data-type="restaurant">Wing's Catering</span>
					<span data-type="restaurant">Ajisen Ramen</span>
					<span data-type="restaurant">A One</span>
					<span data-type="restaurant">Pacific Coffee</span>
					<span data-type="restaurant">Yi Yuen</span>
					<span data-type="restaurant">Thai Cuisine</span>
					<span data-type="restaurant">Cook Light Cafe</span>
					<span data-type="restaurant">Java Mama</span>
					<span data-type="restaurant">Cafe 21</span>
				</div>
			</div>
		</div>
	</div>
	<div id="spinner">
		<div id="pie"></div>
	</div>
	<div id="arrow"><img src="http://icons.mysitemyway.com/wp-content/gallery/pink-jelly-icons-arrows/009121-pink-jelly-icon-arrows-arrowhead2-left.png" width=42 height=42></div>
		
	</div>
</body>