<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<head>
	    <title>Contact</title>
	    <meta http-equiv="Content-Type" content="text/html"  charset="UTF-8"/>
	</head>
	<body>
	    <div>
	    	<h3>Envoyée par : {{ $name }}</h3>
	    	@if(!empty($sujet))
	    	<p><strong>Sujet :</strong> {{ $sujet }}</p>
	    	@endif
	        <p>Email : {{ $email }}</p>
	        @if(!empty($tel))
	        <p>Téléphone : {{ $tel }}</p>
	        @endif
	        <p>à la date du : {{ $date }}</p>
	    	<p>{!! nl2br(e($text)) !!}</p>
	    </div>
	</body>
</html>
