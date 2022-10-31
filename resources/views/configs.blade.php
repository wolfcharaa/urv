<!doctype html>
<html lang="en">
  <head>
  	<title>Table 07</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="/css/style.css">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Конфиги </h2>

				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="table-wrap">
						<table class="table table-bordered table-dark table-hover">
						  <thead>
						    <tr>
						      <th>#</th>
						      <th>Название объекта</th>
						      <th>Адрес</th>
						      <th>Домен</th>
						    </tr>
						  </thead>
						  <tbody>

                          @foreach($configs as $config)
						    <tr onclick="document.location='{{url('/api/urv_object/' . $config->urv_object->id . '/config')}}';">
						      <th scope="row">{{$config->urv_object->id}}</th>
						      <td>{{ $config->urv_object->name }}</td>
						      <td>{{ $config->urv_object->address }}</td>
						      <td>{{ $config->server_ip }}</td>
						    </tr>
                          @endforeach
						  </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="/js/jquery.min.js"></script>
  <script src="/js/popper.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/main.js"></script>

	</body>
</html>

