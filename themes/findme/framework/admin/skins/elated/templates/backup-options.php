<div class="eltd-tabs-content">
	<div class="tab-content">
		<div class="tab-pane fade in active" id="import">
			<div class="eltd-tab-content">
				<h2 class="eltd-page-title"><?php esc_html_e('Backup Options', 'findme'); ?></h2>
				<form method="post" class="eltd_ajax_form eltd-backup-options-page-holder">
					<div class="eltd-page-form">
						<div class="eltd-page-form-section-holder">
							<h3 class="eltd-page-section-title"><?php esc_html_e('Export/Import Options', 'findme'); ?></h3>
							<div class="eltd-page-form-section">
								<div class="eltd-field-desc">
									<h4><?php esc_html_e('Export', 'findme'); ?></h4>
									<p><?php esc_html_e('Copy the code from this field and save it to a textual file to export your options. Save that textual file somewhere so you can later use it to import options if necessary.', 'findme'); ?></p>
								</div>
								<div class="eltd-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="export_options" id="export_options" class="form-control eltd-form-element" rows="10" readonly><?php echo eltd_core_export_options(); ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="eltd-page-form-section">
								<div class="eltd-field-desc">
									<h4><?php esc_html_e('Import', 'findme'); ?></h4>
									<p><?php esc_html_e('To import options, just paste the code you previously saved from the "Export" field into this field, and then click the "Import" button.', 'findme'); ?></p>
								</div>
								<div class="eltd-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="import_theme_options" id="import_theme_options" class="form-control eltd-form-element" rows="10"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="eltd-page-form-section">
								<div class="eltd-field-desc">
									<button type="button" class="btn btn-primary btn-sm " name="import" id="eltd-import-theme-options-btn"><?php esc_html_e('Import', 'findme'); ?></button>
									<?php wp_nonce_field('eltd_import_theme_options_secret_value', 'eltd_import_theme_options_secret', false); ?>
									<span class="eltd-bckp-message"></span>
								</div>
							</div>
							<div class="eltd-page-form-section eltd-import-button-wrapper">
								<div class="alert alert-warning">
									<strong><?php esc_html_e('Important notes:', 'findme') ?></strong>
									<ul>
										<li><?php esc_html_e('Please note that import process will overide all your existing options.', 'findme'); ?></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="eltd-page-form-section-holder">
							<h3 class="eltd-page-section-title"><?php esc_html_e('Export/Import Custom Sidebars', 'findme'); ?></h3>
							<div class="eltd-page-form-section">
								<div class="eltd-field-desc">
									<h4><?php esc_html_e('Export', 'findme'); ?></h4>
									<p><?php esc_html_e('Copy the code from this field and save it to a textual file to export your options. Save that textual file somewhere so you can later use it to import options if necessary.', 'findme'); ?></p>
								</div>
								<div class="eltd-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="export_options" id="export_options" class="form-control eltd-form-element" rows="10" readonly><?php echo eltd_core_export_custom_sidebars(); ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="eltd-page-form-section">
								<div class="eltd-field-desc">
									<h4><?php esc_html_e('Import', 'findme'); ?></h4>
									<p><?php esc_html_e('To import options, just paste the code you previously saved from the "Export" field into this field, and then click the "Import" button.', 'findme'); ?></p>
								</div>
								<div class="eltd-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="import_custom_sidebars" id="import_custom_sidebars" class="form-control eltd-form-element" rows="10"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="eltd-page-form-section">
								<div class="eltd-field-desc">
									<button type="button" class="btn btn-primary btn-sm " name="import" id="eltd-import-custom-sidebars-btn"><?php esc_html_e('Import', 'findme'); ?></button>
									<?php wp_nonce_field('eltd_import_custom_sidebars_secret_value', 'eltd_import_custom_sidebars_secret', false); ?>
									<span class="eltd-bckp-message"></span>
								</div>
							</div>
							<div class="eltd-page-form-section eltd-import-button-wrapper">
								<div class="alert alert-warning">
									<strong><?php esc_html_e('Important notes:', 'findme') ?></strong>
									<ul>
										<li><?php esc_html_e('Please note that import process will override all your existing custom sidebars.', 'findme'); ?></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="eltd-page-form-section-holder">
							<h3 class="eltd-page-section-title"><?php esc_html_e('Export/Import Widgets', 'findme'); ?></h3>
							<div class="eltd-page-form-section">
								<div class="eltd-field-desc">
									<h4><?php esc_html_e('Export', 'findme'); ?></h4>
									<p><?php esc_html_e('Copy the code from this field and save it to a textual file to export your options. Save that textual file somewhere so you can later use it to import options if necessary.', 'findme'); ?></p>
								</div>
								<div class="eltd-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="export_widgets" id="export_widgets" class="form-control eltd-form-element" rows="10" readonly><?php echo eltd_core_export_widgets_sidebars(); ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="eltd-page-form-section">
								<div class="eltd-field-desc">
									<h4><?php esc_html_e('Import', 'findme'); ?></h4>
									<p><?php esc_html_e('To import options, just paste the code you previously saved from the "Export" field into this field, and then click the "Import" button.', 'findme'); ?></p>
								</div>
								<div class="eltd-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="import_widgets" id="import_widgets" class="form-control eltd-form-element" rows="10"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="eltd-page-form-section">
								<div class="eltd-field-desc">
									<button type="button" class="btn btn-primary btn-sm " name="import" id="eltd-import-widgets-btn"><?php esc_html_e('Import', 'findme'); ?></button>
									<?php wp_nonce_field('eltd_import_widgets_secret_value', 'eltd_import_widgets_secret', false); ?>
									<span class="eltd-bckp-message"></span>
								</div>
							</div>
							<div class="eltd-page-form-section eltd-import-button-wrapper">
								<div class="alert alert-warning">
									<strong><?php esc_html_e('Important notes:', 'findme') ?></strong>
									<ul>
										<li><?php esc_html_e('Please note that import process will override all your existing widgets.', 'findme'); ?></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>