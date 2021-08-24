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

function filter(className){
    let elements = document.getElementsByClassName('cat_id_2');
    let filterContainer = document.querySelector('.todo__filter');
    let currFilter = 'filter_' + className;
    let filterLabel = document.getElementById(currFilter);

    filterLabel.classList.remove('todo__item-category-label');
    filterLabel.classList.add('todo__item-category-label-active');
    
    // filterLabel.classList.add('todo__filter-label');
    switch (className) {
        case 'cat_id_1':
            elements = document.getElementsByClassName('cat_id_2');
            for (let i=0; i < elements.length; i++){
                elements[i].style.display = 'none';
            }
            elements = document.getElementsByClassName('cat_id_3');
            for (let i=0; i < elements.length; i++){
                elements[i].style.display = 'none';
            };
            elements = document.getElementsByClassName('cat_id_1');
            for (let i=0; i < elements.length; i++){
                elements[i].style.display = 'flex';
            };
            console.log(filterContainer);
            filterLabel.innerHTML = 'PHP';
            filterContainer.append(filterLabel);
            break;
        case 'cat_id_2':
            elements = document.getElementsByClassName('cat_id_1');
            for (let i=0; i < elements.length; i++){
                elements[i].style.display = 'none';
            }
            elements = document.getElementsByClassName('cat_id_3');
            for (let i=0; i < elements.length; i++){
                elements[i].style.display = 'none';
            }
            elements = document.getElementsByClassName('cat_id_2');
            for (let i=0; i < elements.length; i++){
                elements[i].style.display = 'flex';
            };
            filterLabel.innerHTML = 'JavaScript';
            filterContainer.append(filterLabel);
            break;
        case 'cat_id_3':
            elements = document.getElementsByClassName('cat_id_1');
            for (let i=0; i < elements.length; i++){
                elements[i].style.display = 'none';
            }
            elements = document.getElementsByClassName('cat_id_2');
            for (let i=0; i < elements.length; i++){
                elements[i].style.display = 'none';
            }
            elements = document.getElementsByClassName('cat_id_3');
            for (let i=0; i < elements.length; i++){
                elements[i].style.display = 'flex';
            };
            filterLabel.innerHTML = 'Other';
            filterContainer.append(filterLabel);
            break;
        default:
            break;
    }

    
}