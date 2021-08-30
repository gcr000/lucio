<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Elenco Immobili') }}
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="bug-list-search">
                                                <div class="bug-list-search-content">
                                                    <div class="position-relative">
                                                        <input style="height: 42px" type="search" id="search-box" class="form-control left-placeholder" placeholder="Cerca...">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <select name="category_id" id="category_id" style="width: 100%!important;">
                                                {{--<option value=""> -- Tutte le categorie --</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach--}}
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <select name="province_id" id="province_id" style="width: 100%!important;">
                                                {{--<option value=""> -- Tutte le province --</option>
                                                @foreach($provinces as $province)
                                                    <option value="{{$province->id}}">{{$province->name}}</option>
                                                @endforeach--}}
                                            </select>
                                        </div>
                                        <div class="col-1">
                                            <button class="btn btn-primary" onclick="Search($('#search-box').val())">Cerca</button>
                                        </div>
                                        <div class="col-2 text-right d-md-none">
                                            <a class="btn btn-primary" href="{{url('/')}}/structures/add">+ Aggiungi</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div id="table_data">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>

    document.addEventListener('DOMContentLoaded', function () {

        var last_search = '{{session('structure_last_search')}}';
        var last_category_id = '{{session('structure_last_category_id')}}';
        var last_province_id = '{{session('structure_last_province_id')}}';
        var last_page = window.localStorage.getItem('structure_page');

        let sessionObj = {
            category_id: last_category_id,
            search: last_search,
            province_id: last_province_id,
        };

        if (!!last_category_id) {
            $('#category_id').val(last_category_id);
        }

        if (!!last_province_id) {
            $('#province_id').val(last_province_id);
        }

        if (last_search.length > 0) {
            $('#search-box').val(last_search);
        }

        fetch_data(last_search, sessionObj, last_page);
    })


    $(document).on('click', '.pagination a', function (event) {
        event.preventDefault();
        page = $(this).attr('href').split('page=')[1];
        window.localStorage.setItem('structure_page', page);
        fetch_data($('#search-box').val(), undefined, page);
    });

    function fetch_data(string, selectsObj = {category_id: false, province_id: false}, page) {
        $('#table_data').html("<i class=\"fa fa-circle-o-notch fa-spin fa-fw\"></i>");
        $('#table_data').addClass('loading-data');
        $('#table_data').show();

        $.ajax({
            url: "{{url('/')}}/search/table/structures/?search=" + string + "&page=" + page +
                '&category_id=' + (!!selectsObj.category_id ? selectsObj.category_id : $('#category_id').val()) +
                '&province_id=' + (!!selectsObj.province_id ? selectsObj.province_id : $('#province_id').val()),
            success: function (data) {
                $('#table_data')
                    .removeClass('loading-data')
                    .html(data);
            }
        });
    }

    function Search(string) {
        $('#table_data')
            .html('<br><i style="color: #40da88" class="fa fa-circle-o-notch fa-spin fa-fw"></i>').addClass('loading-data');

        jQuery.ajax({
            url: "{{url('/')}}/search/table/structures/?search=" + string + '&category_id=' + $('#category_id').val() + '&province_id=' + $('#province_id').val(),
            method: 'GET',
            datatype: 'json',
            success: function (response) {
                $('#table_data').removeClass('loading-data').html(response);
                window.localStorage.removeItem('structure_page');
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

</script>

<style>
    .fa-circle-o-notch {
        color: #40da88;
        width: 100%;
        text-align: center;
        margin: 0 auto !important;
    }

    .loading-data {
        color: #da4949;
        text-align: center;
        font-size: 35px;
    }

    body {
        background: #f7f7ff;
        margin-top: 20px;
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid transparent;
        border-radius: .25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
    }
</style>

