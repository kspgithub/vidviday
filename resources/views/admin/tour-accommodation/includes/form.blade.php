<x-forms.select-group label="Садиба" name="accommodation_id"
                      :value="old('accommodation_id', $accomm->accommodation_id)"
                      :options="$accommodations"
/>

<x-forms.text-group name="title" :label="__('Title')" :value="old('title', $accomm->title)" maxlength="100"
                    required></x-forms.text-group>

<x-forms.textarea-group :label="__('Text')" name="text"
                        :value="old('text', $accomm->text)" maxlength="100"
                        required></x-forms.textarea-group>
