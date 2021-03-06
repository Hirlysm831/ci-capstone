<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Create_course extends CI_Capstone_Controller
{

        function __construct()
        {
                parent::__construct();
                $this->load->model(array('Course_model', 'Education_model'));
                $this->load->library('form_validation');
                $this->form_validation->set_error_delimiters('<span class="help-inline">', '</span> ');
                $this->breadcrumbs->unshift(2, lang('index_utility_label'), '#');
                $this->breadcrumbs->unshift(3, lang('create_course_heading'), 'create-course');
        }

        /**
         * Function to display index
         * 
         * @author Lloric Garcia
         * @version 2017-2-1
         */
        public function index()
        {
                if ($this->input->post('submit'))
                {
                        $id = $this->Course_model->from_form()->insert();
                        if ($id)
                        {
                                $this->session->set_flashdata('message', bootstrap_success('create_course_succesfully_added_message'));
                                redirect(site_url('courses'), 'refresh');
                        }
                }
                $this->_form_view();
        }

        private function _form_view()
        {
                $this->load->helper('icon');

                $inputs['course_code'] = array(
                    'name'  => 'code',
                    'value' => $this->form_validation->set_value('code'),
                    'type'  => 'text',
                    'lang'  => 'create_course_code_label'
                );

                $inputs['course_icon'] = array(
                    'name'  => 'icon',
                    'value' => bootstrap_icons(),
                    'type'  => 'dropdown',
                    'lang'  => 'create_course_icon_label'
                );

                $inputs['course_color'] = array(
                    'name'  => 'color',
                    'value' => tile_color(),
                    'type'  => 'dropdown',
                    'lang'  => 'create_course_color_label'
                );

                $inputs['course_description'] = array(
                    'name'  => 'desc',
                    'value' => $this->form_validation->set_value('desc'),
                    'type'  => 'text',
                    'lang'  => 'create_course_description_label'
                );

                if ($this->config->item('version_id_generator') == 2)
                {
                        $inputs['course_code_id'] = array(
                            'name'  => 'id',
                            'value' => $this->form_validation->set_value('id'),
                            'type'  => 'text',
                            'lang'  => 'create_course_code_id_label'
                        );
                }

//                $inputs['education_id'] = array(
//                    'name'  => 'educ',
//                    'value' => $this->Education_model->
//                            as_dropdown('education_code')->
//                            set_cache('as_dropdown_education_code')->
//                            get_all(),
//                    'type'  => 'dropdown',
//                    'lang'  => 'create_course_education_label'
//                );

                $data['course_form'] = $this->form_boostrap('create-course/index', $inputs, 'create_course_heading', 'create_course_submit_button_label', 'info-sign', NULL, TRUE);
                $data['bootstrap']   = $this->_bootstrap();
                $this->render('admin/create_course', $data);
        }

        /**
         * 
         * @return array
         *  @author Lloric Garcia <emorickfighter@gmail.com>
         */
        private function _bootstrap()
        {
                /**
                 * for header
                 */
                $header       = array(
                    'css' => array(
                        'css/bootstrap.min.css',
                        'css/bootstrap-responsive.min.css',
                        'css/fullcalendar.css',
                        'css/matrix-style.css',
                        'css/matrix-media.css',
                        'font-awesome/css/font-awesome.css',
                        'css/jquery.gritter.css',
                        'css/jquery.gritter.css',
                        'css/uniform.css',
                        'css/select2.css',
                        'http://fonts.googleapis.com/css?family=Open+Sans:400,700,800'
                    ),
                    'js'  => array(
                    ),
                );
                /**
                 * for footer
                 */
                $footer       = array(
                    'css' => array(
                    ),
                    'js'  => array(
                        'js/jquery.min.js',
                        'js/jquery.ui.custom.js',
                        'js/bootstrap.min.js',
                        'js/bootstrap-colorpicker.js',
                        'js/bootstrap-datepicker.js',
                        'js/jquery.toggle.buttons.js',
                        'js/masked.js',
                        'js/jquery.uniform.js',
                        'js/select2.min.js',
                        'js/matrix.js',
                        'js/matrix.form_common.js',
                        'js/wysihtml5-0.3.0.js',
                        'js/jquery.peity.min.js',
                        'js/bootstrap-wysihtml5.js',
                    ),
                );
                /**
                 * footer extra
                 */
                $footer_extra = '<script type="text/javascript">
        // This function is called from the pop-up menus to transfer to
        // a different page. Ignore if the value returned is a null string:
        function goPage(newURL) {

            // if url is empty, skip the menu dividers and reset the menu selection to default
            if (newURL != "") {

                // if url is "-", it is this page -- reset the menu:
                if (newURL == "-") {
                    resetMenu();
                }
                // else, send page to designated URL            
                else {
                    document.location.href = newURL;
                }
            }
        }

        // resets the menu selection upon entry to this page:
        function resetMenu() {
            document.gomenu.selector.selectedIndex = 2;
        }
</script>';
                return generate_link_script_tag($header, $footer, $footer_extra);
        }

}
