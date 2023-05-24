<div id="welcome" data-auth="<?php echo $data['auth']; ?>">
    <?php echo $data['title']; ?>
</div>

<div class="section">
        <?php if($data['auth']){ ?>
        <div class="control">
            <div class="control__btn green_btn">add</div>
            <div class="control__btn orange_btn">edit</div>
            <div class="control__btn red_btn">remove</div>
        </div>
        <?php } ?>
    <div class="tree">
        <?php
            echo $data['cat'];
        ?>
    </div>
    <div class="popup" style="display: none;"></div>
</div>