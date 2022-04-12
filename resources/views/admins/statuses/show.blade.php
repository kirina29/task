@extends('dashboard')

@section('title', 'Просмотр одного статуса')

@section('content')
<h4 class=" mb-8 items-center px-1 pt-1 border-b-2 border-t-2 border-indigo-400 font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out font-semibold text-xl text-gray-800 leading-tight text-center">Вывод одного статуса</h4>
    <div class="table">
        <div class="table-colgroup">
            <div class="table-col" style="width: 20%"></div>
        </div>
        <div class="table-thead">    
            <div class="table-tr">
                <div class="table-th">Название</div>
            </div>
        </div>
        <div class="table-tbody"> 
            <div class="table-tr">
                <div class="table-td">{{$stts->name}}</div>
            </div>
        </div>
        <div class="flex items-center mt-4">
            <a href="{{route('statuses.index')}}" class="items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 btn btn-success ml-3">Вернуться обратно</a>
        </div>
    </div>
@endsection