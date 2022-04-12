function addTaskV(){
    let form=document.forms.addTask
    let validator ={}
    let error=''
    let p_err = document.querySelectorAll("p.error");

    if(form.elements['name'].value=="")
    {
        error="Название должно быть заполнено"
        validator.name=error
    }

    if(form.elements['descriptions'].value=="")
    {
        error="Описание должно быть заполнено"
        validator.descriptions=error
    }

    if(form.elements['price'].value=="")
    {
        error="Стоимость должна быть заполнена"
        validator.price=error
    }

    if(form.elements['deadline_date'].value=="")
    {
        error="Дата дедлайна должна быть заполнена"
        validator.deadline_date=error
        console.log(validator)
    }

    if(form.elements['start_date'].value=="")
    {
        error="Дата начала должна быть заполнена"
        validator.start_date=error
        console.log(validator)
    }

    if(form.elements['start_date'].value>form.elements['deadline_date'].value)
    {
        error="Дата начала не может быть позднее даты дедлайна"
        validator.start_date=error
        console.log(validator)
    }

    if(Object.keys(validator).length!=0)
    {
        for(let i=0; i<p_err.length; i++)
        {
            if(validator[p_err[i].id] ==undefined)
            {
                validator[p_err[i].id]=""
            }
            p_err[i].innerHTML=validator[p_err[i].id]
        }
        return false
    }
    return true
}

function upTaskV(){
    let form=document.forms.upTask
    let validator ={}
    let error=''
    let p_err = document.querySelectorAll("p.error");

    if(form.elements['name'].value=="")
    {
        error="Название должно быть заполнено"
        validator.name=error
    }

    if(form.elements['descriptions'].value=="")
    {
        error="Описание должно быть заполнено"
        validator.descriptions=error
    }

    if(form.elements['price'].value=="")
    {
        error="Стоимость должна быть заполнена"
        validator.price=error
    }

    if(form.elements['deadline_date'].value=="")
    {
        error="Дата дедлайна должна быть заполнена"
        validator.deadline_date=error
        console.log(validator)
    }

    if(form.elements['start_date'].value=="")
    {
        error="Дата начала должна быть заполнена"
        validator.start_date=error
        console.log(validator)
    }

    if(form.elements['start_date'].value>form.elements['deadline_date'].value)
    {
        error="Дата начала не может быть позднее даты дедлайна"
        validator.start_date=error
        console.log(validator)
    }

    if(Object.keys(validator).length!=0)
    {
        for(let i=0; i<p_err.length; i++)
        {
            if(validator[p_err[i].id] ==undefined)
            {
                validator[p_err[i].id]=""
            }
            p_err[i].innerHTML=validator[p_err[i].id]
        }
        return false
    }
    return true
}


function addSub(){
    let form=document.forms.addSubTask
    let validator ={}
    let error=''
    let p_err = document.querySelectorAll("p.error");
    console.log(form)

    if(form.elements['name'].value=="")
    {
        error="Название должно быть заполнено"
        validator.name=error
    }
    if(form.elements['executName'].value=="")
    {
        error= "Исполнитель должен быть выбран"
        validator.executName=error
    }
    if(form.elements['deadline_date'].value>form.dataset.deadline || form.elements['deadline_date'].value=="")
    {
        error="Дата должна входить в диапазон даты задачи!(измените дату дедлайна)"
        validator.deadline_date=error
        console.log(validator)
    }

    if(form.elements['start_date'].value<form.dataset.start || form.elements['start_date'].value=="")
    {
        error="Дата должна входить в диапазон даты задачи!(измените дату начала)"
        validator.start_date=error
        console.log(validator)
    }

    if(form.elements['start_date'].value>form.elements['deadline_date'].value)
    {
        error="Дата начала не может быть позднее даты дедлайна"
        validator.start_date=error
        console.log(validator)
    }

    if(Object.keys(validator).length!=0)
    {
        for(let i=0; i<p_err.length; i++)
        {
            if(validator[p_err[i].id] ==undefined)
            {
                validator[p_err[i].id]=""
            }
            p_err[i].innerHTML=validator[p_err[i].id]
        }
        return false
    }
    return true
}

function upSub(){
    let form=document.forms.upSubTask
    let validator ={}
    let error=''
    let p_err = document.querySelectorAll("p.error");
    console.log(form)

    if(form.elements['name'].value=="")
    {
        error="Название должно быть заполнено"
        validator.name=error
    }
    if(form.elements['executName'].value=="" || !form.elements['executName'])
    {
        error= "Исполнитель должен быть выбран"
        validator.executName=error
    }

    if(form.elements['deadline_date'].value>form.dataset.deadline || form.elements['deadline_date'].value=="")
    {
        error="Дата должна входить в диапазон даты задачи!(измените дату дедлайна)"
        validator.deadline_date=error
        console.log(validator)
    }

    if(form.elements['start_date'].value<form.dataset.start || form.elements['start_date'].value=="")
    {
        error="Дата должна входить в диапазон даты задачи!(измените дату начала)"
        validator.start_date=error
        console.log(validator)
    }

    if(form.elements['start_date'].value>form.elements['deadline_date'].value)
    {
        error="Дата начала не может быть позднее даты дедлайна"
        validator.start_date=error
        console.log(validator)
    }

    if(Object.keys(validator).length!=0)
    {
        for(let i=0; i<p_err.length; i++)
        {
            if(validator[p_err[i].id] ==undefined)
            {
                validator[p_err[i].id]=""
            }
            p_err[i].innerHTML=validator[p_err[i].id]
        }
        return false
    }
    return true
}
