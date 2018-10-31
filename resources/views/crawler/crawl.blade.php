<html>
@include('crawler.header')
<style>
#resizable {max-width: 100%}
iframe {
    width: 100%;
    height: 250px;
}
</style>
<script>
$(function() {
    $("#resizable").resizable();
    $(".ui-widget-content").resize(function(){
    	var heightno = $(".ui-widget-content").outerHeight(true);
  		$("#size").html(heightno);
  		$(".ui-widget-header").height(heightno);
    });
});
</script>
<body>
	<div id="resizable" class="ui-widget-content">
		<iframe src="<?php echo $url ?>" frameborder="0" class="ui-widget-header"></iframe>
	</div>
	<br><br>
	<center>
	<form action="/crawler/detail" method="POST" >
		{{ csrf_field() }}
		<input type="hidden" name="title" value="{{ $title }}">
		<input type="hidden" name="url" value="{{ $url }}">
			<table class="resultURL">
				<tr>
					<th>URL</th>
					<th>Tag</th>
					<th>Attributes 1</th>
					<th>Value</th>
					<th>Attributes 2</th>
					<th>Value 2</th>
				</tr>
				<tr>
				<td>{{ $url }}</td>
				<td>
					<select name='tag' id=''>
						@foreach ($tags as $tag)
							<option value = '{{ $tag }}'>{{ $tag }}</option>
						@endforeach
					</select>
				</td>
			<td><input type="text" name="attr1"></td>
			<td><input type="text" name="val1"></td>
			<td><input type="text" name="attr2"></td>
			<td><input type="text" name="val2"></td>
		</table>
		<br>
		<input type='submit'  formtarget="_blank" class="button-link" value='Proses!' name='sub_tag'>
	</form>

		<br><br>
</body>
</html>
