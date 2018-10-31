<html>
@include('crawler.header')
<body>
<form action="/crawler/scrap" method="POST">	
	{{ csrf_field() }}
	<table id="link-table">
		<tr>
		    <th>Link</th>
		    <th>Title</th>
		    <th>Check</th>
	 	</tr>
		@for ($x=0;$x<count($data);$x++)
 			<tr><td><a href={{ $data[$x]['Link'] }}>{{ $data[$x]['Link'] }}</a></td>
			<td>{{ $data[$x]['Title'] }}</td>
			<td><input type='checkbox' name='inclink[]' value="{{ $data[$x]['Link'] }}::{{ $data[$x]['Title'] }}"></td></tr>
 		@endfor 		
	</table>
	<br>
					<center>
					<table class="resultURL">
				<tr>
					<th>Name</th>
					<th>Tag</th>
					<th>Attributes 1</th>
					<th>Value</th>
					<th>Attributes 2</th>
					<th>Value 2</th>
				</tr>
				<td>
					<select name="name[]">
						@foreach ($columns as $column)
							@if ($column == "ID" || $column == "LINK" || $column == "GET_DATE")
								<?php continue; ?>
							@else
								<option value='{{ $column }}'>{{ $column }}</option>
							@endif
						@endforeach
					</select>
				</td>
				<td>
					<select name='tag[]' id=''>
						@foreach ($tags as $tag)
							<option value = '{{ $tag }}'>{{ $tag }}</option>
						@endforeach
					</select>
				</td>

			<td><input type="text" name="attr1[]"></td>
			<td><input type="text" name="val1[]"></td>
			<td><input type="text" name="attr2[]"></td>
			<td><input type="text" name="val2[]"></td>
		</table>
		<br>
	<input type="submit"  formtarget="_blank" name="scrapContent" class="button-link" value="SCRAP SEKARANG!">
	<button class="add-Tag button-link">Add Selection</button></center>
</form>
</body>
</html>
<script>
	$(".add-Tag").on("click",function(event){
		event.preventDefault();
		clone();
		alert("Success");
	})
	function clone(){
		$("table.resultURL:last").clone().insertAfter("table.resultURL:last");
	}
</script>