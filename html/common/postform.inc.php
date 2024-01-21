<?php

 /* Copyright 2020-2023 Arsentyev Igor(https://rebirth-edu.ru).
     * Файлы проекта для социальной сети Rebirth, проект в рамках выполнения дипломной работы студента.
     * Разработка является тестовой, сроки тестирования до 01/03/2024.
     * Данный проект может быть использован только после разрешения правообладателем.
     */

if (!defined("APP_SIGNATURE")) {

    header("Location: /");
    exit;
}

?>

<div class="card">

    <div class="card-header">
        <h3 class="card-title"><?php echo $LANG['label-create-post']; ?></h3>
    </div>

    <div class="remotivation_block mb-4" style="display:none">
        <h1><?php echo $LANG['msg-post-sent']; ?></h1>

        <button onclick="Profile.showPostForm(); return false;" class="button blue primary_btn"><?php echo $LANG['action-another-post']; ?></button>

    </div>

    <?php

        $s_username = auth::getCurrentUserLogin();

        if (isset($profileInfo)) {

            $s_username = $profileInfo['username'];
        }
    ?>

    <form onsubmit="Profile.post('<?php echo $s_username; ?>'); return false;" class="profile_question_form" action="/<?php echo $s_username; ?>/post" method="post">

        <input autocomplete="off" type="hidden" name="authenticity_token" value="<?php echo auth::getAuthenticityToken(); ?>">
        <input autocomplete="off" type="hidden" name="access_mode" value="0">

        <a href="/<?php echo auth::getCurrentUserUsername(); ?>" class="avatar" style="background-image:url(<?php echo auth::getCurrentUserPhotoUrl(); ?>)"></a>

        <?php

            if (isset($page_id) && $page_id === 'group') {

                if ($myPage) {

                    ?>
                    <a href="/<?php echo $s_username; ?>" class="avatar" style="background-image:url(<?php echo $profilePhotoUrl; ?>)"></a>
                    <?php
                }
            }
        ?>

        <div class="mb-2" style="margin-left: 60px; display: block; position: relative">

            <textarea name="postText" maxlength="1000" placeholder="<?php echo $LANG['label-placeholder-post']; ?>"></textarea>



            <div class="dropdown emoji-dropdown dropup" style="">

                <span class="smile-button btn-emoji-picker" data-toggle="dropdown">
                    <i class="btn-emoji-picker-icon iconfont icofont-slightly-smile"></i>
                </span>

                <div class="dropdown-menu dropdown-menu-right mt-2">
                    <div class="emoji-items">
                        <div class="emoji-item">😀</div>
                        <div class="emoji-item">😁</div>
                        <div class="emoji-item">😂</div>
                        <div class="emoji-item">😃</div>
                        <div class="emoji-item">😄</div>
                        <div class="emoji-item">😅</div>
                        <div class="emoji-item">😆</div>
                        <div class="emoji-item">😉</div>
                        <div class="emoji-item">😊</div>
                        <div class="emoji-item">😋</div>
                        <div class="emoji-item">😎</div>
                        <div class="emoji-item">😍</div>
                        <div class="emoji-item">😘</div>
                        <div class="emoji-item">🤗</div>
                        <div class="emoji-item">🤩</div>
                        <div class="emoji-item">🤔</div>
                        <div class="emoji-item">🤨</div>
                        <div class="emoji-item">😐</div>
                        <div class="emoji-item">🙄</div>
                        <div class="emoji-item">😏</div>
                        <div class="emoji-item">😣</div>
                        <div class="emoji-item">😥</div>
                        <div class="emoji-item">😮</div>
                        <div class="emoji-item">🤐</div>
                        <div class="emoji-item">😯</div>
                        <div class="emoji-item">😪</div>
                        <div class="emoji-item">😫</div>
                        <div class="emoji-item">😴</div>
                        <div class="emoji-item">😌</div>
                        <div class="emoji-item">😜</div>
                        <div class="emoji-item">🤤</div>
                        <div class="emoji-item">😓</div>
                        <div class="emoji-item">😔</div>
                        <div class="emoji-item">🤑</div>
                        <div class="emoji-item">😲</div>
                        <div class="emoji-item">🙁</div>
                        <div class="emoji-item">😖</div>
                        <div class="emoji-item">😞</div>
                        <div class="emoji-item">😟</div>
                        <div class="emoji-item">😤</div>
                        <div class="emoji-item">😢</div>
                        <div class="emoji-item">😭</div>
                        <div class="emoji-item">😦</div>
                        <div class="emoji-item">😧</div>
                        <div class="emoji-item">😨</div>
                        <div class="emoji-item">😩</div>
                        <div class="emoji-item">😰</div>
                        <div class="emoji-item">😱</div>
                        <div class="emoji-item">😳</div>
                        <div class="emoji-item">🤪</div>
                        <div class="emoji-item">😵</div>
                        <div class="emoji-item">😡</div>
                        <div class="emoji-item">😠</div>
                        <div class="emoji-item">🤬</div>
                        <div class="emoji-item">😷</div>
                        <div class="emoji-item">🤒</div>
                        <div class="emoji-item">🤕</div>
                        <div class="emoji-item">🤢</div>
                        <div class="emoji-item">🤮</div>
                        <div class="emoji-item">🤧</div>
                        <div class="emoji-item">😇</div>
                        <div class="emoji-item">🤠</div>
                        <div class="emoji-item">🤡</div>
                        <div class="emoji-item">🤥</div>
                        <div class="emoji-item">🤫</div>
                        <div class="emoji-item">🤭</div>
                        <div class="emoji-item">🧐</div>
                        <div class="emoji-item">🤓</div>
                        <div class="emoji-item">😈</div>
                        <div class="emoji-item">👿</div>
                    </div>
                </div>
            </div>

            <div class="popover top popover-emoji bs-popover-top fade hidden bs-popover-top-right" data-toggle="popover-emoji">
                <div class="arrow" style="right: 15px;"></div>
                <div class="popover-body p-1" >

                </div>
            </div>

        </div>

        <div class="img_container">

            <div class="img-items-list-page d-inline-block w-100" style="">

            </div>

        </div>

        <div class="form_actions">

            <div class="item-image-progress hidden">
                <div class="progress-bar " role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>

            <div class="item-actions">

                <div class="btn btn-secondary item-image-action-button item-add-image">
                    <input type="file" id="item-image-upload" name="uploaded_file">
                    <i class="iconfont icofont-ui-image mr-1"></i>
                    <?php echo $LANG['action-add-img']; ?>
                </div>

                <span id="word_counter" style="display: none">1000</span>


                <?php

                    if (isset($page_id) && $page_id != 'group') {

                        ?>
                        <div class="d-inline-block align-top">

                            <span class="dropdown" style="display: inline-block;">
                                <button type="button" class="button flat_btn change-post-mode-button dropdown-toggle mb-sm-0" data-toggle="dropdown" style="padding: 10px; font-size: 12px;">
                                    <i class="iconfont icofont-earth mr-1"></i>
                                    <span><?php echo $LANG['action-access-mode-all']; ?></span>
                                </button>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item access-mode-all-button" onclick="Profile.changePostMode(0); return false;"><?php echo $LANG['action-access-mode-all']; ?></a>
                                    <a class="dropdown-item access-mode-friends-button" onclick="Profile.changePostMode(1); return false;"><?php echo $LANG['action-access-mode-friends']; ?></a>
                                </div>
                            </span>

                        </div>
                        <?php
                    }
                ?>

                <button style="padding: 7px 16px;" class="primary_btn blue" value="ask"><?php echo $LANG['action-post']; ?></button>

            </div>

        </div>
    </form>

</div>