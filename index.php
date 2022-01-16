<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/d8deeee5a9.js"></script>

    <title>Admin App</title>
</head>
<header>
    <nav class="navbar navbar-expand-lg navbar-light navbar-dark bg-primary">
        <div class="container-fluid" style="padding-left: 10%">
            <a class="navbar-brand" href="#">English IT</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">...
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active cursor_pointer" aria-current="page" data-block="terms">Terms</a>
                    <a class="nav-link cursor_pointer" data-block="professions">Professions</a>
                    <a class="nav-link cursor_pointer" data-block="languages">Languages</a>
                    <a class="nav-link cursor_pointer" data-block="trends">Trends</a>
                </div>
            </div>
        </div>
    </nav>
</header>

<body>

<div class="container">

    <div id="terms">

        <div class="container">
            <div class="row">
                <h3 align="center" class="col" id="nameFullBlock">Terms</h3>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        data-bs-whatever="terms" style="width: 8%;height: 2%;margin-top: 1%;">+
                </button>
            </div>

            <table id='terms_table' class="table" width="100%">
                <thead>
                <tr>
                    <th>
                        id
                    </th>
                    <th>
                        Название
                    </th>
                    <th style="max-width: 45%;">
                        Описание
                    </th>
                    <th>
                        Картинка
                    </th>
                    <th>
                        #
                    </th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

    <div id="professions" class="hidden">
        <div class="container">
            <div class="row">
                <h3 align="center" class="col" id="nameFullBlock">Professions</h3>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        data-bs-whatever="professions" style="width: 8%;height: 2%;margin-top: 1%;">+
                </button>
            </div>

            <table id='professions_table' class="table" width="100%">

            </table>
        </div>
    </div>



    <div id="languages" class="hidden">
        <div class="container">
            <div class="row">
                <h3 align="center" class="col" id="nameFullBlock">Languages</h3>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        data-bs-whatever="languages" style="width: 8%;height: 2%;margin-top: 1%;">+
                </button>
            </div>

            <table id='languages_table' class="table" width="100%">
            </table>
        </div>
    </div>


    <div id="trends" class="hidden">
        <div class="container">
            <div class="row">
                <h3 align="center" class="col" id="nameFullBlock">Trends</h3>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        data-bs-whatever="trends" style="width: 8%;height: 2%;margin-top: 1%;">+
                </button>
            </div>

            <table id='trends_table' class="table" width="100%">
            </table>
        </div>
    </div>

</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавление данных в таблицу </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Название:</label>
                        <input type="text" class="form-control" id="add-title">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Описание:</label>
                        <textarea class="form-control text-area-height" id="add-description"></textarea>
                    </div>
                    <label for="sortpicture">Загрузить картинку</label><br/>
                    <input id="sortpicture" type="file" name="sortpic"/>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-primary" id="btn_add_item">Отправить</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Редактирование данных</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Название:</label>
                        <input type="text" class="form-control" id="edit-title">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Описание:</label>
                        <textarea class="form-control text-area-height" id="edit-description"></textarea>
                    </div>
                    <label for="editPicture">Изменить картинку</label>
                    <input type="checkbox" id="editPicture" onchange="showPictureBlock()"/>
                    <div id="blockEditPicture" class="hidden">
                        <input id="edit-picture" type="file" name="sortpic"/>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-primary" id="btn_edit_item">Отправить</button>
            </div>
        </div>
    </div>
</div>
<!-- Вариант 1: Bootstrap в связке с Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>


<script type="module" src="js/index.js"></script>
<script type="text/javascript" src="js/modal.js"></script>

<style>
    body {
        font-size: 1.5vw
    }

    .desc-div{
        height: 7.5em;
        overflow: auto;
    }

    .small-th{
        width: 5%;
    }

    .middle-th{
        width: 10%;
    }

    .large-th{
        width: 50%;
    }

    .picture-td{
        font-size: 1.0vw;
    }

    @media (min-width: 768px) {
        .modal-dialog{
            max-width: 850px;
        }

        .text-area-height{
            height: 16em;
        }
    }


    @media (max-width: 768px) {
        body {
            font-size: 3.5vw;
        }
        .picture-td{
            font-size: 2.0vw
        }
        tbody{
            font-size: smaller;
        }
        th{
            font-size: smaller;
        }

        .btn {
            text-align: center;
            padding: 1px 5px;
            font-size: 12px;
            line-height: 1.5;
            border-radius: 3px;
        }

        .desc-div{
            height: 7.5em;
            overflow: auto;
        }

        .small-th{
            width: 2%;
        }

        .middle-th{
            width: 5%;
        }

        .large-th{
            width: 45%;
        }

        .word-break{
            width: 5em;
            word-wrap: break-word;
        }

    }

    .hidden {
        display: none;
    }

    .cursor_pointer {
        cursor: pointer;
    }
</style>
</body>
</html>