document.addEventListener('DOMContentLoaded', function() {
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
document.addEventListener('DOMContentLoaded', function() {
    const followButtons = document.querySelectorAll('.follow-button');
    console.log(followButtons);
    followButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            const authorId = this.dataset.authorId;
            const button = this; // Сохраняем ссылку на кнопку

            fetch('../user/follow.php', { // Проверьте этот путь!
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'authorid=' + encodeURIComponent(authorId) //  Изменили authorid
            })
                .then(response => {
                    if (!response.ok) {
                        // Обработка ошибок HTTP (например, 404, 500)
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json(); // Получаем JSON
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
});
