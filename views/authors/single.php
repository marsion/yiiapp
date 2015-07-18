<?php
$this->title = $author->firstName.' '.$author->lastName;
$this->params['breadcrumbs'][] = ['label' => 'Автори', 'url' => ['/authors']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="authors_single">
    <div class="post">
        <div class="thumbnails">
            <a class="thumb">
                <img src="../css/images/authors/<?php echo $author->img; ?>" alt="" />
            </a>
        </div>
        <div class="post_title">
            <h3>
                <?php echo $author->firstName.' '.$author->lastName; ?>
                <?php echo $author->countryId != 1
                    ? ' ('.$author->originalFirstName.' '.$author->originalLastName.')'
                    : ''; ?>
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