
<x-utils.link-button :href="route('admin.tour.picture.index', $tour)" :text="__('Pictures').' ('.$tour->media_count.')'" />
<x-utils.link-button :href="route('admin.tour.schedule.index', $tour)" :text="__('Schedule')" />
<x-utils.edit-button :href="route('admin.tour.edit', $tour)" />
<x-utils.delete-button :href="route('admin.tour.destroy', $tour)" text="" />
