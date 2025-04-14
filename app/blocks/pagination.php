<?php if ($total_pages > 1): ?>
    <nav class="my-4" aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item <?= ($page == 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="?id=<?= $id ?>&page=<?= $page - 1 ?>" aria-label="Предыдущая">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            <?php
            // Определяем номера страниц для отображения

            // Отображаем предыдущую страницу, если это необходимо
            if ($page > 1) {
                echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '">' . ($page - 1) . '</a></li>';
            }

            // Отображаем текущую страницу
            echo '<li class="page-item active"><span class="page-link">' . $page . '</span></li>';

            // Отображаем следующую страницу, если это необходимо
            if ($page < $total_pages) {
                echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '">' . ($page + 1) . '</a></li>';
            }
            ?>

            <li class="page-item <?= ($page == $total_pages) ? 'disabled' : '' ?>">
                <a class="page-link" href="?id=<?= $id ?>&page=<?= $page + 1 ?>" aria-label="Следующая">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
<?php endif; ?>
