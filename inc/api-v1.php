<?php

/**
 * Icoda_Api_V1
 *
 */
class Icoda_Api_V1
{
    protected static $instance = null;

    public static function get_instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct()
    {
        add_action('rest_api_init', function () {
            register_rest_route('icoda/v1', '/feedback', [
                'methods'  => 'POST',
                'callback' => [$this, 'feedback_form'],
                'permission_callback' => '__return_true'
            ]);
        });
    }

    function feedback_form(WP_REST_Request $request)
    {
        $site_title = get_bloginfo('name');

        $params = $request->get_params();

        $answers = [];
        $feedback_page_id = $params['feedback_page_id'];
        $icoda_feedback_questions = get_field('icoda_feedback_questions', $feedback_page_id);
        foreach ($icoda_feedback_questions as $index => $question_data) {
            if ($question_data['type'] === 'choise') {
                $param_name = 'goal' . $index;
            } elseif ($question_data['type'] === 'yesno') {
                $param_name = 'recommend' . $index;
            } elseif ($question_data['type'] === 'text' || $question_data['type'] === 'textarea') {
                $param_name = 'overview' . $index;
            }
            $answers[] = [
                'question' => $question_data['question'],
                'answer' => !empty($params[$param_name]) ? $params[$param_name]  : 'N/A'
            ];
        }

        $title = $site_title . ' "Feedback"';

        $headers = array(
            'From: ' . $site_title . ' <post@icoda.io>',
            'content-type: text/html'
        );

        $recipients = [
            'post@icoda.io'
        ];

        $message_email = "";
        foreach ($answers as $answer_data) {
            $message_email .= "<p>" . $answer_data['question'] . ":</p>" . $answer_data['answer'];
        }

        $sended = wp_mail($recipients, $title, $message_email, $headers);

        if (!empty($sended) && !is_wp_error($sended)) {
            $success = 1;
        } else {
            $success = 0;
        }

        $response = [
            'success' => $success,
        ];
        return $response;
    }
}

function icoda_api_v1()
{
    return Icoda_Api_V1::get_instance();
}

// Initialize Icoda_Api_V1
icoda_api_v1();
