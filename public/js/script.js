$(document).ready(function () {
    const apiUrl = "http://localhost:7000";
    const $memesList = $('.memes');
    $.ajax({
        url : apiUrl + '/?page=index_memes',
        dataType : 'json'
    })
        .done((res) => {
            $memesList.empty();
            console.log(res);
            res.forEach(el => {
                let relativePath = '..' + el.path.slice(33);
                $memesList.append(`<div class="meme-field">
                                <p class="meme-title">${el.title}</p>
                                <img src="${relativePath}" width="100%" alt="${el.title}" class="meme-image">
                                <p>Author: ${el.username}</p>
                                </div>
                  
                                `);
            })
        });

    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#uploadedImage').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#chooseImage").change(function() {
        readURL(this);
    });

    const $generatedMeme = $('.generated-meme');
    $.ajax({
        url : apiUrl + '/?page=latest_meme',
        dataType : 'json'
    })
        .done((res) => {
            console.log(res);
            res.forEach(el => {
                let relativePath = '..' + el.path.slice(33);
                $generatedMeme.append(`
                                <img class="img-responsive" src="${relativePath}" width="80%" alt="${el.title}">
                                `);
            })
        });

})

