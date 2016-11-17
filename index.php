<?php get_header() ?>
<div class="wrapper">
    <div class="row">
        <div class="col-lg-3">
            <p><h4>Find the Store near you: </h4></p>
            <select name="country" id="country_list">
                <option value="0">All</option>
                <?php
                foreach (get_locations() as $country):?>
                    <?php if ($country->parent == 0): ?>
                        <option value="<?php echo $country->term_id ?>"><?php echo $country->name; ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="branchs-list col-lg-9">

            <?php
            foreach (get_locations() as $country):?>
                <?php require('template-part/tamplate-country.php'); ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php get_footer() ?>
