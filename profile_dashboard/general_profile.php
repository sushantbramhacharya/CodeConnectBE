<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>General Profile Update</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>


<body>
    <div class="update-profile">
        <form>
            
            <div class="form-icon">
                <span><i class="icon icon-user"></i></span>
            </div>
            <div class="form-group">
            <label class="form-label" for="customFile">Choose Photo</label>
            <input type="file" class="form-control" id="customFile" />
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" id="username" name="username" placeholder="Username">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" id="location" name="location" placeholder="Location">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" id="email"
                name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" id="github-link" name="github-link" placeholder="Github Link">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" id="bio" name="bio"placeholder="Bio">
            </div>
            <p class="warning">* Empty fields wont be updated.</p>
            <div class="form-group">
                <button type="button" class="btn btn-block update-account">Update Account</button>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>
