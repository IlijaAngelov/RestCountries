<?php
    session_start();
    require 'vendor/autoload.php';
    include 'partials/header.php';
?>
<section id="control-center">
    <button class="submit_button" id="get-btn">GET Data</button>
    <div id="container" class="flex-container">
    </div>
</section>
<script>
    const getBtn = document.getElementById('get-btn');
    const postBtn = document.getElementById('post-btn');

    const getData = () => {
        axios.get('https://restcountries.com/v3.1/all')
            .then((response) => {
                var data = response.data;
                for (var i = 0; i < data.length; i++) {
                    // create the card div element and add .card class
                    var card = document.createElement('div');
                    card.classList.add('card');
                    // create the card-body div element and add .card-body class
                    var cardBody = document.createElement('div');
                    cardBody.classList.add('card-body');

                    var nameParagraph = document.createElement("p");
                    var regionParagraph = document.createElement("p");
                    var populationParagraph = document.createElement("p");
                    var button = document.createElement("button");

                    let id = i + 1;
                    let name = data[i].name.common;
                    let region = data[i].region;
                    let population = data[i].population;

                    nameParagraph.innerHTML = name;
                    regionParagraph.innerHTML = region;
                    populationParagraph.innerHTML = population;
                    button.innerText = 'Add to Favourites';
                    button.setAttribute("id", id);
                    button.setAttribute("data-name", name);
                    button.setAttribute("data-region", region);
                    button.setAttribute("data-population", population);

                    document.querySelector(".flex-container").appendChild(card);
                    card.appendChild(cardBody);
                    cardBody.appendChild(nameParagraph);
                    cardBody.appendChild(regionParagraph);
                    cardBody.appendChild(populationParagraph);
                    cardBody.appendChild(button);

                    button.onclick = sendData = () => {
                        axios.post('saveFavourites.php', {
                            name: name,
                            region: region,
                            population: population
                        })
                        .then(function (response) {
                            document.getElementById(id).disabled = true;
                            // console.log(response)
                        })
                        .catch(function (error) {
                            // console.log(error);
                        });
                    };
                }
            })
    };

    getBtn.addEventListener('click', getData);

</script>
</body>
</html>


