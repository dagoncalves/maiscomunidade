<?php
$eltd_sidebar_layout  = findme_elated_sidebar_layout();

get_header();
//findme_elated_get_title();
get_template_part('slider');

$query = new WP_Query( array( 
    'post_type' => 'team-member',
    'post_status'   => 'publish',
    'orderby' => 'menu_order title',
    'order'          => 'ASC',
    'posts_per_page' => -1
) );

$lideres_ES = array();
$lideres_MG = array();
?>
<div class="eltd-title  eltd-standard-type eltd-content-center-alignment eltd-preload-background eltd-has-background eltd-has-responsive-background eltd-title-image-responsive" style="height:530px;background-color:#007e7a;" data-height="530">
    <div class="eltd-title-image">
        <img itemprop="image" src="https://maiscomunidade.vc/plataforma/wp-content/uploads/2021/11/fundo_liderancas-scaled.jpg" alt="Title Image">
    </div>
    <div class="eltd-title-holder">
        <div class="eltd-container clearfix">
            <div class="eltd-container-inner">
                <div class="eltd-title-subtitle-holder" style="">
                    <div class="eltd-title-subtitle-holder-inner">
                        <h1 class="eltd-page-title entry-title" style="color:#ffffff;"><span>Intercâmbio de Lideranças</span></h1>
                        <span class="eltd-subtitle" style="color:#ffffff;"><span>Conheça algumas das lideranças que já fazem parte dessa jornada.</span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="eltd-container eltd-default-page-template">
	<?php do_action('findme_elated_after_container_open'); ?>
	<div class="">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="eltd-grid-row">
				<div <?php echo findme_elated_get_content_sidebar_class(); ?>>
                    <?php 
                    if ($query->posts) :
                        foreach ($query->posts as $key => $member) :
                            $title = $member->post_title;
                            $email = get_post_meta( $member->ID, 'eltd_team_member_email', true );
                            $cidade = get_post_meta( $member->ID, 'eltd_team_member_position', true );
                            $image_elatedteam = wp_get_attachment_image_src( get_post_thumbnail_id($member->ID), 'medium' );
                            $pagina = get_permalink($member->ID);
                            $participacoes = get_post_meta( $member->ID, 'eltd_team_member_participacoes', true );
                            //$image_avatar = get_avatar_url($profileuser->ID, ['size' => '170']);

                            if($email):
                                $user = get_user_by('email', $email);
                                $uf   = $user->uf ?? '';
                                //$profileuser = get_userdata( $user->ID );
                                //$image = strpos($image_avatar,'gravatar.com') === false  ? $image_avatar : $image_elatedteam[0];
                                $image = $image_elatedteam[0] ?? '';
                                
                                if(!empty($uf)):
                                    if($image==='' && $uf==='ES') {
                                        $image = get_template_directory_uri() . "/assets/img/avatar_laranja.png";
                                    } else if($image==='' && $uf==='MG') {
                                        $image = get_template_directory_uri() . "/assets/img/avatar_verde.png";
                                    }

                                    $lider = array(
                                        "nome" => $title,
                                        "email" => $email,
                                        "cidade" => $cidade,
                                        "uf" => $uf,
                                        "foto" => $image,
                                        "pagina" => $pagina,
                                        "participacoes" => $participacoes,
                                    );

                                    if($uf==='ES')
                                        $lideres_ES[] = $lider;

                                    if($uf==='MG')
                                        $lideres_MG[] = $lider;
 
                                endif;
                            endif;
                        endforeach;
                    endif;
                    ?>
                    <!-- MG -->
                    <div class="" style="background-color: #e37222; display: flex; flex-direction: row; padding: 40px 20px">
                        <div class="eltd-section-title-holder" style="text-align: center; width: 25%">
                            <h1 class="eltd-st-title" style="color: #ffffff; margin-top: 100px">
                                <span class="eltd-section-title-inner-wrapper">Minas Gerais</span>
                            </h1>
                        </div>
                        <div style="display: flex; flex-wrap: wrap; width: 75%">
                        <?php 
                        foreach ($lideres_MG as $lider) :
                            ?>
                                <div class="eltd-team info-hover" style="width: 300px; height: 225px; padding: 10px; position: relative">
                                    <?php if($lider["participacoes"]==='1'): ?><img style="position: absolute; width: 64px; height: 64px; bottom: 0px; z-index: 1" src="<?php echo esc_attr( get_template_directory_uri() . "/assets/img/Emblema_1_Encontro_Bronze.png" ); ?>" alt="" width="64"><?php endif; ?>
                                    <?php if($lider["participacoes"]==='2'): ?><img style="position: absolute; width: 64px; height: 64px; bottom: 0px; z-index: 2" src="<?php echo esc_attr( get_template_directory_uri() . "/assets/img/Emblema_2_Encontros_Prata.png" ); ?>" alt="" width="64"><?php endif; ?>
                                    <?php if($lider["participacoes"]==='3'): ?><img style="position: absolute; width: 64px; height: 64px; bottom: 0px; z-index: 3" src="<?php echo esc_attr( get_template_directory_uri() . "/assets/img/Emblema_3_Encontros_Ouro.png" ); ?>" alt="" width="64"><?php endif; ?>
                                    <div class="eltd-team-inner">
                                        <div class="eltd-team-image" style="">
                                            <img style="width: 300px; height: 225px;" src="<?php echo esc_attr( $lider["foto"] ); ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" loading="lazy" srcset="<?php echo esc_attr( $lider["foto"] ); ?> 800w, <?php echo esc_attr( $lider["foto"] ); ?> 300w, <?php echo esc_attr( $lider["foto"] ); ?> 768w, <?php echo esc_attr( $lider["foto"] ); ?> 600w" sizes="(max-width: 800px) 100vw, 800px" width="300" height="225">
                                            <div class="eltd-team-info-tb">
                                                <div class="eltd-team-info-tc">
                                                    <div class="eltd-team-title-holder">
                                                        <h4 itemprop="name" class="eltd-team-name entry-title">
                                                            <a itemprop="url" href="<?php echo esc_attr( $lider["pagina"] ); ?>"><?php echo esc_attr( $lider["nome"] ); ?></a>
                                                        </h4>
                                                        <h6 class="eltd-team-position"><?php echo esc_attr( $lider["cidade"] ); ?></h6>
                                                    </div>
                                                    <div class="eltd-team-social-holder-between">
                                                        <div class="eltd-team-social">
                                                            <div class="eltd-team-social-inner">
                                                                <div class="eltd-team-social-wrapp">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php 
                        endforeach;
                        ?>
                        </div>
                    </div>

                    <!-- ES -->
                    <div class="" style="background-color: #178272; display: flex; flex-direction: row; padding: 40px 20px">
                        <div class="eltd-section-title-holder" style="text-align: center; width: 25%">
                            <h1 class="eltd-st-title" style="color: #ffffff; margin-top: 100px">
                                <span class="eltd-section-title-inner-wrapper">Espírito Santo</span>
                            </h1>
                        </div>
                        <div style="display: flex; flex-wrap: wrap; width: 75%">
                        <?php 
                        foreach ($lideres_ES as $lider) :
                            ?>
                                <div class="eltd-team info-hover" style="width: 300px; height: 225px; padding: 10px; position: relative">
                                    <?php if($lider["participacoes"]==='1'): ?><img style="position: absolute; width: 64px; height: 64px; bottom: 0px; z-index: 1" src="<?php echo esc_attr( get_template_directory_uri() . "/assets/img/Emblema_1_Encontro_Bronze.png" ); ?>" alt="" width="64"><?php endif; ?>
                                    <?php if($lider["participacoes"]==='2'): ?><img style="position: absolute; width: 64px; height: 64px; bottom: 0px; z-index: 2" src="<?php echo esc_attr( get_template_directory_uri() . "/assets/img/Emblema_2_Encontros_Prata.png" ); ?>" alt="" width="64"><?php endif; ?>
                                    <?php if($lider["participacoes"]==='3'): ?><img style="position: absolute; width: 64px; height: 64px; bottom: 0px; z-index: 3" src="<?php echo esc_attr( get_template_directory_uri() . "/assets/img/Emblema_3_Encontros_Ouro.png" ); ?>" alt="" width="64"><?php endif; ?>
                                    <div class="eltd-team-inner">
                                        <div class="eltd-team-image" style="">
                                            <img style="width: 300px; height: 225px;" src="<?php echo esc_attr( $lider["foto"] ); ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" loading="lazy" srcset="<?php echo esc_attr( $lider["foto"] ); ?> 800w, <?php echo esc_attr( $lider["foto"] ); ?> 300w, <?php echo esc_attr( $lider["foto"] ); ?> 768w, <?php echo esc_attr( $lider["foto"] ); ?> 600w" sizes="(max-width: 800px) 100vw, 800px" width="300" height="225">
                                            <div class="eltd-team-info-tb">
                                                <div class="eltd-team-info-tc">
                                                    <div class="eltd-team-title-holder">
                                                        <h4 itemprop="name" class="eltd-team-name entry-title">
                                                            <a itemprop="url" href="<?php echo esc_attr( $lider["pagina"] ); ?>"><?php echo esc_attr( $lider["nome"] ); ?></a>
                                                        </h4>
                                                        <h6 class="eltd-team-position"><?php echo esc_attr( $lider["cidade"] ); ?></h6>
                                                    </div>
                                                    <div class="eltd-team-social-holder-between">
                                                        <div class="eltd-team-social">
                                                            <div class="eltd-team-social-inner">
                                                                <div class="eltd-team-social-wrapp">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php 
                        endforeach;
                        ?>
                        </div>
                    </div>

					<?php
						//the_content();
						do_action('findme_elated_page_after_content');
					?>
				</div>
				<?php if($eltd_sidebar_layout !== 'no-sidebar') { ?>
					<div <?php echo findme_elated_get_sidebar_holder_class(); ?>>
						<?php get_sidebar(); ?>
					</div>
				<?php } ?>
			</div>
		<?php endwhile; endif; ?>
	</div>
	<?php do_action('findme_elated_before_container_close'); ?>
</div>
<?php get_footer(); ?>