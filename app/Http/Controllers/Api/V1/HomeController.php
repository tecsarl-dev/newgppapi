<?php 
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __invoke(): array
    {
        return [
            'success' => true,
            'message' => __('message.welcome'),
            'data' => [
                'service' => 'GPP API',
                'version' => '1.0.0',
                'language' => app()->getLocale(),
                'support' => 'contact@gpp-control.com'
            ]
        ];
    }
}