<html>
@include('crawler.header')
	<body>
		<table id="link-table">
			<tr>
			    <th style>Link</th>
			    <th>Action</th>
		 	</tr>
			  	@foreach ($links as $link)
			  		@if (strlen($link) > 150)
			  			<?php 
			  				$shortlink = substr($link,0,150) . "...";
			  			?>
			  			<tr><td>{{ $shortlink }}</td>
			  		@else
			  			<tr><td>{{ $link}}</td>
			  		@endif
					<form action="/crawler/browse" method="POST">
						{{ csrf_field() }}	
						<td><button class='button-link' name='subLink' value='{{ $link }}' type='submit'>Crawl</button></td></tr>
					</form>
				@endforeach
		</table>
	</body>
</html>

