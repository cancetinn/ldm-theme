function selector(selector){
    return document.querySelector(selector)
}

function selectorAll(selector){
    return document.querySelectorAll(selector)
}

function getDataset(item, set){
    const dataSet = selector(item).dataset[set]
    return dataSet
}

function getAjaxUrl(){
    return getDataset('[data-ajaxurl]', 'ajaxurl')
}

document.addEventListener("DOMContentLoaded", function(){
    callToAction()
    backToTop()
    //AOS.init()
})

function callToAction(){
    const openButton = selector(".callToAction .buttonx")
    const closeButton = selector(".callToAction .close")

    if (!openButton) return

    callToActionOpened(openButton, true)
    callToActionOpened(closeButton, false)
}

function callToActionOpened(item, status) {
    const ctaSidebar = selector(".ctaSidebar")

    item.addEventListener("click", e => {
        e.preventDefault()
        ctaSidebar.classList.toggle("opened", status)
        document.body.classList.toggle("hide-scrollbar", status)
    })
}

function backToTop(){
    const backToTop = selector('.backToTop')

    if (!backToTop) return

    backToTop.addEventListener("click", () =>{
        document.body.scrollIntoView({
            behavior: "smooth",
        })
    })

    document.addEventListener("scroll", () =>{
        backToTop.classList.toggle("active", window.scrollY > 350)
    })
}

function fancyBox(items, thumbs = false){
    const checkItem = selector(items)
    if (!checkItem) return

    Fancybox.bind(items, {
        caption: function (_fancybox, slide) {
            const workCaption = slide.triggerEl?.querySelector(".op-content")
            return workCaption ? workCaption.innerHTML : slide.caption || "";
        },
        compact: false,
        Hash: false,
        idle: false,
        Carousel: {
            Navigation : false,
        },
        Thumbs: {
            showOnStart: thumbs,
            type: 'classic',
        },
        Toolbar: {
            display: {
                left: [],
                middle: ["prev", "infobar", "next"],
                right: ["close"],
            }
        }
    })
}

console.log("Lidoma Theme - Can Cetin");

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

