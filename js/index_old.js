import {action} from './actions.js';

let TITLE_=['id','Название','Описание','Картинка','#']
// let server_link =document.location.origin;

$('#send_query').on('click',()=>{
    $.ajax({
        url:'db/select_terms.php',
        type:"POST",
        dataType:"json",
        success:(data)=>{
            console.log('connection ok');
            fulledTable(data);
        }
    });
})

function getTermsTable() {
    $.ajax({
        url:'http://q90932z7.beget.tech/server.php?action=select_terms',
        type:"POST",
        dataType:"json",
        success:(data)=>{
            console.log('connection ok');
            fulledTable(data);
        }
    });
}

function deleteTerms(id) {
    $.ajax({
        url:'db/delete_terms.php',
        type:"POST",
        data:{id:id},
        dataType:"json",
        success:(data)=>{
            console.log('delete ok');
            window.location.reload();
        }
    });
}
//
// let recipient =''
//
// function addNewItem(data) {
//     $.ajax({
//         url:'db/insert_table.php',
//         type:"POST",
//         data:data,
//         dataType:"json",
//         success:(data)=>{
//             console.log('New row was added');
//             window.location.reload();
//         },
//         error:er=>{alert('Не удалось добавить запись.')}
//     });
// }


// STARTING -------------------------------------------------------
$(document).ready(()=>{

    let nav = $('#navbarNavAltMarkup')[0] ;
    let indexes=[],links = [];

    nav.querySelectorAll('a').forEach(el=>{
        links.push(el);
        indexes.push(el.dataset.block);

        el.addEventListener('click',evt => {
            let current_block = evt.target.dataset.block;
            action.changeBlock(current_block);
        })
    });

    let key_block = localStorage.getItem('current_page');

    action.init(indexes,links);

    if (key_block && key_block !== action.current_page) {
        action.changeBlock(key_block);
    }
console.log(action.current_page);
    getTermsTable();
});

function drawItemTable(elem){
    return `
        <td>${elem.id}</td>
        <td>${elem.title}</td>
        <td>${elem.description}</td>
        <td><a href="${elem.img}" target="_blank">${elem.img}</a></td>
        <td>
            <a class="edit"  data-bs-toggle="modal" data-bs-target="#editModal" data-bs-whatever="terms" data-bs-idelem="${elem.id}">
                <i class="fa fa-pencil" aria-hidden="true"></i>
            </a>
            <a class="delete">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </a>
        </td>
        `;
}

function drawRowTable(elem){
    return `<tr>
        ${drawItemTable(elem)}
        </tr>`;
}


function fulledTable(data) {
    $('#terms_table>tbody')[0].insertAdjacentHTML('beforeend',data.map(el=>drawRowTable(el)).join(''));

    addListeners();
}

function addListeners() {

    $('a[class=delete]').on('click',function (e) {
        const cell = e.target.closest('td');
        if (!cell) {return;} // Quit, not clicked on a cell
        const row = cell.parentElement;
        let id_dropped = row.querySelector('td').textContent;

        deleteTerms(id_dropped)
    });

    $('a[class=edit]').on('click',function (e) {
        const cell = e.target.closest('td');
        if (!cell) {return;} // Quit, not clicked on a cell
        const row = cell.parentElement;
        let data = [];
        row.querySelectorAll('td').forEach((el,i)=>{
            if(i < (TITLE_.length-1)) data.push(el.textContent);
        });

        $('#edit-title')[0].value =data[1];
        $('#edit-description')[0].value =data[2];

    });
}


// const tbody = document.querySelector('#terms_table');
// tbody.addEventListener('click', function (e) {
//     const cell = e.target.closest('td');
//     if (!cell) {return;} // Quit, not clicked on a cell
//     const row = cell.parentElement;
//     let id_dropped = row.querySelector('td').textContent;
//     console.log(id_dropped);
// });





