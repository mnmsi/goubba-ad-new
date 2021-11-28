<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
// use Illuminate\Http\Resources\Json\JsonResource;


class CampainRecource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'campaign_name'      => $this->campaign_name,
            'campaign_type_name' => $this->campaign_type ? $this->campaign_type->campaign_type_name : null,
            'campaign_active'    => $this->campaign_type ? $this->campaign_type->is_active == 1 ? 'Active' : 'Not Active' : null,
            'total_ad'           => $this->advertisement ? $this->advertisement->count() : null,
            'total_publish_ad'   => $this->advertisement ? $this->advertisement->where('is_active', 'publish')->count() : null,
            'total_pending_ad'   => $this->advertisement ? $this->advertisement->where('is_active', 'pending')->count() : null,
        ];
    }
}
