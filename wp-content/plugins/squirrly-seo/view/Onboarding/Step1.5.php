<?php
add_filter('sq_themes', array(SQ_Classes_ObjController::getClass('SQ_Models_ImportExport'), 'getAvailableThemes'));
add_filter('sq_plugins', array(SQ_Classes_ObjController::getClass('SQ_Models_ImportExport'), 'getAvailablePlugins'));
$platforms = apply_filters('sq_importList', false);

$next_step = 'step4';
if ($platforms && count((array)$platforms) > 0) {
    $next_step = 'step3';
}
?>
<div id="sq_wrap">
    <div class="d-flex flex-row my-0 bg-white" style="clear: both !important;">
        <?php echo SQ_Classes_ObjController::getClass('SQ_Models_Menu')->getAdminTabs('step1.1', 'sq_onboarding'); ?>
        <div class="sq_row d-flex flex-row bg-white px-3">
            <div class="sq_col flex-grow-1 mr-3">

                <div class="card col-sm-12 p-0">
                    <div class="card-body p-2 bg-title rounded-top row">
                        <div class="col-sm-6 m-0 p-0 py-2 bg-title rounded-top">
                            <div class="sq_icons sq_squirrly_icon m-1 mx-3"></div>
                            <h3 class="card-title"><?php _e('Google SERP Checker', _SQ_PLUGIN_NAME_); ?></h3>
                        </div>
                        <div class="col-sm-6 m-0 p-0 py-2 text-right">
                            <a href="<?php echo SQ_Classes_Helpers_Tools::getAdminUrl('sq_onboarding', $next_step) ?>" class="btn rounded-0 btn-success btn-lg px-3 mx-2 float-sm-right"><?php _e('Next Feature >', _SQ_PLUGIN_NAME_); ?></a>
                            <a href="<?php echo SQ_Classes_Helpers_Tools::getAdminUrl('sq_rankings', 'rankings') ?>" target="_blank" class="btn rounded-0 btn-info btn-lg px-3 mx-2 float-sm-right"><?php _e('See Rankings', _SQ_PLUGIN_NAME_); ?></a>
                        </div>
                    </div>
                    <div class="card col-sm-12 p-0 m-0 border-0  border-0">
                        <div class="card-body p-0">
                            <div class="col-sm-12 m-0 p-0">
                                <div class="card col-sm-12 p-0 border-0 ">

                                    <div class="col-sm-12 pt-0 pb-4 ">

                                        <div class="col-sm-12 card-title py-3 text-success text-center" style="font-size: 24px; line-height: 30px"><?php _e("Accurately Track Your Rankings with Squirrly’s User-Friendly Google SERP Checker", _SQ_PLUGIN_NAME_); ?></div>

                                        <div class="col-sm-12 my-3 clear text-center">
                                            <img src="https://storage.googleapis.com/squirrly/images/serp-checker.gif" class="img-fluid img-thumbnail" style="max-width: 90%; margin: auto;">

                                        </div>

                                        <div class="col-sm-12 card-title py-3  text-center">
                                           <a href="https://plugin.squirrly.co/google-serp-checker/" target="_blank"  class="btn rounded-0 btn-info btn-lg px-5 mx-3"><?php _e("Read more about this feature >", _SQ_PLUGIN_NAME_); ?></a>
                                        </div>

                                        <div class="col-sm-12 m-0 mt-3 p-0 py-2 text-right border-top">
                                            <a href="<?php echo SQ_Classes_Helpers_Tools::getAdminUrl('sq_onboarding', $next_step) ?>" class="btn rounded-0 btn-success btn-lg px-3 mx-4 float-sm-right"><?php _e('Next Feature >', _SQ_PLUGIN_NAME_); ?></a>
                                            <a href="<?php echo SQ_Classes_Helpers_Tools::getAdminUrl('sq_onboarding', 'step4') ?>" class="btn btn-default btn-lg px-3 mx-1 text-secondary float-sm-left rounded-0"><?php _e('Close Tutorial', _SQ_PLUGIN_NAME_); ?></a>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
</div>
</div>
