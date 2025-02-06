<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=,initial-scale=1.0">
	<title>Formulario</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="index.css">

</head>
<body>

	<form class="bg-dark" action="index.php" method ="GET">
		<br>
		<h1 class="text-center">Juego del</h1>
		<h1 class="text-center">UNO</h1>
		<hr>
		<br>
		<div class="form-group">
			<label>Introduce el número de jugadores</label>
			<input type="number" class="form-control" style ="width:200px" name="njugadors" min = 1 max= 5 placeholder="Jugadores">
			<br>	
	 
				<div class="form-group">
					<label>Introduce el número de cartas por jugador</label>
					<input type="number" class="form-control" style ="width:200px" name="ncartas"min = 1 max = 7 placeholder="Cartas">
				</div>
	  			<br>	
	  			<button type="submit" class="btn btn-primary">Jugar</button>

		</div>
	</form>




</body>
</html>





