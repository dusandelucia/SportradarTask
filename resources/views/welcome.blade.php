<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Add author form</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 48px;
            }

            hr {
                color: transparent;
                background: transparent;
                border-color: lightgray;
                border-style: inset;
            }

            .form {
                font-size: 1.2em;
            }
            .m-b-md {
                margin-bottom: 30px;
            }
            .data {
                text-align: left;
                list-style: circle;
                position: absolute;
                top: 0;
                left: 50px;
                border: 1px solid lightgray;
                padding: 10px;
                border-radius: 15px;
                display: none;
            }
        </style>
    </head>
    <body>
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function ajaxGetData(){
                $.post(
                    '/getData',
                    {},
                    function(response){
                        console.log(response);

                        $('.data').html('');
                        $('.data').css("display", 'block');

                        let dl = $('<dl></dl>');
                        for (let author of response){
                            let dt = $('<dt></dt>');
                            dt.text('* ' + author.name);
                            dl.append(dt);
                            for (let book in author.books){
                                let bookData = author.books[book];
                                let dd = $('<dd></dd>');
                                dd.text(' - ' + bookData.name + ' - ' + bookData.releaseDate);
                                dl.append(dd);
                            }
                        }
                        $('.data').append(dl);
                    }
                );
            }

            function validateForm(){
                if ($('#authorAge').val() < 16){
                    alert('Invalid author age!');
                    if(event.preventDefault){
                        event.preventDefault();
                    }else{
                        event.returnValue = false; // for IE as dont support preventDefault;
                    }
                    return false;
                } else if ($('#authorName').val().length < 2){
                    alert('Invalid author name!');
                    if(event.preventDefault){
                        event.preventDefault();
                    }else{
                        event.returnValue = false; // for IE as dont support preventDefault;
                    }
                    return false;
                } else if ($('#bookRelease').val() > Date()){
                    alert('Invalid book release date!');
                    if(event.preventDefault){
                        event.preventDefault();
                    }else{
                        event.returnValue = false; // for IE as dont support preventDefault;
                    }
                    return false;
                }

                $('#form').submit();
                return true;
            }
        </script>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    <button onclick="ajaxGetData()">Show Data</button>
                </div>
                <div class="data">

                </div>
                <div class="title m-b-md">
                    Add author and book
                </div>

                <div class="form">
                    <form method="post" action="addAuthor" id="form" onsubmit="return validateForm()">
                        @csrf
                        <hr/>
                        <label for="authorName">Author name:</label><br/>
                        <input name="authorName" id="authorName" type="text" required><br/>
                        <label for="authorAge">Author age:</label><br/>
                        <input name="authorAge" id="authorAge" type="number" required><br/>
                        <label for="authorAddress">Author address:</label><br/>
                        <input name="authorAddress" id="authorAddress" type="text" required><br/>
                        <hr/>
                        <label for="bookName">Book name:</label><br/>
                        <input name="bookName" id="bookName" type="text" required><br/>
                        <label for="bookRelease">Release date:</label><br/>
                        <input name="bookRelease" id="bookRelease" type="date" required><br/>
                        <hr/>
                        <input type="submit" value="Add author and book"/>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
