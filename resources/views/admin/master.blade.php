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
                    <h1 align=" center" class="page-header">Tableau de bord</h1>
                </div>
                
            </div>


        </div>
       

    </div>
    
    @include('admin.include.stylfoot')

</body>

</html>