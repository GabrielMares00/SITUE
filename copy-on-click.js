document.getElementById("copy-text-share").onclick = function() {
    this.select();
    document.execCommand('copy');
}

document.getElementById("copy-text-direct").onclick = function() {
    this.select();
    document.execCommand('copy');
}

document.getElementById("copy-text-bbcode").onclick = function() {
    this.select();
    document.execCommand('copy');
}

document.getElementById("copy-text-markdown").onclick = function() {
    this.select();
    document.execCommand('copy');
}