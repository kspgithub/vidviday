

<x-forms.text-group name="title" :label="__('Title')" :value="old('title', $menuItem->title)" maxlength="100" required ></x-forms.text-group>
<x-forms.text-group name="slug" :label="__('Url')" :value="old('slug', $menuItem->slug)" maxlength="100" :help="__('Leave blank for automatic generation')" ></x-forms.text-group>

<x-forms.text-group name="position" :label="__('Position')" :value="old('position', $menuItem->position)" type="number" required></x-forms.text-group>

<x-forms.switch-group name="active" :label="__('Active')" :active="$menuItem->active"></x-forms.switch-group>

<x-forms.select-default-group name="parent_id" :label="__('Parent menu item')" :value="old('parent_id', $menuItem->parent_id)" :options="$parentMenuItems" type="number"></x-forms.select-default-group>

<x-forms.select-group name="menu_id" :label="__('Parent menu')" :value="old('menu_id', $menuItem->menu_id)" :options="$menus" type="number"></x-forms.select-group>






