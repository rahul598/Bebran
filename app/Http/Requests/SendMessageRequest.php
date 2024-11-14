<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendMessageRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {

        if ($this->media_file && $this->media_file == '1'):
            if ($this->message_type == '2'):
                return [
                    'receiver_id' => 'required|numeric',
                    'message_type' => 'required|numeric',
                    'file_name' => 'required|mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi|max:20480',
                ];
            elseif ($this->message_type == '4'):
                return [
                    'message_type' => 'required|numeric',
                    'file_name' => 'required|mimes:jpeg,jpg,png,gif,svg|max:15360',
                    'receiver_id' => 'required|numeric',
                ];
            elseif ($this->message_type == '5'):
                return [
                    'message_type' => 'required|numeric',
                    'file_name' => 'required|max:15360',
                    'receiver_id' => 'required|numeric',
                ];

            endif;
        else:
            return[
                'receiver_id' => 'required|numeric',
                'message' => 'required',
            ];
        endif;
    }

    public function messages() {
        parent::messages();

        if ($this->media_file):

            if ($this->message_type == '2'):
                return [
                    'message_type.required' => 'Please upload a video type file',
                    'file_name.mimetypes' => 'Please upload a valid video type file',
                    'file_name.max' => 'Uploaded video file may not be greater than 20MB',
                ];
            elseif ($this->message_type == '4'):
                return [
                    'message_type.required' => 'Please upload a image file',
                    'file_name.mimes' => 'Please upload a valid image type file',
                    'file_name.max' => 'Uploaded image may not be greater than 15MB'
                ];
            elseif ($this->message_type == '5'):
                return [
                    'message_type.required' => 'Please upload a file',
                    'file_name.max' => 'Uploaded image may not be greater than 15MB'
                ];
            endif;
        else:
            return[
                'message_type.required' => '',
            ];

        endif;
    }

}
