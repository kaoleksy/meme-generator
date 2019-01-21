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
})



