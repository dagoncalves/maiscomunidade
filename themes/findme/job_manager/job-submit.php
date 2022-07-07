<?php
/**
 * Job Submission Form
 */
if ( ! defined( 'ABSPATH' ) ) exit;


global $job_manager;
$submit_action = explode('=', $action);
$last_param = end($submit_action);
?>
<form action="<?php echo esc_url( $action ); ?>" method="post" id="submit-job-form" class="job-manager-form" enctype="multipart/form-data">

    <h3 class="eltd-membership-dashboard-page-title eltd-main-title">
		<?php
		if( isset($last_param) ){
			if( $last_param === 'add-new-listing'){
				esc_html_e( 'Add new listing', 'findme' );
			}else{
				esc_html_e( 'Edit listing', 'findme' );
			}
		}

		?>
    </h3>

        <?php do_action( 'submit_job_form_start' ); ?>

        <?php if ( apply_filters( 'submit_job_form_show_signin', true ) ) : ?>

            <?php get_job_manager_template( 'account-signin.php' ); ?>

        <?php endif; ?>

        <?php if ( job_manager_user_can_post_job() || job_manager_user_can_edit_job( $job_id ) ) : ?>

            <div class="eltd-ls-field-holder">
                <!-- Job Information Fields -->
                <?php do_action( 'submit_job_form_job_fields_start' ); ?>

                <?php

                $counter = 0;
                $limit  = count($job_fields);
                $limiter = round($limit/2);

                foreach ( $job_fields as $key => $field) {
                    $counter++;
                    ?>
                    <fieldset class="fieldset-<?php esc_attr( $key ); ?>">
                        <label for="<?php esc_attr( $key ); ?>"><?php echo wp_kses_post($field['label']) . apply_filters( 'submit_job_form_required_label', $field['required'] ? '' : ' <small>' . esc_html__( '(optional)', 'findme' ) . '</small>', $field ); ?></label>
                        <div class="field <?php echo wp_kses_post($field['required']) ? 'required-field' : ''; ?>">
			                <?php get_job_manager_template( 'form-fields/' . $field['type'] . '-field.php', array( 'key' => $key, 'field' => $field ) ); ?>
                        </div>
                    </fieldset>
                    <?php
                    if($counter == $limiter && $counter !== $limit){ ?>
                        </div>
                        <div class="eltd-ls-field-holder">
                    <?php }

                }  ?>

                <?php do_action( 'submit_job_form_job_fields_end' ); ?>

            </div> <!--close eltd-ls-field-holder-->

            <!-- Company Information Fields -->
            <div class="eltd-ls-field-holder-full-width">
                <?php if ( $company_fields ) : ?>
                <h3 class="eltd-membership-dashboard-page-title eltd-main-title">
                    <?php esc_html_e( 'Company Details', 'findme' ); ?>
                </h3>

                    <?php do_action( 'submit_job_form_company_fields_start' ); ?>

                    <?php foreach ( $company_fields as $key => $field ) : ?>
                        <fieldset class="fieldset-<?php esc_attr( $key ); ?>">
                            <label for="<?php esc_attr( $key ); ?>"><?php echo wp_kses_post($field['label']) . apply_filters( 'submit_job_form_required_label', $field['required'] ? '' : '', $field ); ?></label>
                            <div class="field <?php echo wp_kses_post($field['required']) ? 'required-field' : ''; ?>">
                                <?php get_job_manager_template( 'form-fields/' . $field['type'] . '-field.php', array( 'key' => $key, 'field' => $field ) ); ?>
                            </div>
                        </fieldset>
                    <?php endforeach; ?>

                    <?php do_action( 'submit_job_form_company_fields_end' ); ?>
                <?php endif; ?>
            </div>

            <?php do_action( 'submit_job_form_end' ); ?>

            <p>
                <input type="hidden" name="job_manager_form" value="<?php echo wp_kses_post($form); ?>" />
                <input type="hidden" name="job_id" value="<?php echo esc_attr( $job_id ); ?>" />
                <input type="hidden" name="step" value="<?php echo esc_attr( $step ); ?>" />
                <?php
                    echo findme_elated_get_button_html( array(
                        'text'      => esc_html__( 'Save Changes', 'findme' ),
                        'html_type' => 'input',
                        'size' => 'small',
                        'input_name' => 'submit_job',
                        'custom_attrs' => array(
                            'data-updating-text' => esc_html__('Saving Changes', 'findme'),
                            'data-updated-text' => esc_html__('Changes Saved', 'findme'),
                        )
                    ) );
                ?>
            </p>

	<?php else : ?>

		<?php do_action( 'submit_job_form_disabled' ); ?>

	<?php endif; ?>
        
    
</form>
