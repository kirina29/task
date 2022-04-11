@extends('dashboard')

@section('title', 'Статусы')

@section('content')
    <div class="container">
        <div class="">
            <div class="col-md-3"></div>
            <div class="col-md-offset-6">
            <h4 class="mb-8 items-center px-1 pt-1 border-b-2 border-t-2 border-indigo-400 font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out font-semibold text-xl text-gray-800 leading-tight text-center">Вывод всех статусов
                @if(session()->get('success'))
                    <span>({{session()->get('success')}})</span>
                @endif
                </h4>
                <h5 class="text-center"><a href="{{route('statuses.create')}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 btn btn-success ml-3">
                    Добавить новый статус
                </a></h5>
                <div class="table">
                    <div class="table-colgroup">
                        <div class="table-col" style="width: 5%"></div>
                        <div class="table-col" style="width: 20%"></div>
                        <div class="table-col" style="width: 20%"></div>
                    </div>
                    <div class="table-thead">    
                        <div class="table-tr">
                            <div class="table-th">#</div>
                            <div class="table-th">Название</div>
                            <div class="table-th">Управление</div>
                        </div>
                    </div>
                    <div class="table-tbody"> 
                    @foreach($status as $stts)
                        <div class="table-tr">
                            <div class="table-td">{{$stts->id}}</div>
                            <div class="table-td">{{$stts->name}}</div>
                            <div class="table-td">
                                <a href="{{route('statuses.show', $stts)}}" class="btn btn-success">
                                    <i class="fa fa-eye">Просмотр</i>
                                </a>
                                <a href="{{route('statuses.edit', $stts)}}" class="btn btn-primary">
                                    <i class="fa fa-pencil">Изменить</i>
                                </a>
                                <form method="POST" action="{{route('statuses.destroy', $stts)}}" style="display: contents">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-del">
                                        <i class="fa fa-del">Удалить</i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-11 d-flex justify-content-center p-4">
                        {{$status->links('vendor.pagination.bootstrap-4')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection