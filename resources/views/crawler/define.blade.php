<center><html>
@include('crawler.header')
	<table class="resultURL">
		<tr>
			<th>Title</th>
			<th>Link</th>
		</tr>
			<tr><td>{{ $title }}</td>
			<td>{{ $url }}</td></tr>
	</table>
	<form action="/crawler/crawl" method="POST">
		{{ csrf_field() }}
		<input type="hidden" name="url" value="{{ $url }}">
		<input type="hidden" name="title" value="{{ $title }}">
		<br>
		<input type="submit" class="button-link" value="Silahkan Browse !">
	</form>

</html>

