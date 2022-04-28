const getAllBooks = (result) => {
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            result = this.responseText
        }
    }
    xmlhttp.open("GET","http://localhost/18021745/php/book");
    xmlhttp.send();
}

module.exports = {getAllBooks}
