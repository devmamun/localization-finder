
let processBtn = document.getElementById('start_process');
processBtn.addEventListener('click', function () {
    var inter = setInterval(() => {
        getFileData();
    }, 100);

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            progressStartValue = 100;
            clearInterval(inter);
        }
    }
    xhr.open("GET", "./finder.php?query=test", true);
    xhr.send();
})

function getFileData() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText) {
                obj = JSON.parse(this.responseText);
                let text = document.querySelector('.text');
                text.innerHTML = obj.file_counter + ' / ' + obj.total_files;
                progressStartValue = Math.round(obj.file_counter / obj.total_files * 100);
            }
        }
    }
    xhr.open("GET", "./assets/file/file.txt", true);
    xhr.send();
}

let circularProgress = document.querySelector(".circular-progress"),
    progressValue = document.querySelector(".progress-value");

var progressStartValue = 0,    
    progressEndValue = 100,    
    speed = 20;
    
let progress = setInterval(() => {
    progressValue.textContent = `${progressStartValue}%`
    circularProgress.style.background = `conic-gradient(#423f45 ${progressStartValue * 3.6}deg, #ededed 0deg)`

    if (progressStartValue == progressEndValue) {
        clearInterval(progress);
    }    
}, speed);