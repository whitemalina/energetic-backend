<?php

namespace App\Http\Resources;

use App\Models\Organization;
use App\Models\Project;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $organization = Organization::all()->where('id', '=', $this->organization_id);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'geotag' => $this->geotag,
            'photo_url' => $this->photo_url,
            'scheme_url' => $this->scheme_url,
            'risks' => $this->risks,
            'security' => $this->security,
            'project' => ProjectResource::make(Project::find($this->project_id)),
        ];
    }
}
