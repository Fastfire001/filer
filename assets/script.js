window.onload = function () {
    var btnrename = document.querySelectorAll('.rename');
    for (var i = 0; i < btnrename.length; i++){
        btnrename[i].onclick = function () {
            var oldName = this.previousSibling.previousSibling.previousSibling.previousSibling.textContent;
            document.querySelector('div.popup').classList.remove("hide");
            document.querySelector('div.overlay').classList.remove("hide");
            document.querySelector('input#newName').value = oldName;
            document.querySelector('input[name="fileID"]').value = this.parentElement.getAttribute('data-fileid');
        };
    }
    document.querySelector('form.renameForm').onsubmit = function () {
        var newName = this.elements['newName'].value;
        if (0 === newName.length){
            document.querySelector('div.popup').classList.add("hide");
            document.querySelector('div.overlay').classList.add("hide");
            alert("Invalid name");
            return false;
        } else {
            return true;
        }
    };
};