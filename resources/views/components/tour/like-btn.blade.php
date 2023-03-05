@props(['tour' => null])

<div v-is="'tour-like-btn'"
     :tour-id='@json($tour->id)'
></div>
