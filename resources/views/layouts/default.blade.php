<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AULA DEL CONOCIMIENTO</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <script type="text/javascript" src="//cdn.jsdelivr.net/afterglow/latest/afterglow.min.js"></script>
    <link href="../lightbox/lightbox.min.css" rel="stylesheet">
    <script src="../jquery.min.js"></script>
    

</head>
<body>

<div style="width:100%">
	<h2 style="text-align:center">AULA DEL CONOCIMIENTO</h2>
	<div id="navegacion" class="col-lg-12 margin-tb" style="width:19%; float:left ">

		</br><h3 style="text-align:center">MENÚ</h3>
		</br><h4>Aprendizaje</h4>
			<a href="#" class="btn btn-primary btn-block" role="button">Introducción EV3</a>
			<a href="{{ URL('listar') }}" class="btn btn-primary btn-block" role="button">Tutorias</a>
			<a href="#" class="btn btn-primary btn-block" role="button">Avance del conocimiento</a>
		   
		</br><h4>Administrativo</h4>
			<a href="{{ route('taller.index') }}" class="btn btn-primary btn-block" role="button">Mantenimiento Tutorias</a>
			<a href="#" class="btn btn-primary btn-block" role="button">Mantenimiento Evaluaciones</a>
		  	
	</div>
	<div style="width:75%; float:right">
	    @yield('content')
	</div>
</div>

 
</body>
</html>