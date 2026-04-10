@props(['status'])

@if($status === 'published')
    <span class="badge bg-success">Published</span>
@else
    <span class="badge bg-secondary">Draft</span>
@endif