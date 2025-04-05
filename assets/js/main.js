document.addEventListener('DOMContentLoaded', function() {
    const heartButton = document.getElementById('heart-button');
    const heartIcon = document.getElementById('heart-icon');
    const postId = heartButton.dataset.postId;

    heartButton.addEventListener('click', function(e) {
        e.preventDefault();


        fetch('../user/like.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'id_post=' + encodeURIComponent(postId)
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
                } else {
                    alert('Ошибка: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Ошибка:', error);
                alert('Произошла ошибка при отправке запроса.');
            });
    });
});