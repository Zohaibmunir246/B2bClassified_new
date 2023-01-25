<?php include_once realpath(__DIR__) . '/includes/top_header.php'; ?>
<?php include_once realpath(__DIR__) . '/includes/header.php'; ?>

<section class="main-section cat_by_city">
    <div class="container-fluid mainWrapper listingMain buying_page">
        <div class="row">
            <!-- Start Copy From here  -->
            <div class="col-md-8 col-lg-9">
                <h1 class="leads-main-title">Search by Category</h1>

                <div class="row">
                    <div class="col-md-12">
                        <ul class="cat_city masonry">
                        <?php foreach ((array)$categories as $category):
                            $category_parent = $category['parent'];
                            $category_childs = $category['childs'];

                            // Skipping Buying Lead and Seller Lead
                            if ($category_parent->slug === 'buying-lead' || $category_parent->slug === 'seller-lead'){
                                continue;
                            }

                            $cat_slug = empty($category_parent->slug) ? '#' : base_url($category_parent->slug);
                            ?>

                                <li class="item box-leads item-p-<?php echo $category_parent->id; ?>">
                                    <h2><?php echo ucwords($category_parent->name); ?></h2>
                                    <ul class="cat_city_blk">
                                    <?php  foreach ($category_childs as $key => $child): ?>
                                    
                                        <?php $child_cat_slug = empty($child->slug) ? '#' : $child->slug;
                                        ?>
                                            <li class="child-lead lead-">
                                                <a href="<?php echo base_url() . '?s=' . $child_cat_slug .'-in-' . $city; ?>"><?php echo ucwords($child->name) . ' in ' . $city; ?></span>
                                        	</a>
                                            </li>
                                    
                                    <?php endforeach; ?>
                                    </ul>
                                </li>

                            <?php endforeach; ?>
                        </ul>
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
