<div class="authors_single">
    <div class="post">
        <div class="thumbnails">
            <a class="thumb">
                <img src="../css/img/sample-thumbnail.jpg" width="220" height="300" alt="" />
            </a>
        </div>
        <div class="post_title">
            <h3>
                <?php echo $author->firstName.' '.$author->lastName; ?>
            </h3>
        </div>
        <div class="post_title">
            <h6>
                <?php echo '('.$author->birthYear.' - '.$author->deathYear.')'; ?></td>
            </h6>
        </div>
        <div class="post_title">
            <h6>
                <?php echo $author->countryName; ?></td>
            </h6>
        </div>
        <div class="post_body">
            <?php echo $author->bio; ?>
        </div>
    </div>
</div>