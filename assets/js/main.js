document.addEventListener('DOMContentLoaded', function () {
    const heartButton = document.querySelector('.heart-button');


    heartButton.addEventListener('click', function (e) {
        e.preventDefault();

        const postId = this.dataset.postId;
        const heartIcon = this.querySelector('i');
        const counter = this.querySelector('.counter');

        fetch('../user/like.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'id_post=' + postId
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.liked) {
                        heartIcon.classList.remove('bi-heart');
                        heartIcon.classList.add('bi-heart-fill');
                    } else {
                        heartIcon.classList.remove('bi-heart-fill');
                        heartIcon.classList.add('bi-heart');
                    }
                    counter.textContent = data.likes_count;
                } else {
                    alert('Ошибка: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Ошибка:', error);
                alert('Произошла ошибка при отправке запроса.');
            });
    });

})
document.addEventListener('DOMContentLoaded', function () {
    const followButton = document.querySelector('.follow-button');

    followButton.addEventListener('click', function (e) {
        e.preventDefault();

        const authorId = this.dataset.authorId;
        const button = this;

        fetch('../user/follow.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'authorid=' + encodeURIComponent(authorId) //
        })
            .then(response => {
                if (!response.ok) {

                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    if (data.is_following) {
                        button.textContent = 'Отписаться';
                        button.classList.remove('btn-primary');
                        button.classList.add('btn-danger');
                    } else {
                        button.textContent = 'Подписаться';
                        button.classList.remove('btn-danger');
                        button.classList.add('btn-primary');
                    }
                } else {
                    alert('Ошибка: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Ошибка:', error);
                if (error.message.includes('HTTP error!')) {
                    alert(`Ошибка при выполнении запроса.  Пожалуйста, попробуйте позже.  Код ошибки: ${error.message}`);
                } else {
                    alert('Произошла ошибка при отправке запроса.  Проверьте консоль.');
                }
            });
    });

});


document.addEventListener('DOMContentLoaded', function () {
    const commentForm = document.getElementById('commentForm');

    commentForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const commentText = document.getElementById('commentText').value;
        const page = document.querySelector('input[name="page"]').value;


        fetch('../app/controllers/comments.php?post=' + page, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'commentText=' + encodeURIComponent(commentText) + '&post=' + page
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    document.getElementById('commentText').value = '';

                    const comments = data.comments;
                    const commentList = document.getElementById('commentList');

                    commentList.innerHTML = '';


                    comments.forEach(comment => {

                        if (comment.commentText && comment.commentText.trim() !== '') {

                            const commentHTML = `
                            <div class="comment mb-3">
                            <div class="card p-3 m-4">
                                <div class="d-inline-flex">
                                    <p class="text-muted me-4"><i class="bi bi-calendar-event"></i>${comment.created_date}</p>
                                    <p class="text-muted"><i class="bi bi-person"></i>${comment.username}</p>
                                </div>
                                <p class="card-text">${comment.commentText}</p>
                            </div>
                            </div>`;


                            commentList.insertAdjacentHTML('beforeend', commentHTML);
                        }
                    });
                } else {
                    alert('Ошибка: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Ошибка:', error);
                if (error.message.includes('HTTP error!')) {
                    alert(`Ошибка при выполнении запроса. Пожалуйста, попробуйте позже. Код ошибки: ${error.message}`);
                } else {
                    alert('Произошла ошибка при отправке запроса. Проверьте консоль.');
                }
            });
    });
});