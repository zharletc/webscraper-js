<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<form action="/tes/validasi" method="POST">
		{{ csrf_field() }}
		<input type="text" name="user">
		<input type="password" name="password">
		<input type="submit" name="submit" value="submit">
	</form>
</body>
</html>