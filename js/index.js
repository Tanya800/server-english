import {action} from './actions.js';

let TITLE_TABLE = [
    {title:'id', class:'small-th'},
    {title:'Название', class:'middle-th'},
    {title:'Описание', class:'large-th'},
    {title:'Картинка', class:'middle-th'},
    {title:'#', class:'small-th'}
]

function getTermsTable() {

    let url = 'http://q90932z7.beget.tech/server.php?action=select_'+action.current_page;

    $.ajax({
        url:url,
        type:"POST",
        dataType:"json",
        success:(data)=>{
            fulledTable(data);

        }
    });
}

function deleteTerms(data) {
    $.ajax({
        url:'db/delete_terms.php',
        type:"POST",
        data:data,
        dataType:"json",
        success:(data)=>{
            console.log('delete ok');
            window.location.reload();
        }
    });
}

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
            getTermsTable();
        })
    });

    let key_block = localStorage.getItem('current_page');

    action.init(indexes,links);

    if (key_block && key_block !== action.current_page) {
        action.changeBlock(key_block);
    }

    getTermsTable();
});

function drawItemTable(elem){
    let image = elem.img.split('/');
    image = image[image.length - 1];
    elem.description = elem.description.replaceAll( "<" , "&lt;" ).replaceAll( ">" , "&gt;");

    return `
        <td>${elem.id}</td>
        <td><div class="word-break">${elem.title}</div></td>
        <td><div class="desc-div">${elem.description}</div></td>
        <td class="picture-td"><a href="${elem.img}" target="_blank"><div class="word-break">${image}</div></a></td>
        <td>
            <a class="edit"  data-bs-toggle="modal" data-bs-target="#editModal" data-bs-whatever="${action.current_page}" data-bs-idelem="${elem.id}">
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

function createThTable(elem) {
    return `<th class="${elem.class}">
                ${elem.title}
            </th>`;
}

function createHeaderTable() {
    return `<thead>
                <tr>
                ${TITLE_TABLE.map(el=>createThTable(el)).join('')}
                </tr>
            </thead>`;
}

function fulledTable(data) {

    let table = $('#'+action.current_page+'_table')[0];
    table.innerHTML = '';
    table.innerHTML = createHeaderTable();

    let tbody = document.createElement('tbody');
    if(data){
        tbody.innerHTML= data.map(el=>drawRowTable(el)).join('');

        table.insertAdjacentElement('beforeend',tbody);

        addListeners();
    }

}

function addListeners() {

    $('a[class=delete]').on('click',function (e) {
        const cell = e.target.closest('td');
        if (!cell) {return;} // Quit, not clicked on a cell
        const row = cell.parentElement;
        let id_dropped = row.querySelector('td').textContent;
        let data ={
            id:id_dropped,
            table:action.current_page
        }

        deleteTerms(data)
    });

    $('a[class=edit]').on('click',function (e) {
        const cell = e.target.closest('td');
        if (!cell) {return;} // Quit, not clicked on a cell
        const row = cell.parentElement;
        let data = [];
        row.querySelectorAll('td').forEach((el,i)=>{
            if(i < (TITLE_TABLE.length-1)) data.push(el.textContent);
        });

        $('#edit-title')[0].value =data[1];
        $('#edit-description')[0].value =data[2];

    });
}
