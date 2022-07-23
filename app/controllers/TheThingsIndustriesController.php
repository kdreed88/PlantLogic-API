<?php

namespace plantlogic\controllers;

class TheThingsIndustriesController
{
    public function registerDevice()
    {
        // REFERENCE: https://www.thethingsindustries.com/docs/reference/api/end_device/
        // METHOD: POST
        // URL: /api/v3/applications/{end_device.ids.application_ids.application_id}/devices
    }

    public function getDevice()
    {
        // REFERENCE: https://www.thethingsindustries.com/docs/reference/api/end_device/
        // METHOD: GET
        // URL: /api/v3/applications/{end_device_ids.application_ids.application_id}/devices/{end_device_ids.device_id}
    }

    public function updateDevice()
    {
        // REFERENCE: https://www.thethingsindustries.com/docs/reference/api/end_device/
        // METHOD: PUT
        // URL: /api/v3/applications/{end_device.ids.application_ids.application_id}/devices/{end_device.ids.device_id}
    }

    public function deleteDevice()
    {
        // REFERENCE: https://www.thethingsindustries.com/docs/reference/api/end_device/
        // METHOD: DELETE
        // URL: /api/v3/applications/{application_ids.application_id}/devices/{device_id}
    }

    public function listDevices()
    {
        // REFERENCE: https://www.thethingsindustries.com/docs/reference/api/end_device/
        // METHOD: GET
        // URL: /api/v3/applications/{application_ids.application_id}/devices
    }

    public function sendDownlink(int $port, string $device_id, string $payload): void
    {
        $data = json_encode(array(
            "downlinks"=>array(array(
                "frm_payload"=>$payload,
                "f_port"=>$port
            ))
        ));

        // Send CURL request here
        // METHOD: POST
        // URL: /api/v3/as/applications/plapp002/webhooks/default/devices/${devID}/down/push

        // HEADERS

    }
}