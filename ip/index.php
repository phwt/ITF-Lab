<link rel="stylesheet" type="text/css" href="bootstrap.min.css"/>
<script src="jquery-3.3.1.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<script>
    $( document ).ready(function() {
        $('#res').hide();
    });
    function lookup(){
        if ($('#ipa').val() == ""){
            cur_ip = "<?php echo $_SERVER['REMOTE_ADDR'] ?>";
        } else{
            cur_ip = $('#ipa').val();
        }
        $('#form').slideUp();$('#res').slideDown();
        $.getJSON("https://ipinfo.io/"+cur_ip+"/json?token=2f252b1023a121", function(res){
            $('.b_ip').html(res.ip);
            $('.b_city').html(res.city);
            $('.b_region').html(res.region);
            $('.b_country').html(res.country);
            $('.b_postal').html(res.postal);
            $('.b_isp').html(res.org);
        });
    }
</script>
<div class="container"><br>
    <h2>Geolocation Look-up</h2><hr>
    <div id="form">
        <label>IP Address (Leave blank to use your IP Address)</label>
        <input id="ipa" class="form-control" placeholder="Enter IP address here. Leave blank to use your current IP address."/><br>
        <button class="btn btn-success btn-lg btn-block" onclick="lookup()">Submit</button>
    </div>
    <div class="card" id="res">
        <div class="card-body">
            <b>IP Address: </b><span class="b_ip">Undefined</span><br>
            <b>City: </b><span class="b_city">Undefined</span><br>
            <b>Region: </b><span class="b_region">Undefined</span><br>
            <b>Postal Code: </b><span class="b_postal">Undefined</span><br>
            <b>Country: </b><span class="b_country">Undefined</span><br>
            <b>ISP: </b><span class="b_isp">Undefined</span>
        </div>
    </div>
</div>