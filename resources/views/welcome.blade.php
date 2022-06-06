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
                <h2>Nous gérons vos caméras de chantier</h2>
                <H5><b>Visualisation en temps reèl de vos images / Maintenance de votre matériel</b></H5>

            </div>
           <div class="row">
            <form class="form-inline"  method="GET"  action="{{ route ('camera.find') }}">
                
                <div class="form-group offset-md-5 col-md-2 mb-2 mt-2">
                
                  <input type="text" class="form-control m-2" id="camera" name ="camera" placeholder="Nom de la camera">
               
                   
                       
                            <div style="text-align: center">
                            <button type="submit" class="btn btn-primary mt-3 text-center ">Voir la caméra</button>
                            <a class="btn btn-primary" href="{{ route('copy') }}" >Copier les fichiers</a>

                            @if ($errors->any())
                            <div class="alert alert-danger mt-2">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                          </div>
                    
              </div>
              </form>
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
