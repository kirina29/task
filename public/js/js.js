let listTask = document.querySelectorAll('.litask');
let modalSubtask = document.getElementById('modalSubtask');
let modalSubtaskUpd = document.querySelector('.modalSubtask-upd');
let modal = document.querySelector('.modal');
let modalUpd = document.querySelector('.modal-upd');
let modalCom = document.querySelector('.modalComment');
let btn = document.querySelector('.addTask');
let close = document.getElementsByClassName("close");
let updateSub = document.querySelectorAll(".update_sub");
let updateTask = document.querySelectorAll(".update_task");
let checkTask = document.getElementsByClassName("checkTask");
let formSubTask=document.getElementById('addSubTask');
// let formUpTask=document.getElementById('upTask');
// let formUpSubTask=document.getElementById('upSubTask');
let formUpTask=document.forms.upTask
let formUpSubTask=document.forms.upSubTask
let formComment=document.forms.addComment
let listSubTask = document.querySelectorAll('.dash-subtask');
let listSubTaskBoard = document.querySelectorAll('.task-board');

if(btn){
    btn.onclick = function() {
        modal.style.display = "block";
    }
}

window.onclick = function(event) {
    if (event.target == modalSubtask || event.target == modal || event.target == modalUpd || event.target == modalSubtaskUpd|| event.target == modalCom) {
        modal.style.display = "none";
        modalSubtask.style.display = "none";
        modalSubtaskUpd.style.display = "none";
        modalUpd.style.display = "none";
        modalCom.style.display = "none";
        let ul=document.querySelector('.executor_ul')
        ul.style.display='none'
        let p_err=document.querySelectorAll("p.error");
        for(let i=0;i<p_err.length;i++){
            p_err[i].innerHTML=''
        }
    }
}
for (let list of listTask) {
    list.onclick = function() {
        formSubTask.action=`dashboard/addsubtask/${list.id}`
        formSubTask.dataset.start=list.dataset.start
        formSubTask.dataset.deadline=list.dataset.deadline
        modalSubtask.style.display = "block";
    }
    list.onmouseover=function () {
        list.children[0].style.opacity='1'
        list.children[0].style.visibility='visible'
    }
    list.onmouseout=function () {
        list.children[0].style.opacity = '0'
        list.children[0].style.visibility = 'hidden'
        list.children[0].style.transition = '0.2s ease-in-out';
    }
}

for (let list of listSubTask) {
    console.log(list)
    list.onclick = function() {
        event.stopPropagation()
        formComment.action=`dashboard/addcomment/${list.id}`
        modalCom.style.display = "block";
    }
    list.onmouseover=function () {
        list.children[0].style.opacity='1'
        list.children[0].style.visibility='visible'
    }
    list.onmouseout=function () {
        list.children[0].style.opacity='0'
        list.children[0].style.visibility='hidden'
        list.children[0].style.transition= '0.2s ease-in-out';
    }
}

for (let list of listSubTaskBoard) {
    list.onmouseover=function () {
        console.log('aa')
        list.children[0].style.opacity='1'
        list.children[0].style.visibility='visible'
    }
    list.onmouseout=function () {
        list.children[0].style.opacity='0'
        list.children[0].style.visibility='hidden'
        list.children[0].style.transition= '0.2s ease-in-out';
    }
}

