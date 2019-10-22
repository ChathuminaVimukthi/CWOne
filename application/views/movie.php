<!DOCTYPE html>
<html>
<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Lookup Terminator movies</h2>
            <div class="col-md-4">
                <form action="/2016238/index.php/MovieController/showMovies" method=GET>
                    <div class="form-group">
                        <input type=text class="form-control" name=RELYEAR placeholder="Release year">
                    </div>
                    <input type=submit class="form-control" value="Lookup movie">
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
