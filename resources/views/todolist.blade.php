<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .remove-link {
            text-decoration: none;
            display: inline-block;
            width: 12px;
            height: 12px;
            position: relative;
            left: 30px;
            top: 1px;
            font-size: x-large;
        }

        .link {
            text-decoration: none;
            background: transparent;
            display: inline-block;
            width: 13px;
            height: 12px;
            position: relative;
            z-index:3;
            right: 21px;
            bottom: 1px;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .text-barre {
            text-decoration: line-through;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
    <div class="top-right links">
        @auth
        <a href="{{ url('/home') }}">Home</a>
        @else
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
        @endauth
    </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            My Todolist
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="col-md-offset-4 ">
            <form method="post" action="{{ route('todo.store') }}">
                {{ csrf_field() }}
                <label for="title" class="label">Title</label>
                <input type="text" class="form-control" name="title" id="title">
                <label for="description" class="label">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>

                <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-plus-sign"></span>
                    Ajouter
                </button>
            </form>
        </div>
        <div>
            <ul class="list-unstyled">
                @if(empty($tasks))
                Aucun élément trouvé
                @else
                @foreach($tasks as $task)
                <li title="{{ $task->description }}">
                    @if($task->done)
                    <input type="checkbox" name="taskDone[]" id="{{ $task->id }}" checked>
                    <a href="{{ route('todo.state',['id'=>$task->id]) }}" class="link"></a>
                    @else
                    <input type="checkbox" name="taskDone[]" id="{{ $task->id }}">
                    <a href="{{ route('todo.state',['id'=>$task->id]) }}" class="link"></a>
                    @endif


                    @if($task->done)
                        <h5 class="text-barre" style="display:inline-block">{{ $task->title}}</h5>
                    @else
                        <h5 style="display:inline-block">{{ $task->title}}</h5>
                    @endif

                    <a href="{{ route('todo.destroy',['id'=>$task->id]) }}" class="remove-link" style="color: red;font-weight: bold">x</a>
                </li>
                @endforeach
                @endif

            </ul>
        </div>
    </div>
</div>
</body>
</html>
