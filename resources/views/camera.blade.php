<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Timelapse Réunion</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700&amp;display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kaushan+Script&amp;display=swap">
       
    </head>
    <body >
        <section>
            <div class="row text-center mt-4">
                <H1>TIMELAPSE REUNION</H1>
                <h2>CAMERA {{ $camera->camera_id }}</h2>
                <H5><b>Temps de raffraichissement 1 mn</b></H5>

            </div>
           <div class="row">
               <div class="col-md-8 offset-md-2 text-center mt-4">
                <img src="../{{ $camera->directory }}/last.jpg" width="800px" height="4git init00px">
               </div>

             
           </div>
        </section>
       <section>
           <div class="row text-center mt-4">
            <H6><b>Copyright : My Lovely Planet - Contact : fabrice@my-lovely-planet.com</b></H6>
           </div>
       
       </section>
        <script src="{{ asset('/js/app.js')}}"></script>

    </body>
</html>
