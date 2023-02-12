
let processBtn = document.getElementById('start_process');
var progressUI = document.getElementById('progress_bar');
processBtn.addEventListener('click', function () {
    progressStartValue = 0;
    progressBar();
    
    progressUI.classList.remove('hidden');
    processBtn.disabled = true;

    var inter = setInterval(() => {
        getFileData();
    }, 1000);

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            progressStartValue = 100;
            progressUI.classList.add('hidden');
            processBtn.disabled = false;
            clearInterval(inter);
        }
    }

    xhr.open("POST", "./src/actions/Action.php?query=execute", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    const form = document.querySelector('form');
    const queryString = new URLSearchParams(new FormData(form)).toString()
    xhr.send(queryString);
})

function getFileData() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200 && this.responseText) {
            let obj = JSON.parse(this.responseText);
            let text = document.querySelector('.text');
            text.innerHTML = obj.file_counter + ' / ' + obj.total_files;
            progressStartValue = Math.round(obj.file_counter / obj.total_files * 100);
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
    
function progressBar() {
    let progress = setInterval(() => {
        progressValue.textContent = `${progressStartValue}%`
        circularProgress.style.background = `conic-gradient(#423f45 ${progressStartValue * 3.6}deg, #ededed 0deg)`

        if (progressStartValue == progressEndValue) {
            clearInterval(progress);
        }    
    }, speed);
}
