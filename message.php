<?php

class Response {
    public function error($message) {
        $error = [
            'error' => 1,
            'msg' => $message
        ];
        return $error;
    }

    public function errors($message) {
        $error = [
            'error' => 2,
            'msg' => $message
        ];
        return $error;
    }

    public function invalidaccess() {
        $error = [
            'error' => 2,
            'msg' => 'Access Denied'
        ];
        return $error;
    }

    public function success($message = "", $data = "") {
        $meta = [
            'error' => 0,
            'msg' => $message
        ];

        if (!empty($data)) {
            $meta['data'] = $data;
        }
        return $meta;
    }
}
$response = new Response();
?>
