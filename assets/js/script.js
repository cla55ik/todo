window.onload = function(){
    var create = document.getElementById('todo_create_form');
    let showCreateForm = document.getElementById('view_create_form');
    
    create.addEventListener('submit', function(event){
        event.preventDefault();
        formData = new FormData(create);
        formData.append('type', 'create');

        ajaxSend(formData)
            .then((response)=>{
                //console.log(response);
                res = JSON.parse(response);
                if (res.status == 'ok') {
                    console.log(res.message);
                    window.location.reload();
                }else{
                    console.log(res);
                    console.log(res.message);
                }
            })
            .catch((err)=>console.log(err))

    });

    showCreateForm.addEventListener('click', function(event){
        showElement('todo_create_form');
    });




}


const ajaxSend = async (formData) => {
    const fetchResp = await fetch('controllers/post.php', {
        method: 'POST',
        body: formData
    });
    if (!fetchResp.ok) {
        throw new Error(`Ошибка по адресу ${url}, статус ошибки ${fetchResp.status}`);
    }
    return await fetchResp.text();
};

function showElement(id){
    elem = document.getElementById(id);
    elem.classList.toggle('hidden');
}

function todoDone(id){
    formData = new FormData();
    formData.append('type', 'done');
    formData.append('id', id);

    ajaxSend(formData)
        .then((response)=>{
            res = JSON.parse(response);

            if (res.status == 'ok') {
                console.log('stayus OK');
                window.location.reload();
            }
        })
        .catch((error)=>{
            console.log(error);
        })
}

function reWork(id){
    formData = new FormData();
    formData.append('type', 'rework');
    formData.append('id', id);

    ajaxSend(formData)
        .then((response)=>{
            res = JSON.parse(response);

            if (res.status == 'ok') {
                console.log('reWork OK');
               window.location.reload();
            }
        })
        .catch((error)=>{
            console.log(error);
        })
}

function deleteTodo(id){
    formData = new FormData();
    formData.append('type', 'delete');
    formData.append('id', id);

    ajaxSend(formData)
        .then((response)=>{
            res = JSON.parse(response);

            if (res.status == 'ok') {
                console.log('reWork OK');
               window.location.reload();
            }
        })
        .catch((error)=>{
            console.log(error);
        })
}