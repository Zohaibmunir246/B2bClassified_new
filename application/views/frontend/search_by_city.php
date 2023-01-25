<?php include_once realpath(__DIR__) . '/includes/top_header.php'; ?>
<?php include_once realpath(__DIR__) . '/includes/header.php'; ?>

<section class="main-section search_by_city">
    <div class="container-fluid mainWrapper listingMain buying_page">
        <div class="row">
            <!-- Start Copy From here  -->
            <div class="col-md-8 col-lg-9">
                <h1 class="leads-main-title">Search by City</h1>

                <div class="row">
                    <div class="col-md-12">

                        <?php if (! empty($states)): ?>
                            <?php foreach ($states as $state):
                                ?>

                                <div class="box-leads item-p-<?php echo $state->id; ?>">
                                    <h2><?php echo ucwords($state->name); ?></h2>

                                    <?php if (isset($cities) && ! empty($cities)) : ?>
                                    <ul>
                                        <?php foreach ($cities as $city):
                                            if($state->id === $city->state_id) {
                                        ?>
                                            <li class="child-lead lead-<?php echo $city->state_id; ?>">
                                                <a href="<?php echo base_url('Home/category_by_city') . '?s=' .$city->name; ?>"><?php echo ucwords($city->name); ?></a>
                                            </li>
                                        <?php } ?>
                                        <?php endforeach; ?>
                                    </ul>
                                    <?php endif; ?>
                                </div>

                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>


            <!-- Search -->
            <!-- right side-bar search start -->
            <?php include_once realpath(__DIR__ . '') . '/includes/sidebar-search.php'; ?>
            <!-- right side-bar search end -->
        </div>

    </div>
</section>

<?php include_once realpath(__DIR__ . '') . '/includes/footer.php'; ?>