for (let up of updateTask) {
    up.onclick = function() {
        event.stopPropagation()
        formUpTask.action=`dashboard/uptask/${up.dataset.id}`
        formUpTask.elements['nameUpdTask'].value=up.dataset.name
        formUpTask.elements['descriptionsUpdTask'].value=up.dataset.description
        formUpTask.elements['deadline_dateUpdTask'].value=up.dataset.deadline
        formUpTask.elements['start_dateUpdTask'].value=up.dataset.start
        formUpTask.elements['priceUpdTask'].value=up.dataset.price
        if(!up.dataset.flags){
            formUpTask.elements['flags'].value=null
        }
        else{
            formUpTask.elements['flags'].value=up.dataset.flags
        }
        modalUpd.style.display = "block";
    }
}
for (let up of updateSub) {
    up.onclick = function() {
        event.stopPropagation()
        let before=document.querySelector('.beforeExecut')
        formUpSubTask.action=`dashboard/upsubtask/${up.dataset.id}`
        formUpSubTask.dataset.start=up.dataset.start
        formUpSubTask.dataset.deadline=up.dataset.deadline
        formUpSubTask.elements['nameUpdSub'].value=up.dataset.name
        formUpSubTask.elements['deadline_dateUpdSub'].value=up.dataset.deadline
        formUpSubTask.elements['start_dateUpdSub'].value=up.dataset.start
        let ul=document.querySelector('.executor_ul')
        document.querySelectorAll('.executor_div').forEach(function(execut){
            execut.remove()
        })
        for(let i=0; i<up.children.length;i++){
            console.log(up.children[i].dataset.name + i)
            if((up.children.length-1)==i){
                before.insertAdjacentHTML('afterend', `<div class="form-group executor_div">
                                <label for="form-users">??????????????????????</label>
                                <div class="executor_block">
                                    <input type="hidden" name="executor[]" value="${up.children[i].dataset.id}">
                                    <input type="text" id="executor" name="executNameUpdSub" class="form-control block mt-1 w-full execut_in" value="${up.children[i].dataset.name}" oninput="executors(event)" onfocus="executors(event)">
                                    <ul class="executor_ul">

                                    </ul>
                                </div>
                            </div>`)
            }
            else{
                before.insertAdjacentHTML('afterend', `<div class="form-group executor_div">
                                <label for="form-users">??????????????????????</label>
                                <div class="executor_block">
                                    <button class="remove_execut" onclick="remove_execut(event)">x</button>
                                    <input type="hidden" name="executor[]" value="${up.children[i].dataset.id}">
                                    <input type="text" id="executor" name="executNameUpdSub" class="form-control block mt-1 w-full execut_in" value="${up.children[i].dataset.name}" oninput="executors(event)" onfocus="executors(event)">
                                    <ul class="executor_ul">

                                    </ul>
                                </div>
                            </div>`)

            }

        }
        modalSubtaskUpd.style.display = "block";
    }
}


let i;
for (i = 0; i < close.length; i++) {
  close[i].onclick = function() {
    var div = this.parentElement;
    div.style.display = "none";
  }
}

 function onDragStart(event) {
  event.dataTransfer.setData('text/plain', event.target.id);
}
function onDragOver(event) {
  event.preventDefault();
}
async function onDrop(event) {
  const id = event.dataTransfer.getData('text');
    const draggableElement = document.getElementById(id);
    const dropzone = event.target;
    let status=event.target.dataset.statusId
    let response=await fetch(`http://task/api/updateStatus/${draggableElement.id}`,{
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify({id_statuses: status})
    })
    dropzone.appendChild(draggableElement);
    event.dataTransfer.clearData();
}

async function executors(event){
    let ul=event.target.nextElementSibling
    let ulAll=document.querySelectorAll('.execut_in')
    ul.replaceChildren()
    let data
    if(event.target.value!=''){
        let response = await fetch(`http://task/api/executor/${event.target.value}`);

        if (response.ok) { // ???????? HTTP-???????????? ?? ?????????????????? 200-299
            // ???????????????? ???????? ???????????? (????. ?????? ???????? ?????????? ????????)
            data = await response.json();
            ul.style.display='block'
            ul.replaceChildren()
            let n
            if(data.length!=0){
                for(let i=0; i<data.length;i++){
                    n=0
                    if (event.target.value.trim()==data[i].name){
                        event.target.previousElementSibling.value=data[i].id

                    }
                    for(let j=0; j<ulAll.length;j++){
                        if(ulAll[j].value.trim()==data[i].name.trim()){
                            if(ulAll[j]!=event.target){
                                n=1
                            }
                        }
                    }
                    if(n==0){
                        ul.insertAdjacentHTML('beforeend', `<li onclick="executLi(event)" data-id="${data[i].id}">${data[i].name}</li>`)
                    }
                }
            }
            else{
                ul.insertAdjacentHTML('beforeend', `<li>?????????????????????? ???? ????????????</li>`)
            }
        } else {
            alert("???????????? ?????? ???????????? ??????????????????????!");
        }
    }
}

function executLi(event){
    let ul=event.target.parentNode
    event.target.parentNode.previousElementSibling.value=event.target.innerHTML
    event.target.parentNode.previousElementSibling.previousElementSibling.value=event.target.dataset.id
    ul.style.display='none'
}

function closeExecut(){
    let ul=document.querySelectorAll('.executor_ul')
    for (let u of ul) {
        u.style.display='none'
    }
}

function addExecut(event){
    event.target.parentNode.insertAdjacentHTML('beforebegin', `<div class="form-group">
                                <label for="form-users">??????????????????????</label>
                                <div class="executor_block">
                                    <button class="remove_execut" onclick="remove_execut(event)">x</button>
                                    <input type="hidden" name="executor[]">
                                    <input type="text" id="executor" class="form-control block mt-1 w-full" oninput="executors(event)" onfocus="executors(event)">
                                    <ul class="executor_ul">

                                    </ul>
                                </div>
                            </div>
                           `)
}
function remove_execut(event){
    event.target.parentNode.parentNode.remove()
}
