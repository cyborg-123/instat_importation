<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>visualisation</title>
    
    @include('admin.include.stylhead')
<style>
    .cs-loader {
  position: relative;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  margin-top: 10px;
}

.cs-loader-inner {
  transform: translateY(-50%);
  top: 50%;
  position: absolute;
  width: calc(100% - 200px);
  color: #005a57;
  padding: 0 100px;
  text-align: left;
}

#msg {
    font-weight: 500;
    color: #636363;
    font-family: 'arial';
    margin-left: 80px;
    text-align: left;
}

.cs-loader-inner label {
  font-size: 20px;
  opacity: 0;
  display:inline-block;
}

@keyframes lol {
  0% {
    opacity: 0;
    transform: translateX(-300px);
  }
  33% {
    opacity: 1;
    transform: translateX(0px);
  }
  66% {
    opacity: 1;
    transform: translateX(0px);
  }
  100% {
    opacity: 0;
    transform: translateX(300px);
  }
}

@-webkit-keyframes lol {
  0% {
    opacity: 0;
    -webkit-transform: translateX(-300px);
  }
  33% {
    opacity: 1;
    -webkit-transform: translateX(0px);
  }
  66% {
    opacity: 1;
    -webkit-transform: translateX(0px);
  }
  100% {
    opacity: 0;
    -webkit-transform: translateX(300px);
  }
}

.cs-loader-inner label:nth-child(6) {
  -webkit-animation: lol 3s infinite ease-in-out;
  animation: lol 3s infinite ease-in-out;
}

.cs-loader-inner label:nth-child(5) {
  -webkit-animation: lol 3s 100ms infinite ease-in-out;
  animation: lol 3s 100ms infinite ease-in-out;
}

.cs-loader-inner label:nth-child(4) {
  -webkit-animation: lol 3s 200ms infinite ease-in-out;
  animation: lol 3s 200ms infinite ease-in-out;
}

.cs-loader-inner label:nth-child(3) {
  -webkit-animation: lol 3s 300ms infinite ease-in-out;
  animation: lol 3s 300ms infinite ease-in-out;
}

.cs-loader-inner label:nth-child(2) {
  -webkit-animation: lol 3s 400ms infinite ease-in-out;
  animation: lol 3s 400ms infinite ease-in-out;
}

.cs-loader-inner label:nth-child(1) {
  -webkit-animation: lol 3s 500ms infinite ease-in-out;
  animation: lol 3s 500ms infinite ease-in-out;
}

</style>
    </head>

    <body>

    <div id="soft-all-wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            
            @include('admin.include.header')
            <!-- /.navbar-header -->

            @include('admin.include.navbar')
            <!-- /.navbar-top-links -->

            @include('admin.include.navleft')
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">Importation</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
               

                              <div class="card-body g-py-20 g-py-md-40 g-px-md-40">
              <form id="my_form" action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                 <div class="form-group row{{ $errors->has('survey') ? 'has-error':'' }}">
                    <label form="survey" class="col-sm-2 col-form-label">Enquetes</label>
                    <div class="col-sm-10">
                        <select id="id_survey" class="custom-select form-control" name="id_survey" >
                            @foreach($surveys as $survey)
                                <option value="{{ $survey->id }}">{{ $survey->name}} </option>
                                  @endforeach
                        </select>     
                    </div>
                </div>
                <br>
                
        
                <div class="form-group row{{ $errors->has('group') ? 'has-error':'' }}">
                    <label form="group" class="col-sm-2 col-form-label">Groupé par</label>
                    <div class="col-sm-10">
                        <select id="group" class="custom-select form-control" name="group" >
                            @foreach($groups as $group)
                               <option value="{{ $group }}">{{ $group}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                

                <div class="form-group row{{ $errors->has('year') ? 'has-error':'' }}">
                    <label form="year" class="col-sm-2 col-form-label">Anneé Enquete</label>
                    <div class="col-sm-10">
                        <select id="year" class="custom-select form-control" name="year" >             
                            @foreach($years as $year)
                               <option value="{{ $year }}">{{ $year }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                

                
                <div class="form-group row{{ $errors->has('file') ? 'has-error':'' }}">
                  
                  <label form="file" class="col-sm-2 col-form-label">fichier csv</label>
                  <div class="col-sm-6">
                          <input type="file" name="file" class="col-sm-6 col-form-label">
                  </div>

                </div>

                <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" id="import" class="btn btn-primary">Importer</button>
                </div>
               </div>

                    <div id="server-results"><!-- For server results --></div>
                </form>
                 <div id="upload-progress" style="display: none">
                    <p id="msg">Enregistrement en cours...</p>
                  <div class="cs-loader">
                      <div class="cs-loader-inner">
                        <label> ●</label>
                        <label> ●</label>
                        <label> ●</label>
                        <label> ●</label>
                        <label> ●</label>
                        <label> ●</label>
                      </div>
                    </div>
                    
                </div> 
           </div>
            



            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    
    @include('admin.include.stylfoot')
<script>
    $(document).ready(function() {
        $("#my_form").submit(function(event) {
            event.preventDefault(); //prevent default action 
            var post_url = $(this).attr("action"); //get form action url
            var request_method = $(this).attr("method"); //get form GET/POST method
            var form_data = new FormData(this); //Creates new FormData object
            $("#upload-progress").show();
            $.ajax({
                url : post_url,
                type: request_method,
                data : form_data,
                contentType: false,
                cache: false,
                processData:false,
            success: function(response) {
                $("#server-results").html(response);
                $("#upload-progress").hide();
                setTimeout(hideMsg,10000);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                $("#upload-progress").hide();
                alert(textStatus + " " + errorThrown);
            }

            });
        });
    });

    function hideMsg() {
        $("#server-results").html("");
    }
</script>
</body>

</html>