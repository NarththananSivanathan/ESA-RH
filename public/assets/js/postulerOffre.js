document.addEventListener("DOMContentLoaded", function() {
    const newCvRadio = document.getElementById('new_cv');
    const newCvFileInput = document.getElementById('cv');
    const newLm = document.getElementById('new_lm');

    if (!app.user.CV) {
        newCvRadio.checked = true;
        newCvFileInput.setAttribute('required', 'required');
    }

    if (!app.user.LM) {
        newLm.checked = true;
        //newCvFileInput.setAttribute('required', 'required');
    }

    newCvRadio.addEventListener('change', function() {
        if (this.checked) {
            newCvFileInput.setAttribute('required', 'required');
        } else {
            newCvFileInput.removeAttribute('required');
        }
    });

});