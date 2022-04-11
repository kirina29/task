@extends('dashboard')

@section('title', 'Редактировать подзадачу')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 mx-auto">
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <h4 class=" mb-8 items-center px-1 pt-1 border-b-2 border-t-2 border-indigo-400 font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out font-semibold text-xl text-gray-800 leading-tight text-center">Редактирование подзадачи</h4>
                <form method="POST" action="{{route('subtasks.update', $sbtsk)}}"  class="adminFormAddTask">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                    <label for="form-name">Название</label>
                    <input type="text" class="form-control block mt-1 w-full" value="{{$sbtsk->name}}" name="name" id="form-name" placeholder="Название подзадачи">
                    </div>
                    <div class="form-group">
                        <label for="form-start_date">Дата начала</label>
                        <input type="date" class="form-control block mt-1 w-full" value="{{$sbtsk->start_date}}" name="start_date" id="form-start_date" placeholder="Дата создания подзадачи">
                    </div>
                    <div class="form-group">
                        <label for="form-deadline_date">Дата дедлайна</label>
                        <input type="date" class="form-control block mt-1 w-full" value="{{$sbtsk->deadline_date}}" name="deadline_date" id="form-deadline_date" placeholder="Дата сдачи подзадачи">
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <x-button class="btn btn-success ml-3" type="submit">Отредактировать</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection