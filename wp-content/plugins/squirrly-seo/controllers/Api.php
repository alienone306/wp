<?php

class SQ_Controllers_Api extends SQ_Classes_FrontController {

    /** @var string token local key */
    private $token;

    /**
     * Initialize the TinyMCE editor for the current use
     *
     * @return void
     */
    public function hookInit() {

        if (SQ_Classes_Helpers_Tools::getOption('sq_api') == '')
            return;

        $this->token = md5(SQ_Classes_Helpers_Tools::getOption('sq_api') . parse_url(home_url(), PHP_URL_HOST));
        //Change the rest api if needed
        add_action('rest_api_init', array($this, 'sqApiCall'));
    }



    function sqApiCall() {
        if (function_exists('register_rest_route')) {
            register_rest_route('save', '/post/', array(
                'methods' => WP_REST_Server::EDITABLE,
                'callback' => array($this, 'savePost'),
            ));

            register_rest_route('test', '/post/', array(
                'methods' => WP_REST_Server::EDITABLE,
                'callback' => array($this, 'testConnection'),
            ));
        }
    }

    /**
     * Test the connection
     * @param WP_REST_Request $request Full details about the request.
     */
    public function testConnection($request) {
        SQ_Classes_Helpers_Tools::setHeader('json');

        //get the token from API
        $token = $request->get_param('token');
        if ($token <> '') {
            $token = sanitize_text_field($token);
        }

        if ($this->token  <> $token) {
            exit(json_encode(array('connected' => false, 'error' => __('Invalid Token. Please try again', _SQ_PLUGIN_NAME_))));
        }

        echo json_encode(array('connected' => true, 'error' => false));
        exit();
    }

    /**
     * Save the Post
     * @param WP_REST_Request $request Full details about the request.
     */
    public function savePost($request) {
        SQ_Classes_Helpers_Tools::setHeader('json');

        //get the token from API
        $token = $request->get_param('token');
        if ($token <> '') {
            $token = sanitize_text_field($token);
        }

        if ($this->token  <> $token) {
            exit(json_encode(array('error' => __('Connection expired. Please try again', _SQ_PLUGIN_NAME_))));
        }

        $post = $request->get_param('post');
        if ($post = json_decode($post)) {
            if (isset($post->ID) && $post->ID > 0) {
                $post = new WP_Post($post);
                $post->ID = 0;
                if (isset($post->post_author)) {
                    if (is_email($post->post_author)) {
                        if ($user = get_user_by('email', $post->post_author)) {
                            $post->post_author = $user->ID;
                        } else {
                            exit(json_encode(array('error' => __('Author not found', _SQ_PLUGIN_NAME_))));
                        }
                    } else {
                        exit(json_encode(array('error' => __('Author not found', _SQ_PLUGIN_NAME_))));
                    }
                } else {
                    exit(json_encode(array('error' => __('Author not found', _SQ_PLUGIN_NAME_))));
                }

                $post_ID = wp_insert_post($post->to_array());
                if (is_wp_error($post_ID)) {
                    echo json_encode(array('error' => $post_ID->get_error_message()));
                } else {
                    echo json_encode(array('saved' => true, 'post_ID' => $post_ID, 'permalink' => get_permalink($post_ID)));
                }
                exit();
            }
        }
        echo json_encode(array('error' => true));
        exit();
    }

}
