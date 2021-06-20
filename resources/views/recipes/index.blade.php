@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Smidthouse Recipes</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('create') }}" title="Create a recipe"> <i class="fas fa-plus-circle"></i>
                    </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>Success</p>
        </div>
    @endif

    <table class="table table-bordered table-responsive-lg">
        <tr>

            <th>Name</th>

            <th>Servings</th>
            <th>Length</th>
            <th>Calories (per serving)</th>
            <th>Actions</th>
        </tr>

        @foreach ($recipes as $recipe)
           <tr>

               <td>{{$recipe->name}}</td>

               <td>{{$recipe->servings}}</td>
               <td>{{

                 (int)($recipe->length / 60) . ' hour(s), ' . $recipe->length % 60 . ' minutes'
               }}</td>
              <td>{{$recipe->calories}}</td>
               <td>
                   <form action="" method="POST">

                       <a href="{{ URL::to('recipes/' . $recipe->id)  }}" title="Show">
                           <i class="fas fa-eye text-success fa-lg"></i>
                       </a>

                        <a href="{{ URL::to('recipes/' . $recipe->id . '/edit')  }}" title="Edit">
                           <i class="fas fa-edit fa-lg"></i>
                       </a>


                       <a href="{{ URL::to('recipes/' . $recipe->id . '/delete')  }}" title="Delete">
                           <i class="fas fa-trash fa-lg text-danger"></i>
                       </a>
                   </form>
               </td>
           </tr>
       @endforeach

    </table>



@endsection
