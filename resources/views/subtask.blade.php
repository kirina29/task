<x-app-layout>
    <x-slot name="header">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="font-semibold text-xl text-gray-800 leading-tight">
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
        </x-nav-link><x-nav-link :href="route('subtask')" :active="request()->routeIs('subtask')" class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Назначенные подзадачи') }}
        </x-nav-link>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200 bg">
                    <div class="container-board" style="height:10px;">
                        <p>SubTask</p>
                    </div>
                </div>
                <div>
                    <ul id="myULTask">
                        @foreach($resultsubtask as $rs)
                            <li class="litask">
                                <div class="tooltip_subtask">
                                    <p>Назначил:
                                        @foreach($users as $u)
                                            @if($u->id==$rs->user)
                                                <span>{{$u->name}}</span>
                                            @endif
                                        @endforeach
                                    </p>
                                    <p>Исполняют:
                                        @foreach($execut as $ex)
                                            @if($ex->id_subtasks==$rs->id)
                                                <span>{{$user[$ex->id_users][0]->name}}</span>
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
                                <form method="POST" action="{{route('checksubtask', $rs)}}" id="formTask">
                                    @csrf
                                    <button type="submit" class="checkTask" name="checkTask" onclick="event.stopPropagation()">&#x2713;</button>
                                </form>
                                {{$rs->name}}
                                <br>
                                <small>{{$rs->status}}</small>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
