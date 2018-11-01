<link rel="stylesheet" type="text/css" href="bootstrap.min.css"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<?php

if(!isset($_POST['type'])){
    header("Location: http://www.it.kmitl.ac.th/~it61070173/hash/");
}
$type = $_POST['type'];
$text = $_POST['text'];
$hash = strtolower($_POST['hash']);
$check = false;

switch($type){
    case "php":
        $check = password_verify($text, '$hash');
        break;
    case "md5":
        $check = (md5($text) == $hash);
        break;
    case "sha1":
        $check = (sha1($text) == $hash);
        break;
    case "sha256":
        $check = (hash('sha256', $text) == $hash);
        break;
}

$file = fopen("chk_log.txt","a");
$chk = ($check) ? 'true' : 'false';
$ip = $_SERVER['REMOTE_ADDR'];
fwrite($file,"\n$type | $text | $hash | $chk | $ip");
fclose($file);

?>
<html>
    <head>
        <title>Hash Checker - Result</title>
    </head>

    <body class="container"><br>
        <h2>Result</h2><hr>

        <form>
            <label>Selected hashing algorithms</label>
            <input disabled name="type" class="form-control" value="<?php switch($type){
                case "php": echo "PHP Hash";break;
                case "md5": echo "MD5";break;
                case "sha1": echo "SHA-1";break;
                case "sha256": echo "SHA-256";break;
            } ?>"/>
            </select><br>
            <div class="row">
                <div class="col-md-6">
                        <label>Entered value</label>
                    <textarea disabled class="form-control <?php if($check){echo 'is-valid';}else{echo 'is-invalid';} ?>"><?php echo $text; ?></textarea>
                </div>
                <div class="col-md-6">
                        <label>Entered hashed value</label>
                    <textarea disabled class="form-control <?php if($check){echo 'is-valid';}else{echo 'is-invalid';} ?>"><?php echo $hash; ?></textarea>
                </div>
            </div>
        </form>
        <center class="alert alert-<?php if($check){echo 'success';}else{echo 'danger';} ?>" role="alert">
            <?php if($check){echo 'The result are matched!';}else{echo 'The result aren\'t match.';} ?> 
            <a onclick="window.history.back()" href="#" class="badge badge-<?php if($check){echo 'success';}else{echo 'danger';} ?>">< Back</a>
        </center>
    </body>
</html>