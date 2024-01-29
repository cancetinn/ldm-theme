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
