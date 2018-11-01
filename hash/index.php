<link rel="stylesheet" type="text/css" href="bootstrap.min.css"/>
<script src="jquery-3.3.1.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<?php
    $result = "Hashed text will appear here.";
    if(isset($_POST['gen_sub'])){
        $type = $_POST['type'];
        $text = $_POST['text'];
        switch($type){
            case "php":
                $result = password_hash($text, PASSWORD_BCRYPT);
                break;
            case "md5":
                $result = md5($text);
                break;
            case "sha1":
                $result = sha1($text);
                break;
            case "sha256":
                $result = hash('sha256', $text);
                break;
        }

        $file = fopen("gen_log.txt","a");
        $ip = $_SERVER['REMOTE_ADDR'];
        fwrite($file,"\n$type | $text | $result | $ip");
        fclose($file);
    }    
?>
<html>
    <head>
        <title>Hash Generator and Checker</title>
        <script>
            function check(whr){
                idx = 0;$('.is-invalid').removeClass('is-invalid');
                $(whr + ' > select, ' + whr + ' div > div > textarea').each(function(){
                    if (($(this).val() == null || $(this).val() == "") && !$(this).is(":disabled")){
                        $(this).addClass("is-invalid");
                    }else{idx++;}
                });
                if (idx == 3 && whr == '#hash_form'){$('#hash_form').submit();}
            }
        </script>
    </head>

    <body class="container"><br>
        <h2>Hash Generator</h2>
        <h4><small class="text-muted">Generate hashed value of the input</small></h4><hr>
        <form method="POST" action="" id="gen_form">
                <label>Hashing algorithms</label>
                <select name="type" class="form-control type">
                    <option selected disabled>- Select hashing algorithms -</option>
                    <!-- <option value="php">PHP Hash</option> -->
                    <option value="md5">MD5</option>
                    <option value="sha1">SHA-1</option>
                    <option value="sha256">SHA-256</option>
                </select><br>
                <div class="row">
                    <div class="col-md-6">
                            <label>Input value</label>
                        <textarea class="form-control text" name="text" placeholder="Enter the text to be hashed."></textarea>
                    </div><br>
                    <div class="col-md-6">
                            <label>Hashed value</label>
                        <textarea disabled class="form-control hash_gen" name="hash"><?php echo $result; ?></textarea>
                    </div>
                </div><br>
                <button onclick="check('#gen_form')" type="submit" name="gen_sub" class="btn btn-block btn-success">Generate</button>
            </form>
        <hr>

        <h2>Hash Checker</h2>
        <h4><small class="text-muted">Check that input and hash value are matched or not</small></h4><hr>

        <form method="POST" action="result.php" id="hash_form">
            <label>Hashing algorithms</label>
            <select name="type" class="form-control type">
                <option selected disabled>- Select used hashing algorithms -</option>
                <!-- <option value="php">PHP Hash</option> -->
                <option value="md5">MD5</option>
                <option value="sha1">SHA-1</option>
                <option value="sha256">SHA-256</option>
            </select><br>
            <div class="row">
                <div class="col-md-6">
                        <label>Input value</label>
                    <textarea class="form-control text" name="text" placeholder="Enter the text to be checked with hash."></textarea>
                </div><br>
                <div class="col-md-6">
                        <label>Hashed value</label>
                    <textarea class="form-control hash" name="hash" placeholder="Enter the hashed value to be checked with text."></textarea>
                </div>
            </div><br>
            <button onclick="check('#hash_form')" type="button" class="btn btn-block btn-success">Check</button>
        </form>
        <hr>

        <h2>More info about hashing</h2>
        <h4><small class="text-muted">What is hashing and how does hashing works</small></h4><hr>
        <p>A hash function is any function that can be used to map data of arbitrary size to data of a fixed size. The values returned by a hash function are called hash values, hash codes, digests, or simply hashes
            <a href="https://en.wikipedia.org/wiki/Hash_function" target="_BLANK">> more information</a>
        </p>
        <center class="row">
                <div class="col-md-6">
                    <img src="hash1.png"/>
                </div><br>
                <div class="col-md-6">
                    <img src="hash2.png"/>
                </div>
        </center><br>
            
        <table class="table">
        <thead class="thead-light">
            <tr>
            <th scope="col">Method</th>
            <th scope="col">Security</th>
            <th scope="col">Length</th>
            <th scope="col">Speed</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <th scope="row">MD5</th>
            <td>Less secure</td>
            <td>128 Bits</td>
            <td>64 iterations</td>
            </tr>
            <tr>
            <th scope="row">SHA-1</th>
            <td>Secure</td>
            <td>160 Bits</td>
            <td>80 iterations</td>
            </tr>
            <tr>
            <th scope="row">SHA-256</th>
            <td>More secure</td>
            <td>256 Bits</td>
            <td>80 iterations</td>
            </tr>
        </tbody>
        </table>
    </body><br><br>
</html>