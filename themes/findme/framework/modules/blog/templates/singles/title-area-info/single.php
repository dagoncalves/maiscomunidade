<?php

findme_elated_get_single_post_format_html($blog_single_type);

findme_elated_get_module_template_part('templates/parts/single/author-info', 'blog');

findme_elated_get_module_template_part('templates/parts/single/related-posts', 'blog', '', $single_info_params);

findme_elated_get_module_template_part('templates/parts/single/comments', 'blog');