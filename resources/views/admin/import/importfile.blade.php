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
              <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
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
                </br>
                
        
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
                </br>
                

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
                </br>
                

                
                <div class="form-group row{{ $errors->has('file') ? 'has-error':'' }}">
                  
                  <label form="file" class="col-sm-2 col-form-label">fichier csv</label>
                  <div class="col-sm-6">
                          <input type="file" name="file" class="col-sm-6 col-form-label">
                  </div>

                </div>

                <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Importer</button>
                </div>
               </div>

             </form>
           </div>
            



            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    
    @include('admin.include.stylfoot')

</body>

</html>