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
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="border-b border-gray-200 bg" style="border: 1px solid #b2b2b2">
                    <div class="container-board">
                        <div id="user_id" style="display:none;">
                            {{$id}}
                        </div>
                        <div id="gantt_here" style='width:100%; height:100%;'></div>
                        <script>
                            let ids=document.querySelector('#user_id').textContent
                            anychart.onDocumentReady(async function () {
                                anychart.theme('lightProvence');

                                // create data
                                let data
                                let response = await fetch(`http://task/api/taskGant/${ids}`);

                                if (response.ok) { // если HTTP-статус в диапазоне 200-299
                                                   // получаем тело ответа (см. про этот метод ниже)
                                    data = await response.json();
                                } else {
                                    alert("Ошибка HTTP: " + response.status);
                                }

                                // create a data tree
                                var treeData = anychart.data.tree(data, "as-tree");
                                // create a chart
                                var chart = anychart.ganttProject();
                                // set the data
                                chart.data(treeData);
                                // set the container id
                                chart.container("gantt_here");
                                chart.scrollToRow(6);
                                chart.scrollToEnd(6);
                                chart.dataGrid().column(3).enabled(false);
                                var dataGrid = chart.dataGrid();
                                dataGrid.rowEvenFill("gray 0.3");
                                dataGrid.rowOddFill("gray 0.1");
                                dataGrid.headerFill("gray 0.1");
                                chart.splitterPosition("17%");
                                // set the indent for nested labels in the second column
                                chart.dataGrid().column(1).depthPaddingMultiplier(25);
                                chart.getTimeline().groupingTasks().height(10);
                                // initiate drawing the chart
                                chart.draw();
                                // fit elements to the width of the timeline
                                chart.fitAll();

                                chart.dataGrid().tooltip().useHtml(true);

                                chart.dataGrid().tooltip().format(function() {

                                    var numChildren = this.item.numChildren();
                                    var duration = (this.actualEnd - this.actualStart) / 1000 / 3600 / 24;
                                    var startDate = anychart.format.dateTime(this.actualStart, "dd MMM");
                                    var endDate = anychart.format.dateTime(this.actualEnd, "dd MMM");
                                    var progress = this.progress * 100 + "%";
                                    var manager = this.getData("manager");
                                    var status = this.getData("status");
                                    var price = this.getData("price");

                                    var parentText = "<span style='font-weight:600;font-size:12pt'>" +
                                        startDate + " - " + endDate + "</span><br><br>" +
                                        "Период: " + duration + " дней<br>" +
                                        "Количество подзадач: " + numChildren + "<br><br>" +
                                        "Цена: " + price + " рублей"+"<br>" +
                                        "Статус: " + status;

                                    var milestoneText = "<span style='font-weight:600;font-size:12pt'>" +
                                        startDate + "</span><br><br>" +
                                        "Исполнитель: " + manager;

                                    var taskText = "<span style='font-weight:600;font-size:12pt'>" +
                                        startDate + " - " + endDate + "</span><br><br>" +
                                        "Период: " + duration + " дней<br>" +
                                        "Прогресс: " + progress + "<br><br>" +
                                        "Статус: " + status + "<br>" +
                                        "Исполнитель: " + manager;

                                    // identify the task type and display the corresponding text
                                    if (numChildren > 0) {
                                        return parentText;
                                    } else {
                                        if (duration == 0) {
                                            return milestoneText;
                                        } else {
                                            return taskText;
                                        }
                                    }

                                });
                                var column_1 = chart.dataGrid().column(0);
                                column_1.labels().fontWeight(600);
                                column_1.labels().useHtml(true);

                                column_1.labels().format(function() {

                                    var children = this.item.numChildren();
                                    var index = this.linearIndex;

                                    // identify the resource type and display the corresponding text
                                    if (children > 0) {
                                        return "<span style='color:#3f0979'>" + index + ".</span>";
                                    } else {
                                        return "<span style='color:#7a708a'>" + index + ".</span>";
                                    }

                                });

                                // set the text of the second data grid column

                                var column_2 = chart.dataGrid().column(1);
                                column_2.labels().useHtml(true);

                                column_2.labels().format(function() {

                                    var numChildren = this.item.numChildren();
                                    var duration = (this.end - this.start) / 1000 / 3600 / 24;
                                    var customField = " ";
                                    if (this.getData("custom_field")) {
                                        customField = "<span style='font-weight:bold'>" +
                                            this.getData("custom_field") + customField + "</span>";
                                    }

                                    var parentText = "<span style='color:#3f0979;font-weight:bold'>" +
                                        this.name.toUpperCase() + "<span>";
                                    var childText = "<span style='color:#7a708a'>" + customField +
                                        this.name + ": " + duration + " дней</span>";

                                    // identify the resource type and display the corresponding text
                                    if (numChildren > 0) {
                                        return parentText;
                                    } else {
                                        return childText;
                                    }

                                });
                            });

                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
