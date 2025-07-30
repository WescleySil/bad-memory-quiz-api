<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'answer' => $this->answer,
            'is_correct' => $this->is_correct,
            'question' => $this->question->question,
            'created_at' => Carbon::parse( $this->created_at)->format('Y-m-d H:i:s'),
            ];
    }
}
