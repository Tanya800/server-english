let recipient =''
let edit_id = -1;

function addNewItem(data) {

    $.ajax({
        url:'db/insert_table.php',
        type:"POST",
        data:data,
        dataType:"json",
        cache: false,
        contentType: false,
        processData: false,
        success:(data)=>{
            console.log('New row was added');
            window.location.reload();
        }
        ,
        error:er=>{
            alert('Не удалось добавить запись.');
            console.log(er)
        }
    });
}


function editItem(data) {

    $.ajax({
        url:'db/edit_item.php',
        type:"POST",
        data:data,
        dataType:"json",
        cache: false,
        contentType: false,
        processData: false,
        success:(data)=>{
            console.log('Row was edited');
            window.location.reload();
        },
        error:er=>{
            alert('Не удалось изменить запись.');
            console.log(er);
        }
    });
}


var exampleModal = document.getElementById('exampleModal');
var editModal = document.getElementById('editModal');



exampleModal.addEventListener('show.bs.modal', function (event) {

    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    recipient = button.getAttribute('data-bs-whatever');

    // edit_id = button.getAttribute('data-bs-idelem');
    // let title = 'Добавление данных в таблицу ' + recipient;
    // if(edit_id){
    //     console.log('exist edit id');
    //     title = 'Редактирование таблицы ' + recipient;
    // }

    var modalTitle = exampleModal.querySelector('.modal-title')
    title = 'Добавление данных в таблицу '+ recipient;
    modalTitle.textContent = title;
});


editModal.addEventListener('show.bs.modal', function (event) {

    var button = event.relatedTarget
    recipient = button.getAttribute('data-bs-whatever');
    edit_id = button.getAttribute('data-bs-idelem');

    var modalTitle = editModal.querySelector('.modal-title')
    title = 'Редактирование таблицы ' + recipient;
    modalTitle.textContent = title;
})

$('#btn_add_item').on('click',(e)=>{

    var inputs = exampleModal.querySelectorAll('input');
    var textareas = exampleModal.querySelectorAll('textarea');

    var data = new FormData();
    let files =  $('#sortpicture').prop('files')[0];

    data.append('file',files);

    data.append('table',recipient);

    console.log('inputs')
    inputs.forEach(el => {
        if(el.id !== 'sortpicture') {
            var key = (el.id).split('-')[1];
            data.append(key,el.value);

        }
    })

    textareas.forEach(el => {
        var key = (el.id).split('-')[1];
        data.append(key,el.value);

    })

    addNewItem(data);

});

$('#btn_edit_item').on('click',()=>{

    var inputs = editModal.querySelectorAll('input');
    var textareas = editModal.querySelectorAll('textarea');
    let check_picture = $('#editPicture')[0].checked;

    var data = new FormData();
    data.append('table',recipient);

    if(check_picture){

        let files =  $('#edit-picture').prop('files')[0];

        data.append('file',files);
        data.append('file_exist',1);
        console.log('file_exist')
    }

    inputs.forEach(el => {
        if(el.id !== 'edit-picture') {
            var key = (el.id).split('-')[1];
            data.append(key,el.value);
        }
    })

    textareas.forEach(el => {
        var key = (el.id).split('-')[1];

        var newval = el.value.replaceAll(/\'/g, "’");
        // console.log(newval)

        data.append(key,newval);

    })


    data.append('edit_id',edit_id);

    // for (var pair of data.entries()) {
    //     console.log(pair[0]+ ', ' + pair[1]);
    // }
    editItem(data);
})

$('#sortpicture').change(()=>{
    let file = $('#sortpicture').prop('files')[0]
   console.log(file.name)
});

function showPictureBlock(){
    let pic_block = $('#blockEditPicture')[0];
    pic_block.classList.contains('hidden') ? pic_block.classList.remove('hidden') : pic_block.classList.add('hidden');
}
