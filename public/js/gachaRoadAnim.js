(function(win, doc) {

    "use strict";
    
    var img = doc.getElementById("img"),
        classList = [
            "",
            "two"
        ],
        length = classList.length,
        index = 0;
    
    setInterval(function() {
        img.className = classList[index];
        index = ++index % length;
    }, 200);
})(this, document);