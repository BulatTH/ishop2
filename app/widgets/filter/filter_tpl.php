<?php foreach( $this->groups as $group_id => $group_name): ?>
    <section class="sky-form">
        <h4> <?= $group_name ?> </h4>
        <div class="row1 scroll-pane">
            <div class="col col-4">
                <?php foreach( $this->attrs[$group_id] as $attr_id => $attr_name ): ?>
                <?php
                    if (!empty($filter) && in_array($attr_id, $filter)) {
                        $checked = ' checked';
                    } else {
                        $checked = null;
                    }
                ?>
                    <label class="checkbox">
                        <input type="checkbox" name="checkbox" value="<?= $attr_id ?>" <?= $checked ?> >
                        <i></i>
                        <?= $attr_name ?>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endforeach; ?>

