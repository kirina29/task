@if(Auth::user()->name==='admin')
<x-app-layout>
    <x-slot name="header">
        <x-nav-link :href="route('tasks.index')" :active="request()->routeIs('tasks.index')" class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Задачи') }}
        </x-nav-link>
        <x-nav-link :href="route('subtasks.index')" :active="request()->routeIs('subtasks.index')" class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Подзадачи') }}
        </x-nav-link>
        <x-nav-link :href="route('statuses.index')" :active="request()->routeIs('statuses.index')" class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Статусы') }}
        </x-nav-link>
        <x-nav-link :href="route('flags.index')" :active="request()->routeIs('flags.index')" class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Метки') }}
        </x-nav-link>
        <x-nav-link :href="route('comments.index')" :active="request()->routeIs('comments.index')" class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Комментарии') }}
        </x-nav-link>
        <x-nav-link :href="route('spaces.index')" :active="request()->routeIs('spaces.index')" class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Пространства') }}
        </x-nav-link>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @yield('content')
            </div>
        </div>
    </div>
</x-app-layout>
@else
<x-app-layout>
    <x-slot name="header">
        <x-nav-link :href="route('dashboard')" active class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Список') }}
        </x-nav-link>
        <x-nav-link :href="route('board')" :active="request()->routeIs('board')" class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Доска') }}
        </x-nav-link>
        <x-nav-link :href="route('calendar')" :active="request()->routeIs('calendar')" class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Календарь') }}
        </x-nav-link>
        <x-nav-link :href="route('gant')" :active="request()->routeIs('gant')" class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Диаграмма Ганта') }}
        </x-nav-link>
        <x-nav-link :href="route('subtask')" :active="request()->routeIs('subtask')" class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Назначенные подзадачи') }}
        </x-nav-link>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200 bg" style="position: relative">
                <a class="registr addTask">Добавить задачу</a>
                <div class="filtr-container">
                    <nav class="filtr">
                        <a onclick="filtr('1')">Срочные</a> |
                        <a onclick="filtr('2')">Важные</a> |
                        <a onclick="filtr('3')">Несущественные</a> |
                        <a onclick="filtr()">Все</a>
                    </nav>
                    <div id="mess"></div>
                </div>
            </div>
                <div>
                    <ul id="myULTask">
                        @if(count($res)==0)
                            <h2>Задачи отсутствуют</h2>
                        @else
                            @foreach($res as $r)
                                <li class="litask" data-flag-id="{{$r->id_flags}}" id="{{$r->id}}" data-start="{{$r->start_date}}" data-deadline="{{$r->deadline_date}}">
                                    <div class="tooltip_subtask">
                                        <p>Описание: {{$r->descriptions}}</p>
                                        <p>Дата начала: {{$r->start_date}}</p>
                                        <p>Дата дедлайна: {{$r->deadline_date}}</p>
                                    </div>
                                    <form method="POST" action="{{route('checktask', $r)}}" id="formTask">
                                    @csrf
                                        <button type="submit" class="checkTask" name="checkTask" onclick="event.stopPropagation()">&#x2713;</button>
                                    </form>
                                    {{$r->name}}<br>
                                    <small>{{$r->status}}</small>
                                    <button type="button" class="update update_task" onclick="event.stopPropagation()" data-id="{{$r->id}}" data-start="{{$r->start_date}}" data-deadline="{{$r->deadline_date}}" data-name="{{$r->name}}" data-description="{{$r->descriptions}}" data-price="{{$r->price}}" data-flags="{{$r->id_flags}}">
                                        &#9998;
                                    </button>
                                    @foreach($tags as $t)
                                        @if($t->id===$r->id_flags)
                                            <span style="background-color: {{$t->color}}" class="tags_li" data-id="{{$r->id_flags}}">{{$t->name}}</span>
                                        @endif
                                    @endforeach

                                    <form method="POST" action="{{route('destroytask', $r)}}" onclick="event.stopPropagation()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="close" onclick="event.stopPropagation()">
                                            x
                                        </button>
                                    </form>
                                </li>
                                @foreach($resultsubtask as $rs)
                                    @if($rs->id_tasks==$r->id)
                                        <li class="dash-subtask" data-flag-id="{{$r->id_flags}}" id="{{$rs->id}}">
                                            <div class="tooltip_subtask">
                                                <p>Исполнитель:
                                                    @foreach($execut as $ex)
                                                        @if($ex->id_subtasks==$rs->id)
                                                            <span>{{$users[$ex->id_users][0]->name}}</span>
                                                        @endif
                                                    @endforeach
                                                </p>
                                                <p>Дата начала: {{$rs->start_date}}</p>
                                                <p>Дата дедлайна: {{$rs->deadline_date}}</p>
                                                <p>Комментарии:
                                                    @foreach($comment as $c)
                                                        @if($c->id_subtasks==$rs->id)
                                                            <span>{{$c->textcomment}}</span><br>
                                                        @endif
                                                    @endforeach
                                                </p>

                                            </div>
                                            <form method="POST" action="{{route('checksubtask', $rs)}}" id="formTask" data-flag-id="{{$r->id_flags}}">
                                                @csrf
                                                <button type="submit" class="checkTask" name="checkTask" onclick="event.stopPropagation()">&#x2713;</button>
                                            </form>
                                            {{$rs->name}}
                                            <br>
                                            <small>{{$rs->status}}</small>
                                            <button type="button" class="update update_sub" onclick="event.stopPropagation()" data-id="{{$rs->id}}" data-start="{{$rs->start_date}}" data-deadline="{{$rs->deadline_date}}" data-name="{{$rs->name}}">
                                                &#9998;
                                                @foreach($execut as $ex)
                                                    @if($ex->id_subtasks==$rs->id)
                                                        <span style="display: none" data-id="{{$ex->id_users}}" data-name="{{$users[$ex->id_users][0]->name}}"></span>
                                                    @endif
                                                @endforeach
                                            </button>
                                            <form method="POST" action="{{route('destroysubtask', $rs)}}" onclick="event.stopPropagation()">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="close" onclick="event.stopPropagation()">
                                                    x
                                                </button>
                                            </form>
                                        </li>
                                    @endif
                                @endforeach
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div id="myModal" class="modal">
                    <div class="modal-content">
                    <h4 class=" mb-8 items-center px-1 pt-1 border-b-2 border-black font-medium leading-5 text-gray-900 focus:outline-none focus:border-black transition duration-150 ease-in-out font-semibold text-xl text-gray-800 leading-tight text-center">Добавление задачи</h4>
                        <form action="dashboard/addtask" role="form" autocomplete="off" class="adminFormAddTask" id="addTask" name="addTask" onsubmit="return addTaskV();">
                                @csrf
                                <div class="form-group">
                                    <label for="form-name">Название</label>
                                    <input type="text" class="form-control block mt-1 w-full" value="{{old('name')}}" name="name" id="form-name" placeholder="Название задачи">
                                </div>
                                <p class="error" id="name"></p>
                                <div class="form-group">
                                    <label for="form-descriptions">Описание</label>
                                    <textarea class="form-control block mt-1 w-full" value="{{old('descriptions')}}" name="descriptions" id="form-descriptions" placeholder="Описание задачи"></textarea>
                                </div>
                                <p class="error" id="descriptions"></p>
                                <div class="form-group">
                                    <label for="form-price">Стоимость</label>
                                    <input type="number" class="form-control block mt-1 w-full" value="{{old('price')}}" name="price" id="form-price" placeholder="Стоимость задачи">
                                </div>
                                <p class="error" id="price"></p>
                                <div class="form-group">
                                    <label for="form-start_date">Дата начала</label>
                                    <input type="date" class="form-control block mt-1 w-full" value="{{old('start_date')}}" name="start_date" id="form-start_date" placeholder="Дата создания задачи">
                                </div>
                                <p class="error" id="start_date"></p>
                                <div class="form-group">
                                    <label for="form-deadline_date">Дата дедлайна</label>
                                    <input type="date" class="form-control block mt-1 w-full" value="{{old('deadline_date')}}" name="deadline_date" id="form-deadline_date" placeholder="Дата сдачи задачи">
                                </div>
                                <p class="error" id="deadline_date"></p>
                                <div class="flex items-center justify-end mt-4">
                                    <x-button class="btn btn-success ml-3" type="submit">Добавить задачу</x-button>
                                </div>
                        </form>
                    </div>
                </div>
                <div id="myModalUpd" class="modal-upd">
                    <div class="modal-content">
                        <h4 class=" mb-8 items-center px-1 pt-1 border-b-2 border-black font-medium leading-5 text-gray-900 focus:outline-none focus:border-black transition duration-150 ease-in-out font-semibold text-xl text-gray-800 leading-tight text-center">Изменение задачи</h4>
                        <form action="dashboard/uptask" role="form" autocomplete="off" class="adminFormAddTask" id="upTask" name="addTask" onsubmit="return upTaskV();">
                            @csrf
                            <div class="form-group">
                                <label for="form-name">Название</label>
                                <input type="text" class="form-control block mt-1 w-full" value="{{old('name')}}" name="nameUpdTask" id="formTaskUpd-name" placeholder="Название задачи">
                            </div>
                            <p class="error" id="name"></p>
                            <div class="form-group">
                                <label for="form-descriptions">Описание</label>
                                <textarea class="form-control block mt-1 w-full" value="{{old('descriptions')}}" name="descriptionsUpdTask" id="formTaskUpd-descriptions" placeholder="Описание задачи"></textarea>
                            </div>
                            <p class="error" id="descriptions"></p>
                            <div class="form-group">
                                <label for="form-price">Стоимость</label>
                                <input type="number" class="form-control block mt-1 w-full" value="{{old('price')}}" name="priceUpdTask" id="formTaskUpd-price" placeholder="Стоимость задачи">
                            </div>
                            <p class="error" id="price"></p>
                            <div class="form-group">
                                <label for="form-start_date">Дата начала</label>
                                <input type="date" class="form-control block mt-1 w-full" value="{{old('start_date')}}" name="start_dateUpdTask" id="formTaskUpd-start_date" placeholder="Дата создания задачи">
                            </div>
                            <p class="error" id="start_date"></p>
                            <div class="form-group">
                                <label for="form-deadline_date">Дата дедлайна</label>
                                <input type="date" class="form-control block mt-1 w-full" value="{{old('deadline_date')}}" name="deadline_dateUpdTask" id="formTaskUpd-deadline_date" placeholder="Дата сдачи задачи">
                            </div>
                            <p class="error" id="deadline_date"></p>
                            <div class="form-group">
                                <label for="form-flags">Теги</label>
                                <select name="flags">
                                    <option disabled value="null" selected>Выберите тег</option>
                                    @foreach($tags as $t)
                                        <option value="{{$t->id}}">{{$t->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                 <x-button class="btn btn-success ml-3" type="submit">Изменить задачу</x-button>
                            </div>

                        </form>
                    </div>
                </div>
                <div id="modalSubtask" class="modalSubtask" onclick="closeExecut()">
                    <div class="modal-content-subtask">
                    <h4 class=" mb-8 items-center px-1 pt-1 border-b-2 border-black font-medium leading-5 text-gray-900 focus:outline-none focus:border-black transition duration-150 ease-in-out font-semibold text-xl text-gray-800 leading-tight text-center">Добавление подзадачи</h4>
                        <form action="dashboard/addsubtask" role="form" autocomplete="off" class="adminFormAddTask" id="addSubTask" name="addSubTask" onsubmit="return addSub();">
                            @csrf
                            <div class="form-group">
                                <label for="form-name">Название</label>
                                <input type="text" class="form-control block mt-1 w-full" value="{{old('name')}}" name="name" id="form-name" placeholder="Название подзадачи">
                            </div>
                            <p class="error" id="name"></p>
                            <div class="form-group">
                                <label for="form-start_date">Дата начала</label>
                                <input type="date" class="form-control block mt-1 w-full" value="{{old('start_date')}}" name="start_date" id="form-start_date" placeholder="Дата создания задачи">
                            </div>
                            <p class="error" id="start_date"></p>
                            <div class="form-group">
                                <label for="form-deadline_date">Дата дедлайна</label>
                                <input type="date" class="form-control block mt-1 w-full" value="{{old('deadline_date')}}" name="deadline_date" id="form-deadline_date" placeholder="Дата сдачи задачи">
                            </div>
                            <p class="error" id="deadline_date"></p>
                            <div class="form-group">
                                <label for="form-users">Исполнитель</label>
                                <div class="executor_block">
                                    <input type="hidden" name="executor[]">
                                    <input type="text" id="executor" name="executName" class="form-control block mt-1 w-full execut_in" oninput="executors(event)" onfocus="executors(event)">
                                    <ul class="executor_ul">

                                    </ul>
                                </div>
                            </div>
                            <div class="flex items-center justify-center mt-2">
                                <button class="btn btn-success ml-2" type="button" onclick="addExecut(event)">Добавить исполнителя</button>
                            </div>
                            <p class="error" id="executName"></p>
                            <div class="flex items-center justify-end mt-4">
                                <x-button class="btn btn-success ml-3" type="submit">Добавить подзадачу</x-button>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="modalSubtaskUpd" class="modalSubtask-upd" onclick="closeExecut()">
                    <div class="modal-content-subtask">
                        <h4 class=" mb-8 items-center px-1 pt-1 border-b-2 border-black font-medium leading-5 text-gray-900 focus:outline-none focus:border-black transition duration-150 ease-in-out font-semibold text-xl text-gray-800 leading-tight text-center">Изменение подзадачи</h4>
                        <form action="dashboard/addsubtask" role="form" autocomplete="off" class="adminFormAddTask" id="upSubTask" name="addSubTask" onsubmit="return upSub();">
                            @csrf
                            <div class="form-group">
                                <label for="form-name">Название</label>
                                <input type="text" class="form-control block mt-1 w-full" value="{{old('name')}}" name="nameUpdSub" id="form-name" placeholder="Название подзадачи">
                            </div>
                            <p class="error" id="name"></p>
                            <div class="form-group">
                                <label for="form-start_date">Дата начала</label>
                                <input type="date" class="form-control block mt-1 w-full" value="{{old('start_date')}}" name="start_dateUpdSub" id="form-start_date" placeholder="Дата создания задачи">
                            </div>
                            <p class="error" id="start_date"></p>
                            <div class="form-group">
                                <label for="form-deadline_date">Дата дедлайна</label>
                                <input type="date" class="form-control block mt-1 w-full" value="{{old('deadline_date')}}" name="deadline_dateUpdSub" id="form-deadline_date" placeholder="Дата сдачи задачи">
                            </div>
                            <p class="error beforeExecut" id="deadline_date"></p>
                            <div class="flex items-center justify-center mt-2">
                                <button class="btn btn-success ml-2" type="button" onclick="addExecut(event)">Добавить исполнителя</button>
                            </div>
                            <p class="error" id="executName"></p>
                            <div class="flex items-center justify-end mt-4">
                                <x-button class="btn btn-success ml-3" type="submit">Изменить подзадачу</x-button>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="modalComment" class="modalComment" onclick="closeExecut()">
                    <div class="modal-content-comment">
                        <h4 class=" mb-8 items-center px-1 pt-1 border-b-2 border-black font-medium leading-5 text-gray-900 focus:outline-none focus:border-black transition duration-150 ease-in-out font-semibold text-xl text-gray-800 leading-tight text-center">Комментарий к подзадаче</h4>
                        <form action="dashboard/addcomment" role="form" autocomplete="off" class="adminFormAddTask" id="addComment" name="addComment" onsubmit="return addCom();">
                            @csrf
                            <div class="form-group">
                                <label for="form-name">Комментарий</label>
{{--                                <input type="text" class="form-control block mt-1 w-full" value="{{old('name')}}" name="nameUpdSub" id="form-name" placeholder="Название подзадачи">--}}
                                <textarea name="textcomment" rows="3" class="form-control block mt-1 w-full"></textarea>
                            </div>
                            <p class="error" id="textcomment"></p>
                            <div class="flex items-center justify-end mt-4">
                                <x-button class="btn btn-success ml-3" type="submit">Отправить комментарий</x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endif
