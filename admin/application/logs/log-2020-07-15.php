<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-07-15 14:24:31 --> Severity: Warning --> mysqli::query(): (08S01/1053): Server shutdown in progress /var/www/html/b2bclassified/admin/system/database/drivers/mysqli/mysqli_driver.php 307
ERROR - 2020-07-15 14:24:31 --> Query error: Server shutdown in progress - Invalid query: SELECT c.id,c.name,
        (
        SELECT COUNT(u.id)
            FROM b2b_users u
            JOIN b2b_user_meta um
            ON u.id = um.user_id
            WHERE 1 = 1
        
                AND(
                (um.meta_key = "nationality" AND um.meta_value IS NOT NULL AND um.meta_value = c.id)
                OR (um.meta_key = "Selected_country" AND um.meta_value IS NOT NULL AND um.meta_value = c.id)
                OR (um.meta_key = "user_country" AND um.meta_value IS NOT NULL AND um.meta_value = c.id)
            )
            AND DATE(u.created_at) = CURDATE()
        ) AS reg_users,
        (
        SELECT COUNT(l.id) 
            FROM listings l
            WHERE DATE(l.created_at) = CURDATE()
                AND l.country_id = c.id
        )as posts,
        (
        SELECT COUNT(l.id) 
            FROM listings l
            WHERE DATE(l.created_at) = CURDATE()
                AND l.country_id = c.id
                AND l.status = "enabled"
        )as active_posts,
        (
        SELECT COUNT(l.id) 
            FROM listings l
            WHERE DATE(l.created_at) = CURDATE()
                AND l.country_id = c.id
                AND l.status = "disabled"
        )as inactive_posts
        FROM b2b_countries c
        HAVING reg_users > 0
                OR posts > 0
                OR active_posts > 0
                OR inactive_posts > 0
ERROR - 2020-07-15 17:37:36 --> 404 Page Not Found: Uploads/listing_images
