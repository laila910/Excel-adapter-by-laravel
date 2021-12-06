<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>import Data in excel to database</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>

    <section style="padding-top:60px">
        <div class="container">
            <div class="row">

                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header"> Import </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="{{ route('data.import') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="file"> choose excel</label>
                                    <input type="file" name="file" class="form-control">

                                </div>
                                <button type="submit" class="btn btn-primary"> Submit</button>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>
</body>

</html>
