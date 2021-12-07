<x-bootstrap.card>
    <x-slot name="body">

        <x-forms.translation-switch/>

        <x-forms.textarea-loc-group name="title" :label="__('Title')"
                                    :value="old('title', $banner->getTranslations('title'))"
                                    rows="2"
                                    required></x-forms.textarea-loc-group>

        <x-forms.text-loc-group name="url" :label="__('Url')" :value="old('url', $banner->getTranslations('url'))"
                                required></x-forms.text-loc-group>

        <x-forms.textarea-loc-group name="text" :label="__('Text')"
                                    :value="old('text', $banner->getTranslations('text'))"></x-forms.textarea-loc-group>


        <x-forms.single-image-upload name="image" :label="__('Image')"
                                     :value="$banner->image"
                                     :preview="$banner->image ? $banner->image_url : ''"
                                     imgstyle="height: 200px;"/>

        <x-forms.text-loc-group name="image_alt" :label="__('Image Alt')"
                                :value="old('image_alt', $banner->getTranslations('image_alt'))"
        ></x-forms.text-loc-group>


        <x-forms.text-loc-group name="image_title" :label="__('Image Title')"
                                :value="old('image_title', $banner->getTranslations('image_title'))"
        ></x-forms.text-loc-group>


        <x-forms.switch-group name="show_price" :label="__('Show Price')" :active="$banner->show_price"/>


        <x-forms.text-group :label="__('Price')" name="price" :value="old('price', $banner->price)"/>
        <x-forms.select-group name="currency" :label="__('Currency')" :value="old('currency', $banner->currency)"
                              :options="currency_options()"></x-forms.select-group>

        <x-forms.text-loc-group name="price_comment" :label="__('Comment')"
                                :value="old('price_comment', $banner->getTranslations('price_comment'))"
        ></x-forms.text-loc-group>

        <x-forms.text-loc-group name="label" :label="__('Label')"
                                :value="old('label', $banner->getTranslations('label'))"></x-forms.text-loc-group>

        <x-forms.text-group type="color" :label="__('Color')" name="color" :value="old('color', $banner->color)"/>

        <x-forms.switch-group name="published" :label="__('Published')" :active="$banner->published"/>
    </x-slot>
</x-bootstrap.card>

