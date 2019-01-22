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
            $memesList.append(`<div class="meme-field center">
                                <p class="meme-title">${el.title}</p>
                                <img src="${relativePath}" width="100%" alt="${el.title}" class="meme-image">
                                <p class="author">Author: ${el.username}</p>
                                <button class="btn btn-warning btn-lg" type="button" onclick="showFormComment()">Add Comment
                                </button><br>
                                <form style="display:none;" class="newCommentForm"><hr>
                                <textarea id=${el.id} class="newComment" name="newCommentValue" placeholder="Enter your comment here..."></textarea><br>
                                <input type="button" name="${el.id}" value="Submit" 
                                        class="btn btn-primary" onclick="addCommentToMeme(${el.id})"><hr>
                                </form><br>
                                <button class="btn btn-danger btn-lg showCommentsButton${el.id}" type="button" onclick="showAllMemeComments(${el.id})">Show All Comments
                                </button>
                                </div>
                  
                                `);
            });
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

    const $uploadedMemes = $('.uploaded-memes');
    $.ajax({
        url : apiUrl + '/?page=your_uploaded_memes',
        dataType : 'json'
    })
        .done((res) => {
            $uploadedMemes.empty();
            console.log(res);
            res.forEach(el => {
                let relativePath = '..' + el.path.slice(33);
                $uploadedMemes.append(`
                                <img class="img-responsive" src="${relativePath}" width="80%" alt="${el.title}"><hr>
                                `);
            })
        });

    const $generatedMemes = $('.generated-memes');
    $.ajax({
        url : apiUrl + '/?page=your_generated_memes',
        dataType : 'json'
    })
        .done((res) => {
            $generatedMemes.empty();
            console.log(res);
            res.forEach(el => {
                let relativePath = '..' + el.path.slice(33);
                $generatedMemes.append(`
                                <img class="img-responsive" src="${relativePath}" width="80%" alt="${el.title}"><hr>
                                `);
            })
        });
})

function getUsers() {
    const apiUrl = "http://localhost:7000";
    const $list = $('.users-list');

    $.ajax({
        url : apiUrl + '/?page=admin_users',
        dataType : 'json'
    })
        .done((res) => {
            console.log(res);
            $list.empty();
            res.forEach(el => {
                $list.append(`<tr>
                    <td>${el.username}</td>
                    <td>${el.name}</td>
                    <td>${el.surname}</td>
                    <td>${el.email}</td>
                    <td>${el.role_id}</td>
                    <td>
                    <button class="btn btn-danger" type="button" onclick="deleteUser(${el.ID})">
                        <i class="material-icons">delete_forever</i>
                    </button>
                    </td>
                    </tr>`);
            })
        });
}

function deleteUser(id) {
    if (!confirm('Do you want to delete this user?')) {
        return;
    }

    const apiUrl = "http://localhost:7000";

    $.ajax({
        url : apiUrl + '/?page=admin_delete_user',
        method : "POST",
        data : {
            id : id
        },
        success: function() {
            alert('Selected user successfully deleted from database!');
            getUsers();
        }
    });
}

function addCommentToMeme(id) {
    const apiUrl = "http://localhost:7000";
    let value = $('#'+id+'.newComment').val();
    console.log(value);
    $.ajax({
        url : apiUrl + '/?page=add_comment',
        method : "POST",
        data : {
            id : id,
            comment: value
        },
        success: function(msg) {
            alert('Add comment successfully!');
            console.log(msg);
            showAllMemeComments(id);
        },
        error: function(e) {
            console.log(e);
        }
    });
}

function showFormComment() {
    $('.newCommentForm').css('display', 'block');
    console.log('click!');
}

function showAllMemeComments(id) {
    const showCommentsButton = $('.showCommentsButton'+id);
    const apiUrl = "http://localhost:7000";
    $.ajax({
        url: apiUrl + '/?page=show_comments',
        method: "POST",
        data: {
            id: id
        }
    })
        .done((res) => {
            showCommentsButton.empty();
            var resDecode = JSON.parse(res);
            showCommentsButton.parent().append(`<table class="table table-hover" id="commentTable`+id+`">
            `);
            $('#commentTable'+id).empty();
            resDecode.forEach(el => {
                $('#commentTable'+id).append(`<tr>
                     <td>${el.id}</td>
                     <td>${el.comment}</td></tr>`);
            })
            showCommentsButton.parent().append(`</table>`);
        });
    $('.showCommentsButton'+id).css('display', 'none');
}