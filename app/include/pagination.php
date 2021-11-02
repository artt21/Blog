<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item"><a class="page-link" href="?page=1">1</a></li>
        <?php if($page < $pages_count): ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo "?page=".($page + 1);?>">2</a>
            </li>
        <?php endif; ?>
        <li class="page-item"><a class="page-link" href="?page=<?php echo $pages_count; ?>">Last</a></li>
    </ul>
</nav>