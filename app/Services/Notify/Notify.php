<?php

namespace App\Services\Notify;

use App\DTOs\Notify\MessageDTO;
use Session;

class Notify {
    public $data;

    public function __construct(public string $key = 'notify') {
        $this->data = (object)[
            'type' => 'success',
            'confirm_text' => 'Ok',
            'title' => null,
            'message' => '',
        ];
    }

    /**
     * Creates notifier a session or alerts if a message is provided
     *
     * @return void|mixed|App\Services\Notify\Notify
     */
    public function notify(?string $message = null, string $type = 'success', ?string $title = null, string $confirmText = 'Ok') {
        if ($message != null) {
            $this->data->message = $message;
            $this->data->type = $type;
            $this->data->title = $title ?? $this->data->type;
            $this->data->confirm_text = $confirmText;

            return session()->flash($this->key, $this->data);
        }

        return $this;
    }

    public function success(string $message, ?string $title = null, string $confirmText = 'Ok') {
        return $this->notify(
            message: $message,
            type: 'success',
            title: $title,
            confirmText: $confirmText
        );
    }

    public function warning(string $message, ?string $title = null, string $confirmText = 'Ok') {
        return $this->notify(
            message: $message,
            type: 'warning',
            title: $title,
            confirmText: $confirmText
        );
    }

    public function danger(string $message, ?string $title = null, string $confirmText = 'Ok') {
        return $this->notify(
            message: $message,
            type: 'danger',
            title: $title,
            confirmText: $confirmText
        );
    }

    public function error(string $message, ?string $title = null, string $confirmText = 'Ok') {
        return $this->danger(
            message: $message,
            title: $title,
            confirmText: $confirmText
        );
    }
}