function filtr(status)
{
    let litask=document.querySelectorAll('.litask')
    let lisub=document.querySelectorAll('.dash-subtask')
    if(litask.length==0)
    {
        return;
    }

    if(status==undefined)
    {
        for(let i=0; i<litask.length; i++)
        {
            litask[i].style.display='block'
        }
        for(let i=0; i<lisub.length; i++)
        {
            lisub[i].style.display='block'
        }
        document.querySelector('#mess').innerHTML=""

        return
    }
    for(let i=0;i<litask.length; i++)
    {
        console.log(litask[i].dataset.flagId)
        console.log(status)
        if(litask[i].dataset.flagId===status)
        {
            litask[i].style.display="block"
            continue
        }
        litask[i].style.display="none"
    }
    for(let i=0;i<lisub.length; i++)
    {
        if(lisub[i].dataset.flagId===status)
        {
            lisub[i].style.display="block"
            continue
        }
        lisub[i].style.display="none"
    }

    let count=0

    for(let i=0;i<litask.length; i++)
    {
        if(litask[i].style.display=='none')
        {
            count++
        }
    }

    if(litask.length==count)
    {
        document.querySelector('#mess').innerHTML='Фильтрация ничего не нашла'
    }
    else{
        document.querySelector('#mess').innerHTML=''
    }
}
