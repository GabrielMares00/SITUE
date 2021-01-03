//Copies share page link on click
document.getElementById("copy-text-share").onclick = function() {
    this.select();
    document.execCommand('copy');
}

//Copies direct page link on click
document.getElementById("copy-text-direct").onclick = function() {
    this.select();
    document.execCommand('copy');
}

//Copies bbcode link on click
document.getElementById("copy-text-bbcode").onclick = function() {
    this.select();
    document.execCommand('copy');
}

//Copies markdown link on click
document.getElementById("copy-text-markdown").onclick = function() {
    this.select();
    document.execCommand('copy');
}