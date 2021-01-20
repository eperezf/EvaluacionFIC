<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>Sistema de evaluación académica y docente UAI</title>
	<!-- Styles -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<style>body,html {height: 100%;}</style>
	<!--JS-->
	<script type="text/javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
	@if(Auth::check())
	<script>
		$(document).ready(function() {
				$('#confirmar-salida').modal('show')
		})
	</script>
	@endif
	<div class="modal fade" id="confirmar-salida" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
		  <div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Confirmar</h5>
				</div>
				<div class="modal-body">
			  	Usted ya está en el sistema como {{ $nombre }}, es necesario cerrar la sesión antes de acceder como un usuario diferente.
				</div>
				<div class="modal-footer">
			  	<a href="{{ route('index') }}">
						<div class="btn btn-secondary">Volver a EvalFIC</div>
					</a>
			  	<a href="{{ route('logout') }}">
						<div class="btn btn-danger">Cerrar sesión</div>
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="container h-100">
		<div class="row h-100 justify-content-center">
	  	<div class="col-lg-6 col-md-8 col-sm-12 align-self-center">
				<div class="text-center">
					<img class="img-fluid mb-5" src="{{asset('img/logo_negro.gif')}}"/>
				</div>
				<div class="card">
				  <div class="card-header text-center">
				    Sistema de evaluación académica y docente
				  </div>
				  <div class="card-body">
						@if(session()->get('danger'))
					    <div class="alert alert-danger">
					      {{session()->get('danger') }}
					    </div>
					  @endif
						<form method="post" action="{{ route('doLogin') }}">
							@csrf
						  <div class="form-group">
						    <label for="Email">Correo</label>
						    <input type="email" class="form-control" id="Email" name="Email" aria-describedby="emailHelp" placeholder="ejemplo@correo.cl">
						  </div>
						  <div class="form-group">
						    <label for="Password">Contraseña</label>
						    <input type="password" class="form-control" id="Password" name="Password" placeholder="Contraseña">
							</div>
							<div class="text-center align-center">
								<button type="submit" class="btn btn-primary btn-lg">Entrar</button>
							</div>
						</form>
				  </div>
				</div>
			</div>
	  </div>
</div>
<!--JS-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>
