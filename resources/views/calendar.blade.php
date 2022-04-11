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
                        <div style="display: none" id="hiddenBlock" data-task="{{$result}}">
                            {{$result}}
                        </div>
                        <table id="calendar2">
                            <thead>
                            <tr style="margin-bottom: 10px">
                                <td>‹</td>
                                <td colspan="5"></td>
                                <td>›</td>
                            </tr><br>
                            <tr>
                                <td>Пн</td>
                                <td>Вт</td>
                                <td>Ср</td>
                                <td>Чт</td>
                                <td>Пт</td>
                                <td>Сб</td>
                                <td>Вс</td>
                            </tr>
                            <tbody>
                        </table>
                        <div id="myModal" class="modal modalCalendar">
                            <div class="modal-content">
                                <h4 class=" mb-8 items-center px-1 pt-1 border-b-2 border-indigo-400 font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out font-semibold text-xl text-gray-800 leading-tight text-center">Добавление задачи</h4>
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
                        <div class="modal_task_calendar">
                            <div class="modal_task_content">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
