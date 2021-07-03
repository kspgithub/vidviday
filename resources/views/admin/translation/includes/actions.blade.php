<x-utils.edit-button :href="route('admin.translation.edit', $language_line->id)" text="" />
@if(current_user()->isMasterAdmin())
<x-utils.delete-button :href="route('admin.translation.destroy', $language_line->id)" text="" />
@endif
