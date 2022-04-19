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
        </x-nav-link>
        <x-nav-link :href="route('subtask')" :active="request()->routeIs('subtask')" class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Назначенные подзадачи') }}
        </x-nav-link>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200 bg">
                <div class="container-board">
                    <div class="block-board column1">
                        <h2 class="font-semibold text-xl text-black leading-tight">Новые</h2>
                        <ul class="list-group c1" data-name="new" data-status-id="1" ondrop="onDrop(event);" ondragover="onDragOver(event);">
                            @foreach($result as $r)
                                @if($r->status==='Новая')
                                    <li class="task-board" id="{{$r->id}}" draggable="true" ondragstart="onDragStart(event);" ondrop="event.stopPropagation()">
                                        <div class="tooltip_subtask" style="min-width: 60%;left: 30%">
                                            <p>Описание: {{$r->descriptions}}</p>
                                            <p>Дата начала: {{$r->start_date}}</p>
                                            <p>Дата дедлайна: {{$r->deadline_date}}</p>
                                        </div>
                                        {{$r->name}}
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>

                    <div class="block-board column2">
                        <h2 class="font-semibold text-xl text-black leading-tight">В работе</h2>
                        <ul class="list-group c2" data-name="in-work" data-status-id="2" ondrop="onDrop(event);" ondragover="onDragOver(event);">
                            @foreach($result as $r)
                                @if($r->status==='В работе')
                                    <li class="task-board" id="{{$r->id}}" draggable="true" ondragstart="onDragStart(event);"  ondrop="event.stopPropagation()">
                                        <div class="tooltip_subtask" style="min-width: 60%;left: 30%">
                                            <p>Описание: {{$r->descriptions}}</p>
                                            <p>Дата начала: {{$r->start_date}}</p>
                                            <p>Дата дедлайна: {{$r->deadline_date}}</p>
                                        </div>
                                        {{$r->name}}
                                    </li>
                                @endif
                            @endforeach

                        </ul>
                    </div>

                    <div class="block-board column3">
                        <h2 class="font-semibold text-xl text-black leading-tight">Готовы</h2>
                        <ul class="list-group c3" data-name="completed" data-status-id="3" ondrop="onDrop(event);" ondragover="onDragOver(event);">
                            @foreach($result as $r)
                                @if($r->status==='Готова')
                                    <li class="task-board" id="{{$r->id}}" draggable="true" ondragstart="onDragStart(event);" ondrop="event.stopPropagation()">
                                        <div class="tooltip_subtask" style="min-width: 60%; left: 30%">
                                            <p>Описание: {{$r->descriptions}}</p>
                                            <p>Дата начала: {{$r->start_date}}</p>
                                            <p>Дата дедлайна: {{$r->deadline_date}}</p>
                                        </div>
                                        {{$r->name}}
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
