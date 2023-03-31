
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    
    <title>みらいチケット</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--<link href="css/materialize01/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>-->
    <!--<link href="css/materialize01/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>-->

     @include('layouts.usermain')
    
                <!-- Page Heading -->
                @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow py-3 px-4 sm:py-4 sm:px-6 lg:px-8">
                    <div class="text-2xl font-bold text-gray-900">
                        {{ $header }}
                    </div>
                </header>
                @endif
