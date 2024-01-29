function selector(selector){
    return document.querySelector(selector)
}
function selectorAll(selector){
    return document.querySelectorAll(selector)
}

function getDataset(selector, set){
    const dataSet = document.querySelector(selector).dataset[set]
    return dataSet
}

console.log("Arina theme");

document.addEventListener("DOMContentLoaded", function () {
    var countrySelect = document.getElementById("country");
    var playerInfo = document.getElementById("player-info");
    var extraPlayers = document.getElementById("extra-players");
    var submitButton = document.getElementById("submit-application");
    var playerInputs = document.querySelectorAll("#players .player input");
    var extraPlayerButton = document.getElementById("add-extra-players");

/*    // Ülke seçildiğinde oyuncu bilgilerini göster
    if (countrySelect) {
        countrySelect.addEventListener("change", function () {
            if (this.value) {
                playerInfo.style.display = "block";
            } else {
                playerInfo.style.display = "none";
            }
        });
    }*/

    // Yedek Oyuncu ve Koç Ekle butonu işlevselliği
    if (extraPlayerButton) {
        extraPlayerButton.addEventListener("click", function () {
            extraPlayers.style.display = "block";
        });
    }

    // Tüm oyuncu bilgileri doldurulduğunda Başvuru Gönder butonunu göster
    function checkAllPlayerInputs() {
        var allFilled = Array.from(playerInputs).every(
            (input) => input.value.trim() !== "",
        );
        submitButton.style.display = allFilled ? "block" : "none";
    }

    playerInputs.forEach((input) =>
        input.addEventListener("input", checkAllPlayerInputs),
    );
});

