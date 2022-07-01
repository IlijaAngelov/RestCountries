<?php
session_start();
$uid = $_SESSION['uid'];
require "database/Connection.php";
require "src/Country.php";
require "index.php";
//use BtoBet;

$pdo = Connection::make();
$fav = new \BtoBet\Country($pdo);
$countries = $fav->getFavCountries($uid);


//$url = "https://restcountries.com/v3.1/all";
//$json_data = file_get_contents($url);
//$countries = json_decode($json_data);

?>
<h1>ALL COUNTRIES</h1>
<div class="flex-container">
    <?php foreach($countries as $country){ ?>
        <div class="card">
            <img src="" alt="" class="card-img-top">
            <div class="card-body">
                <p><?= $country['name']; ?></p>
                <p><?= $country['region']; ?></p>
                <p><?= $country['population']; ?></p>
                <button id="<?= $country['id']; ?>"
                        type="button" onclick="sendData(id)">
                    Remove from Favourites
                </button>
            </div>
        </div>
        <?php } ?>
</div>
<script>
    sendData = (id) => {
        axios.post('deleteFavourites.php', {
            id: id
        })
        .then(function (response) {
            console.log(response)
            location.reload();
        })
        .catch(function (error) {
            // console.log(error);
        });
    };
</script>
</body>
</html>