function Calendar2(id, year, month) {
    let t=document.querySelector('#hiddenBlock').innerHTML
    let task=JSON.parse(t)
    let n=0
    var Dlast = new Date(year,month+1,0).getDate(),
        D = new Date(year,month,Dlast),
        DNlast = new Date(D.getFullYear(),D.getMonth(),Dlast).getDay(),
        DNfirst = new Date(D.getFullYear(),D.getMonth(),1).getDay(),
        calendar = '<tr>',
        months=["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"];
    if (DNfirst != 0) {
        for(var  i = 1; i < DNfirst; i++) calendar += '<td>';
    }else{
        for(var  i = 0; i < 6; i++) calendar += '<td>';
    }
    for(var  i = 1; i <= Dlast; i++) {
        if (i == new Date().getDate() && D.getFullYear() == new Date().getFullYear() && D.getMonth() == new Date().getMonth()) {
            calendar += '<td class="today" id="dayCalendar"'+  'data-date-td="'+ new Date(year,month,i+1).toISOString().slice(0,10)+'">' + '<span class="spanDay">'+ i + '</span>';
        }else{
            calendar += '<td id="dayCalendar" '+  'data-date-td="'+ new Date(year,month,i+1).toISOString().slice(0,10)+'">' + '<span class="spanDay">'+ i + '</span>';
        }
        if (new Date(D.getFullYear(),D.getMonth(),i).getDay() == 0) {
            calendar += '<tr>';
        }
    }
    for(var  i = DNlast; i < 7; i++) calendar += '<td>&nbsp;';
    document.querySelector('#'+id+' tbody').innerHTML = calendar;
    document.querySelector('#'+id+' thead td:nth-child(2)').innerHTML = months[D.getMonth()] +' '+ D.getFullYear();
    document.querySelector('#'+id+' thead td:nth-child(2)').dataset.month = D.getMonth();
    document.querySelector('#'+id+' thead td:nth-child(2)').dataset.year = D.getFullYear();
    if (document.querySelectorAll('#'+id+' tbody tr').length < 6) {  // чтобы при перелистывании месяцев не "подпрыгивала" вся страница, добавляется ряд пустых клеток. Итог: всегда 6 строк для цифр
        document.querySelector('#'+id+' tbody').innerHTML += '<tr><td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;';
    }

    let dayCalendar=document.querySelectorAll('#dayCalendar')
    let modalCalendar = document.querySelector('.modalCalendar');

    for (let day of dayCalendar) {
        for(let j=0;j<task.length;j++)
        {
            if(task[j].start_date==day.dataset.dateTd)
            {
                n++
            }
        }
        if(n>0)
        {
            day.insertAdjacentHTML("beforeend", `<a href="#" class="calendar_task" onclick="event.stopPropagation();">+ ещё ${n}</a>`)
        }
        day.onclick = function(event) {
            modalCalendar.style.display = "block";
            document.querySelector('.modalCalendar #form-start_date').value=day.dataset.dateTd
        }
        n=0
    }
    let calendar_task=document.querySelectorAll('.calendar_task')
    let modal_task=document.querySelector('.modal_task_calendar')
    let modal_task_content=document.querySelector('.modal_task_content')
    for (let calenT of calendar_task) {
        calenT.onclick = function(event) {
            event.stopPropagation();
            let pos=event.target.getBoundingClientRect()
            let position={
                top:pos.top + pageYOffset,
                left:pos.left + pageYOffset
            }
            modal_task_content.style.top=position.top+'px'
            modal_task_content.style.left=position.left+'px'
            modal_task.style.display='block'
            modal_task_content.replaceChildren()
            for(let i=0;i<task.length;i++)
            {
                if(task[i].start_date==calenT.parentNode.dataset.dateTd)
                {
                    modal_task_content.insertAdjacentHTML("beforeend", `<div class="modal-content-task" onclick="event.stopPropagation();">
                                                                                         <div class="tooltip_subtask" style="width: 90%; right: auto; left: auto">
                                                                                            <p>Описание: ${task[i].descriptions}</p>
                                                                                            <p>Дата начала: ${task[i].start_date}</p>
                                                                                            <p>Дата дедлайна: ${task[i].deadline_date}</p>
                                                                                         </div>
                                                                                        ${task[i].name}
                                                                                    </div>`)
                }
            }
            let opentool=modal_task_content.querySelectorAll('.modal-content-task')
            console.log(opentool)
            for (let t of opentool) {
                t.onmouseover=function () {
                    console.log('aa')
                    t.children[0].style.opacity='1'
                    t.children[0].style.visibility='visible'
                }
                t.onmouseout=function () {
                    t.children[0].style.opacity='0'
                    t.children[0].style.visibility='hidden'
                    t.children[0].style.transition= '0.2s ease-in-out';
                }
            }
        }
    }
    document.body.onclick = function(event) {
        console.log('ff')
        console.log(event.target)
        if (event.target == modalCalendar) {
            modalCalendar.style.display = "none";
        }
        if(event.target==modal_task){
            modal_task.style.display = "none";
        }
    }
}
Calendar2("calendar2", new Date().getFullYear(), new Date().getMonth());
// переключатель минус месяц
document.querySelector('#calendar2 thead tr:nth-child(1) td:nth-child(1)').onclick = function() {
    Calendar2("calendar2", document.querySelector('#calendar2 thead td:nth-child(2)').dataset.year, parseFloat(document.querySelector('#calendar2 thead td:nth-child(2)').dataset.month)-1);
}
// переключатель плюс месяц
document.querySelector('#calendar2 thead tr:nth-child(1) td:nth-child(3)').onclick = function() {
    Calendar2("calendar2", document.querySelector('#calendar2 thead td:nth-child(2)').dataset.year, parseFloat(document.querySelector('#calendar2 thead td:nth-child(2)').dataset.month)+1);
}
