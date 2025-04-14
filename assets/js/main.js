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