<?php
use app\helpers\CatalogLinkPager;
?>
<div id="comments">
    <div class="empty_separator"></div>

    <h3 class="left">Коментарі:</h3>

    <p class="right"><a href="#reply">Залишити відгук &#187;</a></p>
    <div class="clearer">&nbsp;</div>
    <?php if (count($comments) > 0) { ?>

        <div class="comment_list">
            <?php foreach ($comments as $comment) { ?>
                <div class="comment">

                    <div class="comment_gravatar left">
                        <img alt="" src="<?php echo Yii::$app->request->baseUrl; ?>/css/img/gravatar.gif" height="64" width="64"/>
                    </div>

                    <div class="comment_author left">
                        <?php echo $comment->user; ?>
                        <div class="comment_date">
                            створено: <?php echo $comment->createdAt; ?> (редаговано: <?php echo $comment->updatedAt; ?> )
                        </div>
                    </div>
                    <div class="clearer">&nbsp;</div>
                    <div class="comment_body">
                        <p><?php echo $comment->text; ?></p>
                    </div>

                </div>
            <?php } ?>
        </div>

        <div class="pagination-pan">
            <?php

            echo CatalogLinkPager::widget([
                'pagination' => $pages,
            ]);

            ?>
        </div>

    <?php } else { ?>
        <div class="no-comments">
            На жаль, тут ще ніхто нічого не написав. Будь першим!
        </div>

    <?php } ?>

    <div id="reply">
        <form action="" method="post" >

            <fieldset>

                <div class="legend"><h3>Залишити відгук</h3></div>

                <div class="form_row">

                    <div class="form_property form_required">Ваше ім'я</div>
                    <div class="form_value"><input type="text" size="32" name="name" value="" /></div>

                    <div class="clearer">&nbsp;</div>

                </div>

                <div class="form_row">

                    <div class="form_property">E-mail</div>
                    <div class="form_value"><input type="text" size="32" name="email" value="" /></div>

                    <div class="clearer">&nbsp;</div>

                </div>

                <div class="form_row">

                    <div class="form_property">Веб-сайт</div>
                    <div class="form_value"><input type="text" size="32" name="website" value="" /></div>

                    <div class="clearer">&nbsp;</div>

                </div>

                <div class="form_row">

                    <div class="form_property form_required">Коментар</div>
                    <div class="form_value"><textarea rows="10" cols="46" name="comment"></textarea></div>

                    <div class="clearer">&nbsp;</div>

                </div>

                <div class="form_row form_row_submit">

                    <div class="form_value"><input type="submit" class="button" value="Відправити" /></div>

                    <div class="clearer">&nbsp;</div>

                </div>

            </fieldset>

        </form>
    </div>
</div>
